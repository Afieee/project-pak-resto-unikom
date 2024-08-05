<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- <link href="style1.css" rel="stylesheet" /> -->
  <title>Resto Unikom</title>
  <link rel="stylesheet" href="style.css" />
  <!-- <script src="script.js"></script> -->
   
</head>

<body>
  <?php 
  session_start();
  if (isset($_SESSION['id_pelanggan']) && isset($_SESSION['nama_pelanggan']) && isset($_SESSION['email_pelanggan']) && isset($_SESSION['no_handphone']) ) {
    $id_pelanggan = $_SESSION['id_pelanggan'];
    $nama_pelanggan = $_SESSION['nama_pelanggan'];
    $email_pelanggan = $_SESSION['email_pelanggan'];
    $no_handphone = $_SESSION['no_handphone'];
  } 
  else {
    echo "<script>alert('Anda belum login, mohon login kembali'); window.location.href='login-pelanggan.php'</script>";
    exit;
  }
  ?>

  <!-- navbar -->
  <nav class="navbar">
    <div class="logo_item" id="homeLink">
      <i class="bx bx-menu" id="sidebarOpen"></i>
      <img src="images/logo-unikom.png" class='logo-unikom' alt="Logo Unikom">
      <p id="teks-logo">Resto Unikom<p>
    </div>

    <div class="navbar_content">
      <i class="bi bi-grid"></i>
      <i class='bx bx-sun' id="darkLight"></i>
      <span><i><?php echo $nama_pelanggan; ?></i></span>
    </div>
  </nav>

  <!-- sidebar -->
  <nav class="sidebar">
    <div class="menu_content">
      <ul class="menu_items">
        <div class="menu_title menu_dahsboard"></div>
        <li class="item">
          <div class="nav_link submenu_item">
            <span class="navlink_icon">
              <!-- ICON -->
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cup-hot" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M.5 6a.5.5 0 0 0-.488.608l1.652 7.434A2.5 2.5 0 0 0 4.104 16h5.792a2.5 2.5 0 0 0 2.44-1.958l.131-.59a3 3 0 0 0 1.3-5.854l.221-.99A.5.5 0 0 0 13.5 6zM13 12.5a2 2 0 0 1-.316-.025l.867-3.898A2.001 2.001 0 0 1 13 12.5M2.64 13.825 1.123 7h11.754l-1.517 6.825A1.5 1.5 0 0 1 9.896 15H4.104a1.5 1.5 0 0 1-1.464-1.175"/>
                <path d="m4.4.8-.003.004-.014.019a4 4 0 0 0-.204.31 2 2 0 0 0-.141.267c-.026.06-.034.092-.037.103v.004a.6.6 0 0 0 .091.248c.075.133.178.272.308.445l.01.012c.118.158.26.347.37.543.112.2.22.455.22.745 0 .188-.065.368-.119.494a3 3 0 0 1-.202.388 5 5 0 0 1-.253.382l-.018.025-.005.008-.002.002A.5.5 0 0 1 3.6 4.2l.003-.004.014-.019a4 4 0 0 0 .204-.31 2 2 0 0 0 .141-.267c.026-.06.034-.092.037-.103a.6.6 0 0 0-.09-.252A4 4 0 0 0 3.6 2.8l-.01-.012a5 5 0 0 1-.37-.543A1.53 1.53 0 0 1 3 1.5c0-.188.065-.368.119-.494.059-.138.134-.274.202-.388a6 6 0 0 1 .253-.382l.025-.035A.5.5 0 0 1 4.4.8m3 0-.003.004-.014.019a4 4 0 0 0-.204.31 2 2 0 0 0-.141.267c-.026.06-.034.092-.037.103v.004a.6.6 0 0 0 .091.248c.075.133.178.272.308.445l.01.012c.118.158.26.347.37.543.112.2.22.455.22.745 0 .188-.065.368-.119.494a3 3 0 0 1-.202.388 5 5 0 0 1-.253.382l-.018.025-.005.008-.002.002A.5.5 0 0 1 6.6 4.2l.003-.004.014-.019a4 4 0 0 0 .204-.31 2 2 0 0 0 .141-.267c.026-.06.034-.092.037-.103a.6.6 0 0 0-.09-.252A4 4 0 0 0 6.6 2.8l-.01-.012a5 5 0 0 1-.37-.543A1.53 1.53 0 0 1 6 1.5c0-.188.065-.368.119-.494.059-.138.134-.274.202-.388a6 6 0 0 1 .253-.382l.025-.035A.5.5 0 0 1 7.4.8m3 0-.003.004-.014.019a4 4 0 0 0-.204.31 2 2 0 0 0-.141.267c-.026.06-.034.092-.037.103v.004a.6.6 0 0 0 .091.248c.075.133.178.272.308.445l.01.012c.118.158.26.347.37.543.112.2.22.455.22.745 0 .188-.065.368-.119.494a3 3 0 0 1-.202.388 5 5 0 0 1-.252.382l-.019.025-.005.008-.002.002A.5.5 0 0 1 9.6 4.2l.003-.004.014-.019a4 4 0 0 0 .204-.31 2 2 0 0 0 .141-.267c.026-.06.034-.092.037-.103a.6.6 0 0 0-.09-.252A4 4 0 0 0 9.6 2.8l-.01-.012a5 5 0 0 1-.37-.543A1.53 1.53 0 0 1 9 1.5c0-.188.065-.368.119-.494.059-.138.134-.274.202-.388a6 6 0 0 1 .253-.382l.025-.035A.5.5 0 0 1 10.4.8"/>
              </svg>
            </span>
            <span class="navlink">Menu</span>
            <i class="bx bx-chevron-right arrow-left"></i>
          </div>
          <ul class="menu_items submenu">
            <li><a href="#" class="nav_link sublink" id="menuKesayanganLink">Menu Kesayangan</a></li>
            <li><a href="#" class="nav_link sublink" id="lokasiKami">Lokasi Kami</a></li>
          </ul>
        </li>
        <li class="item">
          <div class="nav_link submenu_item">
            <span class="navlink_icon">
              <!-- ICON -->
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
              </svg></i>    
            </span>
            <span class="navlink">Reservation</span>
            <i class="bx bx-chevron-right arrow-left"></i>
          </div>
          <ul class="menu_items submenu">
            <li><a href="#" class="nav_link sublink" id="reservasiSekarangLink">Reservasi Sekarang</a></li>
            <li><a href="#" class="nav_link sublink" id="statusReservasi">Lihat Reservasi Kamu</a></li>
          </ul>
        </li>
      </ul>
      <ul class="menu_items">
      <div class="menu_title menu_setting"></div>
      <li class="item">
        <a href="#" class="nav_link" id="setting"> <!-- tambahkan id setting di sini -->
          <span class="navlink_icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
          </svg>          </span>
          <span class="navlink" id="setting">Profile</span>
        </a>
      </li>
    </ul>

      <div class="bottom_content">
        <div class="bottom">
          <span id="logoutButton">Log-Out</span>
          <i class='bx bx-log-out' id="logoutButton1"></i>
        </div>
      </div>
      </div>
      </div>
    </div>
  </nav>

  <!-- Main Content Area -->
  <div class="main_content">
    <h1>Welcome to Resto Unikom</h1>
    <p>Please select an option from the sidebar. <?php echo $nama_pelanggan; ?></p>
  </div>

  <!-- JavaScript -->
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const body = document.querySelector("body");
    const darkLight = document.querySelector("#darkLight");
    const sidebar = document.querySelector(".sidebar");
    const submenuItems = document.querySelectorAll(".submenu_item");
    const sidebarOpen = document.querySelector("#sidebarOpen");
    const mainContent = document.querySelector(".main_content");
    const menuKesayanganLink = document.getElementById("menuKesayanganLink");
    const reservasiSekarangLink = document.getElementById("reservasiSekarangLink");
    const homeLink = document.getElementById("homeLink");
    const logo = document.querySelector(".logo-unikom");
    const teksUnikom = document.getElementById("teks-logo");
    const logoutButton = document.getElementById("logoutButton");
    const logoutButton1 = document.getElementById("logoutButton1");
    const lokasiKami = document.getElementById('lokasiKami');
    const statusReservasi = document.getElementById("statusReservasi");
    const setting = document.getElementById("setting");

    logo.addEventListener('mouseover', function() {
      logo.style.cursor = 'pointer';
    });
    teksUnikom.addEventListener('mouseover', function() {
      teksUnikom.style.cursor = 'pointer';
    });

    sidebarOpen.addEventListener("click", () => sidebar.classList.toggle("close"));

    darkLight.addEventListener("click", () => {
      body.classList.toggle("dark");
      if (body.classList.contains("dark")) {
        darkLight.classList.replace("bx-sun", "bx-moon");
      } else {
        darkLight.classList.replace("bx-moon", "bx-sun");
      }
    });

    submenuItems.forEach((item, index) => {
      item.addEventListener("click", () => {
        item.classList.toggle("show_submenu");
        submenuItems.forEach((item2, index2) => {
          if (index !== index2) {
            item2.classList.remove("show_submenu");
          }
        });
      });
    });

    if (window.innerWidth < 768) {
      sidebar.classList.add("close");
    } else {
      sidebar.classList.remove("close");
    }

    menuKesayanganLink.addEventListener("click", (e) => {
      e.preventDefault();
      fetchContent('lihat-menu.php');
    });

    reservasiSekarangLink.addEventListener("click", (e) => {
      e.preventDefault();
      fetchContent('pelanggan-reservasi.php');
    });

    statusReservasi.addEventListener("click", (e) => {
      e.preventDefault();
      fetchContent('pelanggan-konfirmasi-status.php');
    });

    lokasiKami.addEventListener("click", (e) => {
      e.preventDefault();
      fetchContent('lokasi-kami.html');
    });

    setting.addEventListener("click", (e) => {
      e.preventDefault();
      fetchContent('pelanggan-setting.php');
    });

    homeLink.addEventListener("click", (e) => {
      e.preventDefault();
      mainContent.innerHTML = `<h1>Welcome to Resto Unikom</h1><p>Please select an option from the sidebar. <?php echo $nama_pelanggan; ?></p>`;
    });

    logoutButton.addEventListener('click', function() {
      if (confirm("Apakah Anda ingin logout?")) {
        window.location.href = 'logout.php';
      }
    });
    logoutButton1.addEventListener('click', function() {
      if (confirm("Apakah Anda ingin logout?")) {
        window.location.href = 'logout.php';
      }
    });

    function fetchContent(url) {
      fetch(url, {
        method: 'POST'
      })
      .then(response => response.text())
      .then(data => {
        mainContent.innerHTML = data;
      })
      .catch(error => {
        mainContent.innerHTML = '<p>Terjadi kesalahan saat memuat halaman.</p>';
      });
    }

    function togglePasswordVisibility() {
      var passwordField = document.getElementById("password");
      var passwordValue = document.getElementById("password-value").innerText;
      var toggleIcon = document.getElementById("toggle-icon");
      if (passwordField.innerText === passwordValue) {
        passwordField.innerText = "*".repeat(passwordValue.length);
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
      } else {
        passwordField.innerText = passwordValue;
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
      }
    }

    function enableEditing() {
      var inputs = document.querySelectorAll('.editable');
      inputs.forEach(input => {
        input.removeAttribute('disabled');
      });
      document.getElementById('save-btn').style.display = 'inline-block';
    }
  });
</script>
</body>
</html>
