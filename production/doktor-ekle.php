<?php 

include 'header.php'; 

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2> ekleme Formu<small>,

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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı Tipi<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php
                
                    $tmdr_id=$doktorcek['tmu_id'];
                    $kullanicisor=$db->prepare("SELECT * FROM tmp_me_users where tmu_type=:tmu_type order by tmu_name ");
                    $kullanicisor->execute(array(                
                      'tmu_type' => 0
                    ));
                    ?>                  
                    <select id="heard" class="form-control" name="tmu_id" required>
                      <?php 
                        while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)){
                      ?>          
                   <option value="<?php echo $kullanicicek['tmu_id']; ?>" ><?php echo $kullanicicek['tmu_mail']; ?> </option>    
                   <?php } ?>                     
                 </select>
               </div>
             </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Doktor Adı<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="dr_name" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>   
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Doktor Soyadı<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="dr_surname" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TCKN<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="number" id="first-name" name="dr_identity" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telefon<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="number" id="first-name" name="dr_iphone" required="required" class="form-control col-md-7 col-xs-12" >
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mail<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="email" id="first-name" name="dr_mail" required="required" class="form-control col-md-7 col-xs-12" min="10">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Doğum Tarihi<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="date" id="first-name" name="dr_birth" required="required" class="form-control col-md-7 col-xs-12" max="1995-12-31" min="1965-12-31">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kurum  Durumu <span class="required">*</span>
              </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="heard" class="form-control" name="dr_status" required>
                  <option value="0">Pasif</option>
                  <option value="1" >Aktif</option>
                 </select>
                </div>

            <div class="ln_solid"></div>
             <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="DoktorEkle" class="btn btn-success">Kaydet</button>
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
