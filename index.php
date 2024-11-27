<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PhotoBook</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    @keyframes scrollText {
      0%, 33% { transform: translateY(0); }
      34%, 66% { transform: translateY(-100%); }
      67%, 100% { transform: translateY(-200%); }
    }

    @keyframes marquee {
      0% { transform: translateX(100%); }
      100% { transform: translateX(-100%); }
    }

    .animate-marquee {
      animation: marquee 12s linear infinite;
      white-space: nowrap;
    }

    .group-hover:animate-marquee-paused {
      animation-play-state: paused;
    }
  </style>
</head>
<body class="bg-gradient-to-b from-gray-100 to-white text-gray-800">

  <!-- Hero Section -->
  <header class="relative bg-gradient-to-r from-indigo-600 to-blue-500 text-white">
    <div class="container mx-auto px-6 py-20 flex flex-col items-center text-center">
      <h1 class="text-4xl md:text-6xl font-bold">PhotoBook</h1>
      <p class="mt-4 text-lg md:text-xl">Share Your Creativity with Friendly way</p>
      <div class="mt-6 flex space-x-4">
        <a href="archive.php" class="bg-white text-indigo-600 px-6 py-3 rounded-lg shadow-md hover:bg-gray-100 hover:shadow-lg transition">Explore Archive</a>
        <a href="contribute.php" class="bg-blue-700 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-800 hover:shadow-lg transition">Contribute</a>
      </div>
    </div>
  </header>


  <!-- Scrolling Text -->
  <section class="py-12 bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
    <div class="container mx-auto text-center">
      <div class="overflow-hidden relative h-12">
        <div class="absolute inset-0 flex items-center justify-start space-x-8 animate-marquee">
          <p class="text-2xl font-bold flex items-center">
            <span class="mr-2">✨</span> Share your creativity
          </p>
          <p class="text-2xl font-bold flex items-center">
            <span class="mr-2">🚀</span> Join this journey
          </p>
          <p class="text-2xl font-bold flex items-center">
            <span class="mr-2">🌟</span> Reveal your talent
          </p>
        </div>
      </div>
    </div>
  </section>


  
  <!-- Feature Section -->
  <section class="py-16">
    <div class="container mx-auto text-center">
      <h2 class="text-3xl font-bold mb-8 text-gray-800">Why Choose PhotoBook?</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
          <i class="fas fa-camera-retro text-blue-500 text-4xl mb-4"></i>
          <h3 class="text-xl font-semibold mb-2">Open-minded Platform</h3>
          <p>Showcase your photography in a professional and friendly way.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
          <i class="fas fa-users text-green-500 text-4xl mb-4"></i>
          <h3 class="text-xl font-semibold mb-2">Collaborative Community</h3>
          <p>Connect and grow with like-minded photography enthusiasts.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
          <i class="fas fa-globe text-yellow-500 text-4xl mb-4"></i>
          <h3 class="text-xl font-semibold mb-2">Global Reach</h3>
          <p>Get discovered by audiences across the world.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-gray-400 py-12">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
      <div>
        <h3 class="text-lg font-semibold text-white">About PhotoBook</h3>
        <p class="mt-2 text-sm">PhotoBook is a creative platform that allows photographers to showcase their talent to the world.</p>
      </div>
      <div>
        <h3 class="text-lg font-semibold text-white">Quick Links</h3>
        <ul class="mt-2 text-sm space-y-2">
          <li><a href="#" class="hover:text-white">About Us</a></li>
          <li><a href="#" class="hover:text-white">Contact</a></li>
          <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
          <li><a href="#" class="hover:text-white">Terms & Conditions</a></li>
        </ul>
      </div>
      <div>
        <h3 class="text-lg font-semibold text-white">Follow Us</h3>
        <div class="mt-4 flex space-x-4">
          <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook fa-lg"></i></a>
          <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter fa-lg"></i></a>
          <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram fa-lg"></i></a>
          <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin fa-lg"></i></a>
        </div>
      </div>
    </div>
    <p class="text-center text-sm mt-12">&copy; 2024 PhotoBook. All rights reserved.</p>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>
