<?php 

include 'header.php'; 
$_GET['durum']='no'; 
//Belirli veriyi seçme işlemi
$tmpr_id=$hastacek['tmpr_id'];
$HastaGelissor=$db->prepare("SELECT * FROM tmp_me_patient_register where tmp_id =:tmp_id");
$HastaGelissor->execute(array(                
    'tmp_id'=>$_GET['tmp_id']
));

?>
<div class="right_col" role="main">

   
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
      
          
            <h2>Hasta Geliş  Detay <small>,        
      <!-- Hasta Arama İnput İşlemi -->
     

          <div class="x_content">
            <!-- Div İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>                        
                  <th>Bölüm Adı</th>        
                  <th>Doktor Adı ve Soyadı</th>   
                  <th>Kayıt Tarih</th>      
                                                
                </tr>
              </thead>
              <tbody>
                <?php 
               
                while($HastaGelisCek=$HastaGelissor->fetch(PDO::FETCH_ASSOC)) {



                  //Kurum Tablosu
                  $tmo_id=$HastaGelisCek['tmo_id'];
                  $kurumsor=$db->prepare("SELECT * FROM tmp_me_organisation WHERE tmo_id=:tmo_id");
                  $kurumsor->execute(array(
                      'tmo_id'=>$tmo_id
                  ));
                  $kurumcek=$kurumsor->fetch(PDO::FETCH_ASSOC);
                //Bölümler Tablosu
                  $tmd_id=$HastaGelisCek['tmd_id'];
                  $bolumsor=$db->prepare("SELECT * FROM tmp_me_dept WHERE tmd_id=:tmd_id");
                  $bolumsor->execute(array(
                      'tmd_id'=>$tmd_id
                  ));
                  $bolumcek=$bolumsor->fetch(PDO::FETCH_ASSOC);
                  
                  //Doktor Tablosu 
                  $tmu_id=$HastaGelisCek['tmu_id'];
                  $kullanicisor=$db->prepare("SELECT * FROM tmp_me_users WHERE tmu_id=:tmu_id");
                  $kullanicisor->execute(array(
                      'tmu_id'=>$tmu_id
                  ));
                  $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);                          
                  ?>
                <tr>                                                     
                  <td><?php echo $bolumcek['dept_name'];?></td>  
                  <td><?php echo $kullanicicek['name']." ".$kullanicicek['surname']; ?></td>
                  <td><?php echo $HastaGelisCek['ctime'] ?></td>      
                   
                                                           
                </tr>
                <?php  }
                ?>
              </tbody>
            </table>
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
