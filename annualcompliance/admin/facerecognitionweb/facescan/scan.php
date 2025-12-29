<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Face Recognition Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #ecf0f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
        }
        .login-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 30px;
            width: 100%;
            max-width: 500px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .camera-container {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #dee2e6;
            margin-bottom: 20px;
        }
        .progress {
            height: 10px;
            margin-bottom: 5px;
        }
        .alert {
            padding: 8px;
            margin-bottom: 0;
            font-size: 12px;
        }
        .face-validation-box {
            border: 2px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-top: 10px;
            background-color: #f9f9f9;
            min-height: 80px;
        }
        .validation-message {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 16px;
        }
        .validation-success {
            color: #28a745;
        }
        .validation-error {
            color: #dc3545;
        }
        .validation-warning {
            color: #ffc107;
        }
        .validation-info {
            color: #17a2b8;
        }
        #videoContainer {
            position: relative;
            display: inline-block;
        }
        .face-box {
            position: absolute;
            border: 2px solid #28a745;
            background-color: rgba(40, 167, 69, 0.1);
            pointer-events: none;
        }
        .multiple-face-warning {
            border-color: #dc3545;
            background-color: rgba(220, 53, 69, 0.1);
        }
        .model-loading {
            background-color: #d1ecf1;
            color: #0c5460;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h3><i class="fas fa-user"></i> Face Recognition Login</h3>
            <p class="text-muted">Login using your face</p>
        </div>

        <!-- Model Loading Indicator -->
        <div id="modelLoading" class="model-loading">
            <i class="fas fa-spinner fa-spin"></i> Loading face detection model...
        </div>

        <!-- Camera Capture Section -->
        <div class="camera-container">
            <div class="text-center" id="videoContainer">
                <video id="video" width="320" height="240" autoplay muted style="border: 2px solid #ddd; border-radius: 5px; background: #000;"></video>
                <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
            </div>
            
            <!-- Face Validation Box -->
            <div class="face-validation-box">
                <div class="validation-message validation-info" id="faceValidationMessage">Camera not started</div>
                <div id="faceValidationDetails">Click "Start Camera" to begin face detection</div>
            </div>
            
            <div class="text-center mt-2">
                <button type="button" id="startCamera" class="btn btn-primary btn-sm" disabled>
                    <i class="fas fa-camera"></i> Start Camera
                </button>
                <button type="button" id="loginButton" class="btn btn-success btn-sm" style="display:none;">
                    <i class="fas fa-sign-in-alt"></i> Login with Face
                </button>
                <button type="button" id="stopCamera" class="btn btn-danger btn-sm" style="display:none;">
                    <i class="fas fa-stop"></i> Stop Camera
                </button>
            </div>
            <div id="captureProgress" class="mt-2" style="display:none;">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div>
                </div>
                <small class="text-muted">Capturing: <span id="frameCount">0</span>/20 frames</small>
            </div>
            <div id="captureStatus" class="mt-2"></div>
        </div>

     
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- TensorFlow.js and BlazeFace -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@3.18.0/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/blazeface@0.0.7/dist/blazeface.min.js"></script>

    <script>
        let stream = null;
        let capturedFrames = [];
        let isCapturing = false;
        let faceDetectionInterval = null;
        let model = null;
        let isModelLoaded = false;

        // Load TensorFlow.js BlazeFace model
       // Load TensorFlow.js BlazeFace model
async function loadFaceDetectionModel() {
    try {
        // Show loading status only in the main status area, not in two places
        showStatus('Loading face detection model...', 'info');
        
        // Load the BlazeFace model
        model = await blazeface.load();
        isModelLoaded = true;
        
        // Enable start camera button
        document.getElementById('startCamera').disabled = false;
        
        // Remove the separate model loading indicator entirely
        document.getElementById('modelLoading').style.display = 'none';
        
        showStatus('Face detection model loaded successfully! Camera ready.', 'success');
        
    } catch (error) {
        console.error('Error loading face detection model:', error);
        // Hide the loading indicator and show error in main status
        document.getElementById('modelLoading').style.display = 'none';
        showStatus('Face detection unavailable. Basic camera functions only.', 'warning');
    }
}

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadFaceDetectionModel();
        });

        document.getElementById('startCamera').addEventListener('click', startCamera);
        document.getElementById('stopCamera').addEventListener('click', stopCamera);
        document.getElementById('loginButton').addEventListener('click', loginWithFace);

        async function startCamera() {
            try {
                stream = await navigator.mediaDevices.getUserMedia({ 
                    video: { 
                        width: 320, 
                        height: 240,
                        facingMode: 'user' 
                    } 
                });
                
                const video = document.getElementById('video');
                video.srcObject = stream;
                
                document.getElementById('startCamera').style.display = 'none';
                document.getElementById('loginButton').style.display = 'inline-block';
                document.getElementById('stopCamera').style.display = 'inline-block';
                
                showStatus('Camera started successfully. Face detection is active.', 'success');
                
                // Start real-time face detection
                startRealTimeFaceDetection();
                
            } catch (error) {
                console.error('Error accessing camera:', error);
                showStatus('Error accessing camera: ' + error.message, 'error');
            }
        }

        function stopCamera() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }
            
            // Stop real-time face detection
            if (faceDetectionInterval) {
                clearInterval(faceDetectionInterval);
                faceDetectionInterval = null;
            }
            
            const video = document.getElementById('video');
            video.srcObject = null;
            
            document.getElementById('startCamera').style.display = 'inline-block';
            document.getElementById('loginButton').style.display = 'none';
            document.getElementById('stopCamera').style.display = 'none';
            document.getElementById('captureProgress').style.display = 'none';
            
            // Reset validation message
            updateFaceValidationMessage('Camera not started', 'Click "Start Camera" to begin face detection', 'info');
            
            // Clear face boxes
            clearFaceBoxes();
            
            showStatus('Camera stopped.', 'info');
        }

        // Real-time face detection using TensorFlow.js BlazeFace
        function startRealTimeFaceDetection() {
            if (faceDetectionInterval) {
                clearInterval(faceDetectionInterval);
            }
            
            faceDetectionInterval = setInterval(async () => {
                if (!stream || !isModelLoaded) return;
                
                const video = document.getElementById('video');
                
                try {
                    // Perform face detection
                    const predictions = await model.estimateFaces(video, false);
                    
                    // Clear previous face boxes
                    clearFaceBoxes();
                    
                    // Update validation message based on detection results
                    if (predictions.length === 0) {
                        updateFaceValidationMessage(
                            'No face detected', 
                            'Please position your face in the camera view', 
                            'error'
                        );
                    } else if (predictions.length > 1) {
                        updateFaceValidationMessage(
                            'Multiple faces detected', 
                            `Found ${predictions.length} faces. Please ensure only one person is visible.`, 
                            'error'
                        );
                        
                        // Draw boxes around multiple faces
                        predictions.forEach(face => {
                            drawFaceBox(face, true);
                        });
                    } else {
                        const face = predictions[0];
                        const confidence = (face.probability[0] * 100).toFixed(1);
                        
                        updateFaceValidationMessage(
                            'Face detected', 
                            `Confidence: ${confidence}% - Ready for login`, 
                            'success'
                        );
                        
                        // Draw box around the single face
                        drawFaceBox(face, false);
                    }
                } catch (error) {
                    console.error('Face detection error:', error);
                    updateFaceValidationMessage(
                        'Detection error', 
                        'Unable to perform face detection', 
                        'warning'
                    );
                }
            }, 1000); // Check every second
        }

        // Draw a box around detected faces
        function drawFaceBox(face, isMultiple) {
            const videoContainer = document.getElementById('videoContainer');
            const video = document.getElementById('video');
            
            const box = document.createElement('div');
            box.className = isMultiple ? 'face-box multiple-face-warning' : 'face-box';
            
            // Get bounding box coordinates
            const bbox = face.topLeft.concat(face.bottomRight);
            
            // Calculate position relative to video
            const scaleX = video.offsetWidth / video.videoWidth;
            const scaleY = video.offsetHeight / video.videoHeight;
            
            box.style.left = (bbox[0] * scaleX) + 'px';
            box.style.top = (bbox[1] * scaleY) + 'px';
            box.style.width = ((bbox[2] - bbox[0]) * scaleX) + 'px';
            box.style.height = ((bbox[3] - bbox[1]) * scaleY) + 'px';
            
            videoContainer.appendChild(box);
        }

        // Clear all face boxes
        function clearFaceBoxes() {
            const boxes = document.querySelectorAll('.face-box');
            boxes.forEach(box => box.remove());
        }

        // Update the face validation message display
        function updateFaceValidationMessage(title, details, type) {
            const messageElement = document.getElementById('faceValidationMessage');
            const detailsElement = document.getElementById('faceValidationDetails');
            
            messageElement.textContent = title;
            detailsElement.textContent = details;
            
            // Remove all type classes
            messageElement.classList.remove('validation-success', 'validation-error', 'validation-warning', 'validation-info');
            
            // Add appropriate class based on type
            if (type === 'success') {
                messageElement.classList.add('validation-success');
            } else if (type === 'error') {
                messageElement.classList.add('validation-error');
            } else if (type === 'warning') {
                messageElement.classList.add('validation-warning');
            } else {
                messageElement.classList.add('validation-info');
            }
        }

        // Enhanced face detection function for frame capture
        async function detectFace(imageElement) {
            if (!isModelLoaded || !model) {
                // Basic validation without model
                return { hasFace: true, confidence: 1, message: 'Basic validation passed' };
            }
            
            try {
                const predictions = await model.estimateFaces(imageElement, false);
                
                if (predictions.length === 0) {
                    return { 
                        hasFace: false, 
                        confidence: 0, 
                        message: 'No face detected in the frame' 
                    };
                }
                
                if (predictions.length > 1) {
                    return { 
                        hasFace: false, 
                        confidence: 0, 
                        message: `Multiple faces detected (${predictions.length}). Please ensure only one face is visible.` 
                    };
                }
                
                const face = predictions[0];
                const confidence = face.probability[0];
                
                // Check face size and position for quality
                const bbox = face.topLeft.concat(face.bottomRight);
                const width = bbox[2] - bbox[0];
                const height = bbox[3] - bbox[1];
                const faceArea = width * height;
                const frameArea = imageElement.width * imageElement.height;
                const areaRatio = faceArea / frameArea;
                
                if (areaRatio < 0.1) {
                    return { 
                        hasFace: false, 
                        confidence: confidence,
                        message: 'Face is too small. Please move closer to the camera.' 
                    };
                }
                
                if (areaRatio > 0.6) {
                    return { 
                        hasFace: false, 
                        confidence: confidence,
                        message: 'Face is too large. Please move further from the camera.' 
                    };
                }
                
                return { 
                    hasFace: true, 
                    confidence: confidence,
                    message: `Face detected (confidence: ${(confidence * 100).toFixed(1)}%)` 
                };
                
            } catch (error) {
                console.error('Face detection error:', error);
                return { 
                    hasFace: true, 
                    confidence: 1, 
                    message: 'Face detection skipped due to error' 
                };
            }
        }

        async function loginWithFace() {
            if (isCapturing) return;
            
            // Check current face detection status
            const currentStatus = document.getElementById('faceValidationMessage').textContent;
            if (currentStatus === 'No face detected' || currentStatus === 'Multiple faces detected') {
                showStatus('Please ensure only one face is visible before logging in.', 'error');
                return;
            }
            
            capturedFrames = [];
            isCapturing = true;
            
            const progressBar = document.querySelector('.progress-bar');
            const frameCount = document.getElementById('frameCount');
            const captureProgress = document.getElementById('captureProgress');
            const loginButton = document.getElementById('loginButton');
            
            captureProgress.style.display = 'block';
            loginButton.disabled = true;
            loginButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging in...';
            
            showStatus('Starting face capture for login... Please look directly at the camera.', 'info');
            
            const totalFrames = 20;
            const minValidFrames = 15; // Minimum number of valid frames required
            let validFramesCount = 0;
            
            for (let i = 0; i < totalFrames; i++) {
                if (!isCapturing) break;
                
                const captureResult = await captureAndValidateFrame();
                
                if (captureResult.valid) {
                    validFramesCount++;
                    capturedFrames.push(captureResult.frameData);
                }
                
                // Update progress with validation info
                const progress = ((i + 1) / totalFrames) * 100;
                progressBar.style.width = progress + '%';
                frameCount.textContent = `${i + 1}/${totalFrames} (Valid: ${validFramesCount})`;
                
                // Show current frame validation result
                if (captureResult.message) {
                    showStatus(`Frame ${i + 1}: ${captureResult.message}`, 
                              captureResult.valid ? 'success' : 'warning');
                }
                
                // Wait before next capture
                if (i < totalFrames - 1) {
                    await new Promise(resolve => setTimeout(resolve, 200));
                }
            }
            
            isCapturing = false;
            
            // Final validation
            if (validFramesCount >= minValidFrames) {
                showStatus(`✅ Successfully captured ${validFramesCount} valid frames! Authenticating...`, 'success');
                await authenticateUser();
            } else {
                showStatus(`❌ Only ${validFramesCount} valid frames captured (minimum ${minValidFrames} required). Please try again.`, 'error');
                loginButton.disabled = false;
                loginButton.innerHTML = '<i class="fas fa-sign-in-alt"></i> Login with Face';
            }
        }

        async function captureAndValidateFrame() {
            return new Promise(async (resolve) => {
                const video = document.getElementById('video');
                const canvas = document.getElementById('canvas');
                const context = canvas.getContext('2d');
                
                // Set canvas size for better quality
                canvas.width = 640;
                canvas.height = 480;
                
                // Draw current video frame to canvas
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                
                // Convert to image data
                const imageData = canvas.toDataURL('image/jpeg', 0.9);
                
                // Create image element for face detection
                const img = new Image();
                img.src = imageData;
                
                img.onload = async function() {
                    try {
                        const faceResult = await detectFace(img);
                        
                        if (faceResult.hasFace && faceResult.confidence > 0.5) {
                            resolve({
                                valid: true,
                                frameData: imageData,
                                message: faceResult.message
                            });
                        } else {
                            resolve({
                                valid: false,
                                frameData: null,
                                message: faceResult.message
                            });
                        }
                    } catch (error) {
                        console.error('Validation error:', error);
                        resolve({
                            valid: true, // Allow capture even if validation fails
                            frameData: imageData,
                            message: 'Validation skipped'
                        });
                    }
                };
                
                img.onerror = function() {
                    resolve({
                        valid: false,
                        frameData: null,
                        message: 'Failed to process image'
                    });
                };
            });
        }

        async function authenticateUser() {
            try {
                const payload = {
                    frames: capturedFrames
                };

                console.log('Sending login request...');
                
                const response = await fetch('http://localhost:5000/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                console.log('Response status:', response.status);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const result = await response.json();
                console.log('Login result:', result);

                if (result.success) {
                    showStatus('✅ Login successful! Setting up session...', 'success');
                    
                    // ✅ SET PHP SESSION via form submission
                    await setPHPSession(result.user);
                    
                } else {
                    showStatus('❌ ' + result.message, 'error');
                    resetLoginButton();
                }
                
            } catch (error) {
                console.error('Login error:', error);
                showStatus('❌ Login failed: ' + error.message, 'error');
                resetLoginButton();
            }
        }

        // ✅ NEW FUNCTION: Set PHP Session via form submission
        async function setPHPSession(userData) {
            try {
                // Create a hidden form and submit it to set PHP session
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'set_session.php'; // Create this file
                
                // Add user data as hidden inputs
                const fields = ['users_id', 'type', 'email', 'fullname', 'employeeid', 'firstname', 'lastname'];
                fields.forEach(field => {
                    if (userData[field]) {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = field;
                        input.value = userData[field];
                        form.appendChild(input);
                    }
                });
                
                // Add to document and submit
                document.body.appendChild(form);
                form.submit();
                
            } catch (error) {
                console.error('Session setup error:', error);
                showStatus('❌ Session setup failed', 'error');
                resetLoginButton();
            }
        }

        function resetLoginButton() {
            document.getElementById('loginButton').disabled = false;
            document.getElementById('loginButton').innerHTML = '<i class="fas fa-sign-in-alt"></i> Login with Face';
        }

        function showStatus(message, type) {
            const statusDiv = document.getElementById('captureStatus');
            const className = type === 'error' ? 'alert alert-danger' : 
                            type === 'success' ? 'alert alert-success' : 
                            type === 'warning' ? 'alert alert-warning' : 
                            'alert alert-info';
            
            statusDiv.innerHTML = `<div class="${className}">${message}</div>`;
        }

        // Stop camera when leaving page
        window.addEventListener('beforeunload', function() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
        });
    </script>   
</body>
</html>