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
<section class="panel b-blue" id="1">
  <article class="panel__wrapper">
    <div class="panel__content">
      <h1 class="panel__headline">&nbsp;Dashboard</h1>
      <p class="panel__headline"><?php echo $_COOKIE['nama']?></p>
      <fieldset>
       <a href="home.php?w=submissioned" class='fa fa-lock' aria-hidden='true'><br><label for="Diajukan">Submission</label></a>
       |
       <a href="home.php?w=Approved"class="fa fa-file-archive-o" aria-hidden="true"><br><label>Approved</label></a>
       |
       <a href="home.php?w=rejected" class='fa fa-ban' aria-hidden='true'><br><label>Rejected</label></a>
       |
       <a href="home.php?w=funded" class='fa fa-envelope-o' aria-hidden='true'><br><label>Funded</label></a>
       <br>
       <a href="home.php" class="fa fa-globe" aria-hidden="true"><br><label>All</label></a>
       |
       <a href="home.php?w=finish"class="fa fa-check-circle-o" aria-hidden="true"><br><label>Finish</label></a>
      </fieldset>
      <div class="panel__block"></div>
      
      <table>
       
       <?php
       
       /*
        * Bisa ditaruh didalam function Advance
       */
       
       // Normal
       $query = dashBoard ($_COOKIE['nama'],$_COOKIE['akses']);
       
       if (isset($_GET['w'])){
        
        $query =  filter ($_COOKIE['akses'],$query,$_GET['w']);
        
       }
       $sql = mysqli_query ($koneksi,$query);
       
       
       
       if ($efek = mysqli_affected_rows ($koneksi)){
       
       echo "<tr><th>No</th><th>Kode</th><th>Nama</th><th>Nominal</th><th>Status</th></tr>";
       
       $no = 1;
         while ($data = mysqli_fetch_assoc ($sql)){
         
          // use switch untuk data status
           $status = $data['status'];
           
          // number format
           $inquery = "SELECT * FROM riw_pengambilan WHERE kode ='$data[kode]'";
           $insql = mysqli_query ($koneksi,$inquery);
           $inefek = mysqli_affected_rows ($koneksi);
           if ($inefek){
            
            $inpengambilan = mysqli_fetch_assoc ($insql);
            $nominal = number_format ($inpengambilan['nominal_pengambilan'],0);
           }
           else {
            $nominal = number_format ($data['nominal_pengajuan'],0);
           }
           
           
           
           
           if (!empty($data['lampiran'] and $status == "submissioned")){
            $lampiran = " | <a target=_blank href='$data[lampiran]'><i class='fa fa-file-pdf-o' aria-hidden='true'></i></a>"; 
           }
           else {
            $lampiran = "";
            $link = "";
           }
           
           
          echo "<tr><td> $no </td>";
          echo "<td> $data[kode] </td>";
          echo "<td> $data[nama_pengajuan]</td>";
          
          
          if (strlen ($nominal) >= 10){
           echo "<td class='homy'>".($nominal)."</td>";
          }
          else {
           echo "<td>".($nominal)."</td>";
          }
          
          
          
          switch ($data['status']){
           
           case 'submissioned';
            $link = "<i class='fa fa-lock' aria-hidden='true'></i>";
            break;
           
           case 'approved';
            $link = "<form method='post' action='bukti_pengajuan.php'>";
            
            $link .= "<input name='kode_sub' class='print' style='font-family: FontAwesome' value='&#xf1c6;' type='submit'>";
            $link .= "<input name='kode' type='hidden' value='$data[kode]'>";
            $link .= "<input name='status' type='hidden' value='approved'>";
            $link .= "</form>";
            break;
           
           
           case 'rejected';
            $link = "<i class='fa fa-ban' aria-hidden='true'></i>";
            break;
           
           case 'funded';
            $link = "<abbr title='data sudah diambil'><i class='fa fa-envelope-o' aria-hidden='true'></i></abbr>";
            break;
           
           case 'finish';
            $link = "<abbr title='Pelaporan sudah selesai'><a href='riwayat.php?k=$data[kode]' class='fa fa-check-circle-o' aria-hidden='true'></></abbr>";
           
          }
          
          echo "<td style='text-align: center;'>$link$lampiran</td>";
          
          echo "</tr>";
          
          $no++;
         }
       }
       else {
        echo "<h3 class='panel__headline'>&nbsp;Belum ada pengajuan</h3>";
       }
       ?>
       
      </table>
      
      
    </div>
  </article>
</section>
<!-- partial -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="js/script.js"></script>

</body>
</html>