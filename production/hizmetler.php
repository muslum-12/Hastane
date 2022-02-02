<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$hizmetsor=$db->prepare("SELECT * FROM tmp_me_services");
$hizmetsor->execute();
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
              <a href="hizmet-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
            </div>
          </div>
          <div class="x_content">
            <!-- Div İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Kayıt Tarih</th>
                  <th>Hizmet Tipi</th>
                  <th>Hizmet Adı </th>    
                  <th>Hizmet Durumu </th>         
                  <th>İşlemler</th>        
                </tr>
              </thead>
              <tbody>
                <?php 
                while($hizmetcek=$hizmetsor->fetch(PDO::FETCH_ASSOC)) {?>
                <tr>
                  <td><?php echo $hizmetcek['ctime'] ?></td>
                  <td>
                  <select id="heard" class="form-control" name="servic_type" required>
                 <option value="1"<?php echo $hizmetcek['servic_type'] == '1' ? 'selected=""' : ''; ?>>radyoloji</option>
                  <option value="2"<?php echo $hizmetcek['servic_type'] == '2' ? 'selected=""' : ''; ?>>Tomografi</option>
                  <option value="3"<?php echo $hizmetcek['servic_type'] == '3' ? 'selected=""' : ''; ?>>Rötgen</option>
                  <option value="4"<?php echo $hizmetcek['servic_type'] == '4' ? 'selected=""' : ''; ?>>Acil</option>
                  <option value="5"<?php echo $hizmetcek['servic_type'] == '5' ? 'selected=""' : ''; ?>>Aşı odası</option>
                  <option value="6"<?php echo $hizmetcek['servic_type'] == '6' ? 'selected=""' : ''; ?>>Kan alma</option>
                </select>
                  </td>
                  <td><?php echo $hizmetcek['servic_name'] ?></td>             
                  <td><center><?php 
                      if ($hizmetcek['servic_satatus']==0) {?> 
                    <button class="btn btn-success btn-xs">Pasif</button>
                    <?php } else { ?>
                    <button class="btn btn-danger btn-xs">Aktif</button>
                    <?php } ?>                  
                    </center></td>
                  <td><center><a href="hizmet-duzenle.php?tms_id=<?php echo $hizmetcek['tms_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                  <td><center><a href="../netting/kullanici.php?tms_id=<?php echo $hizmetcek['tms_id']; ?>&hizmetsil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
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
