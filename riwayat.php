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

<section class="panel b-green" id="4">
  <article class="panel__wrapper">
    <div class="panel__content">
      <h1 class="panel__headline"><i class="fa fa-folder-open" aria-hidden="true"></i>&nbsp;Buka riwayat</h1>
      <div class="panel__block"></div>
      
      <form>
       <table>
        <tr>
         <td>
          <input type="text" list="pencairan" name="kode" placeholder="Cari Kode" autocomplete="off" maxlength=6>
          <datalist id="pencairan">
           
           <?php
            $quapp = riwayatPengajuan ($_COOKIE['no_id'],$_COOKIE['akses']);
            $sqlquapp = mysqli_query ($koneksi,$quapp);
            
            while ($data = mysqli_fetch_assoc ($sqlquapp)){
             
             echo "<option>$data[kode]</option>";
             
            }
           ?>
           
          </datalist>
         </td>
         <td>
           <input name="cari" type="submit" class="pencarian-riw" style='font-family: FontAwesome; font-size: 37px;'  value='&#xf002;'>
         </td>
        </tr>
       </table>
      </form>
       <?php
        
       if (!empty($_GET['kode'])){
        
        
        $qpenc = riwayatPengajuan ($_COOKIE['no_id'],$_COOKIE['akses'])." AND kode = '$_GET[kode]'";
        
        
       }
       else {
        
        $qpenc = riwayatPengajuan ($_COOKIE['no_id'],$_COOKIE['akses']);
        
       }
       
       
       
        $sqlpenc = mysqli_query ($koneksi,$qpenc);
        $afpenc = mysqli_affected_rows ($koneksi);
        
        if ($afpenc){
         
       ?>
       
        <table>
         <tr><th style="text-align: center;" colspan=4>Riwayat Pengajuan</th></tr>
         <?php
         
         while ($data = mysqli_fetch_assoc ($sqlpenc)){
          echo  "<tr><td>$data[kode]</td><td>$data[nama_pengajuan]</td>
          <td>"
           . number_format ( $data['nominal_pengajuan'],0).
          "</td>
           <td>
           <form action='riwayat-detail.php' method='post'>
            <input name='kode' type='hidden' value='$data[kode]'>
            <input name='cair' type='submit' class='pencarian-riw-sub' style='font-family: FontAwesome'; value='&#xf06e';>
            </form>
           </td>
          </tr>";
         }
         
         ?>
        </table>
       
       
       <?php
        }
        else {
       ?>
       
       <!-- JIka tidak ada data yang di approved -->
       <h3>Tidak ada data yang ditemukan !</h3>
       
       <?php
       
        }

       ?>
       <!-- JIka tidak ada data yang di approved -->
       
      
    </div>
  </article>
</section>

<!-- partial -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="js/script.js"></script>

</body>
</html>