<?php
    require_once "view/header.php";

    $email = $_GET['email'];
    $code_auth = $_GET['code'];

    $email = $_GET['email'];
    $code_auth = $_GET['code'];

    $tamu = $pdo->query("SELECT * FROM tamu where email = '$email' AND code_auth = '$code_auth'");
    if($tamu->rowCount() == 0 ){
        echo "<script>swal({
            type: 'danger',
            title: 'Verifikasi Gagal!',
            showConfirmButton: false,
            backdrop: 'rgba(0,0,123,0.5)',
            });
            window.setTimeout(function(){
                window.location.replace('login');
            } ,1500);</script>";
    } else {
        $update = $pdo->query("UPDATE tamu SET is_active = '1' WHERE email = '$email'");
        echo "<script>swal({
            type: 'success',
            title: 'Verifikasi Berhasil!Silahkan Login',
            showConfirmButton: false,
            backdrop: 'rgba(0,0,123,0.5)',
            });
            window.setTimeout(function(){
                window.location.replace('login');
            } ,1500);</script>";
    }

    
?>