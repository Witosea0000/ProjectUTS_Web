<?php
require_once "view/header.php";

if(isset($_POST['submit'])) {
$user = $_POST['user'];
$email = $_POST['email'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$telepon = $_POST['telepon'];
$pass = md5($_POST['pass']);
$code_auth = random_int(100000, 999999);

$cek_username = $pdo->query("SELECT * FROM tamu WHERE username= '$user'");
$cek_email = $pdo->query("SELECT * FROM tamu WHERE email= '$email'");

  if ($cek_username->rowCount() == 0 && $cek_email->rowCount() == 0) {
    $sqlsimpan = $pdo->query("INSERT INTO tamu VALUES('', '$user', '$email', '$nama', '$alamat', '$telepon', '$pass', '', '$code_auth', '')");

    
    require 'PHPMailer/PHPMailerAutoload.php';
      $email_pengirim = "tesakun000666@gmail.com";
      $isi="Silahkan klik tautan ini http://localhost:8080/sisfohotel/validasi?email=".$email."&code=".$code_auth." untuk memvalidasi email";
      $subjek="Verifikasi Email";
      $email_tujuan=$email;

      $mail = new PHPMailer();

      $mail->IsHTML(true);    // set email format to HTML
      $mail->IsSMTP();   // we are going to use SMTP
      $mail->SMTPAuth   = true; // enabled SMTP authentication
      $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
      $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
      $mail->Port       = 465;                   // SMTP port to connect to GMail
      $mail->Username   = $email_pengirim;  // alamat email kamu
      $mail->Password   = "tesakun666";            // password GMail
      $mail->SetFrom($email_pengirim, 'noreply');  //Siapa yg mengirim email
      $mail->Subject    = $subjek;
      $mail->Body       = $isi;
      $mail->AddAddress($email_tujuan);

      if(!$mail->Send()) {
          echo "Eror: ".$mail->ErrorInfo;
          exit;
      }else {
          echo"<script>swal({
            type: 'success',
            title: 'Registrasi Sukses!',
            showConfirmButton: false,
            backdrop: 'rgba(0,0,123,0.5)',
            });
            window.setTimeout(function(){
                window.location.replace('login');
            } ,1500);</script>";
      }

    echo"<script>swal({
            type: 'success',
            title: 'Registrasi Sukses!',
            showConfirmButton: false,
            backdrop: 'rgba(0,0,123,0.5)',
            });
            window.setTimeout(function(){
                window.location.replace('login');
            } ,1500);</script>";
    
  }else{
    echo"<script>swal({
            type: 'danger',
            title: 'Registrasi Gagal! Username atau Email sudah terdaftar!',
            showConfirmButton: false,
            backdrop: 'rgba(0,0,123,0.5)',
            });
            window.setTimeout(function(){
                window.location.replace('daftar');
          } ,1500);</script>";
    
  }
}

?>

<div>
  <img src="https://upload.wikimedia.org/wikipedia/commons/3/39/UAJY_Logo.png" width="100px" style="margin-left: -1110px; margin-top: -50px; margin-bottom: 20px;">
</div>

  <div id="daftar" style="margin-top: 60px;">
    <center>
      <h3>Isi Sesuai Kartu Identitas Anda (KTP/SIM/Passport)</h3>
      <hr>
      <form method="post" action="daftar" enctype="multipart/form-data">
        <input type="text" class="in" required="required" name="user" placeholder="Username">
        <input type="Email" class="in" required="required" name="email" placeholder="Email">
        <input type="text" class="in" required="required" name="nama" placeholder="Nama Lengkap">
        <input type="text" class="in" required="required" name="alamat" placeholder="Alamat">
        <input type="text" class="in" required="required" name="telepon" placeholder="Telepon">
        <input type="password" class="in" required="required" name="pass" placeholder="Password">
        <input type="submit" class="ins" name="submit" value="Daftar">
        <input type="reset" class="ins" name="" value="Reset">
      </form>
    </center>
  </div>

  <?php
    require_once "view/footer.php"
?>
