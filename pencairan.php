<?php
ob_start();
include ("advance.php");

// allow-log
logAllow ($_COOKIE['no_id']);

// back to
if (!logPencairan ($_COOKIE['akses'])){
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

<section class="panel b-pink" id="3">
  <article class="panel__wrapper">
    <div class="panel__content">
      <h1 class="panel__headline"><i class="fa fa-university" aria-hidden="true"></i></i>&nbsp;Pencairan</h1>
      <div class="panel__block"></div>
      <form>
       <table>
        <tr>
         <td>
          <input type="text" list="pencairan" name="kode" placeholder="Cari Kode" autocomplete="off" maxlength=6>
          <datalist id="pencairan">
           
           <?php
            $quapp = "SELECT * FROM submission WHERE status = 'approved'";
            $sqlquapp = mysqli_query ($koneksi,$quapp);
            
            while ($data = mysqli_fetch_assoc ($sqlquapp)){
             
             echo "<option>$data[kode]</option>";
             
            }
           ?>
           
          </datalist>
         </td>
         <td>
           <input name="cari" type="submit" class="pencarian" style='font-family: FontAwesome; font-size: 37px;'  value='&#xf002;'>
         </td>
        </tr>
       </table>
      </form>
       <?php
        
       if (!empty($_GET['kode'])){
        
        $qpenc = "SELECT * FROM submission WHERE status = 'approved' AND kode = '$_GET[kode]'";
        
       }
       else {
        
        $qpenc = "SELECT * FROM submission WHERE status = 'approved'";
        
       }
       
        $sqlpenc = mysqli_query ($koneksi,$qpenc);
        $afpenc = mysqli_affected_rows ($koneksi);
        
        if ($afpenc){
         
       ?>
       
        <table>
         <tr><th style="text-align: center;" colspan=4>Pengajuan yang sudah disetujui</th></tr>
         <?php
         
         while ($data = mysqli_fetch_assoc ($sqlpenc)){
          echo  "<tr><td>$data[kode]</td><td>$data[nama_pengajuan]</td>
          <td>"
           . number_format ( $data['nominal_pengajuan'],0).
          "</td>
           <td>
           <form action='pencairan-form.php' method='post'>
            <input name='kode' type='hidden' value='$data[kode]'>
            <input name='cair' type='submit' class='pencairan' style='font-family: FontAwesome'; value='&#xf164';>
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

<script>
 alert ('<?php echo $_GET['notice']; ?>')
</script>

</body>
</html>