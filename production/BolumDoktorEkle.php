<?php 

include 'header.php'; 

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        
            <h2>Bölüm Doktoru Ekleme<small>,

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

    
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bölüm Seçin<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                 <?php             
                    $tmdd_id=$Bdoktorcek['tmd_id'];
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
 
           

             <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Doktor Adı<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php
                
                    $tmdd_id=$Bdoktorcek['tmu_id'];
                    $kullanicisor=$db->prepare("SELECT * FROM tmp_me_users where tmu_type=:tmu_type order by tmu_name");
                    $kullanicisor->execute(array(                
                      'tmu_type' => 0
                     
                    ));
                    ?>                  
                    <select id="heard" class="form-control" name="tmu_id" required>
                      <?php 
                        while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)){
                      ?>          
                   <option value="<?php echo $kullanicicek['tmu_id']; ?>" ><?php echo $kullanicicek['name']." ".$kullanicicek['name']; ?> </option>    
                   <?php } ?>                     
                 </select>
               </div>
             </div>

            <div class="ln_solid"></div>
             <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="BolumDoktorEkle" class="btn btn-success">Kaydet</button>
              </div>
            </div>
          </form>
        </div>
      </div>
</div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
