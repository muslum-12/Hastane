<?php include 'header.php'; 

              $tmpr_id=$hastaGelisCek['tmpr_id'];            
              $hastaGelisSor=$db->prepare("SELECT * FROM tmp_me_patient_register where tmpr_id =:tmpr_id");
              $hastaGelisSor->execute(array(                
                'tmpr_id'=> $_GET['tmpr_id'],                            
              ));                 
              $hastaGelisCek=$hastaGelisSor->fetch(PDO::FETCH_ASSOC);
              ?>
              	
<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Hasta Geliş Hizmet Ekleme<small>,

              <?php 

              if ($_GET['durum']=="ok") {?>

              <b style="color:green;">İşlem Başarılı...</b>

              <?php } elseif ($_GET['durum']=="no") {?>

              <b style="color:red;">İşlem Başarısız...</b>

              <?php }

              ?>
            </small></h2>
         
          </div>
          <div class="x_content">
            <br />
            <form action="../netting/kullanici.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
              
              <?php     
              
                      $tmp_id=$hastaGelisCek['tmp_id'];
                      $hastasor=$db->prepare("SELECT * FROM tmp_me_patient where tmp_id =:tmp_id");
                      $hastasor->execute(array(                
                        'tmp_id'=> $tmp_id                  
                      ));
                      $hastacek=$hastasor->fetch(PDO::FETCH_ASSOC);    
              ?>     
              <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hasta Adı ve Soyadı<span class="required">*</span> </label>            
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="" id="first-name" name="tmp_id" value="<?php echo $hastacek['pat_name']." ".$hastacek['pat_surname'] ?>"  disabled="" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
    
              <!-- Hizmetler Tablosundan Veriler Çekildi-->
              <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hizmet Ekleyin<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <?php              
                $tms_id=$hastaGelisCek['tms_id'];
                $hizmetsor=$db->prepare("SELECT * FROM tmp_me_services where servic_satatus=:servic_satatus order by servic_name");
                $hizmetsor->execute(array(                
                  'servic_satatus' => 1                    
                ));
                ?>                  
                <select id="heard" class="form-control" name="tms_id" required>           
                  <?php 
                    while($hizmetcek=$hizmetsor->fetch(PDO::FETCH_ASSOC)){
                  ?>          
                <option value="<?php echo $hizmetcek['tms_id']; ?>" ><?php echo $hizmetcek['servic_name']; ?> </option>    
                <?php } ?>                     
              </select>
              </div>
              </div>
              <input type="hidden" name="tmpr_id" value="<?php echo $hastaGelisCek['tmpr_id'] ?>">
              <input type="hidden" name="tmp_id" value="<?php echo $hastaGelisCek['tmp_id'] ?>">
              
                
             <div class="ln_solid"></div>
              <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" name="HastaGelisHizmetEkleme" class="btn btn-success">Kaydet</button>
              </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>



  <hr>
  <hr>
  <hr>



</div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
