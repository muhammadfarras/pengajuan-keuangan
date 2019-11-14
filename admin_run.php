<?php
ob_start();
include ("advance.php");

// allow-log
logAllow ($_COOKIE['no_id']);

// only admin can go
logAdmin ($_COOKIE['no_id']);


?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Pengajuan Yayasan Imam Ahmad Bin Hanbal</title>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

<meta name="viewport" content="width=device-width"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <!-- Finale form -->
    
    
    
    
    
    
<!-- partial:index.partial.html -->
<?php
 include_once ("list.php");
?>

<section class="panel b-blue" id="2">
  <article class="panel__wrapper">
    <div class="panel__content">
      <h1 class="panel__headline"><i class="fa fa-user-plus" aria-hidden="true">Tambah Akun</i></h1>
      <div class="panel__block"></div>
       <?php
        if ($_POST['daftar']=="Submit"){
            
            $nama = mysqli_real_escape_string ($koneksi,htmlentities ( strip_tags ( trim ( $_POST['nama']) ) ) );
            
            $user = mysqli_real_escape_string ($koneksi, strtolower ( htmlentities ( strip_tags ( trim ( $_POST['usname']) ) ) ) );
            
            $email = mysqli_real_escape_string ($koneksi,htmlentities ( strip_tags ( trim ( $_POST['email']) ) ) );
            
            // MD5 Pass
            $pass = md5 ($_POST['password']);
            
            
            $query = "INSERT INTO user (username,password,akses,nama,no_hp,email) VALUES ('$user','$pass','$_POST[akses]','$nama','$_POST[nohp]','$email')";
            
            $sqladd = mysqli_query ($koneksi,$query);
            
            echo $efek = mysqli_affected_rows ($koneksi);
            
            if ($efek){
                
                header ("location: admin.php?s=Akun berhasil dibuat");
                
            }
        }
    ?>
    </div>
  </article>
</section>

<!-- partial -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="js/script.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script  src="js/cure-jav.js"></script>
</body>
</html>