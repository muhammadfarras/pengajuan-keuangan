<?php
ob_start();
include ("advance.php");

// allow-log
logAllow ($_COOKIE['no_id']);

// back to
if (!logApprove ($_COOKIE['akses'])){
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
</head>
<body>
<!-- partial:index.partial.html -->
<?php
 include_once ("list.php");
?>

<section class="panel b-red" id="3">
  <article class="panel__wrapper">
    <div class="panel__content">
      <h1 class="panel__headline"><i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;Persetujuan</h1>
      <div class="panel__block"></div>
      
      <?php
      // form final

 
      if (isset($_POST['setuju'])){
       
         // Update database
         $queryUpdate = "UPDATE submission SET status = 'approved' WHERE kode = '$_POST[kode]'";
         $sqlUdpate = mysqli_query ($koneksi,$queryUpdate);
         
         // insert into riwayat baru
         $nama = mysqli_real_escape_string ($koneksi,$_POST['nama']);
         $admin = mysqli_real_escape_string ($koneksi,$_POST['administrator']);
         
         $queryInsert = "INSERT INTO riw_persetujuan (kode,noid,nama_pengaju,nominal_pengaju,administrator) VALUES ('$_POST[kode]','$_POST[noid]','$nama','$_POST[nominal]','$admin')";
         $sqlInsert = mysqli_query ($koneksi,$queryInsert);
         
         echo mysqli_error ($koneksi);
         
         echo "<h1 class='panel__headline'>Pengajuan disetuji</h1>";
       
         echo "</div>";
         echo "</article>";
         echo "</section>";
         
         echo "<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>";
         echo "<script  src='js/script.js'></script>";
         echo "</body>";
         echo "</html>";
         exit();
      }
      
      if (isset($_POST['tolak'])){
        // Update database
         $queryUpdate = "UPDATE submission SET status = 'rejected' WHERE kode = '$_POST[kode]'";
         $sqlUdpate = mysqli_query ($koneksi,$queryUpdate);
         
         // insert into riwayat baru
         $nama = mysqli_real_escape_string ($koneksi,$_POST['nama']);
         $admin = mysqli_real_escape_string ($koneksi,$_POST['administrator']);
         
         $queryInsert = "INSERT INTO riw_tolak (kode,noid,nama_pengaju,nominal_pengaju,administrator) VALUES ('$_POST[kode]','$_POST[noid]','$nama','$_POST[nominal]','$admin')";
         $sqlInsert = mysqli_query ($koneksi,$queryInsert);
         
         echo mysqli_error ($koneksi);
         
         echo "<h1 class='panel__headline'>Pengajuan sudah ditolak</h1>";
       
         echo "</div>";
         echo "</article>";
         echo "</section>";
         
         echo "<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>";
         echo "<script  src='js/script.js'></script>";
         echo "</body>";
         echo "</html>";
         exit();
      }
      
      
      
      
      if (!empty($_GET['kode'])){
         $query = "SELECT * FROM submission WHERE kode = '$_GET[kode]'";
        
        $sql = mysqli_query ($koneksi,$query);
        
        $efek = mysqli_affected_rows ($koneksi);
        
        
        // jika tidak ada yang di input
        if (!$efek){
         echo "<h1 class='panel__headline'>Data yang antum input tidak ada . . .</h1>";
         echo "<h2  class='panel__headline'><a href='approve.php'>Back . . . </a></h2>";
         echo "</div>";
         echo "</article>";
         echo "</section>";
         
         echo "<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>";
         echo "<script  src='js/script.js'></script>";
         echo "</body>";
         echo "</html>";
         echo die();
        }
        
        $data = mysqli_fetch_assoc ($sql);
        
        
        // check lampiran
        
        if (!empty($data['lampiran'])){
         $lampiran = "<a class=lamp_approve target=_blank href='$data[lampiran]'><i class='fa fa-file-pdf-o' aria-hidden='true'></i></a>";
        }
        else {
         $lampiran = "<a class=lamp_approve target=_blank href='#'><i class='fa fa-minus' aria-hidden='true'></i></a>";
        }
        
        
        echo "<table>";
         echo "<tr><td><b>Nama</b></td><td>$data[nama_pengajuan]</td></tr>";
         echo "<tr><td><b>Kode</b></td><td>$data[kode]</td></tr>";
         echo "<tr><td><b>Nominal</b></td><td>".number_format ( $data['nominal_pengajuan'],0 )."</td></tr>";
         echo "<tr><td><b>Keterangan</b></td><td>$data[keterangan]</td></tr>";
         echo "<tr><td><b>Lampiran</b></td><td>$lampiran</td></tr>";
         echo "<form method='post'>";
         // Inout hiden
         echo "<input name=kode type=hidden value=$data[kode]>";
         echo "<input name=noid type=hidden value=$data[noid]>";
         echo "<input name=nama type=hidden value='$data[nama_pengajuan]'>";
         echo "<input name=nominal type=hidden value=$data[nominal_pengajuan]>";
         echo "<input name=administrator type=hidden value=\"".$_COOKIE["nama"]."\">";
         echo "<tr><td><input name='setuju' class='approve' style='font-family: FontAwesome' value='&#xf00c;' type='submit'></td>";
         echo "<td><input name='tolak' class='approve' style='font-family: FontAwesome' value='&#xf05e;' type='submit'></td></tr>";
         echo "</form>";
        echo "<table>";
      }
      ?>
    </div>
  </article>
</section>
<!-- partial -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="js/script.js"></script>

</body>
</html>
