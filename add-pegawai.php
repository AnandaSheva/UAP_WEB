<?php 
    include "conn/conn.php";

    $query_old_id = mysqli_query($mysqli, "SELECT id_pegawai FROM pegawai ORDER BY id_pegawai DESC LIMIT 1");
    $query_get_jenis = mysqli_query($mysqli, "SELECT * FROM `jenis_kelamin`");
    $query_get_lokasi = mysqli_query($mysqli, "SELECT * FROM `lokasi_penyimpanan`");

    $temp = mysqli_fetch_assoc($query_old_id);
    $oldID = $temp['id_pegawai'];

    $numericPart = (int)substr($oldID, 3);
    $numericPart++;

    $newID = "NPM" . str_pad($numericPart, 2, "0", STR_PAD_LEFT);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>GoGroceries - Tambah Pegawai</title>

    <!-- Custom fonts -->
    <link href="Assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles -->
    <link href="Assets/css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- icon -->
    <link rel="icon" href="Assets/img/logo.png">

    <!-- Custom styles -->
    <link href="Assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body id="page-top">
    <div id="wrapper">
      <!-- Sidebar -->
      <ul
        class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion"
        id="accordionSidebar"
      >
        <!-- Sidebar - Brand -->
        <a
          class="sidebar-brand d-flex align-items-center justify-content-center"
          href="index.php"
        >
          <div class="sidebar-brand-icon">
            <img src="Assets/img/icons.png" alt="" width="60px">
          </div>
          <div class="sidebar-brand-text mx-2">GoGroceries</div>
        </a>

        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
        </li>

        <!-- Nav Item - Barang -->
        <li class="nav-item">
          <a class="nav-link" href="barang.php">
            <i class="fas fa-fw fa-box"></i>
            <span>Barang</span></a>
        </li>

        <hr class="sidebar-divider" />

        <!-- Nav Section Heading -->
        <div class="sidebar-heading">Transaksi</div>

        <!-- Nav Item - Barang -->
        <li class="nav-item">
          <a class="nav-link" href="stokmasuk.php">
            <i class="fas fa-fw fa-box-open"></i>
            <span>Stok Masuk</span></a>
        </li>

        <!-- Nav Item - Barang -->
        <li class="nav-item">
          <a class="nav-link" href="stokkeluar.php">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Stok Keluar</span></a>
        </li>

        <hr class="sidebar-divider d-none d-md-block" />

        <div class="sidebar-heading">Laporan</div>

        <li class="nav-item">
          <a class="nav-link" href="laporan.php">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Laporan</span></a>
        </li>

        <hr class="sidebar-divider d-none d-md-block" />

        <div class="sidebar-heading">Lainnya</div>

        <li class="nav-item active">
          <a class="nav-link" href="pegawai.php">
            <i class="fas fa-fw fa-user"></i>
            <span>Pegawai</span></a>
        </li>
      </ul>

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
          <!-- Topbar -->
          <nav
            class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"
          >
            <form class="form-inline">
              <button
                id="sidebarToggleTop"
                class="btn btn-link d-md-none rounded-circle mr-3"
              >
                <i class="fa fa-bars"></i>
              </button>
            </form>

            <!-- Topbar Navbar -->
            <a class="nav-link d-flex align-items-center" href="pegawai.php" >
                <i class="fas fa-fw fa-box mr-2" style="color:#6e707e"></i>
                <h1 class="h4 mb-0 text-gray-700 font-weight-bold">Pegawai</h1>
            </a>
            <i class="fas fa-fw fa-chevron-right"></i>
            <a class="nav-link d-flex align-items-center" href="" >
                <i class="fas fa-fw fa-plus mr-2" style="color:#6e707e"></i>
                <h1 class="h4 mb-0 text-gray-700 font-weight-bold">Tambah Pegawai</h1>
            </a>
            <ul class="navbar-nav ml-auto">
              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="userDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small"
                    >Admin</span
                  >
                  <img
                    class="img-profile rounded-circle"
                    src="Assets/img/undraw_profile.svg"
                  />
                </a>
                <!-- Dropdown - User Information -->
                <div
                  class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                  aria-labelledby="userDropdown"
                >
                  <a
                    class="dropdown-item"
                    href="#"
                    data-toggle="modal"
                    data-target="#logoutModal"
                  >
                    <i
                      class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"
                    ></i>
                    Logout
                  </a>
                </div>
              </li>
            </ul>
          </nav>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Databarang -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                  <h5 class="m-0 font-weight-bold text-success">
                    Tambah Pegawai
                  </h5>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <form action="" method="POST">
                    <div class="form-group">
                        <label for="id_pegawai">ID Pegawai <i class="fas fa-star-of-life" style="font-size: 7px; vertical-align: top; color: #ED2939"></i></label>
                        <input type="text" class="form-control shadow-sm" id="id_pegawai" name="id_pegawai" value="<?= $newID; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nama_pegawai">Nama Pegawai <i class="fas fa-star-of-life" style="font-size: 7px; vertical-align: top; color: #ED2939"></i></label>
                        <input type="text" class="form-control shadow-sm" id="nama_pegawai" name="nama_pegawai" placeholder="Masukkan nama pegawai" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat <i class="fas fa-star-of-life" style="font-size: 7px; vertical-align: top; color: #ED2939"></i></label>
                        <input type="text" class="form-control shadow-sm" id="alamat" name="alamat" placeholder="Masukkan alamat" required>
                    </div>

                    <div class="form-group">
                        <label for="no_telepon">No Telepon <i class="fas fa-star-of-life" style="font-size: 7px; vertical-align: top; color: #ED2939"></i></label>
                        <input type="number" class="form-control shadow-sm" id="no_telepon" name="no_telepon" placeholder="Masukkan no telepon" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin <i class="fas fa-star-of-life" style="font-size: 7px; vertical-align: top; color: #ED2939"></i></label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control shadow-sm" required>
                          <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                          <?php while($jenis = mysqli_fetch_assoc($query_get_jenis)) { ?>
                          <option value="<?= $jenis['id_jk']; ?>"><?php echo $jenis['jenis_kelamin']; ?></option>
                          <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="lokasi">Lokasi Penempatan <i class="fas fa-star-of-life" style="font-size: 7px; vertical-align: top; color: #ED2939"></i></label>
                        <select name="lokasi" id="lokasi" class="form-control shadow-sm" required>
                        <option value="" disabled selected>-- Pilih Lokasi Penempatan --</option>
                          <?php while($lokasi = mysqli_fetch_assoc($query_get_lokasi)) { ?>
                          <option value="<?= $lokasi['id_lokasi']; ?>"><?php echo $lokasi['nama_lokasi']; ?></option>
                          <?php } ?>
                        </select>
                    </div>
                    

                    <button type="submit" name="btn-simpan" class="btn btn-success mt-4">Simpan</button>
                    <button type="submit" name="btn-simpan" class="btn btn-secondary mt-4" onclick="back()">Batal</button>
                  </form>

                  <?php
                    if(isset($_POST['btn-simpan'])) {
                      $id_pegawai = $_POST['id_pegawai'];
                      $nama_pegawai = $_POST['nama_pegawai'];
                      $alamat = $_POST['alamat'];
                      $no_telepon = $_POST['no_telepon'];
                      $jenis_kelamin = $_POST['jenis_kelamin'];
                      $lokasi_barang = $_POST['lokasi'];

                      $query_insert = mysqli_query($mysqli, "INSERT INTO `pegawai`(`id_pegawai`, `nama_pegawai`, `alamat`, `no_telepon`, `id_jk`, `id_lokasi`) VALUES ('$id_pegawai','$nama_pegawai','$alamat','$no_telepon','$jenis_kelamin','$lokasi_barang')");

                      if($query_insert) {
                        ?>

                        <script>
                          Swal.fire({
                            title: "Berhasil!",
                            text: "Data Barang Berhasil Ditambahkan!",
                            icon: "success"
                          }).then(function() {
                             window.location.href = 'pegawai.php';
                          });
                        </script>

                        <?php

                      } else {
                        ?>

                        <script>
                          Swal.fire({
                            title: "Gagal!",
                            text: "Data Barang Gagal Ditambahkan!",
                            icon: "error"
                          }).then(function() {
                             window.location.href = 'pegawai.php';
                          });
                        </script>

                        <?php

                      }
                      
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; Go Groceries 2024</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div
      class="modal fade"
      id="logoutModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin ?</h5>
            <button
              class="close"
              type="button"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Pilih "Logout" di bawah jika Anda yakin untuk mengakhiri sesi Anda saat ini.
          </div>
          <div class="modal-footer">
            <button
              class="btn btn-secondary"
              type="button"
              data-dismiss="modal"
            >
              Cancel
            </button>
            <a class="btn btn-primary" href="login.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <script>
    function back() {
        window.history.back();
    }
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="Assets/vendor/jquery/jquery.min.js"></script>
    <script src="Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="Assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="Assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="Assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="Assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="Assets/js/demo/datatables-demo.js"></script>
</body>
</html>
