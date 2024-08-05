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
  include 'connection.php';
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
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['table_id']) && isset($_POST['new_status'])) {
        $table_id = $_POST['table_id'];
        $new_status = $_POST['new_status'];
        $update_query = "UPDATE pesanan SET status_pengantaran = '$new_status' WHERE no_meja = '$table_id'";
        mysqli_query($conn, $update_query);
    }
  }
  ?>
  
  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo_item" id="homeLink">
      <i class="bx bx-menu" id="sidebarOpen"></i>
      <img src="images/logo-unikom.png" class='logo-unikom' alt="Logo Unikom">
      <p id="teks-logo">Resto Unikom</p>
    </div>
    <div class="navbar_content">
      <i class="bi bi-grid"></i>
      <span><i><?php echo htmlspecialchars($nama_pegawai); ?></i></span>
    </div>
  </nav>

  <!-- Sidebar -->
  <nav class="sidebar">
    <div class="menu_content">
      <ul class="menu_items">
        <li class="item">
          <div class="nav_link submenu_item">
            <span class="navlink_icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-arrow-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 5a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5A.5.5 0 0 1 8 5"/>
  <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
  <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
</svg>            </span>
            <span class="navlink">Reservasi</span>
            <i class="bx bx-chevron-right arrow-left"></i>
          </div>
          <ul class="menu_items submenu">
            <li><a href="#" class="nav_link sublink" id="konfirmasiReservasi">Manage Reservasi</a></li>
          </ul>
        </li>
        <li class="item">
          <div class="nav_link submenu_item">
            <span class="navlink_icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
  <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
</svg>            </span>
            <span class="navlink">Pesanan</span>
            <i class="bx bx-chevron-right arrow-left"></i>
          </div>
          <ul class="menu_items submenu">
            <li><a href="#" class="nav_link sublink" id="ManageMenu">Buat Pesanan</a></li>
            <li><a href="#" class="nav_link sublink" id="pesananYangDimasak">Pesanan Sudah Dimasak</a></li>
          </ul>
        </li>
      </ul>
      <div class="bottom_content">
        <div class="bottom">
          <span id="logoutButton"> Log-Out</span>
          <i class='bx bx-log-in' id="logoutButton1"> </i>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content Area -->
  <div class="main_content">
    <h1>Dashboard Pelayan</h1>
    <p>Laman Kerja Kamu Ada Disamping. <?php echo htmlspecialchars($nama_pegawai); ?></p>
  </div>

  <!-- JavaScript -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    const body = document.querySelector("body");
    const sidebar = document.querySelector(".sidebar");
    const submenuItems = document.querySelectorAll(".submenu_item");
    const sidebarOpen = document.querySelector("#sidebarOpen");
    const mainContent = document.querySelector(".main_content");
    const konfirmasiReservasi = document.getElementById('konfirmasiReservasi');
    const ManageMenu = document.getElementById("ManageMenu");
    const pesananYangDimasak = document.getElementById("pesananYangDimasak");
    const homeLink = document.getElementById("homeLink");
    const logoutButton = document.getElementById("logoutButton");
    const logoutButton1 = document.getElementById("logoutButton1");


        function incrementValue(id) {
            var input = document.getElementById(id);
            var value = parseInt(input.value, 10);
            input.value = isNaN(value) ? 0 : value + 1;
        }

        function decrementValue(id) {
            var input = document.getElementById(id);
            var value = parseInt(input.value, 10);
            if (!isNaN(value) && value > 0) {
                input.value = value - 1;
            }
        }
        
    document.addEventListener("DOMContentLoaded", function() {
      const sidebarState = localStorage.getItem("sidebarState");
      if (sidebarState === "closed") {
          sidebar.classList.add("close");
      } else {
          sidebar.classList.remove("close");
      }

      submenuItems.forEach((item, index) => {
        const submenuState = localStorage.getItem(`submenuState${index}`);
        if (submenuState === "show") {
          item.classList.add("show_submenu");
        } else {
          item.classList.remove("show_submenu");
        }
      });
    });

    sidebarOpen.addEventListener("click", () => {
      sidebar.classList.toggle("close");
      localStorage.setItem("sidebarState", sidebar.classList.contains("close") ? "closed" : "opened");
    });

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
        localStorage.setItem(`submenuState${index}`, item.classList.contains("show_submenu") ? "show" : "hide");
      });
    }

    konfirmasiReservasi.addEventListener("click", (e) => {
      e.preventDefault();
      $.ajax({
        url: 'pelayan-reservasi.php',
        type: 'POST',
        success: function(data) {
          mainContent.innerHTML = data;
        },
        error: function() {
          mainContent.innerHTML = '<p>Terjadi kesalahan saat memuat halaman.</p>';
        }
      });
    });

    ManageMenu.addEventListener("click", (e) => {
      e.preventDefault();
      $.ajax({
        url: 'pelayan-lihat-menu.php',
        type: 'POST',
        success: function(data) {
          mainContent.innerHTML = data;
        },
        error: function() {
          mainContent.innerHTML = '<p>Terjadi kesalahan saat memuat halaman.</p>';
        }
      });
    });

    pesananYangDimasak.addEventListener("click", (e) => {
      e.preventDefault();
      $.ajax({
        url: 'pelayan-lihat-menu2.php',
        type: 'POST',
        success: function(data) {
          mainContent.innerHTML = data;
        },
        error: function() {
          mainContent.innerHTML = '<p>Terjadi kesalahan saat memuat halaman.</p>';
        }
      });
    });

    homeLink.addEventListener("click", (e) => {
      e.preventDefault();
      mainContent.innerHTML = `<h1>Welcome to Resto Unikom</h1><p>Please select an option from the sidebar. <?php echo htmlspecialchars($nama_pegawai); ?></p>`;
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
  </script>
</body>
</html>
