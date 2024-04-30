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
        <p>Anda Bukan Admin, Suppliers, atau Employee Staf.</p>
        <button type='button' onclick=location.href='../source/index.php'>Back</button>");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MWAREHOUSE || Main Page</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../source/index.php">
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
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Order</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="buttons.php">List Product</a>
                        <a class="collapse-item" href="charts.php">Cart</a>
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
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Manage</span>
                </a>
                <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item active" href="managedelivery.php">Manage Delivery</a>
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
                    <h1 class="h3 mb-1 text-gray-800">Color Utilities</h1>
                    <p class="mb-4">Bootstrap's default utility classes can be found on the official <a href="https://getbootstrap.com/docs">Bootstrap Documentation</a> page. The custom utilities below were created to extend this theme past the default utility classes
                        built into Bootstrap's framework.
                    </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of Items</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="btn-group mb-4">
                                    <button type="button" class="btn btn-primary" id="multiInsertBtn" data-bs-toggle="modal" data-bs-target="#multiInsertModal">Multi Insert</button>
                                </div>
                                <div class="btn-group mb-4">
                                    <input type="submit" name="multiple_update" id="multiple_update" class="btn btn-info" value="Multiple Update" disabled />
                                </div>
                                <div class="btn-group mb-4">
                                    <button type="button" class="btn btn-primary" id="multiRemoveBtn" disabled>Multi-Remove</button>
                                </div>
                                <form action="" method="post" id="form">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="5%"></th>
                                                <th width="20%">Nama Lengkap</th>
                                                <th width="30%">Kode Transaksi</th>
                                                <th width="15%">Status</th>
                                                <th width="20%">Alamat</th>
                                                <th width="10%">Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr style="display: none;">
                                                <td></td>
                                                <td contenteditable="true" class="item_namalengkap"></td>
                                                <td contenteditable="true" class="item_kodetransaksi"></td>
                                                <td contenteditable="true" class="item_status"></td>
                                                <td contenteditable="true" class="item_alamat"></td>
                                                <td contenteditable="true" class="item_tgl"></td>
                                            </tr>
                                            <tr>
                                                <th width="5%"></th>
                                                <th width="20%">Nama Lengkap</th>
                                                <th width="30%">Kode Transaksi</th>
                                                <th width="15%">Status</th>
                                                <th width="20%">Alamat</th>
                                                <th width="10%">Tanggal</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <!-- Data rows will be added dynamically here -->
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                <script>
                    $(document).ready(function() {
                        function fetch_data() {
                            $.ajax({
                                url: "./data/get-data-delivery.php",
                                method: "POST",
                                dataType: "json",
                                success: function(data) {
                                    var html = "";
                                    for (var count = 0; count < data.length; count++) {
                                        html += "<tr>";
                                        html += '<td><input type="checkbox" id="' + data[count].id_pengiriman + '" data-namalengkap="' + data[count].namalengkap + '" data-kodetransaksi="' + data[count].kodetransaksi + '" data-status="' + data[count].status + '" data-alamat="' + data[count].alamat + '" data-tgl="' + data[count].tgl + '" class="check_box updateCheckbox" /></td>';
                                        html += '<td>' + data[count].namalengkap + '</td>';
                                        html += '<td>' + data[count].kodetransaksi + '</td>';
                                        html += '<td>' + data[count].status + '</td>';
                                        html += '<td>' + data[count].alamat + '</td>';
                                        html += '<td>' + data[count].tgl + '</td></tr>';
                                    }
                                    $('tbody').html(html);
                                },
                            });
                        }

                        function fetchKodePesanan(callback) {
                            var xhr = new XMLHttpRequest();
                            xhr.open("GET", "./ajax/fetch-kodepesanan.php", true);

                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === 4 && xhr.status === 200) {
                                    var response = JSON.parse(xhr.responseText);

                                    var inputOptions = {};
                                    response.forEach(function(kodePesanan) {
                                        inputOptions[kodePesanan] = kodePesanan;
                                    });

                                    callback(inputOptions);
                                }
                            };

                            xhr.send();
                        }

                        function updateButtonStatus() {
                            var checkboxes = document.getElementsByClassName("updateCheckbox");
                            var multiUpdateBtn = document.getElementById("multiple_update");
                            var multiRemoveBtn = document.getElementById("multiRemoveBtn");

                            // Memeriksa apakah setidaknya satu checkbox terpilih
                            var isChecked = false;
                            for (var i = 0; i < checkboxes.length; i++) {
                                if (checkboxes[i].checked) {
                                    isChecked = true;
                                    break;
                                }
                            }

                            // Mengubah status tombol "Multiple Update" berdasarkan checkbox terpilih
                            if (isChecked) {
                                multiUpdateBtn.removeAttribute("disabled");
                                multiRemoveBtn.removeAttribute("disabled");
                            } else {
                                multiUpdateBtn.setAttribute("disabled", "disabled");
                                multiRemoveBtn.setAttribute("disabled", "disabled");
                            }
                        }

                        fetch_data();

                        $(document).on("change", ".updateCheckbox", function(event) {
                            updateButtonStatus();
                        });

                        $(document).on("click", ".check_box", function() {
                            var html = "";
                            if (this.checked) {
                                html =
                                    '<td><input type="checkbox" id="' +
                                    $(this).attr("id_pengiriman") +
                                    '" data-namalengkap ="' +
                                    $(this).data("namalengkap") +
                                    '" data-kodetransaksi ="' +
                                    $(this).data("kodetransaksi") +
                                    '" data-status="' +
                                    $(this).data("status") +
                                    '" data-alamat="' +
                                    $(this).data("alamat") +
                                    '" data-tgl="' +
                                    $(this).data("tgl") +
                                    '" class="check_box updateCheckbox" checked /></td>';
                                html +=
                                    '<td><select name="namalengkap[]" class="form-control item_namalengkap" value=""></select></td>';
                                html +=
                                    '<td><input type="text" name="kodetransaksi[]" class="form-control" value="' +
                                    $(this).data("kodetransaksi") +
                                    '" /></td>';
                                html += '<td><select name="status[]" id="status_' + $(this).attr('id_pengiriman') + '" class="form-control"><option value="Pending">Pending</option><option value="Shiped">Shiped</option><option value="Delivered">Delivered</option></select></td>';
                                html +=
                                    '<td><input type="text" name="alamat[]" class="form-control" value="' +
                                    $(this).data("alamat") +
                                    '" /></td>';
                                html +=
                                    '<td><input type="date" name="tgl[]" class="form-control" value="' +
                                    $(this).data("tgl") +
                                    '" /><input type="hidden" name="hidden_id[]" value="' +
                                    $(this).attr("id") +
                                    '" /></td>';
                            } else {
                                html =
                                    '<td><input type="checkbox" id="' +
                                    $(this).attr("id_pengiriman") +
                                    '" data-namalengkap="' +
                                    $(this).data("namalengkap") +
                                    '" data-kodetransaksi="' +
                                    $(this).data("kodetransaksi") +
                                    '" data-status="' +
                                    $(this).data("status") +
                                    '" data-alamat="' +
                                    $(this).data("alamat") +
                                    '" data-tgl="' +
                                    $(this).data("tgl") +
                                    '" class="check_box updateCheckbox" /></td>';
                                html += "<td>" + $(this).data("namalengkap") + "</td>";
                                html += "<td>" + $(this).data("kodetransaksi") + "</td>";
                                html += "<td>" + $(this).data("status") + "</td>";
                                html += "<td>" + $(this).data("alamat") + "</td>";
                                html += "<td>" + $(this).data("tgl") + "</td>";
                            }
                            $(this).closest("tr").html(html);
                            if (this.checked) {
                                var selectElement = $(this).closest("tr").find("select.item_namalengkap");
                                loadOptions(selectElement, $(this).data("namalengkap"));
                            }
                            if (this.checked) {
                                var selectElement = $(this).closest("tr").find("select[name='status[]']");
                                fetchKodePesanan(function(response) {
                                    for (var i = 0; i < response.length; i++) {
                                        var optionText = response[i].status;
                                        var optionValue = response[i].id_pengiriman;
                                        var option = new Option(optionText, optionValue);
                                        selectElement.append(option);
                                    }
                                    selectElement.val($(this).data("status"));
                                }.bind(this));
                            }
                            updateButtonStatus();
                        });

                        $(document).on("click", "#multiple_update", function(event) {
                            event.preventDefault();
                            if ($(".check_box:checked").length > 0) {
                                swal({
                                    title: "Konfirmasi",
                                    text: "Apakah Anda yakin ingin mengupdate data?",
                                    icon: "warning",
                                    buttons: ["Batal", "Ya"],
                                    dangerMode: true,
                                }).then(function(confirm) {
                                    if (confirm) {
                                        // Ambil data opsi namalengkap yang dipilih oleh pengguna
                                        var selectedOptions = [];
                                        $(".item_namalengkap").each(function() {
                                            selectedOptions.push($(this).val());
                                        });
                                        if (selectedOptions.length > 0) {
                                            $.ajax({
                                                url: "./ajax/multi-update.php",
                                                method: "POST",
                                                data: $("#form").serialize() + "&selectedOptions=" + encodeURIComponent(JSON.stringify(selectedOptions)),
                                                beforeSend: function() {
                                                    // Tampilkan pesan loading atau animasi loading di sini
                                                    // Misalnya:
                                                    $("#loading").show();
                                                },
                                                success: function(response) {
                                                    // Menampilkan data yang dikirim di multi-update.php
                                                    swal("Sukses", "Data Updated\n" + response, "success");
                                                    fetch_data();
                                                },
                                                complete: function() {
                                                    // Sembunyikan pesan loading atau animasi loading di sini
                                                    // Misalnya:
                                                    $("#loading").hide();
                                                },
                                                error: function(xhr, status, error) {
                                                    // Tangani kesalahan jika ada
                                                    console.log(xhr.responseText);
                                                }
                                            });
                                        } else {
                                            console.error("Data namalengkap tidak terkirim");
                                        }
                                    }
                                });
                            }
                        });

                        function loadOptions() {
                            $.ajax({
                                url: "./data/get-namalengkap.php",
                                method: "GET",
                                success: function(response) {
                                    // Tangani respon dari server
                                    var options = response;

                                    // Perbarui opsi pada setiap elemen .item_namalengkap
                                    $(".item_namalengkap").each(function() {
                                        var select = $(this);
                                        select.empty();

                                        // Tambahkan opsi dari data yang diterima
                                        options.forEach(function(option) {
                                            select.append("<option value='" + option.value + "'>" + option.label + "</option>");
                                        });
                                    });
                                },
                                error: function(xhr, status, error) {
                                    // Tangani kesalahan jika ada
                                    console.log(xhr.responseText);
                                }
                            });
                        }

                        function getnamalengkap(callback) {
                            $.ajax({
                                url: "./data/get-namalengkap.php",
                                method: "GET",
                                success: function(response) {
                                    // Tangani respon dari server
                                    var options = response;

                                    // Perbarui opsi pada setiap elemen .item_namalengkap
                                    $(".namaLengkap").each(function() {
                                        var select = $(this);
                                        select.empty();

                                        // Tambahkan opsi dari data yang diterima
                                        options.forEach(function(option) {
                                            select.append("<option value='" + option.value + "'>" + option.label + "</option>");
                                        });
                                    });
                                },
                                error: function(xhr, status, error) {
                                    // Tangani kesalahan jika ada
                                    console.log(xhr.responseText);
                                }
                            });
                        }

                        function getnama(callback) {
                            $.ajax({
                                url: "./data/get-namalengkap.php",
                                method: "GET",
                                success: function(response) {
                                    // Tangani respon dari server
                                    var options = response;

                                    // Perbarui opsi pada setiap elemen .item_namalengkap
                                    $(".namaLengkap:last").each(function() {
                                        var select = $(this);
                                        select.empty();

                                        // Tambahkan opsi dari data yang diterima
                                        options.forEach(function(option) {
                                            select.append("<option value='" + option.value + "'>" + option.label + "</option>");
                                        });
                                    });
                                },
                                error: function(xhr, status, error) {
                                    // Tangani kesalahan jika ada
                                    console.log(xhr.responseText);
                                }
                            });
                        }

                        // Tambahkan event listener untuk button multiInsert
                        $(document).on('click', '#multiInsertBtn', function() {
                            $('#multiInsertModal').modal({
                                backdrop: 'static',
                                keyboard: false,
                                show: true
                            });
                        });

                        // Ambil kode pesanan dan tambahkan sebagai pilihan select di awal
                        fetchKodePesanan(function(options) {
                            var selectElement = $('#kodePesanan');
                            $.each(options, function(key, value) {
                                selectElement.append($('<option>').text(value).attr('value', key));
                            });
                        });

                        // Ambil nama lengkap dan tambahkan sebagai pilihan select di input baru
                        getnama(function(options) {
                            // Memperbarui opsi pada elemen select terakhir
                            selectElement.append($('<option>').text(value).attr('value', key));
                        });

                        // Definisikan array dataRows
                        var dataRows = [];

                        $(document).on('click', '#addRowBtn', function() {
                            // Buat input baru untuk ditambahkan ke dalam modal
                            var newInput = '<div class="mb-3">' +
                                '<hr class="my-4">' +
                                '</div>' +
                                '<div class="mb-3">' +
                                '<label class="form-label">Nama Lengkap</label>' +
                                '<select name="namaLengkap" class="custom-select namaLengkap"></select>' +
                                '</div>' +
                                '<div class="mb-3">' +
                                '<label for="kodePesanan" class="form-label">Kode Pesanan</label>' +
                                '<select name="kodePesananInput" class="custom-select kodePesanan"></select>' +
                                '</div>' +
                                '<div class="mb-3">' +
                                '<label class="form-label">Kode Transaksi</label>' +
                                '<input type="text" class="form-control kodeTransaksi" value="">' +
                                '</div>' +
                                '<div class="mb-3">' +
                                '<label class="form-label">Status</label>' +
                                '<select name="status" class="custom-select status"><option value="ST001">Pending</option><option value="ST002">Shiped</option><option value="ST003">Delivered</option></select>' +
                                '</div>' +
                                '<div class="mb-3">' +
                                '<label class="form-label">Alamat</label>' +
                                '<input type="text" class="form-control alamat" value="">' +
                                '</div>' +
                                '<div class="mb-3">' +
                                '<label class="form-label">Tanggal</label>' +
                                '<input type="date" class="form-control tanggal" value="">' +
                                '</div>';

                            // Tambahkan input ke dalam modal
                            $('#multiInsertForm').append(newInput);

                            // Ambil nama lengkap dan tambahkan sebagai pilihan select di input baru
                            getnama(function(options) {
                                // Memperbarui opsi pada elemen select terakhir
                                selectElement.append($('<option>').text(value).attr('value', key));
                            });

                            // Ambil kode pesanan dan tambahkan sebagai pilihan select di input baru
                            var selectElement = $('#multiInsertForm').find('.kodePesanan:last');
                            fetchKodePesanan(function(options) {
                                $.each(options, function(key, value) {
                                    selectElement.append($('<option>').text(value).attr('value', key));
                                });
                            });
                        });

                        $(document).on('click', '#saveBtn', function() {
                            // Ambil nilai dari setiap input form
                            var formData = [];
                            $('.mb-3').each(function() {
                                formData.push({
                                    namaLengkap: $(this).find('.namaLengkap').val(),
                                    kodePesanan: $(this).find('.kodePesanan').val(),
                                    kodeTransaksi: $(this).find('.kodeTransaksi').val(),
                                    status: $(this).find('.status').val(),
                                    alamat: $(this).find('.alamat').val(),
                                    tanggal: $(this).find('.tanggal').val()
                                });
                            });

                            // Lakukan aksi penyimpanan data menggunakan AJAX
                            $.ajax({
                                url: './ajax/multi-insert-daftar_pengiriman.php',
                                method: 'POST',
                                data: {
                                    formData: formData
                                },
                                success: function(response) {
                                    try {
                                        // Parse response sebagai JSON
                                        var insertedIds = [response.id_pengiriman];

                                        // Menyiapkan teks untuk ditampilkan dalam konfirmasi
                                        var confirmationText = "Are you sure you want to save the data with the following ID Pengiriman(s):\n\n";

                                        // Tambahkan data id_pengiriman ke dalam teks konfirmasi
                                        insertedIds.forEach(function(id) {
                                            confirmationText += "ID Pengiriman: " + id + "\n";
                                        });

                                        // Tampilkan konfirmasi
                                        swal({
                                            title: "Confirmation",
                                            text: confirmationText + "Data: " + JSON.stringify(formData),
                                            icon: "info",
                                            buttons: true,
                                            dangerMode: false,
                                        }).then((confirm) => {
                                            if (confirm) {
                                                // Tambahkan ID Pengiriman ke dalam formData
                                                formData.forEach(function(data) {
                                                    data.idPengiriman = idPengiriman;
                                                });

                                                // Lakukan aksi penyimpanan data menggunakan AJAX
                                                $.ajax({
                                                    url: './ajax/multi-insert-detail_pengiriman.php',
                                                    method: 'POST',
                                                    data: {
                                                        formData: formData
                                                    },
                                                    success: function(response) {
                                                        // Kosongkan nilai input di form
                                                        $('.namaLengkap').val('');
                                                        $('.kodePesanan').val('');
                                                        $('.kodeTransaksi').val('');
                                                        $('.status').val('');
                                                        $('.alamat').val('');
                                                        $('.tanggal').val('');

                                                        // Kosongkan array formData
                                                        formData = [];

                                                        // Sembunyikan modal
                                                        $('#multiInsertModal').modal('hide');

                                                        // Tampilkan pesan sukses
                                                        swal("Success", "Data saved successfully", "success");
                                                    },
                                                    error: function(xhr, status, error) {
                                                        // Tampilkan pesan error
                                                        swal("Error", "Failed to save data", "error");
                                                    }
                                                });
                                            }
                                        });
                                    } catch (error) {
                                        console.error(error);
                                        // Tangani kesalahan jika parsing JSON gagal
                                        swal("Error", "Failed to parse server response: " + error, "error");
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                    // Tangani kesalahan AJAX
                                    swal("Error", "Failed to get ID Pengiriman", "error");
                                }
                            });
                        });

                        $(document).on('click', '#cancelBtn', function() {
                            // Kosongkan nilai input di form
                            $('#namaLengkap').val('');
                            $('#kodeTransaksi').val('');
                            $('#status').val('');
                            $('#alamat').val('');
                            $('#tanggal').val('');

                            // Sembunyikan modal
                            $('#multiInsertModal').modal('hide');
                        });

                        // Event handler untuk tombol "Multi-Remove"
                        $('#multiRemoveBtn').on('click', function() {
                            // Mengumpulkan ID record yang akan dihapus
                            var selectedIds = [];
                            var selectedData = [];

                            $('input.check_box:checked').each(function() {
                                var id = $(this).attr('id_pengiriman');
                                var namalengkap = $(this).data('namalengkap');
                                var kodetransaksi = $(this).data('kodetransaksi');
                                var status = $(this).data('status');
                                var alamat = $(this).data('alamat');
                                var tgl = $(this).data('tgl');

                                selectedIds.push(id);
                                selectedData.push({
                                    id_pengiriman: id,
                                    namalengkap: namalengkap,
                                    kodetransaksi: kodetransaksi,
                                    status: status,
                                    alamat: alamat,
                                    tgl: tgl
                                });
                            });

                            // Mengirim data multi-remove menggunakan AJAX
                            $.ajax({
                                url: './ajax/multi-remove-detail_pengiriman.php',
                                method: 'POST',
                                data: {
                                    selectedIds: selectedIds
                                },
                                success: function(response) {
                                    // Menampilkan konfirmasi menggunakan SweetAlert
                                    swal({
                                        title: "Confirmation",
                                        text: "Are you sure you want to remove the selected records?",
                                        icon: "warning",
                                        buttons: true,
                                        dangerMode: true,
                                    }).then((confirm) => {
                                        if (confirm) {
                                            // Mengirim data multi-remove menggunakan AJAX
                                            $.ajax({
                                                url: './ajax/multi-remove-daftar_pengiriman.php',
                                                method: 'POST',
                                                data: {
                                                    selectedIds: selectedIds
                                                },
                                                success: function(response) {
                                                    // Tampilkan pesan sukses
                                                    swal("Success", "Records removed successfully", "success");

                                                    // Hapus baris tabel yang terpilih dari tampilan
                                                    $('input.check_box:checked').closest('tr').remove();
                                                },
                                                error: function(xhr, status, error) {
                                                    // Tampilkan pesan error
                                                    swal("Error", "Failed to remove records", "error");
                                                }
                                            });
                                        }
                                    });
                                },
                                error: function(xhr, status, error) {
                                    // Tampilkan pesan error
                                    swal("Error", "Failed to remove records", "error");
                                }
                            });
                        });
                    });
                </script>


                <!-- Modal -->
                <div class="modal fade" id="multiInsertModal" tabindex="-1" aria-labelledby="multiInsertModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="multiInsertModalLabel">Modal Pengiriman</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="multiInsertForm">
                                    <div class="mb-3">
                                        <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                        <select id="namaLengkap" name="namaLengkap" class="custom-select namaLengkap">
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kodeTransaksi" class="form-label">Kode Transaksi</label>
                                        <input type="text" class="form-control kodeTransaksi" id="kodeTransaksi" name="kodeTransaksi">
                                    </div>
                                    <div class="mb-3">
                                        <label for="kodePesanan" class="form-label">Kode Pesanan</label>
                                        <select id="kodePesanan" name="kodePesanan" class="custom-select kodePesanan">
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select id="status" name="status" class="custom-select status">
                                            <option value="ST001">Pending</option>
                                            <option value="ST002">Shiped</option>
                                            <option value="ST003">Delivered</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control alamat" id="alamat" name="alamat">
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control tanggal" id="tanggal" name="tanggal">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelBtn">Cancel</button>
                                <button type="button" class="btn btn-primary" id="addRowBtn">Add Row</button>
                                <button type="button" class="btn btn-success" id="saveBtn">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="barangModal" tabindex="-1" role="dialog" aria-labelledby="barangModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="barangModalLabel">Ordered Items</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Content for displaying the list of ordered items -->
                                <ul id="orderedItemsList">

                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for updating address -->
                <div class="modal fade" id="updateAddressModal" tabindex="-1" role="dialog" aria-labelledby="updateAddressModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateAddressModalLabel">Update Address</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Add content here for updating the address -->
                                <form id="updateAddressForm">
                                    <div class="form-group">
                                        <label for="newAddress">New Address:</label>
                                        <input type="text" class="form-control" id="newAddress" name="newAddress">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="saveAddressBtn">Save Changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
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
                    <a class="btn btn-primary" href="login.html">Logout</a>
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script src="./js/filter-tanggal.js"></script>
    <script src="./js/modal-barang.js"></script>
    <script src="./js/update-address.js"></script>
    <script src="./js/addnewrow-manage-delivery.js"></script>
    <script src="./js/multi-update-delivery.js"></script>


</body>

</html>