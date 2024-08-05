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

    // Cek apakah pengguna sudah login
    if (!isset($_SESSION['id_pegawai']) || !isset($_SESSION['nama_pegawai']) || !isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['role'])) {
      echo "<script>alert('Anda belum login, mohon login kembali'); window.location.href='login-pegawai.php'</script>";
      exit;
    }

    // Assign session variables to PHP variables
    $id_pegawai = $_SESSION['id_pegawai'];
    $nama_pegawai = $_SESSION['nama_pegawai'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $role = $_SESSION['role'];

    // Process form submission (if any)
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['menu_id']) && isset($_POST['new_status'])) {
      $menu_id = $_POST['menu_id'];
      $new_status = $_POST['new_status'];
      
      // Update menu status in database
      $update_query = "UPDATE menu SET status = '$new_status' WHERE id_menu = $menu_id";
      mysqli_query($conn, $update_query);
    }

    include 'connection.php';
    session_start();
    if (isset($_SESSION['id_pegawai']) && isset($_SESSION['nama_pegawai']) && isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
      $id_pegawai = $_SESSION['id_pegawai'];
      $nama_pegawai = $_SESSION['nama_pegawai'];
      $username = $_SESSION['username'];
      $password = $_SESSION['password'];
      $role = $_SESSION['role'];
    } else {
      echo "<script>alert('Anda belum login, mohon login kembali'); window.location.href='login-pegawai.php'</script>";
      exit;
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['table_id']) && isset($_POST['new_status'])) {
            $table_id = $_POST['table_id'];
            $new_status = $_POST['new_status'];
            
            // Use prepared statement to avoid SQL injection
            $stmt = $conn->prepare("UPDATE pesanan SET status = ? WHERE no_meja = ?");
            $stmt->bind_param("ss", $new_status, $table_id);
    
            if ($stmt->execute()) {
                echo "<script>alert('Status pesanan berhasil diperbarui'); window.location.href=window.location.href;</script>";
            } else {
                echo "<script>alert('Gagal mengupdate status');</script>";
            }
    
            $stmt->close();
        }
    }

  ?>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo_item" id="homeLink">
      <i class="bx bx-menu" id="sidebarOpen"></i>
      <img src="images/logo-unikom.png" class="logo-unikom" alt="Logo Unikom">
      <p id="teks-logo">Resto Unikom</p>
    </div>

    <div class="navbar_content">
      <i class="bi bi-grid"></i>
      <span><i><?php echo $nama_pegawai; ?></i></span>
    </div>
  </nav>

  <!-- Sidebar -->
  <nav class="sidebar">
    <div class="menu_content">
      <ul class="menu_items">
        <div class="menu_title menu_dahsboard"></div>
        <li class="item">
          <div class="nav_link submenu_item">
            <span class="navlink_icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-menu-down" viewBox="0 0 16 16">
              <path d="M7.646.146a.5.5 0 0 1 .708 0L10.207 2H14a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h3.793zM1 7v3h14V7zm14-1V4a1 1 0 0 0-1-1h-3.793a1 1 0 0 1-.707-.293L8 1.207l-1.5 1.5A1 1 0 0 1 5.793 3H2a1 1 0 0 0-1 1v2zm0 5H1v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM2 4.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5m0 4a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5"/>
            </svg>            </span>
            <span class="navlink">Menu</span>
            <i class="bx bx-chevron-right arrow-left"></i>
          </div>
          <ul class="menu_items submenu">
            <li><a href="#" class="nav_link sublink" id="konfirmasiReservasi">Manage Menu</a></li>
          </ul>
        </li>
        <li class="item">
          <div class="nav_link submenu_item">
            <span class="navlink_icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journals" viewBox="0 0 16 16">
              <path d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2 2 2 0 0 1-2 2H3a2 2 0 0 1-2-2h1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1H1a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v9a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2"/>
              <path d="M1 6v-.5a.5.5 0 0 1 1 0V6h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V9h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 2.5v.5H.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1H2v-.5a.5.5 0 0 0-1 0"/>
            </svg>            </span>
            <span class="navlink">Pesanan</span>
            <i class="bx bx-chevron-right arrow-left"></i>
          </div>
          <ul class="menu_items submenu">
            <!-- <li><a href="koki-lihat-pesanan.php" class="nav_link sublink" >Lihat Pesanan</a></li> -->
            <li><a href="#" class="nav_link sublink" id="lihatPesanan">Lihat Pesanan</a></li>

          </ul>
        </li>
      </ul>
      <ul class="menu_items">
      </ul>
      <div class="bottom_content">
        <div class="bottom">
          <span id="logoutButton">Log-Out</span>
          <i class="bx bx-log-in" id="logoutButton1"></i>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content Area -->
  <div id="mainContent" class="main_content">
    <h1>Dashboard Koki</h1>
    <p>Laman Kerja Kamu Ada Disamping. <?php echo $nama_pegawai; ?></p>
  </div>

  <!-- JavaScript -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const sidebar = document.querySelector(".sidebar");
      const submenuItems = document.querySelectorAll(".submenu_item");
      const logoutButton = document.getElementById("logoutButton");
      const logoutButton1 = document.getElementById("logoutButton1");
      const mainContent = document.getElementById("mainContent");
      const lihatPesanan = document.getElementById("lihatPesanan");
      const konfirmasiReservasi = document.getElementById("konfirmasiReservasi");

      // Toggle sidebar open/close
      document.getElementById("sidebarOpen").addEventListener("click", function() {
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

      // AJAX request for Manage Menu
      konfirmasiReservasi.addEventListener("click", function(e) {
        e.preventDefault();
        fetch('koki-manage-menu.php')
          .then(response => response.text())
          .then(data => {
            mainContent.innerHTML = data;
            mainContent.scrollIntoView({ behavior: 'smooth', block: 'center' });
          })
          .catch(() => {
            mainContent.innerHTML = '<p>Terjadi kesalahan saat memuat halaman.</p>';
          });
      });

      // AJAX request for Lihat Pesanan
      lihatPesanan.addEventListener("click", function(e) {
        e.preventDefault();
        fetch('koki-lihat-pesanan.php')
          .then(response => response.text())
          .then(data => {
            mainContent.innerHTML = data;
            mainContent.scrollIntoView({ behavior: 'smooth', block: 'center' });
          })
          .catch(() => {
            mainContent.innerHTML = '<p>Terjadi kesalahan saat memuat halaman.</p>';
          });
      });

      // Example of returning to the home page
      document.getElementById('homeLink').addEventListener("click", function(e) {
        e.preventDefault();
        mainContent.innerHTML = `<h1>Welcome to Resto Unikom</h1><p>Please select an option from the sidebar. <?php echo $nama_pegawai; ?></p>`;
      });
    });
  </script>
</body>
</html>
