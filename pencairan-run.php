<?php
ob_start();
include ("advance.php");

// allow-log
logAllow ($_COOKIE['no_id']);

// back to
if (!logPencairan ($_COOKIE['akses'])){
 header ("location: error.php");
}
if (!isset($_POST) || empty ($_POST)){
 header ("location: error.php");
}


?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Persetujuan Anggaran</title>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

<meta name="viewport" content="width=device-width"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="css/style.css">
<style>
</style>
</head>
<body>
<!-- partial:index.partial.html -->
<?php
 include_once ("list.php");
?>

<section class="panel b-pink" id="3">
  <article class="panel__wrapper">
    <div class="panel__content">
      <h1 class="panel__headline"><i class="fa fa-university" aria-hidden="true"></i></i>&nbsp;Pencairan</h1>
      <div class="panel__block"></div>
      
      <?php
       print_r ($_POST);      
       /*
        * Change status to funded
       */
       
       $query = "UPDATE submission SET status = 'funded' WHERE kode = '$_POST[kode]'";
       $squery = mysqli_query ($koneksi,$query);
       $efek = mysqli_affected_rows ($koneksi);
       
       if ($efek){
        
        /*
         * Insert riwayat pengambil dana
        */
        
        $namaPengambil = mysqli_real_escape_string ($koneksi,$_POST['pengambil_dana']);
        $namaPengaju = mysqli_real_escape_string ($koneksi,$_POST['namaPengaju']);
        $nominal = strtoint ( $_POST['nominal'] );
        $kasir = mysqli_real_escape_string ($koneksi,$_COOKIE['nama']);
        
        $riwquery = "INSERT INTO riw_pengambilan (kode,noid,nama_pengaju,nominal_pengajuan,pengambil_dana,nominal_pengambilan,kasir)
        VALUES ('$_POST[kode]','$_POST[noid]','$namaPengaju','$_POST[nominal_pengaju]','$namaPengambil','$nominal','$kasir')";
        $myriw = mysqli_query ($koneksi,$riwquery);
        
        $efek = mysqli_affected_rows ($koneksi);
        
        if ($efek){
         
         header ("location: pencairan.php?notice=Kode pengajuan $_POST[kode] dengan nominal sebesar $nominal telah diambil . . .");
         
        }
        else {
         header ("location: pencairan.php?notice=Terjadi erro, harap hubungi admin");
        }
       }
       else {
        header ("location: pencairan.php?notice=Terjadi erro, harap hubungi admin");
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