<section class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-center mb-6">Video Capture</h1>
    <div id="video-area" class="flex flex-col items-center">
        <input type="file" id="photo" class="hidden" />
        <video id="video" width="640" height="480" autoplay class="hidden rounded-lg mt-4"></video>
        <div class="mt-4 flex space-x-4">
            <button id="capture-btn" type="button" class="bg-sky-500 text-white px-3 py-2 rounded-md">
                Capture
            </button>
            <!-- 音声のON/OFF切替ボタン -->
            <button id="toggleAudioBtn" type="button" class="bg-blue-500 text-white px-3 py-2 rounded-md">
                Audio ON
            </button>
        </div>
    </div>
    <!-- 合成用 Canvas 表示エリア -->
    <div id="canvas-area" class="flex justify-center mt-6"></div>
</section>

<!-- カウントダウン用オーバーレイ -->
<div id="countdownOverlay" class="hidden fixed inset-0 flex items-center justify-center">
    <div id="countdownCircle"
        class="w-32 h-32 rounded-full bg-sky-500 bg-opacity-100 border-4 border-white flex items-center justify-center text-6xl text-white">
    </div>
</div>


<!-- ローディングモーダル -->
<div id="loadingModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <p class="text-lg font-semibold">Processing...</p>
    </div>
</div>

<!-- 画像表示モーダル（キャプチャ後の画像を表示） -->
<div id="imageModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white p-4 rounded-lg flex flex-col items-center">
        <img id="capturedImage" src="" alt="Captured Image" class="max-w-full max-h-full">
        <div class="mt-4 flex space-x-4">
            <button id="upload-btn" class="bg-green-500 text-white px-4 py-2 rounded">
                Upload
            </button>
            <button id="closeImageModal" class="text-gray-500 px-4 py-2 rounded">
                Close
            </button>
        </div>
    </div>
</div>


<script src="js/camera.js" defer></script>