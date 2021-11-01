<?php
    require_once "view/header.php";

if(isset($_POST['submit'])) {
$username = $_POST['username'];
$password = md5($_POST['password']);
$sqll = $pdo->query("SELECT * FROM tamu WHERE username='$username' && password='$password'");
$cari = $sqll->rowCount();
$akses = $sqll->fetch();

if($cari){

    if($akses['is_active'] != '1'){
        echo "<script>swal({
            type: 'error',
            title: 'Login Gagal! Silahkan cek email Anda untuk memvalidasi akun!',
            showConfirmButton: false,
            backdrop: 'rgba(123,0,0,0.5)',
            });
            window.setTimeout(function(){
                window.location.replace('login');
            } ,1500); </script>";
    } else {
        $_SESSION['user'] = $akses['idtamu'];
        echo "<script>swal({
            type: 'success',
            title: 'Login Sukses!',
            showConfirmButton: false,
            backdrop: 'rgba(0,0,123,0.5)',
            });
            window.setTimeout(function(){
                window.location.replace('user/');
            } ,1500); </script>";
    }

    
}else{
    echo "<script>swal({
        type: 'error',
        title: 'Maaf Login Gagal!',
        showConfirmButton: false,
        backdrop: 'rgba(123,0,0,0.5)',
        });
        window.setTimeout(function(){
            window.location.replace('login');
        } ,1500); </script>";
}
}
?>

<div>
    <img src="https://upload.wikimedia.org/wikipedia/commons/3/39/UAJY_Logo.png" width="100px" style="margin-left: -1110px; margin-top: -50px; margin-bottom: 20px;">
</div>

<div>
    <center>
        <div id="backlogin">
            <h1>Silahkan Login</h1>
            <br>
            
            <hr>
            <form action="login" method="post">
                <input type="text" class="inputa" name="username" class="input" placeholder="Nama Pengguna">
                <input type="password" class="inputa" name="password" placeholder="Kata Sandi">
                <input type="submit" class="wed" name="submit" value="Login">
                <input type="reset" class="wed" name="" value="Reset">
            </form>
        </div>
    </center>
</div>
