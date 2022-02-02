<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$kurumsor=$db->prepare("SELECT * FROM tmp_me_organisation");
$kurumsor->execute();
?>
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kurumlar Listesi <small>,
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
              <a href="kurum-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
            </div>
          </div>
          <div class="x_content">
            <!-- Div İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Kayıt Tarih</th>
                  <th>Kurum Adı</th>       
                  <th>Kurum Durumu</th>                       
                </tr>
              </thead>
              <tbody>
                <?php 
                while($kurumcek=$kurumsor->fetch(PDO::FETCH_ASSOC)) {?>
                <tr>
                  <td><?php echo $kurumcek['ctime'] ?></td>              
                  <td><?php echo $kurumcek['org_name'] ?></td>   
                  <td><center><?php 
                      if ($kurumcek['org_satatus']==0) {?> 
                    <button class="btn btn-success btn-xs">Pasif</button>
                    <?php } else { ?>
                    <button class="btn btn-danger btn-xs">Aktif</button>
                    <?php } ?>                  
                    </center></td>               
                  <td><center><a href="kurum-duzenle.php?tmo_id=<?php echo $kurumcek['tmo_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                  <td><center><a href="../netting/kullanici.php?tmo_id=<?php echo $kurumcek['tmo_id']; ?>&kurumsil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
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
