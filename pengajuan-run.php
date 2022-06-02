<?php
ob_start();
include ("advance.php");

// allow-log
logAllow ($_COOKIE['no_id']);



/* Keterangan Error */

  if (!empty ($_POST['nominal']) && !empty ($_POST['keterangan'])){
      $error = errorfile ($_FILES['lampiran']['error']);
      
      // Jika tidak ada error
      if ($error == ""){
        
        // validasi file pdf
        if ($_FILES['lampiran']['type'] == "application/pdf"){
          
          $tmp = $_FILES['lampiran']['tmp_name'];
          $lokasi = "lampiran";
          $namafile = "lampiran-".$_POST['kode_pengajuan'];
          $lampiran = $lokasi."/".$namafile;
          move_uploaded_file ($tmp,$lampiran.".pdf");
          
          // Kirim ke database
          
          $kodepengajuan = $_POST["kode_pengajuan"];
          $nama = mysqli_real_escape_string ($koneksi,$_POST['nama']);
          $keterangan = mysqli_real_escape_string ($koneksi,$_POST['keterangan']);
          $nominal = strtoint ($_POST['nominal']);
          
          $query = "INSERT INTO submission (kode, noid, nama_pengajuan, waktu_pengajuan, nominal_pengajuan,lampiran, keterangan, status)
          VALUES ( '$kodepengajuan','$_COOKIE[no_id]','$nama','$_POST[waktu_pengajuan]','$nominal','$lampiran.pdf','$keterangan','$_POST[status_pengajuan]')";
          
          $myque = mysqli_query ($koneksi,$query);
          
          echo mysqli_error ($koneksi);
        }
        else {
          $error1 = "File harus berupa PDF";
          header ("location: pengajuan.php?w=$error1");
        }
        
      }
      elseif ($error == 1){
        
        // Kirim ke database
          
          $kodepengajuan = $_POST["kode_pengajuan"];
          $nama = mysqli_real_escape_string ($koneksi,$_POST['nama']);
          $keterangan = mysqli_real_escape_string ($koneksi,$_POST['keterangan']);
          $nominal = strtoint ($_POST['nominal']);
          
          $query = "INSERT INTO submission (kode, noid, nama_pengajuan, waktu_pengajuan, nominal_pengajuan, keterangan, status) VALUES
          ( '$kodepengajuan','$_COOKIE[no_id]','$nama','$_POST[waktu_pengajuan]','$nominal','$keterangan','$_POST[status_pengajuan]')";
          
          $myque = mysqli_query ($koneksi,$query);
          
          echo mysqli_error ($koneksi);
      }
      else {
        header ("location: pengajuan.php?w=$error");
      }
  }
  else {
    $error = "Harap isian diisi";
    header ("location: pengajuan.php?w=$error");
  }


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

<section class="panel b-yellow" id="2">
  <article class="panel__wrapper">
    <div class="panel__content">
      <h1 class="panel__headline"><i class="fa fa-bolt"></i>&nbsp;Pengajuan Anggaran</h1>
      <div class="panel__block"></div>
      
      <?php
      
      echo "<table style=text-align:left>";
      echo "<tr><td><b>Nama </b></td><td>: $_POST[nama]</td></tr>";
      echo "<tr><td><b>Kode Pengajuan </b></td><td>: ".$_POST['kode_pengajuan']."</td></tr>";
      echo "<tr><td><b>Nominal </b></td><td>: $_POST[nominal]</td></tr>";
      echo "<tr><td><b>Keterangan </b></td><td>: $_POST[keterangan]</td></tr>";
      
      if ($error == ""){
        
        echo "<tr><td><b>Lampiran </b></td><td>: <a target=_blank href=$lampiran.pdf>Lampiran</a></td></tr>";
        
      }
      else {
        
        echo "<tr><td><b>Lampiran </b></td><td>: Tidak ada lampiran</td></tr>";
        
      }
      echo "<tr><td colspan=2><a href=home.php>Back to homepage</a></td></tr>";
      
      echo "</table>";
      

      
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