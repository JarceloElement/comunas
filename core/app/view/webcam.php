<div class="row justify-content-center">
    <div class="col-md-12">
        <!-- <div class="col-md-4"> -->
        <div class="row justify-content-center">
            <div class="form-group">
                <div class="row justify-content-center">
                    <video id="videoElement" style="max-width:400px;" autoplay></video>
                </div>
                <!-- <button id="startButton">Start Webcam</button> -->
                <br>
                <div class="row justify-content-center">
                    <button class="btn btn-primary" id="captureButton">Capturar</button>
                </div>
                <br>
                <canvas id="canvasElement" style="display:none;"></canvas>
                <div class="row justify-content-center">
                    <img id="photoElement" style="display:none;max-width:300px;">
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const videoElement = document.getElementById('videoElement');
    const canvasElement = document.getElementById('canvasElement');
    const photoElement = document.getElementById('photoElement');
    // const startButton = document.getElementById('startButton');
    const captureButton = document.getElementById('captureButton');

    let stream;

    async function startWebcam() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({
                video: true
            });
            videoElement.srcObject = stream;
            // startButton.disabled = true;
            captureButton.disabled = false;
        } catch (error) {
            console.error('Error accessing webcam:', error);
        }
    }

    // startButton.addEventListener('click', startWebcam);

    function capturePhoto() {
        canvasElement.width = videoElement.videoWidth;
        canvasElement.height = videoElement.videoHeight;
        canvasElement.getContext('2d').drawImage(videoElement, 0, 0);
        const photoDataUrl = canvasElement.toDataURL('image/jpeg');
        photoElement.src = photoDataUrl;
        photoElement.style.display = 'block';
    }

    captureButton.addEventListener('click', capturePhoto);

    startWebcam();
</script>