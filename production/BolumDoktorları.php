<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi


$Bdoktorsor=$db->prepare("SELECT * FROM tmp_me_dep_doc order by tmdd_id DESC");
$Bdoktorsor->execute();

?>
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Hizmetler  Listesi <small>,
               <?php 
                if ($_GET['durum']=="ok") {?>
                <b style="color:green;">İşlem Başarılı...</b>
                <?php } elseif ($_GET['durum']=="no") {?>
                <b style="color:red;">İşlem Başarısız...</b>
                <?php }
               ?>
            </small></h2>
            <div class="clearfix"></div>
            <div align="right">
              <a href="BolumDoktorEkle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
            </div>
          </div>
          <div class="x_content">
            <!-- Div İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Kayıt Tarih</th>
                  <th>Bölüm Adı </th>
                  <th>Doktor Adı Ve Soyadı</th>                             
                </tr>
              </thead>
              <tbody>
              <?php 
                   while($Bdoktorcek=$Bdoktorsor->fetch(PDO::FETCH_ASSOC)) {
                    
                    //Bölüm Tablosunu Çektim
                    $tmd_id=$Bdoktorcek['tmd_id'];
                    $bolumsor=$db->prepare("SELECT * FROM tmp_me_dept WHERE tmd_id=:tmd_id");
                    $bolumsor->execute(array(
                        'tmd_id'=>$tmd_id
                    ));
                    $bolumcek=$bolumsor->fetch(PDO::FETCH_ASSOC);
                   //Doktor Tablosu 
                   $tmu_id=$Bdoktorcek['tmu_id'];
                   $kullanicisor=$db->prepare("SELECT * FROM tmp_me_users WHERE tmu_id=:tmu_id");
                   $kullanicisor->execute(array(
                       'tmu_id'=>$tmu_id
                   ));
                   $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
                ?>
                <tr>
                  <td><?php echo $Bdoktorcek['ctime']; ?></td>
                  <td><?php echo $bolumcek['dept_name']; ?></td>
                  <td><?php echo $kullanicicek['name']." ".$kullanicicek['surname']; ?>  </td>             
                     
                   <td><center><a href="BolumDoktorDuzenle.php?tmdd_id=<?php echo $Bdoktorcek['tmdd_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                  <td><center><a href="../netting/kullanici.php?tmdd_id=<?php echo $Bdoktorcek['tmdd_id']; ?>&BolumDoktorSil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
                </tr>
                <?php  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
 </div>
</div>
<?php include 'footer.php'; ?>
