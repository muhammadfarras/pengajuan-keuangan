<?php
ob_start();
include ("advance.php");

// allow-log
logAllow ($_COOKIE['no_id']);

 
 $query = "SELECT * FROM user WHERE no_id = '$_COOKIE[no_id]'";
 $myquery = mysqli_query ($koneksi,$query);
 $data = mysqli_fetch_assoc ($myquery);

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
 body {
  
  color: white;
  
 }
 table, td, th {  
   border: 1px solid #FFFFFF;
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

<section class="panel b-brown" id="4">
  <article class="panel__wrapper">
    <div class="panel__content">
      <h1 class="panel__headline"><i class="fa fa-paper-plane"></i>&nbsp;Pengaturan Akun</h1>
      <div class="panel__block"></div>
      
      <?php
      
       include_once ("config-table.php");
      
      ?>
      
    </div>
  </article>
</section>

<!-- partial -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="js/script.js"></script>

</body>
</html>