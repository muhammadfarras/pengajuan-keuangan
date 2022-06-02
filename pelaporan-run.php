<?php
ob_start();
include ("advance.php");

// allow-log
logAllow ($_COOKIE['no_id']);

if (!logPelaporan ($_COOKIE['akses'])){
 header ("location: error.php");
}
if (!isset($_POST) || empty ($_POST)){
 header ("location: error.php");
}

/* Keterangan Error */


  if (!empty ($_POST['pelapor_dana']) && !empty ($_POST['nominal_laporan']) && !empty($_POST['lapor'])){
      $error = errorfile ($_FILES['lampiran_laporan']['error']);
      
      echo  "<br>";
      echo $error;
      
      // Jika tidak ada error
      if ($error == ""){
        
        // validasi file pdf
        if ($_FILES['lampiran_laporan']['type'] == "application/pdf"){
          
          //validate is kode id exist
          $quevalid = "SELECT * FROM submission WHERE kode = $_POST[kode]";
          $squevalid = mysqli_query ($koneksi,$quevalid);
          $efeksquevalid = mysqli_affected_rows ($koneksi);
          
          if ($efeksquevalid){
            
            $tmp = $_FILES['lampiran_laporan']['tmp_name'];
            $lokasi = "laporan";
            $namafile = "laporan-".$_POST['kode'];
            $lampiran = $lokasi."/".$namafile;
            move_uploaded_file ($tmp,$lampiran.".pdf");
            
            // Kirim ke database
            
            $kodepengajuan = $_POST["kode"];
            $nama = mysqli_real_escape_string ($koneksi,$_POST['pelapor_dana']);
            $nominal = strtoint ($_POST['nominal_laporan']);
            $saksi = mysqli_real_escape_string ($koneksi,$_COOKIE['nama']);
            
            $query = "INSERT INTO riw_pelaporan (kode, id, pelapor, nominal_laporan,lampiran_laporan, saksi)
            VALUES ( '$kodepengajuan','$_POST[noid]','$nama','$nominal','$lampiran.pdf','$saksi')";
            
            $myque = mysqli_query ($koneksi,$query);
            $efekmyque = mysqli_affected_rows ($koneksi);
            $err = mysqli_error ($koneksi);
            
            $queryup = "UPDATE submission SET status = 'finish' WHERE kode = '$_POST[kode]'";
            $mysqup = mysqli_query ($koneksi,$queryup);
            $efekmysqup = mysqli_affected_rows ($koneksi);
            $err .= "<br>".mysqli_error ($koneksi);
            
            // error update database
            if ($efekmyque && $efekmysqup){
              $error = "Laporan dengan kode kode $_POST[kode] sudah dilaporkan";
              header ("location:pelaporan.php?w=$error");
            }
            else {
              echo $error = "Kesalahan => ".$err;
              // header ("location:pelaporan.php?w=$error");  
            }
          }
          else {
            $error = "Mau nyoba nge bobol situs ????";
            header ("location: pelaporan.php?w=$error");
          }
        }
        else {
          echo $error = "File harus berupa PDF";
          header ("location: pelaporan.php?w=$error");
        }
      }
      else {
        $error ="Lampiran laporan wajib diisi dengen eksistensi file PDF";
        header ("location: pelaporan.php?w=$error");
      }
  }
  else {
    echo $error = "Harap isian diisi";
    header ("location: pelaporan.php?w=$error");
  }

?>
<pre>
<?php
print_r ($_COOKIE);
print_r ($_POST);
print_r ($_FILES);
?>
</pre>