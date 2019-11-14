

<form method="post" action="pengajuan-run.php"  enctype="multipart/form-data">
    
    <?php
    
        if (!empty($_GET['w'])){
    
        echo "<p style=\"color: red\">$_GET[w]</p>";
    
        }
        
    ?>
    <table>
        
        <!-- Hide input-->
        <input style="display: none;" name="nama" type="hidden" value="<?php echo $_COOKIE['nama'] ?>">
        <input style="display: none;" name="kode_pengajuan" type="hidden" value="<?php echo kodepengajuan(); ?>">
        <input style="display: none;" name="waktu_pengajuan" type="hidden" value="<?php echo time() ;?>">
        <input style="display: none;" name="status_pengajuan" type="hidden" value="submissioned">
        <!-- Hide input-->
        
        <tr><td class="ket-peng">Nama</td><td class="ket-input">
        <input name="nama" type="text" value="<?php echo $_COOKIE['nama'] ?>" disabled="disabled" autocomplete="off">   
        </td></tr>
        
        <tr><td class="ket-peng">Nominal</td><td class="ket-input">
        <input name="nominal" maxlength=14 type="text" value="" data-type="currency" placeholder="Nominal pengajuan" required="required" autocomplete="off">
        </td></tr>
        
        <tr><td class="ket-peng">Keterangan</td><td class="ket-input">
        <textarea name="keterangan" required="required" autocomplete="off"></textarea>
        </td></tr>
        
        <tr><td class="ket-peng">Lampiran <br><i>Optional</i></td><td class="ket-input">
        <input name="lampiran" type="file" id="file" autocomplete="off"/>
        <label for="file" class="btn-3"><span style="text-align: center";>select</span></label></td></tr>
        <tr><td colspan="2"><input class="submit-peng" name="submit" type="submit"></td></tr>
    </table>
</form>