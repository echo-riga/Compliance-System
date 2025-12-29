// var labels = [];
let detectedFaces = [];
let sendingData = false;
function markAttendance(detectedFaces) {
}



function updateOtherElements() {
    const video = document.getElementById("video");
    const videoContainer = document.querySelector(".video-container");
    const startButton = document.getElementById("startButton");
    let webcamStarted = false;
    let modelsLoaded = false;

    // Load face-api.js models
    Promise.all([
      faceapi.nets.ssdMobilenetv1.loadFromUri("http://localhost/annualcompliance/admin/facerecognitionweb/facescan/models"),
      faceapi.nets.faceRecognitionNet.loadFromUri("http://localhost/annualcompliance/admin/facerecognitionweb/facescan/models"),
      faceapi.nets.faceLandmark68Net.loadFromUri("http://localhost/annualcompliance/admin/facerecognitionweb/facescan/models"),
    ]).then(() => {
      modelsLoaded = true;
    });

    // Start Webcam button click event
    startButton.addEventListener("click", async () => {
        videoContainer.style.display = "flex";
        if (!webcamStarted && modelsLoaded) {
            startWebcam();
            webcamStarted = true;
        }
    });

    function startWebcam() {
        navigator.mediaDevices
            .getUserMedia({
                video: true,
                audio: false,
            })
            .then((stream) => {
                video.srcObject = stream;
            })
            .catch((error) => {
                console.error(error);
            });
    }

    // Load labeled face descriptions from 'labels/registrationNumbers'
    async function getLabeledFaceDescriptions() {
        const labeledDescriptors = [];

        for (const label of labels) {
            const descriptions = [];
            for (let i = 1; i <= 2; i++) {
                try {
                    const img = await faceapi.fetchImage(`./labels/${label}/${i}.png`);
                    const detections = await faceapi
                        .detectSingleFace(img)
                        .withFaceLandmarks()
                        .withFaceDescriptor();

                    if (detections) {
                        descriptions.push(detections.descriptor);
                    }


                    
                } catch (error) {
                    console.error(`Error processing ${label}/${i}.png:`, error);
                }
            }
            if (descriptions.length > 0) {
                detectedFaces.push(label);
                labeledDescriptors.push(new faceapi.LabeledFaceDescriptors(label, descriptions));
            }
        }

        return labeledDescriptors;
    }

    video.addEventListener("play", async () => {
        const labeledFaceDescriptors = await getLabeledFaceDescriptions();
        const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors);

        const canvas = faceapi.createCanvasFromMedia(video);
        videoContainer.appendChild(canvas);

        const displaySize = { width: video.width, height: video.height };
        faceapi.matchDimensions(canvas, displaySize);

        setInterval(async () => {
            const detections = await faceapi
                .detectAllFaces(video)
                .withFaceLandmarks()
                .withFaceDescriptors();

            const resizedDetections = faceapi.resizeResults(detections, displaySize);
            canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);

            const results = resizedDetections.map((d) => {
                return faceMatcher.findBestMatch(d.descriptor);
            });


            detectedFaces = results.map(result => result.label);
            markAttendance(detectedFaces);
            results.forEach((result, i) => {

                const box = resizedDetections[i].detection.box;
                const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString(), 
                boxColor: 'red', 
        lineWidth: 2 });
                drawBox.draw(canvas);


                $.ajax({
                    url: "login_by_code.php",
                    type: 'POST',
                    data: {
                        fullname: result.label,
                    },
                    success: function(data){
                        window.location.href = '../../dashboard.php';
                          // Log the response from PHP
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                    }
                });


                
            });
        }, 100);
    });
}
