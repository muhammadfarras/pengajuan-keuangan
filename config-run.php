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
  <link rel="stylesheet" href="css\font-awesome-4.7.0\css/font-awesome.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

<meta name="viewport" content="width=device-width"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="css/style.css">

</head>

<body>
<!-- partial:index.partial.html -->
<?php
 include_once ("list.php");
?>

<?php
 
 if (isset ($_POST['ganti']) && isset ($_POST['ganti2']) && !empty ($_POST['ganti']) && !empty ($_POST['ganti2']) ){
  
  $pass = htmlentities ( strip_tags ( str_replace (" ","",$_POST['ganti']) ) );
  $pass2 = htmlentities ( strip_tags ( str_replace (" ","",$_POST['ganti2']) ) );
  
  if ($pass !== $pass2){
   
   ?>
   
   <script>
    alert ("Password yang antum input berbeda");
   </script>
   
   <?php
   
  }
  // jika passwordnya sudah sama
  elseif ($pass == $pass2) {
   
   $query = "SELECT * FROM user WHERE no_id = '$_COOKIE[no_id]'";
   $msquery = mysqli_query ($koneksi,$query);
   $data = mysqli_fetch_assoc ($msquery);
   
   
   if (md5 ($pass) == $data['password']){
    
    ?>
    
    <script>
    alert ("Password yang antum input sama dengan password lama");
    </script>
    
    <?php
    
   }
   // ganti password
   else {
    $pass = md5 ($pass);
    
    $quapp = "UPDATE user SET password = '$pass' WHERE no_id = '$_COOKIE[no_id]'";
    
    $myquapp = mysqli_query ($koneksi,$quapp);
    
    $efek = mysqli_affected_rows ($koneksi);
    
    if ($efek){
     
     
     ?>
     
     <script>
    alert ("Password yang antum sudah diganti");
    </script>
     
     <?php
     header ("location: index.php");
     
    }
    
   }
   
  }
  
  
 }
 
 
 
?>

<section class="panel b-brown" id="4">
  <article class="panel__wrapper">
    <div class="panel__content">
      <h1 class="panel__headline"><i class="fa fa-paper-plane"></i>&nbsp;Ganti Password</h1>
      <div class="panel__block"></div>
      
      <form method="post">
       <table>
        <tr>
         <td>Password baru</td>
         <td><input type="text" name="ganti"></td>
        </tr>
        <tr>
         <td>Ulangi Password baru</td>
         <td><input type="text" name="ganti2"></td>
        </tr>
        <tr>
         <td colspan=2><input name='cair' type='submit' class='config' style='font-family: FontAwesome'; value='&#xf087';></td>
        </tr>
       </table>
      </form>
    </div>
  </article>
</section>

<!-- partial -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="js/script.js"></script>

</body>
</html>