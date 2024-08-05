<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Google Maps Example</title>
  <style>
    /* Ukuran untuk peta */
    #map {
      height: 400px;
      width: 100%;
    }
  </style>
</head>
<body>
  <!-- Div untuk Peta -->
  <div id="map"></div>

  <!-- Tambahkan script Google Maps API di sini -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>

  <!-- Script untuk menginisialisasi peta -->
  <script>
    function initMap() {
      // Lokasi yang ingin ditampilkan
      const lokasiUnikom = { lat: -6.914744, lng: 107.609810 };

      // Membuat peta
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: lokasiUnikom,
      });

      // Menambahkan marker pada lokasi
      const marker = new google.maps.Marker({
        position: lokasiUnikom,
        map: map,
      });
    }
  </script>
</body>
</html>
