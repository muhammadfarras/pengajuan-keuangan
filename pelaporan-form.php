<?php
ob_start();
include ("advance.php");

// allow-log
logAllow ($_COOKIE['no_id']);

// back to
if (!logPelaporan ($_COOKIE['akses'])){
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

<section class="panel b-orange" id="3">
  <article class="panel__wrapper">
    <div class="panel__content">
      <h1 class="panel__headline"><i class="fa fa-files-o" aria-hidden="true"></i></i>&nbsp;Pelaporan</h1>
      <div class="panel__block"></div>
      
      
      <?php
       $query = "SELECT * FROM riw_pengambilan WHERE kode = '$_POST[kode]'";
       $squery = mysqli_query ($koneksi,$query);
       
       $efek = mysqli_affected_rows ($koneksi);
       $data = mysqli_fetch_assoc ($squery);
       
       $query2 = "SELECT * FROM riw_persetujuan WHERE kode = '$_POST[kode]'";
       $squery2 = mysqli_query($koneksi,$query2);
       $data2 = mysqli_fetch_assoc ($squery2);
       
       $query3 = "SELECT * FROM submission WHERE kode = '$_POST[kode]'";
       $squery3 = mysqli_query($koneksi,$query3);
       $data3 = mysqli_fetch_assoc ($squery3);
       
        echo "<pre>";
         // print_r ($data);
        echo "</pre>";
      
       ?>
      <form method="post" action="pelaporan-run.php" enctype="multipart/form-data">
       <table>
        
        <tr><td colspan=2 style="text-align: center;">Kode pengajuan : <b><?php echo $data['kode']?></b></td></tr>
        <tr><td>Nama pengaju</td><td><?php echo $data['nama_pengaju'] ?></td></tr>
        <tr><td>Nominal pengajuan</td><td><?php echo "Rp. ".number_format ($data['nominal_pengajuan'],0); ?></td></tr>
        <tr><td>Keterangan</td><td><?php echo $data3['keterangan'] ?></td></tr>
        
        <tr>
         <td>Lampiran</td>
         <td>
         <?php
           
           if (!empty ($data3['lampiran'])){
         ?>
            <a href="<?php echo $data3['lampiran']; ?>" class="fa fa-file-pdf-o" aria-hidden="true"> <i>Lampiran</i></a>
         <?php
           }
           else {
          ?>
           <i class="fa fa-window-minimize" aria-hidden="true"></i>
         <?php
           }
         ?>
         
         </td>
        </tr>
        
        
        <tr><td>Penyetuju nggaran</td><td><?php echo $data2['administrator'] ?></td></tr>
        <tr><td>Pengambil dana<td><?php echo $data['pengambil_dana'] ?></td></tr>
        <tr><td>Nominal pengambilan dana</td><td><?php echo "Rp. ".number_format ($data['nominal_pengambilan'],0); ?></td></tr>
        <tr><td>Kasir<td><?php echo $data['kasir'] ?></td></tr>
        <tr>
         <td>Pelapor Dana</td>
         <td>
          <input type="text" name="pelapor_dana" list="nama" autocomplete="off" required>
          <datalist id="nama">
           
           <option><?php echo $data['nama_pengaju'];  ?></option>
           
          </datalist>
         </td>
        </tr>
        <tr>
         <td>Nominal pelaporan</td>
         <td>
           <input name="nominal_laporan" maxlength=14 type="text" value="" data-type="currency" placeholder="Nominal pencairan" required="required" autocomplete="off">
         </td>
        </tr>
        <tr>
         <td>
          Lampiran PDF
         </td>
         <td>
          <input name="lampiran_laporan" type="file" id="file" autocomplete="off" required/>
          <label for="file" class="btn-3"><span style="text-align: center";>Upload</span></label>
         </td>
        </tr>
        <tr><td colspan=2><input class="submit-pel" name="lapor" type="submit" value="Cairkan"></td></tr>
        
        <input name="kode" type="hidden" value="<?php echo $data['kode']; ?>">
        <input name="noid" type="hidden" value="<?php echo $data['noid']; ?>">
        
       </table>
      </form>
      
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

 