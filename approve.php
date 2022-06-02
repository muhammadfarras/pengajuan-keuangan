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
      
      $query = approver ();
      
      $sql = mysqli_query ($koneksi,$query);
      
      $efek = mysqli_affected_rows ($koneksi);
      if (!$efek){
       
       echo "<h3 class=panel__headline>Tidak ada data . . .</h3>";
       echo "</div>
               </article>
             </section>
             <!-- partial -->
               <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
             <script  src='js/script.js'></script>";
      }
      
      echo "<table>";
       echo "<tr><th>No</th><th>Kode</th><th>Nama</th><th>Nominal</th><th>Persetujuan</th></tr>";
       $no = 1;
       while ($data = mysqli_fetch_assoc($sql)){
        
        echo "<tr><td>$no</td><td>$data[kode]</td><td>$data[nama_pengajuan]</td><td>".number_format ( $data['nominal_pengajuan'],0)."</td>
        <td><a class='approve' href='approve_run.php?kode=$data[kode]' ><i style='font-size: 50px;' class='fa fa-check-square-o'></a></td></tr>";
        
        $no += 1;
       }
       
      echo "</table>";
      
      
      
      ?>
      
      
    </div>
  </article>
</section>
<!-- partial -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="js/script.js"></script>

</body>
</html>