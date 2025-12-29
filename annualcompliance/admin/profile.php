<div class="modal fade" id="profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Profile</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/profileController.php" enctype="multipart/form-data" id="profileForm">
                <div class="form-group" style="display:<?php if ($_SESSION['type'] != 0) {
                  echo "none";
                } else { echo "block"; } ?>">
                </div>
                <div class="form-group">
                  <input type="hidden" name="user_id" id="user_id">
                  <input type="hidden" name="face_frames" id="face_frames">
                    <label for="email" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="email" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-3 control-label">Contact</label>
                    <div class="col-sm-9">
                      <input class="form-control" id="contact" name="contact" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9"> 
                      <input type="password" class="form-control" id="password" name="password" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="firstname" name="firstname" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="lastname" name="lastname" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Middlename</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="middlename" name="middlename" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="address" name="address" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Questionnaire</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="questionnaire" name="questionnaire">
                        <option value="">-- Select a Security Question --</option>
                        <option value="What is your full name?">What is your full name?</option>
                        <option value="What is your favorite color?">What is your favorite color?</option>
                        <option value="What is your favorite food?">What is your favorite food?</option>
                        <option value="What is your favorite number?">What is your favorite number?</option>
                        <option value="What is the name of your first pet?">What is the name of your first pet?</option>
                        <option value="What city were you born in?">What city were you born in?</option>
                        <option value="What is your favorite movie or TV show?">What is your favorite movie or TV show?</option>
                        <option value="What is your favorite book or author?">What is your favorite book or author?</option>
                        <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                        <option value="What is the make and model of your first vehicle?">What is the make and model of your first vehicle?</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Answer</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="answer" name="answer">
                    </div>
                </div>

                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo profile:</label>

                    <div class="col-sm-9">
                      <input type="file" name="img" id="profileImage">
                    </div>
                </div>
           
                <div class="form-group">
                    <h3 for="photo" class="col-sm-12" style="font-weight: bold;">Face Recognition Setup</h3>
                </div>

                <!-- Camera Capture Section -->
                <div class="form-group">
                    <label class="col-sm-3 control-label">Face Capture:</label>
                    <div class="col-sm-9">
                        <div id="cameraSection">
                            <!-- Model Loading Indicator -->
                            <div id="modelLoading" class="alert alert-info">
                                <i class="fa fa-spinner fa-spin"></i> Loading face detection model...
                            </div>
                            
                            <div class="text-center" id="videoContainer">
                                <video id="video" width="320" height="240" autoplay style="border: 2px solid #ddd; border-radius: 5px;"></video>
                                <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
                            </div>
                            
                            <!-- Face Validation Box -->
                            <div class="face-validation-box">
                                <div class="validation-message validation-info" id="faceValidationMessage">Camera not started</div>
                                <div id="faceValidationDetails">Click "Start Camera" to begin face detection</div>
                            </div>
                            
                            <div class="text-center mt-2">
                                <button type="button" id="startCamera" class="btn btn-primary btn-sm" disabled>
                                    <i class="fa fa-camera"></i> Start Camera
                                </button>
                                <button type="button" id="captureFaces" class="btn btn-success btn-sm" style="display:none;">
                                    <i class="fa fa-camera-retro"></i> Capture 20 Frames
                                </button>
                                <button type="button" id="stopCamera" class="btn btn-danger btn-sm" style="display:none;">
                                    <i class="fa fa-stop"></i> Stop Camera
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
                </div>

                <hr>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="saveadmin" id="saveButton">
                <i class="fa fa-check-square-o"></i> Save
              </button>
              </form>
            </div>
        </div>
    </div>
</div>

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
async function loadFaceDetectionModel() {
    try {
        showStatus('Loading face detection model...', 'info');
        
        // Load the BlazeFace model
        model = await blazeface.load();
        isModelLoaded = true;
        
        // Enable start camera button
        document.getElementById('startCamera').disabled = false;
        document.getElementById('modelLoading').innerHTML = '<i class="fa fa-check"></i> Face detection model loaded successfully!';
        document.getElementById('modelLoading').className = 'alert alert-success';
        
        showStatus('Face detection model loaded successfully!', 'success');
        
    } catch (error) {
        console.error('Error loading face detection model:', error);
        document.getElementById('modelLoading').innerHTML = '<i class="fa fa-warning"></i> Face detection model failed to load. Basic validation only.';
        document.getElementById('modelLoading').className = 'alert alert-warning';
        showStatus('Warning: Face detection model not loaded. Basic validation only.', 'warning');
    }
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    loadFaceDetectionModel();
});

