<?php include 'header.php'; ?>
	


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Hasta Geliş Kayıt Açma  Formu<small>,

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
                      'tmp_id'=> $_GET['tmp_id']           
                    ));
                    $hastacek=$hastasor->fetch(PDO::FETCH_ASSOC)
                    ?>     
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TCKN Numarası<span class="required">*</span>
                </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="" id="first-name" name="pat_identity" value="<?php echo $hastacek['pat_identity'] ?>"  disabled="" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
              </div>
                  <!-- kurumlar Tablosundan Veriler Çekildi-->
             <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kurum Seçin<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php              
                    $tmo_id=$hastaGelisCek['tmo_id'];
                    $kurumsor=$db->prepare("SELECT * FROM tmp_me_organisation where org_satatus=:org_satatus order by org_name");
                    $kurumsor->execute(array(                
                      'org_satatus' => 1                    
                    ));
                    ?>                  
                    <select id="heard" class="form-control" name="tmo_id" required>
                      <?php 
                        while($kurumcek=$kurumsor->fetch(PDO::FETCH_ASSOC)){
                      ?>          
                   <option value="<?php echo $kurumcek['tmo_id']; ?>" ><?php echo $kurumcek['org_name']; ?> </option>    
                   <?php } ?>                     
                 </select>
               </div>
             </div>
             <!-- Bölümler Tablosundan Veriler Çekildi-->
             <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bölüm Seçin<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php         
                    $tmd_id=$hastaGelisCek['tmd_id'];
                    $bolumsor=$db->prepare("SELECT * FROM tmp_me_dept where dept_status=:dept_status order by dept_name");
                    $bolumsor->execute(array(                
                      'dept_status' => 1                    
                    ));
                    ?>                  
                    <select id="heard" class="form-control" name="tmd_id" required>
                      <?php 
                        while($bolumcek=$bolumsor->fetch(PDO::FETCH_ASSOC)){
                      ?>          
                   <option value="<?php echo $bolumcek['tmd_id']; ?>" ><?php echo $bolumcek['dept_name']; ?> </option>    
                   <?php } ?>                     
                 </select>
               </div>
             </div>

             <!-- Kullanıcıdan Doktor Çektim-->
             <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Doktor Seçin<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php
                
                    $tmu_id=$hastaGelisCek['tmu_id'];
                    $kullanicisor=$db->prepare("SELECT * FROM tmp_me_users where tmu_type=:tmu_type order by tmu_name ");
                    $kullanicisor->execute(array(                
                      'tmu_type' => 0
                    ));
                    ?>                  
                    <select id="heard" class="form-control" name="tmu_id" required>
                      <?php 
                        while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)){
                      ?>          
                   <option value="<?php echo $kullanicicek['tmu_id']; ?>" ><?php echo $kullanicicek['name']." ".$kullanicicek['surname']; ?> </option>    
                   <?php } ?>                     
                 </select>
               </div>
             </div>
           
             <input type="hidden" name="tmp_id" value="<?php echo $hastacek['tmp_id'] ?>">
            
             
          

           
            <div class="ln_solid"></div>
             <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="HastaGelisKayitAcmaKaydet" class="btn btn-success">Kaydet</button>
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
