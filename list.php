<nav class="nav">
  <div class="burger">
    <div class="burger__patty"></div>
  </div>

  <ul class="nav__list">
    <li class="nav__item">
      <abbr title="Beranda">
        <a href="home.php" class="nav__link c-blue scrolly"><i class="fa fa-home" aria-hidden="true"></i></a>
      </abbr>
      
    </li>
    
    <?php
      if (logAdmin($_COOKIE['akses'])){
    ?>
    
    <li class="nav__item">
      <abbr title="Pembuatan Akun">
        <a href="admin.php" class="nav__link c-alien scrolly"><i class="fa fa-user" aria-hidden="true"></i></a>
      </abbr>
    </li>
    
    <?php
      }
    ?>
    
    
    <li class="nav__item">
      <abbr title="Pengajuan">
        <a href="pengajuan.php" class="nav__link c-yellow scrolly"><i class="fa fa-money" aria-hidden="true"></i></a>
      </abbr>
      
    </li>
    
    
    <?php
      if (logApprove($_COOKIE['akses'])){
    ?>
    <li class="nav__item">
      <abbr>
        <a href="approve.php" class="nav__link c-red scrolly"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>
      </abbr>
    </li>
    <?php
      }
    ?>
    
    <?php
      if (logPencairan($_COOKIE['akses'])){
    ?>
    <li class="nav__item">
      <abbr>
        <a href="pencairan.php" class="nav__link c-pink scrolly"><i class="fa fa-university" aria-hidden="true"></i></a>
      </abbr>
    </li>
    <?php
      }
    ?>
    
    <?php
      if (logPelaporan($_COOKIE['akses'])){
    ?>
    <li class="nav__item">
      <abbr>
        <a href="pelaporan.php" class="nav__link c-orange scrolly"><i class="fa fa-files-o" aria-hidden="true"></i></a>
      </abbr>
    </li>
    <?php
      }
    ?>
    
    
    <li class="nav__item">
      <abbr title="riwayat">
        <a href="riwayat.php" class="nav__link c-green scrolly"><i class="fa fa-folder-open" aria-hidden="true"></i></a>
      </abbr>
      
    </li>
    
    
    <li class="nav__item">
      <abbr title="Configurasi">
        <a href="config.php" class="nav__link c-brown scrolly"><i class="fa fa-cog" aria-hidden="true"></i></a>
      </abbr>
    </li>
    
    
    <li class="nav__item">
      <abbr title="Keluar">
        <a href="index.php" class="nav__link c-white scrolly"><i class="fa fa-times" aria-hidden="true"></i></i></a>
      </abbr>
    </li>
  </ul>
</nav>