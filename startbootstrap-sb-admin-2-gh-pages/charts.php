<?php

session_start();
include "../source/koneksi.php";

if (!isset($_SESSION['username'])) {
    die("<b>Oops!<?b> Access Failed
    <p>Sistem Logout. Anda harus melakukan Login kembali.</p>
    <button type='button' onclick=location.href='../source/index.php'>Back</button>
    ");
}

if ($_SESSION['role'] != "Admin" && $_SESSION['role'] != "Suppliers" && $_SESSION['role'] != "Staf") {
    die("<b>Oops!</b> Access Failed.
        <p>Anda Bukan Admin, Suppliers, atau Staf.</p>
        <button type='button' onclick=location.href='../source/index.php'>Back</button>");
}

?>

<?php

// tabel chart
$sql = "SELECT K.kategori, DP.jumlah_pesanan, B.harga, B.gambar, B.ukuran, B.nama_brg, DP.kodepesanan, DP.id_pesanan, DP.jumlah_pesanan, DP.kodepesanan
                                                    FROM detail_pesanan DP
                                                    INNER JOIN user U ON U.iduser = DP.iduser
                                                    INNER JOIN daftar_barang B ON DP.id_brang = B.id_barang
                                                    INNER JOIN kategori K ON B.id_kategori = K.id_kategori
                                                    WHERE DP.iduser = ? AND DP.kodepesanan LIKE 'KDO%'";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MWAREHOUSE || Main Page </title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/ui.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">

    <link href="assets/css/all.min.css" rel="stylesheet">
    <script src="assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="./js/multiremove-charts.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">MWAREHOUSE</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Product
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Order</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="buttons.php">List Product</a>
                        <a class="collapse-item active" href="cards.php">Cart</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="detaildelivery.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Detail Delivery</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Report
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Detail</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="dtuser.php">User</a>
                        <a class="collapse-item" href="dtstok.php">Stock of Goods</a>
                        <a class="collapse-item" href="dt.order.php">Order</a>
                        <div class="collapse-divider"></div>
                        <a class="collapse-item" href="dtdelivery.php">Delivery</a>
                        <a class="collapse-item" href="dtsuccesdelivery.php">Sucessful Delivery</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Manage</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="managedelivery.php">Manage Delivery</a>
                        <a class="collapse-item" href="order.php">Manage Order</a>
                        <a class="collapse-item" href="barang.php">Manage Barang</a>
                        <a class="collapse-item" href="stok.php">Manage Stok</a>
                        <a class="collapse-item" href="user.php">Manage User</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php
                                    $tampilPeg = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$_SESSION[username]'");
                                    $peg = mysqli_fetch_array($tampilPeg);
                                    echo $peg['namalengkap'];
                                    ?>
                                </span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Shooping Cart</h1>
                    </div>

                    <!-- Content Column -->

                    <!-- Shooping Cart -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"></h6>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-lg-2 col-4">
                                        <a href="#">Order List</a>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <form action="#" class="search">
                                            <div class="input-group w-100">
                                                <input type="text" class="form-control" placeholder="Search">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form> <!-- search-wrap .end// -->
                                    </div> <!-- col.// -->
                                    <button class="btn btn-light btn-remove" data-original-title="Remove selected">Remove</button>
                                </div> <!-- row.// -->
                            </div> <!-- container.// -->

                            <!-- ========================= SECTION CONTENT ========================= -->
                            <div class="container" style="margin-top:3%;">
                                <div class="row">
                                    <main class="col-md-9">
                                        <div class="card">
                                            <table class="table table-borderless table-shopping-cart">
                                                <thead class="text-muted">
                                                    <tr class="small text-uppercase">
                                                        <th scope="col">Product</th>
                                                        <th scope="col" width="120">Quantity</th>
                                                        <th scope="col" width="120">Price</th>
                                                        <th scope="col" class="text-right" width="200">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $stmt = mysqli_prepare($koneksi, $sql);
                                                    mysqli_stmt_bind_param($stmt, "s", $peg['iduser']);
                                                    mysqli_stmt_execute($stmt);
                                                    $result = mysqli_stmt_get_result($stmt);
                                                    $totalPrice = 0.0;
                                                    $discount = 658;
                                                    $totalAfterDiscount = 0.0;
                                                    // Mengecek apakah ada data yang ditemukan
                                                    if (mysqli_num_rows($result) > 0) {

                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $gambar = base64_encode($row['gambar']);
                                                            $harga = $row['harga'];
                                                            $kategori = $row['kategori'];
                                                            $ukuran = $row['ukuran'];
                                                            $nama_brg = $row['nama_brg'];
                                                            $jumlah = $row['jumlah_pesanan'];
                                                            $id_detail_pesanan = $row['kodepesanan'];
                                                            $id_pesanan = $row['id_pesanan'];

                                                            // Menampilkan data ke dalam template HTML
                                                    ?>
                                                            <tr>
                                                                <td>
                                                                    <figure class="itemside">
                                                                        <div class="aside">
                                                                            <img src="data:image/png;base64,<?php echo $gambar; ?>" alt="Gambar Barang" class="img-sm" width="80" height="80">
                                                                        </div>
                                                                        <figcaption class="info">
                                                                            <a href="#" class="title text-dark"><?php echo $nama_brg; ?></a>
                                                                            <p class="text-muted small">Kategori: <?php echo $kategori; ?>, Ukuran: <?php echo $ukuran; ?></p>
                                                                        </figcaption>
                                                                    </figure>
                                                                </td>
                                                                <td>
                                                                    <div class="quantity">
                                                                        <var class="price"><?php echo ($harga && $jumlah) ? $jumlah : '0'; ?></var>
                                                                    </div> <!-- price-wrap .// -->
                                                                </td>
                                                                <td>
                                                                    <div class="price-wrap">
                                                                        <var class="price"><?php echo ($harga && $jumlah) ? ($harga * $jumlah) : '0.0'; ?></var>
                                                                        <small class="text-muted"> IDR</small>
                                                                    </div> <!-- price-wrap .// -->
                                                                </td>
                                                                <td class="text-right">
                                                                    <div class="actions">
                                                                        <a data-original-title="Save to Wishlist" title="" href="" class="btn btn-light mr-2" data-toggle="tooltip"> <i class="fa fa-heart"></i></a>
                                                                        <label for="" style="visibility: hidden;">Selectaaaaaa</label>
                                                                        <input class="form-check-input" type="checkbox" name="selected_items[]" value="<?php echo $id_pesanan; ?>" style="margin-left: -7%;width:30px;height:30px;">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                            $totalPrice += ($harga && $jumlah) ? ($harga * $jumlah) : 0.0; // Menambahkan harga ke total harga
                                                        }
                                                        // Menghitung diskon
                                                        $totalAfterDiscount = ($totalPrice > 0.0) ? ($totalPrice - $discount) : 0.0;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>

                                            <div class="card-body border-top">
                                                <script src="./js/insert-pengiriman.js"></script>
                                                <input type="button" class="btn btn-primary float-md-right btn-purchase" data-original-title="Make Purchase" value="Make Purchase">
                                                <a href="buttons.php" class="btn btn-light"> <i class="fa fa-chevron-left"></i> Continue shopping </a>
                                            </div>

                                        </div> <!-- card.// -->

                                        <div class="alert alert-success mt-3">
                                            <p class="icontext"><i class="icon text-success fa fa-truck"></i> Free Delivery within 1-2 weeks</p>
                                        </div>

                                    </main> <!-- col.// -->
                                    <aside class="col-md-3">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label>Have coupon?</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="" placeholder="Coupon code">
                                                            <span class="input-group-append">
                                                                <button class="btn btn-primary">Apply</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div> <!-- card-body.// -->
                                        </div> <!-- card .// -->
                                        <div class="card">
                                            <div class="card-body">
                                                <dl class="dlist-align">
                                                    <dt>Total price:</dt>
                                                    <dd class="text-right">IDR
                                                        <?php
                                                        echo ($totalPrice > 0.0) ? $totalPrice : '0.0';

                                                        ?>
                                                    </dd>
                                                </dl>
                                                <dl class="dlist-align">
                                                    <dt>Discount:</dt>
                                                    <dd class="text-right">IDR <?php echo $discount; ?></dd>
                                                </dl>
                                                <dl class="dlist-align">
                                                    <dt>Total:</dt>
                                                    <dd class="text-right  h5"><strong>Rp.<?php echo ($totalAfterDiscount > 0.0) ? $totalAfterDiscount : '0.0'; ?></strong></dd>
                                                </dl>
                                                <hr>
                                                <p class="text-center mb-3">
                                                    <img src="assets/images/misc/payments.png" height="26">
                                                </p>

                                            </div> <!-- card-body.// -->
                                        </div> <!-- card .// -->
                                    </aside> <!-- col.// -->
                                </div>

                            </div> <!-- container .//  -->
                        </div>
                    </div>

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2020</span>
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
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

</body>

</html>