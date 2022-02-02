<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$bolumsor=$db->prepare("SELECT * FROM tmp_me_dept");
$bolumsor->execute();
?>
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Bölümler Listesi <small>,
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
              <a href="bolum-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
            </div>
          </div>
          <div class="x_content">
            <!-- Div İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Kayıt Tarih</th>
                  <th>Bölüm Tipi</th>       
                  <th>Bölüm Adı</th>     
                  <th>Bölüm Durumu</th>                    
                </tr>
              </thead>
              <tbody>
                <?php 
                while($bolumcek=$bolumsor->fetch(PDO::FETCH_ASSOC)) {?>
                <tr>
                  <td><?php echo $bolumcek['ctime'] ?></td> 
                                  
                  <td><center><?php 
                     if ($bolumcek['dept_type']==1) {?> 
                    <button class="btn btn-success btn-xs">Acil</button>
                    <?php } else if ($bolumcek['dept_type']==2) { ?>
                    <button class="btn btn-danger btn-xs">Poliknik</button>
                    <?php } else if ($bolumcek['dept_type']==3) { ?>
                    <button class="btn btn-danger btn-xs">Yoğunbakım</button>
                    <?php } else {?>
                      <button class="btn btn-dark btn-xs">Amelyathane</button>
                 <?php } ?>                  
                    </center></td>
                    <td><?php echo $bolumcek['dept_name'] ?></td>
                          
                </select>
                  <td><center><?php 
                      if ($bolumcek['dept_status']==0) {?> 
                    <button class="btn btn-success btn-xs">Pasif</button>
                    <?php } else { ?>
                    <button class="btn btn-danger btn-xs">Aktif</button>
                    <?php } ?>                  
                    </center></td>               
                  <td><center><a href="bolum-duzenle.php?tmd_id=<?php echo $bolumcek['tmd_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                  <td><center><a href="../netting/kullanici.php?tmd_id=<?php echo $bolumcek['tmd_id']; ?>&bolumsil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
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
