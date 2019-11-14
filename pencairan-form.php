<?php
ob_start();
include ("advance.php");

// allow-log
logAllow ($_COOKIE['no_id']);

// back to
if (!logPencairan ($_COOKIE['akses'])){
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

<section class="panel b-pink" id="3">
  <article class="panel__wrapper">
    <div class="panel__content">
      <h1 class="panel__headline"><i class="fa fa-university" aria-hidden="true"></i></i>&nbsp;Pencairan</h1>
      <div class="panel__block"></div>
      
      
      <?php
       $query = "SELECT * FROM riw_persetujuan WHERE kode = '$_POST[kode]'";
       $squery = mysqli_query ($koneksi,$query);
       
       $efek = mysqli_affected_rows ($koneksi);
       $data = mysqli_fetch_assoc ($squery);
       
       
       
        echo "<pre>";
         // print_r ($data);
        echo "</pre>";
      
       ?>
      <form method="post" action="pencairan-run.php">
       <table>
        
        <tr><td colspan=2 style="text-align: center;">Kode pengajuan : <b><?php echo $data['kode']?></b></td></tr>
        <tr><td>Nama pengaju</td><td><?php echo $data['nama_pengaju'] ?></td></tr>
        <tr><td>Nominal</td><td><?php echo "Rp. ".number_format ($data['nominal_pengaju'],0); ?></td></tr>
        <tr><td>Penyetuju</td><td><?php echo $data['administrator'] ?></td></tr>
        <tr>
         <td>Pengambil dana</td>
         <td>
          <input type="text" name="pengambil_dana" list="nama" autocomplete="off" required>
          <datalist id="nama">
           
           <option><?php echo $data['nama_pengaju'];  ?></option>
           
          </datalist>
         </td>
        </tr>
        <tr>
         <td>Nominal pencairan</td>
         <td>
           <input name="nominal" maxlength=14 type="text" value="" data-type="currency" placeholder="Nominal pencairan" required="required" autocomplete="off">
         </td>
        </tr>
        <tr><td colspan=2><input class="submit-penc" type="submit" value="Cairkan"></td></tr>
        <input name="kode" type="hidden" value="<?php echo $data['kode']; ?>">
        <input name="noid" type="hidden" value="<?php echo $data['noid']; ?>">
        <input name="namaPengaju" type="hidden" value="<?php echo $data['nama_pengaju']; ?>">
        <input name="nominal_pengaju" type="hidden" value="<?php echo $data['nominal_pengaju']; ?>">
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

<?php
echo print_r ($data);
?>
