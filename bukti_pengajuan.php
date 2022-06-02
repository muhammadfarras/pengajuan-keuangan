<?php
ob_start();
include ("advance.php");

// allow-log
logAllow ($_COOKIE['no_id']);
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Vertical Layout with Navigation</title>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="css/style.css">
<style>
 
 tr {
  text-align: left;
 }
 
</style>
</head>
<body>
 <!-- partial:index.partial.html -->
<?php
 include_once ("list.php");
?>
 <?php
 
 switch ($_POST['status']){
  
  case 'rejected';
   $hquery = "UPDATE riw_tolak SET sembunyikan = '0' WHERE kode = '$_POST[status]'";
   $mhsquery = mysqli_query ($koneksi,$hquery);
   
   header ("location: home.php");
   break;
  
  case 'approved';
   
   break;
  
  default;
   header ("location: home.php");
   break;
 }
 
 ?>
<section class="panel " id="1">
  <article class="panel__wrapper">
    <div class="panel__content">
      <form action="bukti_pengajuan_run.php" method="post">
       <input name='kode_sub' class='print_pdf' style='font-family: FontAwesome' value='&#xf1c1;' type='submit'>
       <input name='kode' type='hidden' value="<?php echo $_POST['kode']; ?>">
      </form>
      <h1 class="panel__headline">Pengajuan Anggaran</h1>
      <p class="panel__headline"><?php echo $_POST['kode']; ?></p>
      <div class="panel__block">Harap berkas ini ditunjukan ke kasir untuk pengambilan dana . . .</div>
      
      <?php
       $query = "SELECT administrator,nominal_pengaju,nama_pengaju FROM riw_persetujuan WHERE kode = '$_POST[kode]'";
       $sql = mysqli_query ($koneksi,$query);
       $data = mysqli_fetch_assoc ($sql);
       
       $query2 = "SELECT keterangan FROM submission WHERE kode = '$_POST[kode]'";
       $sql2 = mysqli_query ($koneksi,$query2);
       $data2 = mysqli_fetch_assoc ($sql2);
      ?>
      
      <table>
       <tr><td>Pengaju</td><td><?php echo $data['nama_pengaju']; ?></td></tr>
       <tr><td>Nominial</td><td><?php echo number_format($data['nominal_pengaju'],0); ?></td></tr>
       <tr><td>Keterangan</td><td><?php echo $data2['keterangan']; ?></td></tr>
       <tr><td>Penyetuju</td><td><?php echo $data['administrator']; ?></td></tr>
       <tr><td></td><td></td></tr>
       <tr><td></td><td></td></tr>
       <tr><td></td><td></td></tr>
       <tr><td>____________________<br>Pengambil Dana</td><td>____________________<br>Kasir</td></tr>
      </table>
      
      
    </div>
  </article>
</section>
<!-- partial -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="js/script.js"></script>

</body>
</html>