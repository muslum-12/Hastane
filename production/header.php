

<?php 
ob_start();
session_start();
error_reporting(0);

include '../netting/baglan.php';
include 'fonksiyon.php';



// SESSION AD Ataması 
$Mail=$_SESSION['tmu_mail'];
$kullanicisor=$db->prepare("SELECT * FROM tmp_me_users WHERE tmu_mail = '$Mail' ");
$kullanicisor->execute();
$say=$kullanicisor->rowCount();
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

if($say==0){
  header("location:login.php?durum=izinsiz");
  exit;

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bizmed</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Dorpzone.Js-->
    <link href="../vendors/dropzone/dist/min/dropzone.min.css"rel="stylesheet">
    <script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>
    <!--ck Editör -->
    <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js" ></script>
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <div class="profile clearfix">            
              <div class="profile_info">
                <span>Hoşgeldin </span>
                <h2><?php echo  $kullanicicek['name']." ". $kullanicicek['surname']?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa </a></li>
                   <?php if($kullanicicek['tmu_type']==0 || $kullanicicek['tmu_type']==1 ){ ?>
                    <li><a><i class="fa fa-cogs"></i>Hasta İşlemleri<span class="fa fa-cogs"></span></a>

                        <ul class="nav child_menu">
                            <li><a href="Hastalar.php">Yeni Hasta Kayıt</a></li>
                            <li><a href="HastaGelis.php">Hasta Geliş</a></li>
                            <li><a href="HastaAra.php">Hasta Bul</a></li>
                            <li><a href="HastaGelisListesi.php">Hasta Geliş Listesi</a></li>
                       </ul>
                    </li>   
                    <?php } ?> 
                    <?php if($kullanicicek['tmu_type']==2){ ?>
                    <li><a><i class="fa fa-cogs"></i>Yönetici İşlemleri<span class="fa fa-cogs"></span></a>
                     <ul class="nav child_menu">
                        <li><a href="kullanici.php">Kullanıcılar</a></li>
                        <li><a href="hizmetler.php">Hizmetler</a></li>
                        <li><a href="doktorlar.php">Doktorlar</a></li>
                        <li><a href="kurumlar.php">Kurumlar</a></li>
                        <li><a href="hizmetFiyatları.php">Hizmet Fiyatları</a></li>
                        <li><a href="bolumler.php">Bölümler</a></li>
                        <li><a href="BolumDoktorları.php">Doktor Tanımlama</a></li>                    
                     </li>  
                     <?php } ?>           
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?php echo  $kullanicicek['name']." ". $kullanicicek['surname']?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">                
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Güvenli Çıkış</a></li>
                  </ul>
                </li>

                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->