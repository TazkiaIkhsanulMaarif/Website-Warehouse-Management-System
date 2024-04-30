<?php
    session_start();
    include "koneksi.php";
    //dapatkan data user dari form register
    $user = [
    	'username' => $_POST['username'],
    	'password' => $_POST['password'],
    	'confirm-password' => $_POST['confirm-password'],
        'namalengkap' => $_POST['namalengkap'],
        'email' => $_POST['email'],
        'role' => $_POST['role'],
    ];
    //validasi jika password & password_confirmation sama
    if($user['password'] != $user['confirm-password']){
        $_SESSION['error'] = '<script language="javascript">alert("Ulangi.Password Anda tidak sama")</script>';
    	$_SESSION['namalengkap'] = $_POST['namalengkap'];
    	$_SESSION['username'] = $_POST['username'];
    	header("Location: index.php");
    	return;
    }
    //id otomatis
    $sql = mysqli_query($koneksi, "select max(iduser) as maxID from user");
    $data = mysqli_fetch_array($sql);

    $kode = $data['maxID'];
    $kode++;
    $ket = "ID";
    $kodeauto = sprintf("%02s", $kode);

    //check apakah user dengan username tersebut ada di table users
    $query = "select * from user where username = ? limit 1";
    $stmt = $koneksi->stmt_init();
    $stmt->prepare($query);
    $stmt->bind_param('s', $user['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array(MYSQLI_ASSOC);
    //jika username sudah ada, maka return kembali ke halaman register.
    if($row != null){
    	$_SESSION['error'] = '<script language="javascript">alert("Username: '.$user['username'].' yang anda masukkan sudah ada di database.")</script>';
    	$_SESSION['namalengkap'] = $_POST['namalengkap'];
    	$_SESSION['password'] = $_POST['password'];
    	$_SESSION['confirm-password'] = $_POST['confirm-password'];
    	header("Location: index.php");
    	return;
    }else{
        //hash password
    	$password = password_hash($user['password'],PASSWORD_DEFAULT);
    	//username unik. simpan di database.
    	$query = "insert into user (iduser, username, password, namalengkap, email, role) values  (?,?,?,?,?,?)";
    	$stmt = $koneksi->stmt_init();
    	$stmt->prepare($query);
    	$stmt->bind_param('ssssss', $kodeauto, $user['username'],$user['password'],$user['namalengkap'],$user['email'],$user['role']);
    	$stmt->execute();
        $result = $stmt->get_result();
    	var_dump($result);
        $_SESSION['message']  = 'Anda Sukses Registrasi';
    	header("Location: index.php");
    }
?>