document.getElementById('startCamera').addEventListener('click', startCamera);
document.getElementById('stopCamera').addEventListener('click', stopCamera);
document.getElementById('captureFaces').addEventListener('click', captureMultipleFrames);
document.getElementById('profileForm').addEventListener('submit', handleFormSubmit);

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
        document.getElementById('captureFaces').style.display = 'inline-block';
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
    document.getElementById('captureFaces').style.display = 'none';
    document.getElementById('stopCamera').style.display = 'none';
    document.getElementById('captureProgress').style.display = 'none';
    
    // Reset validation message
    updateFaceValidationMessage('Camera not started', 'Click "Start Camera" to begin face detection', 'info');
    
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
            } else {
                const face = predictions[0];
                const confidence = (face.probability[0] * 100).toFixed(1);
                
                updateFaceValidationMessage(
                    'Face detected', 
                    `Confidence: ${confidence}% - Ready for capture`, 
                    'success'
                );
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

async function captureMultipleFrames() {
    if (isCapturing) return;
    
    capturedFrames = [];
    isCapturing = true;
    
    const progressBar = document.querySelector('.progress-bar');
    const frameCount = document.getElementById('frameCount');
    const captureProgress = document.getElementById('captureProgress');
    
    captureProgress.style.display = 'block';
    document.getElementById('captureFaces').disabled = true;
    
    showStatus('Starting face capture with validation... Please look directly at the camera.', 'info');
    
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
    document.getElementById('captureFaces').disabled = false;
    
    // Final validation summary
    if (validFramesCount >= minValidFrames) {
        showStatus(`✅ Successfully captured ${validFramesCount} valid frames! You can now save your profile.`, 'success');
    } else {
        showStatus(`❌ Only ${validFramesCount} valid frames captured (minimum ${minValidFrames} required). Please try again.`, 'error');
        capturedFrames = []; // Clear invalid frames
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

async function handleFormSubmit(event) {
    event.preventDefault();
    
    const minRequiredFrames = 15;
    
    if (capturedFrames.length < minRequiredFrames) {
        showStatus(`Please capture at least ${minRequiredFrames} valid face frames before saving.`, 'error');
        return false;
    }
    
    // Store captured frames in hidden input
    document.getElementById('face_frames').value = JSON.stringify(capturedFrames);
    showStatus(`Saving profile with ${capturedFrames.length} face frames...`, 'info');
    
    // Disable save button during processing
    const saveButton = document.getElementById('saveButton');
    saveButton.disabled = true;
    saveButton.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Saving...';
    
    try {
        // Create FormData from the form
        const formData = new FormData(document.getElementById('profileForm'));
        
        console.log('Submitting form...');
        
        // Submit via AJAX
        const response = await fetch('../controller/profileController.php', {
            method: 'POST',
            body: formData
        });
        
        console.log('Response status:', response.status);
        
        // Get the raw text first to debug
        const responseText = await response.text();
        console.log('Raw response:', responseText);
        
        // Try to parse as JSON
        let result;
        try {
            result = JSON.parse(responseText);
            console.log('Parsed result:', result);
        } catch (parseError) {
            console.error('JSON parse error:', parseError);
            throw new Error('Invalid JSON response from server');
        }
        
        if (result.success) {
            showStatus('✅ ' + result.message, 'success');
            
            // Show success and close modal
            setTimeout(() => {
                $('#profile').modal('hide');
                showMainAlert('success', result.message);
                // Reload to show updated data
                setTimeout(() => location.reload(), 1500);
            }, 2000);
            
        } else {
            if (result.duplicate_face) {
                showDuplicateFaceModal(result.message, result.similarity);
                showStatus('❌ ' + result.message, 'error');
            } else {
                showStatus('❌ ' + result.message, 'error');
            }
        }
        
    } catch (error) {
        console.error('Submission error:', error);
        showStatus('❌ Error: ' + error.message, 'error');
    } finally {
        // Re-enable save button
        saveButton.disabled = false;
        saveButton.innerHTML = '<i class="fa fa-check-square-o"></i> Save';
    }
    
    return false;
}

function showDuplicateFaceModal(message, similarity) {
    const modalHtml = `
        <div class="modal fade" id="duplicateModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Face Already Registered</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">
                            <p>${message}</p>
                            <p><strong>Similarity: ${(similarity * 100).toFixed(1)}%</strong></p>
                        </div>
                        <p>This face is already registered with another account. Please use a different account or contact support.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    $('#duplicateModal').remove();
    $('body').append(modalHtml);
    $('#duplicateModal').modal('show');
}

function showMainAlert(type, message) {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const icon = type === 'success' ? 'fa-check' : 'fa-warning';
    
    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible" style="position: fixed; top: 70px; right: 20px; z-index: 9999; min-width: 300px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa ${icon}"></i> ${type === 'success' ? 'Success!' : 'Error!'}</h4>
            ${message}
        </div>
    `;
    
    $('.alert-dismissible').remove();
    $('body').append(alertHtml);
    
    setTimeout(() => {
        $('.alert-dismissible').fadeOut();
    }, 5000);
}

function showStatus(message, type) {
    const statusDiv = document.getElementById('captureStatus');
    const className = type === 'error' ? 'alert alert-danger' : 
                     type === 'success' ? 'alert alert-success' : 
                     type === 'warning' ? 'alert alert-warning' : 
                     'alert alert-info';
    
    statusDiv.innerHTML = `<div class="${className}">${message}</div>`;
}
</script>

<style>
#cameraSection {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 5px;
    border: 1px solid #dee2e6;
}

.progress {
    height: 10px;
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

/* For the main page alerts */
.alert-dismissible {
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    border-radius: 6px;
}

/* For duplicate modal */
.modal-header.bg-warning {
    background-color: #f39c12;
    color: white;
}
</style>