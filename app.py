from flask import Flask, request, jsonify
from flask_cors import CORS
from deepface import DeepFace
import cv2
import numpy as np
import mysql.connector
import json
import base64
import io
from PIL import Image
import traceback
from typing import List, Dict, Any, Optional

app = Flask(__name__)

# ✅ FIXED: Single CORS configuration - no duplicate headers
CORS(app, 
     origins=["http://localhost", "http://127.0.0.1", "http://localhost:80"],
     methods=["GET", "POST", "PUT", "DELETE", "OPTIONS"],
     allow_headers=["Content-Type", "Authorization", "X-Requested-With"],
     supports_credentials=True)

# Database Configuration
DB_CONFIG = {
    'host': 'localhost',
    'user': 'root',
    'password': '',
    'database': 'annualcompliance'
}

# Face Recognition Configuration
FACE_CONFIG = {
    'model_name': 'ArcFace',
    'detector_backend': 'mtcnn',
    'distance_metric': 'cosine',
    'threshold': 0.4,
    'min_frames': 5,
    'max_frames': 20,
    'enable_face_enhancement': True
}

class FaceRecognitionAPI:
    def __init__(self):
        self.db_config = DB_CONFIG
        self.face_config = FACE_CONFIG
        print(f"Initialized Face Recognition with {FACE_CONFIG['model_name']} model")
    
    def get_db_connection(self):
        """Get database connection"""
        try:
            return mysql.connector.connect(**self.db_config)
        except Exception as e:
            print(f"Database connection error: {e}")
            raise
    
    def enhance_face_quality(self, image: np.ndarray) -> np.ndarray:
        """Enhance face image quality for better recognition"""
        try:
            # Convert to LAB color space
            lab = cv2.cvtColor(image, cv2.COLOR_RGB2LAB)
            l, a, b = cv2.split(lab)
            
            # Apply CLAHE to L channel
            clahe = cv2.createCLAHE(clipLimit=2.0, tileGridSize=(8, 8))
            l_enhanced = clahe.apply(l)
            
            # Merge back and convert to RGB
            lab_enhanced = cv2.merge([l_enhanced, a, b])
            enhanced = cv2.cvtColor(lab_enhanced, cv2.COLOR_LAB2RGB)
            
            return enhanced
        except Exception as e:
            print(f"Face enhancement error: {e}")
            return image
    
    def base64_to_image(self, image_data: str) -> Optional[np.ndarray]:
        """Convert base64 image data to numpy array"""
        try:
            if image_data.startswith('data:image'):
                image_data = image_data.split(',')[1]
            
            image_bytes = base64.b64decode(image_data)
            image = Image.open(io.BytesIO(image_bytes))
            
            # Convert to RGB if necessary
            if image.mode != 'RGB':
                image = image.convert('RGB')
                
            return np.array(image)
        except Exception as e:
            print(f"Image conversion error: {e}")
            return None
    
    def process_single_frame(self, image_data: str) -> Optional[List[float]]:
        """Process single frame and extract face embedding with relaxed detection"""
        try:
            # Convert base64 to image
            image = self.base64_to_image(image_data)
            if image is None:
                print("Failed to convert base64 to image")
                return None
            
            # Enhance image quality if enabled
            if self.face_config['enable_face_enhancement']:
                image = self.enhance_face_quality(image)
            
            # Try with relaxed face detection first
            try:
                embedding_objs = DeepFace.represent(
                    img_path=image,
                    model_name=self.face_config['model_name'],
                    detector_backend=self.face_config['detector_backend'],
                    enforce_detection=False,
                    align=True
                )
                
                if embedding_objs and len(embedding_objs) > 0:
                    print(f"✓ Face detected and embedding generated")
                    return embedding_objs[0]['embedding']
                else:
                    print("✗ No face detected in frame (enforce_detection=False)")
                    return None
                    
            except Exception as e:
                print(f"DeepFace processing error: {e}")
                return None
            
        except Exception as e:
            print(f"Frame processing error: {e}")
            return None
    
    def process_multiple_frames(self, frames: List[str]) -> Optional[List[float]]:
        """Process multiple frames and return average embedding"""
        embeddings = []
        successful_frames = 0
        
        print(f"Starting to process {len(frames)} frames...")
        
        for i, frame_data in enumerate(frames):
            print(f"Processing frame {i+1}/{len(frames)}")
            embedding = self.process_single_frame(frame_data)
            
            if embedding is not None:
                embeddings.append(embedding)
                successful_frames += 1
                print(f"✓ Successfully processed frame {i+1}")
            else:
                print(f"✗ Failed to process frame {i+1}")
            
            # Stop if we have enough good frames
            if len(embeddings) >= self.face_config['max_frames']:
                break
        
        print(f"Successfully processed {successful_frames} out of {len(frames)} frames")
        
        if len(embeddings) < self.face_config['min_frames']:
            print(f"❌ Not enough frames with faces detected. Got {len(embeddings)}, need {self.face_config['min_frames']}")
            return None
        
        # Calculate average embedding
        avg_embedding = np.mean(embeddings, axis=0).tolist()
        print(f"✅ Successfully generated average embedding from {len(embeddings)} frames")
        return avg_embedding
    
    def calculate_similarity(self, embedding1: List[float], embedding2: List[float]) -> float:
        """Calculate cosine similarity between two embeddings"""
        try:
            emb1 = np.array(embedding1)
            emb2 = np.array(embedding2)
            
            # Normalize embeddings
            emb1 = emb1 / np.linalg.norm(emb1)
            emb2 = emb2 / np.linalg.norm(emb2)
            
            # Calculate cosine similarity
            similarity = np.dot(emb1, emb2)
            return float(similarity)
        except Exception as e:
            print(f"Similarity calculation error: {e}")
            return 0.0
    
    def get_all_face_embeddings(self) -> Dict[int, List[float]]:
        """Get all face embeddings from database"""
        connection = self.get_db_connection()
        cursor = connection.cursor(dictionary=True)
        
        try:
            cursor.execute("SELECT users_id, face_value FROM users WHERE face_value IS NOT NULL AND face_value != ''")
            results = cursor.fetchall()
            
            embeddings = {}
            for row in results:
                try:
                    if row['face_value'] and row['face_value'].strip():
                        embeddings[row['users_id']] = json.loads(row['face_value'])
                except Exception as e:
                    print(f"Error loading embedding for user {row['users_id']}: {e}")
                    continue
            
            print(f"Loaded {len(embeddings)} face embeddings from database")
            return embeddings
            
        finally:
            cursor.close()
            connection.close()
    
    def find_best_match(self, query_embedding: List[float]) -> Dict[str, Any]:
        """Find the best matching user in database"""
        user_embeddings = self.get_all_face_embeddings()
        
        if not user_embeddings:
            print("❌ No face embeddings found in database")
            return {'found': False, 'message': 'No registered users found'}
        
        print(f"🔍 Checking against {len(user_embeddings)} stored face embeddings...")
        
        best_match = None
        best_similarity = 0
        
        for user_id, stored_embedding in user_embeddings.items():
            similarity = self.calculate_similarity(query_embedding, stored_embedding)
            print(f"   User {user_id}: similarity = {similarity:.3f}")
            
            if similarity > best_similarity:
                best_similarity = similarity
                best_match = user_id
        
        # Check if best match meets threshold
        threshold_similarity = 1 - self.face_config['threshold']
        print(f"📊 Best similarity: {best_similarity:.3f}, Threshold: {threshold_similarity:.3f}")
        
        if best_match and best_similarity >= threshold_similarity:
            print(f"✅ MATCH FOUND: Face matches user {best_match} with similarity {best_similarity:.3f}")
            return {
                'found': True,
                'user_id': best_match,
                'similarity': best_similarity,
                'verified': True
            }
        else:
            print(f"❌ No match found (best similarity: {best_similarity:.3f} < threshold: {threshold_similarity:.3f})")
            return {
                'found': False,
                'best_similarity': best_similarity,
                'message': f'No matching user found (best similarity: {best_similarity:.3f}, required: {threshold_similarity:.3f})'
            }
    
    def get_user_by_id(self, user_id: int) -> Optional[Dict[str, Any]]:
        """Get user by ID"""
        connection = self.get_db_connection()
        cursor = connection.cursor(dictionary=True)
        
        try:
            cursor.execute("SELECT * FROM users WHERE users_id = %s", (user_id,))
            user = cursor.fetchone()
            if user:
                print(f"📋 Found user: {user.get('email', 'Unknown')} (ID: {user_id})")
            else:
                print(f"❌ User not found: {user_id}")
            return user
        finally:
            cursor.close()
            connection.close()
    
    def register_or_update_user(self, user_data: Dict[str, Any], face_embedding: List[float]) -> Dict[str, Any]:
        """Register new user or update existing user with face embedding"""
        connection = self.get_db_connection()
        cursor = connection.cursor()
        
        try:
            email = user_data.get('email')
            fullname = user_data.get('fullname', '')
            employeeid = user_data.get('employeeid', '')
            firstname = user_data.get('firstname', '')
            lastname = user_data.get('lastname', '')
            user_type = user_data.get('type', 'user')
            
            # Check if user already exists
            cursor.execute("SELECT users_id FROM users WHERE email = %s", (email,))
            existing_user = cursor.fetchone()
            
            if existing_user:
                # Update existing user
                user_id = existing_user[0]
                cursor.execute("""
                    UPDATE users 
                    SET fullname = %s, employeeid = %s, firstname = %s, lastname = %s, type = %s, face_value = %s
                    WHERE users_id = %s
                """, (fullname, employeeid, firstname, lastname, user_type, json.dumps(face_embedding), user_id))
                
                connection.commit()
                print(f"✅ Updated user {email} with face embedding")
                return {
                    'success': True,
                    'message': 'User updated successfully with face data',
                    'user_id': user_id,
                    'action': 'updated'
                }
            else:
                # Insert new user
                cursor.execute("""
                    INSERT INTO users (email, fullname, employeeid, firstname, lastname, type, face_value)
                    VALUES (%s, %s, %s, %s, %s, %s, %s)
                """, (email, fullname, employeeid, firstname, lastname, user_type, json.dumps(face_embedding)))
                
                user_id = cursor.lastrowid
                connection.commit()
                print(f"✅ Registered new user {email} with face embedding")
                return {
                    'success': True,
                    'message': 'User registered successfully',
                    'user_id': user_id,
                    'action': 'registered'
                }
                
        except Exception as e:
            connection.rollback()
            print(f"❌ Database error: {e}")
            return {
                'success': False,
                'message': f'Database operation failed: {str(e)}'
            }
        finally:
            cursor.close()
            connection.close()

