<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contribute | PhotoBook</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }

    .upload-preview img {
      max-width: 100%;
      border-radius: 8px;
    }

    .error {
      color: #e53e3e;
      font-size: 0.875rem;
      margin-top: 0.25rem;
    }
  </style>
</head>
<body class="bg-gradient-to-b from-gray-100 to-white text-gray-800">
  <!-- Header -->
  <header class="py-6 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-center">
    <h1 class="text-4xl font-bold">Contribute to PhotoBook</h1>
    <p class="mt-2 text-lg">Share your creativity and moments with the world</p>
  </header>

  <!-- Contribute Form -->
  <section class="py-10">
    <div class="container mx-auto px-4 max-w-4xl bg-white rounded-lg shadow-lg p-8">
      <h2 class="text-2xl font-bold text-center mb-6">Submit Your Photos</h2>
      <form id="contributeForm" action="config/upload.php" method="POST" enctype="multipart/form-data" class="space-y-6">
        <!-- Name -->
        <div>
          <label for="name" class="block font-medium text-gray-700">Name</label>
          <input type="text" id="name" name="name" placeholder="Enter your name" required class="w-full border rounded-md p-3 mt-1 focus:ring focus:ring-blue-300">
          <p id="nameError" class="error hidden">Name is required.</p>
        </div>
        <!-- Email -->
        <div>
          <label for="email" class="block font-medium text-gray-700">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required class="w-full border rounded-md p-3 mt-1 focus:ring focus:ring-blue-300">
          <p id="emailError" class="error hidden">Please enter a valid email address.</p>
        </div>
        <!-- Phone -->
        <div>
          <label for="phone" class="block font-medium text-gray-700">Phone (Optional)</label>
          <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" class="w-full border rounded-md p-3 mt-1 focus:ring focus:ring-blue-300">
        </div>
        <!-- Caption -->
        <div>
          <label for="caption" class="block font-medium text-gray-700">Caption</label>
          <input type="text" id="caption" name="caption" placeholder="Add a caption for your photo" class="w-full border rounded-md p-3 mt-1 focus:ring focus:ring-blue-300">
        </div>
        <!-- Feeling -->
        <div>
          <label for="feeling" class="block font-medium text-gray-700">Feeling</label>
          <textarea id="feeling" name="feeling" placeholder="Express why you captured that moment" class="w-full border rounded-md p-3 mt-1 focus:ring focus:ring-blue-300"></textarea>
        </div>
        <!-- Place -->
        <div>
          <label for="place" class="block font-medium text-gray-700">Place</label>
          <input type="text" id="place" name="place" placeholder="Where did you capture this photo" class="w-full border rounded-md p-3 mt-1 focus:ring focus:ring-blue-300">
        </div>
        <!-- Capture Date -->
        <div>
          <label for="date" class="block font-medium text-gray-700">Capture Date</label>
          <input type="datetime-local" id="date" name="date" class="w-full border rounded-md p-3 mt-1 focus:ring focus:ring-blue-300">
        </div>
        <!-- Image Upload -->
        <div>
          <label for="images" class="block font-medium text-gray-700">Upload Images</label>
          <input type="file" id="images" name="images[]" accept="image/*" multiple required class="w-full border rounded-md p-3 mt-1 focus:ring focus:ring-blue-300">
          <p class="text-sm text-gray-500 mt-1">Max 10 images, 20MB per image</p>
        </div>
        <!-- Preview -->
        <div id="previewContainer" class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-4 upload-preview"></div>
        <!-- Submit -->
        <div class="text-center">
          <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition">Submit</button>
        </div>
      </form>
    </div>
  </section>


<!-- Popup Notification -->
<div id="popup" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg text-center">
    <h2 id="popupMessage" class="text-lg font-semibold text-gray-800"></h2>
    <button id="closePopup" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">Close</button>
  </div>
</div>

<script>
  // Show popup based on status query parameter
  const urlParams = new URLSearchParams(window.location.search);
  const status = urlParams.get('status');
  const popup = document.getElementById('popup');
  const popupMessage = document.getElementById('popupMessage');

  if (status === 'success') {
    popupMessage.textContent = 'Images successfully uploaded!';
    popup.classList.remove('hidden');
  } else if (status === 'error') {
    popupMessage.textContent = 'Failed to upload images. Please try again.';
    popup.classList.remove('hidden');
  }

  // Close popup
  const closePopup = document.getElementById('closePopup');
  closePopup.addEventListener('click', () => {
    popup.classList.add('hidden');
    window.history.replaceState(null, null, window.location.pathname); // Remove query parameters
  });
</script>



  <script>
    const imageInput = document.getElementById('images');
    const previewContainer = document.getElementById('previewContainer');

    imageInput.addEventListener('change', () => {
      previewContainer.innerHTML = '';
      const files = Array.from(imageInput.files);

      if (files.length > 10) {
        alert('You can only upload a maximum of 10 images.');
        imageInput.value = '';
        return;
      }

      files.forEach(file => {
        if (file.size > 20 * 1024 * 1024) {
          alert(`${file.name} exceeds the 20MB limit.`);
          return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
          const img = document.createElement('img');
          img.src = e.target.result;
          img.alt = file.name;
          previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
      });
    });
  </script>
</body>
</html>
