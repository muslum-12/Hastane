<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi

$fhizmetsor=$db->prepare("SELECT * FROM tmp_me_servic_price order by tmps_id DESC");
$fhizmetsor->execute();

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
              <a href="HizmetFiyat-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
            </div>
          </div>
          <div class="x_content">
            <!-- Div İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Kayıt Tarih</th>
                  <th>Kurum Adı</th>
                  <th>Hizmet Adı</th>    
                  <th>Hizmet Fiyatı</th>                         
                </tr>
              </thead>
              <tbody>
                <?php 
                   while($fhizmetcek=$fhizmetsor->fetch(PDO::FETCH_ASSOC)) {
                    
                    //Hizmet Tablosunu Çektim
                    $tms_id=$fhizmetcek['tms_id'];
                    $hizmetsor=$db->prepare("SELECT * FROM tmp_me_services WHERE tms_id=:tms_id");
                    $hizmetsor->execute(array(
                        'tms_id'=>$tms_id
                    ));
                    $hizmetcek=$hizmetsor->fetch(PDO::FETCH_ASSOC);
                   //Kurum Tablosu 
                   $tmo_id=$fhizmetcek['tmo_id'];
                   $kurumsor=$db->prepare("SELECT * FROM tmp_me_organisation WHERE tmo_id=:tmo_id");
                   $kurumsor->execute(array(
                       'tmo_id'=>$tmo_id
                   ));
                   $kurumcek=$kurumsor->fetch(PDO::FETCH_ASSOC);
                ?>
                <tr>
                  <td><?php echo $fhizmetcek['ctime']; ?></td>
                  <td><?php echo $kurumcek['org_name']; ?></td>
                  <td><?php echo $hizmetcek['servic_name']; ?>  </td>             
                  <td><?php echo $fhizmetcek['price']; ?></td>     
                   <td><center><a href="HizmetFiyat-duzenle.php?tmps_id=<?php echo $fhizmetcek['tmps_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                  <td><center><a href="../netting/kullanici.php?tmps_id=<?php echo $fhizmetcek['tmps_id']; ?>&HizmetFiyatSil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
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