# Initialize the API
face_api = FaceRecognitionAPI()

@app.route('/api/health', methods=['GET'])
def health_check():
    return jsonify({
        'status': 'healthy', 
        'message': 'Face Recognition API is running',
        'model': FACE_CONFIG['model_name'],
        'threshold': FACE_CONFIG['threshold']
    })

@app.route('/api/login', methods=['POST', 'OPTIONS'])
def login_user():
    """Login user using face recognition"""
    if request.method == 'OPTIONS':
        return '', 200
        
    try:
        data = request.get_json()
        
        if not data:
            return jsonify({'success': False, 'message': 'No data provided'}), 400
        
        frames = data.get('frames', [])
        
        if len(frames) < FACE_CONFIG['min_frames']:
            return jsonify({
                'success': False, 
                'message': f'At least {FACE_CONFIG["min_frames"]} frames are required'
            }), 400
        
        print(f"🔄 Processing {len(frames)} frames for login...")
        avg_embedding = face_api.process_multiple_frames(frames)
        
        if avg_embedding is None:
            return jsonify({
                'success': False, 
                'message': 'No faces detected in the provided frames'
            }), 400
        
        print("🔍 Finding matching user for login...")
        match_result = face_api.find_best_match(avg_embedding)
        
        if match_result['found']:
            user = face_api.get_user_by_id(match_result['user_id'])
            if user:
                print(f"✅ Login successful for user: {user.get('email', 'Unknown')}")
                return jsonify({
                    'success': True,
                    'message': 'Login successful',
                    'user': {
                        'users_id': user['users_id'],
                        'email': user['email'],
                        'fullname': user['fullname'],
                        'type': user['type'],
                        'employeeid': user['employeeid'],
                        'firstname': user['firstname'],
                        'lastname': user['lastname']
                    },
                    'similarity': match_result['similarity'],
                    'verified': True
                })
            else:
                return jsonify({
                    'success': False,
                    'message': 'User account not found'
                }), 404
        else:
            return jsonify({
                'success': False,
                'message': 'No matching account found. Please register first.',
                'best_similarity': match_result.get('best_similarity', 0)
            }), 401
        
    except Exception as e:
        print(f"❌ Login error: {traceback.format_exc()}")
        return jsonify({
            'success': False,
            'message': f'Login failed: {str(e)}'
        }), 500

