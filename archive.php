<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Explore Archive | PhotoBook</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    /* Modal fade-in effect */
    #imageModal {
      transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
    }
    #imageModal.hidden {
      visibility: hidden;
      opacity: 0;
    }
    #imageModal:not(.hidden) {
      visibility: visible;
      opacity: 1;
    }
    /* Smooth hover effect for gallery images */
    .gallery-image:hover {
      transform: scale(1.05);
      transition: transform 0.3s ease;
    }
    /* Scrollbar for large images */
    #modalImageWrapper {
      max-height: 80vh;
      overflow-y: auto;
    }
  </style>
</head>
<body class="bg-gradient-to-b from-gray-100 to-white text-gray-800">
  <!-- Header -->
  <header class="py-6 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-center">
    <h1 class="text-4xl font-bold">PhotoBook Archive</h1>
    <p class="mt-2 text-lg">Explore stunning images shared by our community.</p>
  </header>

  <!-- Filter Section -->
  <section class="py-8">
    <div class="container mx-auto px-4 max-w-6xl flex flex-col md:flex-row items-center justify-between">
      <div class="flex space-x-4">
        <!-- Year Filter -->
        <div>
          <label for="year" class="block text-gray-700 font-medium">Year</label>
          <select id="year" class="w-28 border rounded-md p-2 focus:ring focus:ring-blue-300">
            <option value="">All</option>
            <?php
            $currentYear = date("Y");
            for ($year = $currentYear; $year >= $currentYear - 10; $year--) {
              echo "<option value=\"$year\">$year</option>";
            }
            ?>
          </select>
        </div>

        <!-- Month Filter -->
        <div>
          <label for="month" class="block text-gray-700 font-medium">Month</label>
          <select id="month" class="w-28 border rounded-md p-2 focus:ring focus:ring-blue-300">
            <option value="">All</option>
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
          </select>
        </div>
      </div>

      <!-- Place Search -->
      <div class="mt-4 md:mt-0">
        <label for="search" class="block text-gray-700 font-medium">Search by Place</label>
        <input type="text" id="search" placeholder="Search place" class="w-full md:w-64 border rounded-md p-2 focus:ring focus:ring-blue-300">
      </div>
    </div>
  </section>

  <!-- Gallery Section -->
  <section class="py-10">
    <div class="container mx-auto px-4 max-w-6xl">
      <div id="gallery" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Images will be dynamically rendered here -->
      </div>
      <!-- Pagination -->
      <div id="pagination" class="mt-8 flex justify-center space-x-2"></div>
    </div>
  </section>

  <!-- Modal Section -->
  <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-80 hidden z-50 flex flex-col justify-center items-center">
    <div id="modalImageWrapper" class="relative w-full max-w-screen-lg flex-grow p-4">
      <img id="modalImage" class="mx-auto" src="" alt="">
      <p id="modalCaption" class="mt-4 text-white text-lg font-bold text-center"></p>
    </div>
    <div class="flex justify-between items-center w-full max-w-screen-lg mt-4 p-4">
      <button id="prevImage" class="text-white text-3xl p-2 bg-gray-700 rounded-full hover:bg-gray-600">
        &larr;
      </button>
      <button id="closeModal" class="text-white text-2xl px-4 py-2 bg-red-600 rounded-lg hover:bg-red-500">
        Close
      </button>
      <button id="nextImage" class="text-white text-3xl p-2 bg-gray-700 rounded-full hover:bg-gray-600">
        &rarr;
      </button>
    </div>
  </div>

  <script>
    const gallery = document.getElementById('gallery');
    const pagination = document.getElementById('pagination');
    const yearFilter = document.getElementById('year');
    const monthFilter = document.getElementById('month');
    const searchInput = document.getElementById('search');
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalCaption = document.getElementById('modalCaption');
    const closeModal = document.getElementById('closeModal');
    const prevImage = document.getElementById('prevImage');
    const nextImage = document.getElementById('nextImage');

    let currentPage = 1;
    const itemsPerPage = 8;
    let images = [];
    let currentIndex = 0;

    async function fetchImages() {
      const year = yearFilter.value;
      const month = monthFilter.value;
      const search = searchInput.value;

      const response = await fetch(`config/fetch.php?year=${year}&month=${month}&search=${encodeURIComponent(search)}`);
      images = await response.json();

      renderImages();
      renderPagination(images.length);
    }

    function renderImages() {
      gallery.innerHTML = '';
      const startIndex = (currentPage - 1) * itemsPerPage;
      const paginatedImages = images.slice(startIndex, startIndex + itemsPerPage);

      if (paginatedImages.length === 0) {
        gallery.innerHTML = '<p class="col-span-full text-center text-gray-600">No images found. Try adjusting your filters.</p>';
        return;
      }

      paginatedImages.forEach((image, index) => {
        const imgHTML = `
          <div class="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer gallery-image" onclick="openModal(${startIndex + index})">
            <img src="./uploads/${image.file_name}" alt="${image.caption}" class="w-full h-48 object-cover" loading="lazy">
            <div class="p-4">
              <h3 class="text-lg font-semibold">${image.user_name}</h3>
              <p class="text-sm text-gray-600">Place: ${image.place}</p>
              <p class="text-sm text-gray-600">Caption: ${image.caption}</p>
            </div>
          </div>`;
        gallery.insertAdjacentHTML('beforeend', imgHTML);
      });
    }

    function openModal(index) {
      currentIndex = index;
      const image = images[index];
      modalImage.src = `./uploads/${image.file_name}`;
      modalCaption.textContent = image.caption;
      modal.classList.remove('hidden');
    }

    function closeModalFunc() {
      modal.classList.add('hidden');
    }

    function showNextImage() {
      currentIndex = (currentIndex + 1) % images.length;
      openModal(currentIndex);
    }

    function showPrevImage() {
      currentIndex = (currentIndex - 1 + images.length) % images.length;
      openModal(currentIndex);
    }

    closeModal.addEventListener('click', closeModalFunc);
    nextImage.addEventListener('click', showNextImage);
    prevImage.addEventListener('click', showPrevImage);

    yearFilter.addEventListener('change', fetchImages);
    monthFilter.addEventListener('change', fetchImages);
    searchInput.addEventListener('input', fetchImages);

    fetchImages();
  </script>
</body>
</html>
