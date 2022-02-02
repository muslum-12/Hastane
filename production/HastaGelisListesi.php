<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi

$hastaGelisSor=$db->prepare("SELECT * FROM tmp_me_patient_register group by tmp_id");
$hastaGelisSor->execute();

if($kullanicicek['tmu_type']==0){
$tmu_id=$kullanicicek['tmu_id'];
$hastaGelisSor=$db->prepare("SELECT * FROM tmp_me_patient_register where tmu_id=:tmu_id group by tmp_id");
$hastaGelisSor->execute(array(
'tmu_id'=>$tmu_id
));
}else {
  $hastaGelisSor=$db->prepare("SELECT * FROM tmp_me_patient_register group by tmp_id");
  $hastaGelisSor->execute();
}
?>
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Hasta Geliş  Listesi <small>,
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
              <a href="hasta-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
            </div>
          </div>
      <!-- Hasta Arama İnput İşlemi -->
          <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hasta Ara<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-8">
                   <input type="text" id="hasta_ara" name="hasta_ara" required="required" class="form-control col-md-7 col-xs-12">
                </div>
          </div>

          <div class="x_content">
            <!-- Div İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>   
                  <th>H.Geliş Numarası</th>          
                  <th>Kurum</th> 
                  <th>Tckn</th>  
                  <th>Adı ve Soyadı</th> 
                  <th>Bölüm Adı</th>        
                  <th>Doktor Adı ve Soyadı</th>   
                  <th>Kayıt Tarih</th>        
                         
                </tr>
              </thead>
              <tbody>
                <?php 
                while($hastaGelisCek=$hastaGelisSor->fetch(PDO::FETCH_ASSOC)) {

                  //Kurum Tablosu
                  $tmo_id=$hastaGelisCek['tmo_id'];
                  $kurumsor=$db->prepare("SELECT * FROM tmp_me_organisation WHERE tmo_id=:tmo_id");
                  $kurumsor->execute(array(
                      'tmo_id'=>$tmo_id
                  ));
                  $kurumcek=$kurumsor->fetch(PDO::FETCH_ASSOC);
                //Bölümler Tablosu
                  $tmd_id=$hastaGelisCek['tmd_id'];
                  $bolumsor=$db->prepare("SELECT * FROM tmp_me_dept WHERE tmd_id=:tmd_id");
                  $bolumsor->execute(array(
                      'tmd_id'=>$tmd_id
                  ));
                  $bolumcek=$bolumsor->fetch(PDO::FETCH_ASSOC);
                  
                  //Doktor Tablosu 
                  $tmu_id=$hastaGelisCek['tmu_id'];
                  $kullanicisor=$db->prepare("SELECT * FROM tmp_me_users WHERE tmu_id=:tmu_id ");
                  $kullanicisor->execute(array(
                      'tmu_id'=>$tmu_id
                  ));
                  $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
                  //Hasta Tablosu
                  $tmp_id=$hastaGelisCek['tmp_id'];
                  $hastasor=$db->prepare("SELECT * FROM tmp_me_patient where tmp_id =:tmp_id  group by tmp_id ");
                  $hastasor->execute(array(                
                    'tmp_id'=>$tmp_id     
                  ));
                  $hastacek=$hastasor->fetch(PDO::FETCH_ASSOC);
              
             
                ?>
                <tr>
                   <td><?php echo $hastaGelisCek['tmpr_id'];?></td>
                  <td><?php echo $kurumcek['org_name'];?></td>
                  <td><?php echo $hastacek['pat_identity'];?></td>             
                  <td><?php echo $hastacek['pat_name']." ". $hastacek['pat_surname'];?></td>
                  <td><?php echo $bolumcek['dept_name'];?></td>  
                  <td><?php echo $kullanicicek['name']." ".$kullanicicek['surname']; ?></td>
                  <td><?php echo $hastaGelisCek['ctime'] ?></td>           
                  <td><center><a href="HastaGelisHizmetEkleme.php?tmpr_id=<?php echo $hastaGelisCek['tmpr_id'];?>"><button class="btn btn-primary btn-xs">Hizmet Ekle</button></a></center></td>             
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

<script>
  $(function(){

  
// Document is ready

$("#hasta_ara").keyup(function()
{
hastaara=$("#hasta_ara").val();
console.log(hastaara);
    $.ajax({
       type: "POST",
       url: "../netting/HastaBul.php",
       data: {'hastaara' : hastaara},
       dataType: "text",
       success: function(response)
       {
         cevap=jQuery.parseJSON(response);
           $("tbody").empty();
           console.log(cevap.deger);
           $("tbody").append(cevap.deger);
       }
    });

});

});
</script>
<?php include 'footer.php'; ?>