@app.route('/api/register', methods=['POST', 'OPTIONS'])
def register_or_update_user():
    """Unified endpoint for user registration and updates"""
    if request.method == 'OPTIONS':
        return '', 200
        
    try:
        data = request.get_json()
        
        if not data:
            return jsonify({'success': False, 'message': 'No data provided'}), 400
        
        frames = data.get('frames', [])
        user_data = data.get('user_data', {})
        
        if not user_data.get('email'):
            return jsonify({'success': False, 'message': 'Email is required'}), 400
        
        if len(frames) < FACE_CONFIG['min_frames']:
            return jsonify({
                'success': False, 
                'message': f'At least {FACE_CONFIG["min_frames"]} frames are required'
            }), 400
        
        print(f"🔄 Processing {len(frames)} frames for registration/update...")
        avg_embedding = face_api.process_multiple_frames(frames)
        
        if avg_embedding is None:
            return jsonify({
                'success': False, 
                'message': 'Not enough faces detected in the provided frames. Please ensure your face is clearly visible.'
            }), 400
        
        # Check if this face already belongs to another user
        print("🔍 Checking for duplicate faces...")
        match_result = face_api.find_best_match(avg_embedding)
        
        if match_result['found']:
            existing_user = face_api.get_user_by_id(match_result['user_id'])
            if existing_user and existing_user.get('email') != user_data.get('email'):
                print(f"🚫 BLOCKING REGISTRATION: Face belongs to {existing_user.get('email')} but trying to register as {user_data.get('email')}")
                return jsonify({
                    'success': False,
                    'message': f'Face already registered for another user: {existing_user.get("email", "Unknown")}',
                    'similarity': match_result['similarity'],
                    'existing_user_id': match_result['user_id']
                }), 409
        
        # Register or update user with face embedding
        result = face_api.register_or_update_user(user_data, avg_embedding)
        
        if result['success']:
            return jsonify({
                'success': True,
                'message': result['message'],
                'user_id': result['user_id'],
                'action': result['action'],
                'frames_processed': len(frames),
                'face_embedding_stored': True
            })
        else:
            return jsonify({
                'success': False,
                'message': result['message']
            }), 500
        
    except Exception as e:
        print(f"❌ Registration/Update error: {traceback.format_exc()}")
        return jsonify({
            'success': False,
            'message': f'Operation failed: {str(e)}'
        }), 500

if __name__ == '__main__':
    print("🚀 Starting Face Recognition API...")
    print(f"📊 Using model: {FACE_CONFIG['model_name']}")
    print(f"🎯 Similarity threshold: {1 - FACE_CONFIG['threshold']:.3f}")
    print(f"📷 Minimum frames required: {FACE_CONFIG['min_frames']}")
    app.run(debug=False, host='0.0.0.0', port=5000)