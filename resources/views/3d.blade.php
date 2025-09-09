<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>3D Model Gallery for Kids</title>
  <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
  
  <!-- Font ceria -->
  <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
  
  <style>
    body { 
      font-family: 'Fredoka One', sans-serif; 
      margin: 0; 
      background: linear-gradient(to bottom, #fceabb, #f8b500);
    }

    /* Navbar */
    nav {
      background: #ffcc00;
      padding: 15px;
      display: flex;
      gap: 15px;
      justify-content: center;
      flex-wrap: wrap;
    }

    nav a {
      color: #333;
      text-decoration: none;
      padding: 12px 20px;
      border-radius: 30px;
      background: white;
      font-weight: bold;
      transition: transform 0.3s, background 0.3s;
      box-shadow: 0 4px 6px rgba(0,0,0,0.2);
    }

    nav a:hover {
      background: #ff9800;
      color: white;
      transform: scale(1.1);
    }

    nav a.active {
      background: #4caf50;
      color: white;
    }

    /* 3D Viewer */
    model-viewer { 
      width: 100%; 
      height: 65vh; 
      display: block; 
      background: #fffbe7;
      border-top: 4px solid #ffcc00;
      border-bottom: 4px solid #ffcc00;
    }

    /* Kontrol */
    .controls {
      margin: 20px;
      text-align: center;
    }

    button, .video-btn {
      background: #4caf50;
      border: none;
      padding: 14px 28px;
      border-radius: 30px;
      cursor: pointer;
      font-weight: bold;
      font-size: 18px;
      color: white;
      margin: 10px;
      transition: transform 0.2s;
      box-shadow: 0 4px 6px rgba(0,0,0,0.3);
    }

    button:hover, .video-btn:hover {
      transform: scale(1.1);
      background: #388e3c;
    }

    audio {
      margin-top: 10px;
      width: 80%;
    }

    /* Modal video */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0; top: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.7);
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background: #000;
      padding: 10px;
      border-radius: 12px;
      max-width: 90%;
      max-height: 80%;
    }

    .modal video {
      width: 100%;
      height: auto;
      border-radius: 12px;
    }

    .close {
      position: absolute;
      top: 20px; right: 30px;
      font-size: 32px;
      font-weight: bold;
      color: white;
      cursor: pointer;
    }

    /* Mascot */
    .mascot {
      position: fixed;
      bottom: 20px;
      left: 20px;
      background: #fff5c3;
      padding: 12px 18px;
      border-radius: 20px;
      font-size: 16px;
      color: #333;
      box-shadow: 0 4px 6px rgba(0,0,0,0.3);
      animation: bounce 2s infinite;
    }

    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-8px); }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav id="navbar">
    @for ($i = 1; $i <= 10; $i++)
      <a href="#"
         class="{{ $i === 1 ? 'active' : '' }}"
         onclick="loadModel(event,
            '{{ asset("storage/models/model$i.glb") }}',
            '{{ asset("storage/audio/model$i.mp3") }}',
            '{{ asset("storage/videos/model$i.mp4") }}')">
        🎮 Model {{ $i }}
      </a>
    @endfor
  </nav>

  <!-- Model Viewer -->
  <model-viewer id="viewer"
    src="{{ asset('storage/models/model1.glb') }}"
    alt="3D Model"
    camera-controls
    auto-rotate
    shadow-intensity="1">
  </model-viewer>

  <!-- Controls -->
  <div class="controls">
    <audio id="voice" controls>
      <source id="audioSrc" src="{{ asset('storage/audio/model1.mp3') }}" type="audio/mpeg">
    </audio>
    <br>
    <button onclick="document.getElementById('voice').play()">🎵 Putar Suara</button>
    <button class="video-btn" onclick="openVideo()">🎥 Putar Video</button>
  </div>

  <!-- Video Modal -->
  <div id="videoModal" class="modal">
    <span class="close" onclick="closeVideo()">&times;</span>
    <div class="modal-content">
      <video id="videoPlayer" controls>
        <source id="videoSrc" src="{{ asset('storage/videos/model1.mp4') }}" type="video/mp4">
        Browser tidak mendukung video.
      </video>
    </div>
  </div>

  <!-- Mascot (helper) -->
  <div class="mascot">👋 Halo! Klik tombol di atas untuk melihat model seru!</div>

  <script>
    function loadModel(event, modelUrl, audioUrl, videoUrl) {
      event.preventDefault();

      const viewer = document.getElementById('viewer');
      const audio = document.getElementById('voice');
      const audioSrc = document.getElementById('audioSrc');
      const videoSrc = document.getElementById('videoSrc');

      // Update model
      viewer.src = modelUrl;

      // Update audio
      audio.pause();
      audioSrc.src = audioUrl;
      audio.load();

      // Update video
      videoSrc.src = videoUrl;
      document.getElementById('videoPlayer').load();

      // Highlight menu aktif
      document.querySelectorAll('#navbar a').forEach(link => link.classList.remove('active'));
      event.target.classList.add('active');
    }

    function openVideo() {
      document.getElementById('videoModal').style.display = 'flex';
      document.getElementById('videoPlayer').play();
    }

    function closeVideo() {
      document.getElementById('videoModal').style.display = 'none';
      const video = document.getElementById('videoPlayer');
      video.pause();
    }
  </script>

</body>
</html>
