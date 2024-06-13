<?php 
    include "conn/conn.php";

    $query_table = mysqli_query($mysqli, "SELECT id_barang, nama_barang, jenis, nama_lokasi, stok 
                                        FROM barang, jenis_barang, lokasi_penyimpanan 
                                        WHERE barang.id_jenisbarang = jenis_barang.id_jenisbarang AND 
                                        barang.id_lokasi = lokasi_penyimpanan.id_lokasi 
                                        ORDER BY barang.id_barang ASC LIMIT 10");

    $query_databarang = mysqli_query($mysqli, "SELECT COUNT(*) AS jumlah FROM barang");
    $temp = mysqli_fetch_assoc($query_databarang);
    $jml_brg = $temp['jumlah'] ?? 0;

    $query_barangmasuk = mysqli_query($mysqli, "SELECT SUM(jumlah_barang) AS total FROM barang_masuk");
    $temp = mysqli_fetch_assoc($query_barangmasuk);
    $brg_msk = $temp['total'] ?? 0;

    $query_barangkeluar = mysqli_query($mysqli, "SELECT SUM(jumlah_barang) AS total FROM barang_keluar");
    $temp = mysqli_fetch_assoc($query_barangkeluar);
    $brg_klr = $temp['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>GoGroceries - Dashboard</title>

    <!-- Custom fonts -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles -->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- icon -->
    <link rel="icon" href="assets/img/icons.png">

    <!-- Internal Personal CSS -->
    <style>
      .no-effect:hover{
        text-decoration: none;
      }
    </style>
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
        <li class="nav-item active">
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

        <li class="nav-item">
          <a class="nav-link" href="pegawai.php">
            <i class="fas fa-fw fa-user"></i>
            <span>Pegawai</span></a>
        </li>
        <!-- End Sidebar -->
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
            <a class="nav-link d-flex align-items-center" href="index.php" >
                <i class="fas fa-fw fa-home mr-2" style="color:#6e707e"></i>
                <h1 class="h4 mb-0 text-gray-700 font-weight-bold">Dashboard</h1>
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
          
                      <!-- Content Card -->
                      <div class="row justify-content-center">
                        <!-- Data Barang -->
                        <div class="col-xl-4 col-md-6 mb-4">
                          <div class="card border-left-secondary shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div
                                    class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                  >
                                    Data Barang (Total)
                                  </div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $jml_brg; ?>
                                  </div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-box fa-2x text-gray-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          
                        <!-- Barang Masuk -->
                        <div class="col-xl-4 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div
                                    class="text-xs font-weight-bold text-success text-uppercase mb-1"
                                  >
                                    Barang Masuk
                                  </div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $brg_msk; ?>
                                  </div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-box-open fa-2x text-gray-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          
                        <!-- Barang Keluar -->
                        <div class="col-xl-4 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div
                                    class="text-xs font-weight-bold text-success text-uppercase mb-1"
                                  >
                                    Barang Keluar
                                  </div>
                                  <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                      <div
                                        class="h5 mb-0 mr-3 font-weight-bold text-gray-800"
                                      >
                                        <?php echo $brg_klr; ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-auto">
                                  <i
                                    class="fas fa-boxes fa-2x text-gray-300"
                                  ></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
  
                      </div>
          <div class="container-fluid">
    
            <!-- Databarang -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <div class="d-sm-flex align-items-center justify-content-between">
                      <h5 class="m-0 font-weight-bold text-success">
                        Data Barang Sembako
                      </h5>
                      <a class="m-0 font-weight-bold text-primary no-effect" href="barang.php">
                        <span>Lihat Semua</span>
                        <i class="fas fa-fw fa-angle-double-right"></i>
                      </a>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    class="table table-borderless"
                    width="100%"
                    cellspacing="0"
                  >
                    <thead class="thead-light">
                        <tr>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Lokasi Barang</th>
                            <th>Stok Barang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($result = mysqli_fetch_assoc($query_table)) { ?>
                        <tr>
                            <td><?= $result['id_barang'] ?></td>
                            <td><?= $result['nama_barang'] ?></td>
                            <td><?= $result['jenis'] ?></td>
                            <td><?= $result['nama_lokasi'] ?></td>
                            <td><?= $result['stok'] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                  </table>
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
