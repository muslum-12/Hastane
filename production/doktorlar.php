<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$doktorsor=$db->prepare("SELECT * FROM tmp_me_doctors");
$doktorsor->execute();
?>
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Doktorlar  Listesi <small>,
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
              <a href="doktor-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
            </div>
          </div>
          <div class="x_content">
            <!-- Div İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Kayıt Tarih</th>
                  <th>Doktor Adı ve Soyadı </th>  
                  <th>TCKN</th>         
                  <th>Telefon</th>     
                  <th>Mail</th>
                  <th>Doğum tarihi</th>   
                  <th>Kullanıcı Yetkisi</th>   
                </tr>
              </thead>
              <tbody>
                <?php 
                while($doktorcek=$doktorsor->fetch(PDO::FETCH_ASSOC)) {

                $tmu_id=$doktorcek['tmu_id'];
                $kullanicisor=$db->prepare("SELECT * FROM tmp_me_users WHERE tmu_id=:tmu_id");
                $kullanicisor->execute(array(
                    'tmu_id'=>$tmu_id
                ));
                $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
             
                ?>
                <tr>
                  <td><?php echo $doktorcek['ctime'] ?></td>
                  <td><?php echo $kullanicicek['name']." ".$kullanicicek['surname']?></td>             
                  <td><?php echo $doktorcek['dr_identity'] ?></td>
                  <td><?php echo $doktorcek['dr_iphone'] ?></td>
                  <td><?php echo $kullanicicek['tmu_mail'] ?></td>
                  <td><?php echo $doktorcek['dr_birth'] ?></td>
                  <td><center><?php 
                      if ($doktorcek['dr_status']==1) {?> 
                    <button class="btn btn-success btn-xs">Aktif</button>
                    <?php } else { ?>
                    <button class="btn btn-danger btn-xs">Pasif</button>
                    <?php } ?>                  
                    </center></td>
                  <td><center><a href="doktor-duzenle.php?tmdr_id=<?php echo $doktorcek['tmdr_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                  <td><center><a href="../netting/kullanici.php?tmdr_id=<?php echo $doktorcek['tmdr_id']; ?>&doktorsil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
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
