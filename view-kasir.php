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
  if (!isset($_SESSION['id_pegawai']) || !isset($_SESSION['nama_pegawai']) || !isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['role'])) {
    echo "<script>alert('Anda belum login, mohon login kembali'); window.location.href='login-pegawai.php'</script>";
    exit;
  }
  
  $id_pegawai = $_SESSION['id_pegawai'];
  $nama_pegawai = $_SESSION['nama_pegawai'];
  $username = $_SESSION['username'];
  $password = $_SESSION['password'];
  $role = $_SESSION['role'];
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
        <li class="item">
          <div class="nav_link submenu_item">
            <span class="navlink_icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet" viewBox="0 0 16 16">
  <path d="M0 3a2 2 0 0 1 2-2h13.5a.5.5 0 0 1 0 1H15v2a1 1 0 0 1 1 1v8.5a1.5 1.5 0 0 1-1.5 1.5h-12A2.5 2.5 0 0 1 0 12.5zm1 1.732V12.5A1.5 1.5 0 0 0 2.5 14h12a.5.5 0 0 0 .5-.5V5H2a2 2 0 0 1-1-.268M1 3a1 1 0 0 0 1 1h12V2H2a1 1 0 0 0-1 1"/>
</svg>            </span>
            <span class="navlink">Pembayaran</span>
            <i class="bx bx-chevron-right arrow-left"></i>
          </div>
          <ul class="menu_items submenu">
            <li><a href="#" class="nav_link sublink" id="lihatBon">Lihat Pembayaran</a></li>
          </ul>
        </li>
        <li class="item">
        </li>
      </ul>
      <ul class="menu_items">
        <li class="item">
          </a>
        </li>
      </ul>
      <div class="bottom_content">
        <div class="bottom">
          <span id="logoutButton">Log-Out</span>
          <i class='bx bx-log-in' id="logoutButton1"></i>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content Area -->
  <div class="main_content">
    <h1>Dashboard Kasir</h1>
    <p>Laman Kerja Kamu Ada Disamping. <?php echo $nama_pegawai; ?></p>
  </div>

  <!-- JavaScript -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const sidebar = document.querySelector(".sidebar");
      const submenuItems = document.querySelectorAll(".submenu_item");
      const mainContent = document.querySelector(".main_content");
      const logo = document.querySelector(".logo-unikom");
      const logoutButton = document.getElementById("logoutButton");
      const logoutButton1 = document.getElementById("logoutButton1");
      const lihatBon = document.getElementById('lihatBon');

      logo.addEventListener('mouseover', function(){
        logo.style.cursor = 'pointer';
      });

      sidebarOpen.addEventListener("click", () => sidebar.classList.toggle("close"));

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

      lihatBon.addEventListener("click", (e) => {
        e.preventDefault();
        fetch('kasir-lihat-bon.php', {
          method: 'POST'
        })
        .then(response => response.text())
        .then(data => {
          mainContent.innerHTML = data;
          mainContent.scrollIntoView({ behavior: 'smooth', block: 'center' });
        })
        .catch(error => {
          mainContent.innerHTML = '<p>Terjadi kesalahan saat memuat halaman.</p>';
        });
      });

      logoutButton.addEventListener('click', function(){
        if (confirm("Apakah Anda ingin logout?")) {
            window.location.href = 'logout.php';
        }
      });

      logoutButton1.addEventListener('click', function(){
        if (confirm("Apakah Anda ingin logout?")) {
            window.location.href = 'logout.php';
        }
      });
    });
  </script>
</body>
</html>
