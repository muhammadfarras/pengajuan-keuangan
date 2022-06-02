<?php
    // time set
    date_default_timezone_set ('Asia/Jakarta');

    // Koneksi
    
        $uname = ""; // user 
        $pass = ""; // password
        $host = ""; // your host name
        $db = ""; // your database name
        $koneksi = mysqli_connect ($host,$uname,$pass,$db);
          
    
    
    // Login
    
    function login ($username,$password){
        
        $koneksi = $GLOBALS['koneksi'];
        
        $password = md5 ($password);
        
        $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $sql =  mysqli_query ($koneksi,$query);
        $data = mysqli_fetch_assoc ($sql);
        
        setcookie ("akses",$data['akses']);
        setcookie ("no_id",$data['no_id']);
        setcookie ("nama",$data['nama']);
        setcookie ("no-hp",$data['no_hp']);
        setcookie ("email",$data['email']);
        
        
        // check apakah tersedia akun nya atau tidak
        
        $result = mysqli_affected_rows ($koneksi);
        
        return $result;
    }
    
    
    // Jika tidak ada cookie user maka keluar ke index
    function logAllow ($cookie){
        if (!isset($cookie)){
            header("location: index.php");
        }
    }
    
    
    /*
     * 1. Add admin
    */
    function logAdmin ($cookie){
        
        // 1st value
        $result = false;
        
        switch ($cookie){
            
            case 1 :
                $result = true;
                break;
            
        }
        
        return $result;
        
    }
    
    /*
     * 1 and 2 have accses to Approve submission 
    */
    
    function logApprove ($cookie){
        
        // 1st value
        $result = false;
        
        switch ($cookie){
            
            case 1 :
                $result = true;
                break;
            
            case 2 :
                $result = true;
                break;
            
        }
        
        return $result;
        
    }
    
    function logPencairan ($cookie){
        
        // 1st value
        $result = false;
        
        switch ($cookie){
            
            case 1 :
                $result = true;
                break;
            
            case 3 :
                $result = true;
                break;
            
        }
        
        return $result;
        
    }

    
    function logPelaporan ($cookie){
        
        // 1st value
        $result = false;
        
        switch ($cookie){
            
            case 1 :
                $result = true;
                break;
            
            case 2 :
                $result = true;
                break;
            
            case 3 :
                $result = true;
                break;
            
        }
        
        return $result;
        
    }
    
    
    // Function Submisson based on akses //
        // Function Submisson based on akses //
    // Function Submisson based on akses //
    
    
    /*
     * $nama (Cookie nama , cookie hak ases)
    */
    function dashBoard ($nama,$akses){
        
        $koneksi = $GLOBALS['koneksi'];
        
        $in_nama = mysqli_real_escape_string ($koneksi,$nama);
        
        switch ($akses){
            case 1:
                $query = "SELECT * FROM submission";
                break;
            
            case 2:
                $query = "SELECT * FROM submission WHERE nama_pengajuan = '$nama'";
                break;
            
            case 3:
                $query = "SELECT * FROM submission WHERE nama_pengajuan = '$nama'";
                break;
            
            case 4:
                $query = "SELECT * FROM submission WHERE nama_pengajuan = '$nama'";
                break;
        }
        
        /*LANJUT KEBAWAH function filter */
        return $query;
    }
    
    function filter ($akses,$query,$filter){
        
        if ($akses == 1){
            $result = " WHERE status = '$filter'";
        }
        else {
            $result = " AND status = '$filter'";
        }
        

        
        $aquery = $query.$result." ORDER BY 'waktu_pengajuan' DESC";
        return $aquery;
    }
    
    function approver (){
              
        $query = "SELECT * FROM submission WHERE status = 'submissioned'";
        
        return $query;
        
    }
    
    /*
     * riwayatPengajuan (No id akun,akses admin melihat semua)
     * fungsi untuk melihat riwayat pengajuan yang sudah selesai.
    */
    
    function riwayatPengajuan ($no_id,$akses){
        
        $koneksi = $GLOBALS['koneksi'];
        
        switch ($akses){
            case 1:
                $query = "SELECT * FROM submission WHERE status = 'finish'";
                break;
            
            case 2:
                $query = "SELECT * FROM submission WHERE status = 'finish' AND noid = '$no_id'";
                break;
            
            case 3:
                $query = "SELECT * FROM submission WHERE status = 'finish' AND noid = '$no_id'";
                break;
            
            case 4:
                $query = "SELECT * FROM submission WHERE status = 'finish' AND noid = '$no_id'";
                break;
        }
        return $query;
    }
    
    
    
    function riwayatDetail ($akses,$kode,$noid=''){
                
        $koneksi = $GLOBALS['koneksi'];
        
        switch ($akses){
            case 1:
                $query = "SELECT * FROM submission WHERE  status = 'finish AND 'kode = '$kode'";
                break;
            
            case 2:
                $query = "SELECT * FROM submission WHERE  status = 'finish AND 'kode = '$kode' AND noid = '$noid'";
                break;
            
            case 3:
                $query = "SELECT * FROM submission WHERE  status = 'finish AND 'kode = '$kode' AND noid = '$noid'";
                break;
            
            case 4:
                $query = "SELECT * FROM submission WHERE  status = 'finish AND 'kode = '$kode' AND noid = '$noid'";
                break;
        }
        return $query;
    }
    
    /*
     * Function delet-cookie
     * function ini berjalan jika saat user pergi ke home
     * maka delete cookie sehingga tidak bisa langsung masuk ke home.php
    */
    
    function delcookie (){
        
        if (!empty($_COOKIE['akses']) and !empty($_COOKIE['no_id'])and !empty($_COOKIE['nama']) and !empty($_COOKIE['no-hp']) and !empty($_COOKIE['email'])){
            
            setcookie ("akses",'',time()-3600);
            setcookie ("no_id",'',time()-3600);
            setcookie ("nama",'',time()-3600);
            setcookie ("no-hp",'',time()-3600);
            setcookie ("email",'',time()-3600);
            
            
        }

        
    }
    
    
    /*
     * Kode pengajuan secara acak
    */
    
    function kodepengajuan (){
        $text = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $countext = strlen($text);
        $code="";
        for ($i=0 ; $i<6 ;$i++){
        
        $code .= $text[rand(0,($countext-1))];
        }
    
        return $code;    
    }
    
    
    /*
     * Merubah string to integer karena javascript
    */
    
    function strtoint ($nominal){
  
        preg_match_all ('/\d+/',$nominal,$number);
        
        $count = count ($number[0]);
        $nominal = "";
        for ($i = 0 ; $i < $count ; $i++){
          
          $nominal .= $number[0][$i];
          
        }
        
        return $nominal;
        
    }
    
    
    /*
     * File error warning
    */
    
    function errorfile ($error){
        $errno = $error;
        
        $result="";
        
        switch ($errno){
            
            case 1:
            case 2:
                $result = "Ukuran terlalu besar";
                break;
            
            case 3:
                $result = "Ulangi upload, file corupt";
                break;
            
            case 4:
                $result = "1"; // true boleh kosong tanpa file
                break;
            
            case 6:
                $result = "Ada kesalahan, harap hubungi admin";
                break;
            
            case 7:
                $result = "Hak akses tidak dapat masuk, hubungi admin";
                break;
            
            case 8:
                $result = "Hubungi admin segara !!!";
                break;
        }
        return $result;        
    }
    
?>