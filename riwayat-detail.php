<?php
ob_start();
include ("advance.php");

// allow-log
logAllow ($_COOKIE['no_id']);

 // validasi kode yang diajukan
 $query = riwayatDetail ($_COOKIE['akses'],$_POST['kode'],$_COOKIE['no_id']);
 $myquery = mysqli_query ($koneksi,$query);
 $efek = mysqli_affected_rows ($koneksi);


?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Vertical Layout with Navigation</title>
  <link rel="stylesheet" href="css\font-awesome-4.7.0\css/font-awesome.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

<meta name="viewport" content="width=device-width"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="css/style.css">

<style>
 table, td, th {  
   border: 1px solid #000000;
   text-align: left;
 }
 
 table {
   border-collapse: collapse;
   width: 100%;
 }
 
 th, td {
   padding: 15px;
 }
</style>


</head>
<body>
<!-- partial:index.partial.html -->
<?php
 include_once ("list.php");
?>

<section class="panel b-green" id="4">
  <article class="panel__wrapper">
    <div class="panel__content">
      <h1 class="panel__headline"><i class="fa fa-folder-open" aria-hidden="true"></i>&nbsp;Buka riwayat</h1>
      <div class="panel__block"></div>
      
      <?php
      
      
      if ($efek){
       $query1 = "SELECT * FROM submission WHERE kode = '$_POST[kode]'";
       $query2 = "SELECT * FROM riw_persetujuan WHERE kode = '$_POST[kode]'";
       $query3 = "SELECT * FROM riw_pengambilan WHERE kode = '$_POST[kode]'";
       $query4 = "SELECT * FROM riw_pelaporan WHERE kode = '$_POST[kode]'";
       
       $query = array ($query1,$query2,$query3,$query4);
       
      for ($i = 0 ; $i <= 3 ;$i++){
       
       // echo $i;
        $sql[] = mysqli_query ($koneksi,$query[$i]);
       
       // echo $query;
       for ($j = count($sql) - 1 ; $j < count($sql) ; $j++){
          
          
          
           $data[] = mysqli_fetch_assoc ($sql[$j]);
        }
      }
       
       include_once ("riwayat-table.php");
        
      }
      else {
       header ("location: error.php");
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