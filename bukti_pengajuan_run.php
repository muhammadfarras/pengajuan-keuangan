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
 
 td {
  width: 300px;
 }
 
 div {
  width: 600px;
  background-color: rgb(255, 255, 255);
 
  margin: 0 auto;
 }
 
 img {
  width: 200px;
 }
 
 
 
</style>
</head>
<body>
    <div>
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
       <tr><td style=" height: 200px; width: 20px;"><img src="images/ttd.png"><hr>Pengambil Dana</td><td><img src="images/ttd2.png"><hr>Kasir</td></tr>
      </table>
      
      
    </div>

</body>
</html>
<?php

$html = ob_get_clean();



// include autoloader 
require_once 'dompdf/autoload.inc.php';


// reference the Dompdf namespace 
use Dompdf\Dompdf;


// instantiate and use the dompdf class 
$dompdf = new Dompdf();

// (Opsional) Mengatur ukuran kertas dan orientasi kertas
$dompdf->setPaper('A4', 'portrait');


$dompdf->loadHtml($html);


// Render the HTML as PDF 
$dompdf->render();


// Output the generated PDF to Browser 
$dompdf->stream("pengajuan_".$_POST['kode']);

?>