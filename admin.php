<?php
ob_start();
include ("advance.php");

// allow-log
logAllow ($_COOKIE['no_id']);

// only admin can go
if (!logAdmin ($_COOKIE['akses'])){
    
    header ("location: error.php");
    
}


 
 if (!empty($_GET['s'])){
    
    echo "<h1 style=text-align:center;>Akun telah terbuat</h1>";
    echo "<h3 style=text-align:center;><a href=home.php>Back</a></h3>";
    echo mysqli_error ($koneksi);
    exit();
    
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
    
<!-- partial:index.partial.html -->
<?php
 include_once ("list.php");
?>

<section class="panel b-alien" id="2">
  <article class="panel__wrapper">
    <div class="panel__content">
      <h1 class="panel__headline"><i class="fa fa-user-plus" aria-hidden="true">Tambah Akun</i></h1>
      <div class="panel__block"></div>
      <form method="post" action="admin_run.php">
      <table>
        <!-- Default Password -->
        <input value="000000" name="password" type="hidden">
        <tr><td>Nama Panjang</td><td><input type="text" name="nama" required="required" autocomplete="off"></td></tr>
        <tr><td>Nama Pengguna<td><input type="text" name="usname" required="required" autocomplete="off"></td></tr>
        <tr>
         <td>Hak Akses Pengguna</td>
         <td>
          <select required="required" name="akses">
           
           <option disabled="disabled" selected="selected" value required>-- Pilih hak Kases --</option>
           <option value="1">Admin</option>
           <option value="2">Penyetuju</option>
           <option value="3">Kasir</option>
           <option value="4">Pengguna</option>
           
          </select>
         </td>
        </tr>
        <tr><td>No Telepon Genggam</td><td><input type="number" name="nohp" required="required" autocomplete="off"></td></tr>
        <tr><td>Alamat Email</td><td><input type="email" name="email" required="required" autocomplete="off"></td></tr>
        <tr><td colspan="2"><input name="daftar" type="submit" class="admin" required="required" autocomplete="off"></td></tr>
      </table> 
    </div>
    </form>
  </article>
</section>

<!-- partial -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="js/script.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script  src="js/cure-jav.js"></script>
</body>
</html>