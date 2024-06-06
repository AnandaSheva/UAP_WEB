<?php 
    include "conn/conn.php";

    $query_table = mysqli_query($mysqli, "SELECT 
                                            barang.id_barang, 
                                            barang.nama_barang, 
                                            jenis_barang.jenis, 
                                            COALESCE(masuk.total_masuk, 0) AS total_barang_masuk, 
                                            COALESCE(keluar.total_keluar, 0) AS total_barang_keluar, 
                                            barang.stok, 
                                            lokasi_penyimpanan.nama_lokasi 
                                        FROM 
                                            barang
                                        LEFT JOIN 
                                            (SELECT id_barang, SUM(jumlah_barang) AS total_masuk 
                                            FROM barang_masuk 
                                            GROUP BY id_barang) masuk ON barang.id_barang = masuk.id_barang
                                        LEFT JOIN 
                                            (SELECT id_barang, SUM(jumlah_barang) AS total_keluar 
                                            FROM barang_keluar 
                                            GROUP BY id_barang) keluar ON barang.id_barang = keluar.id_barang
                                        LEFT JOIN 
                                            jenis_barang ON barang.id_jenisbarang = jenis_barang.id_jenisbarang 
                                        LEFT JOIN 
                                            lokasi_penyimpanan ON barang.id_lokasi = lokasi_penyimpanan.id_lokasi;");



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>GoGroceries - Laporan</title>

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

        <!-- Nav Item - Barang Masuk -->
        <li class="nav-item">
          <a class="nav-link" href="">
            <i class="fas fa-fw fa-box-open"></i>
            <span>Barang Masuk</span></a>
        </li>

        <!-- Nav Item - Barang -->
        <li class="nav-item">
          <a class="nav-link" href="">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Barang Keluar</span></a>
        </li>

        <hr class="sidebar-divider d-none d-md-block" />

        <div class="sidebar-heading">Laporan</div>

        <li class="nav-item active">
          <a class="nav-link" href="laporan.php">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Laporan</span></a>
        </li>

        <hr class="sidebar-divider d-none d-md-block" />

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
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
            <a class="nav-link d-flex align-items-center" href="manajer-laporan.php" >
                <i class="fas fa-fw fa-file-alt mr-2" style="color:#6e707e"></i>
                <h1 class="h4 mb-0 text-gray-700 font-weight-bold">Laporan</h1>
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
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-success">
                      Laporan Inventaris Barang
                    </h5>
                    <a href="" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary rounded-pill shadow-sm">
                        <i class="fas fa-print fa-sm text-white-100 ms-1"></i>&nbsp;
                        Print Laporan 
                    </a>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    class="table table-borderless"
                    id="dataTable"
                    width="100%"
                    cellspacing="0"
                  >
                    <thead class="thead-light">
                        <tr>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Stock In</th>
                            <th>Stock Out</th>
                            <th>Stock Akhir</th>
                            <th>Lokasi Barang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($result = mysqli_fetch_assoc($query_table)) { ?>
                        <tr>
                            <td><?= $result['id_barang'] ?></td>
                            <td><?= $result['nama_barang'] ?></td>
                            <td><?= $result['jenis'] ?></td>
                            <td><?= $result['total_barang_masuk'] ?></td>
                            <td><?= $result['total_barang_keluar'] ?></td>
                            <td><?= $result['stok'] ?></td>
                            <td><?= $result['nama_lokasi'] ?></td>
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