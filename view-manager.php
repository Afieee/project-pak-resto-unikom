<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Resto Unikom</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <?php 
  ini_set('session.gc_maxlifetime', 600);
  session_start();
  if (isset($_SESSION['id_pegawai']) && isset($_SESSION['nama_pegawai']) && isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role']) ) {
    $id_pegawai = $_SESSION['id_pegawai'];
    $nama_pegawai = $_SESSION['nama_pegawai'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $role = $_SESSION['role'];
  } 
  else {
    echo "<script>alert('Anda belum login, mohon login kembali'); window.location.href='login-pegawai.php'</script>";
    exit;
  }
  ?>

  <!-- navbar -->
  <nav class="navbar">
    <div class="logo_item" id="homeLink">
      <i class="bx bx-menu" id="sidebarOpen"></i>
      <img src="images/logo-unikom.png" class='logo-unikom' alt="Logo Unikom">
      <p id="teks-logo">Resto Unikom</p>
    </div>

    <div class="navbar_content">
      <i class="bi bi-grid"></i>
      <span><i><?php echo $nama_pegawai; ?></i></span>
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
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
  <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
</svg>            </span>
            <span class="navlink">Pegawai</span>
            <i class="bx bx-chevron-right arrow-left"></i>
          </div>
          <ul class="menu_items submenu">
            <li><a href="#" class="nav_link sublink" id="konfirmasiReservasi">Manage Pegawai</a></li>
            <li><a href="manage-tambah-pegawai.php" class="nav_link sublink">Tambah Pegawai</a></li>
          </ul>
        </li>
        <li class="item">
          <div class="nav_link submenu_item">
            <span class="navlink_icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
  <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
</svg>            </span>
            <span class="navlink">Menu Makanan</span>
            <i class="bx bx-chevron-right arrow-left"></i>
          </div>
          <ul class="menu_items submenu">
            <li><a href="manage-menu.php" class="nav_link sublink">Manage Menu</a></li>
            <li><a href="manage-tambah-menu.php" class="nav_link sublink">Tambah Menu</a></li>
          </ul> 
        </li>
        <li class="item">
          <div class="nav_link submenu_item">
            <span class="navlink_icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
  <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"/>
</svg>            </span>
            <span class="navlink">Transaksi</span>
            <i class="bx bx-chevron-right arrow-left"></i>
          </div>
          <ul class="menu_items submenu">
            <li><a href="manage-lihat-bon.php" class="nav_link sublink">Lihat Transaksi</a></li>
          </ul>
        </li>
      </ul>
      <div class="bottom_content">
        <div class="bottom">
          <span id="logoutButton"> Log-Out</span>
          <i class='bx bx-log-in' id="logoutButton1"></i>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content Area -->
  <div class="main_content">
    <h1>Dashboard Manager</h1>
    <p>Laman Kerja Kamu Ada Disamping. <?php echo $nama_pegawai; ?></p>
  </div>

  <!-- JavaScript -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const sidebar = document.querySelector(".sidebar");
      const submenuItems = document.querySelectorAll(".submenu_item");
      const sidebarOpen = document.querySelector("#sidebarOpen");
      const mainContent = document.querySelector(".main_content");
      const konfirmasiReservasi = document.getElementById('konfirmasiReservasi');
      const logoutButton = document.getElementById('logoutButton');
      const logoutButton1 = document.getElementById('logoutButton1');

      // Toggle sidebar open/close
      sidebarOpen.addEventListener("click", function() {
        sidebar.classList.toggle("close");
        const sidebarState = sidebar.classList.contains("close") ? "closed" : "open";
        localStorage.setItem("sidebarState", sidebarState);
      });

      // Save submenu state to localStorage
      submenuItems.forEach((item, index) => {
        item.addEventListener("click", () => {
          item.classList.toggle("show_submenu");
          submenuItems.forEach((item2, index2) => {
            if (index !== index2) {
              item2.classList.remove("show_submenu");
            }
          });
          saveSubmenuState();
        });
      });

      function saveSubmenuState() {
        submenuItems.forEach((item, index) => {
          if (item.classList.contains("show_submenu")) {
            localStorage.setItem(`submenuState${index}`, "show");
          } else {
            localStorage.setItem(`submenuState${index}`, "hide");
          }
        });
      }

      // Check submenu state from localStorage when the page loads
      submenuItems.forEach((item, index) => {
        const submenuState = localStorage.getItem(`submenuState${index}`);
        if (submenuState === "show") {
          item.classList.add("show_submenu");
        } else {
          item.classList.remove("show_submenu");
        }
      });

      // Event listener for logoutButton
      logoutButton.addEventListener('click', function() {
        if (confirm("Apakah Anda ingin logout?")) {
          window.location.href = 'logout.php';
        }
      });

      // Event listener for logoutButton1
      logoutButton1.addEventListener('click', function() {
        if (confirm("Apakah Anda ingin logout?")) {
          window.location.href = 'logout.php';
        }
      });

      // AJAX request for Manage Pegawai
      konfirmasiReservasi.addEventListener("click", function(e) {
        e.preventDefault();
        fetch('manage-pegawai.php', { method: 'POST' })
          .then(response => response.text())
          .then(data => {
            mainContent.innerHTML = data;
          })
          .catch(() => {
            mainContent.innerHTML = '<p>Terjadi kesalahan saat memuat halaman.</p>';
          });
      });

      // AJAX request for Manage Menu
      document.querySelectorAll(".nav_link.submenu_item").forEach(item => {
        item.addEventListener("click", function(e) {
          e.preventDefault();
          const url = item.querySelector('a').getAttribute('href');
          fetch(url, { method: 'POST' })
            .then(response => response.text())
            .then(data => {
              mainContent.innerHTML = data;
            })
            .catch(() => {
              mainContent.innerHTML = '<p>Terjadi kesalahan saat memuat halaman.</p>';
            });
        });
      });

      // Event listener for homeLink
      document.getElementById('homeLink').addEventListener("click", function(e) {
        e.preventDefault();
        mainContent.innerHTML = `<h1>Welcome to Resto Unikom</h1><p>Please select an option from the sidebar. <?php echo $nama_pegawai; ?></p>`;
      });
    });
  </script>
</body>
</html>
