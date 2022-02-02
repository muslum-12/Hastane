<?php 
include 'header.php'; 
$doktorsor=$db->prepare("SELECT * FROM tmp_me_doctors where tmdr_id=:id");
$doktorsor->execute(array(
  'id' => $_GET['tmdr_id']
  ));

$doktorcek=$doktorsor->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Doktorlar Düzenleme formu <small>,

              <?php 

              if ($_GET['durum']=="ok") {?>

              <b style="color:green;">İşlem Başarılı...</b>

              <?php } elseif ($_GET['durum']=="no") {?>

              <b style="color:red;">İşlem Başarısız...</b>

              <?php }

              ?>


            </small></h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/kullanici.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                <?php 
                $zaman=explode(" ",$doktorcek['ctime']);
                ?>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kayıt Tarihi <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="" id="first-name" name="ctime" disabled="" value="<?php echo $zaman[0]; ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

             <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı Tipi<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                   <?php                
                    $tmdr_id=$doktorcek['tmu_id'];
                    $kullanicisor=$db->prepare("SELECT * FROM tmp_me_users where tmu_type=:tmu_type order by tmu_name ");
                    $kullanicisor->execute(array(                
                      'tmu_type' => 0
                    ))                        
                    ?>                  
                    <select id="heard" class="form-control" name="tmu_id" required>
                      <?php 
                        while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)){
                      ?>          
                   <option <?php if ($tmu_id==$tmdr_id) { echo  "selected='select'"; }?> value="<?php echo $kullanicicek['tmu_id']; ?>" ><?php echo $kullanicicek['name']." ".$kullanicicek['name']; ?> </option>    
                   <?php } ?>                     
                  </select>
                 </div>
                </div>


           


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Dr Soyadı<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="dr_surname" value="<?php echo $doktorcek['dr_surname'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TCKN<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="dr_identity" value="<?php echo $doktorcek['dr_identity'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telefon<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="dr_iphone" value="<?php echo $doktorcek['dr_iphone'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mail Adresi<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="dr_mail" value="<?php echo $doktorcek['dr_mail'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Doğum Tarihi<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="date" id="first-name" name="dr_birth" value="<?php echo $doktorcek['dr_birth'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Doktor Durumu<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                 <select id="heard" class="form-control" name="dr_status" required>
                    <option value="0" <?php echo $doktorcek['dr_status'] == '0' ? 'selected=""' : ''; ?>>Pasif</option>
                    <option value="1" <?php if ($doktorcek['dr_status']==1) { echo 'selected=""'; } ?>>Aktif</option>
                 </select>
               </div>
             </div>


        
             <input type="hidden" name="tmdr_id" value="<?php echo $doktorcek['tmdr_id'] ?>"> 
             <div class="ln_solid"></div>
             <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="doktorduzenle" class="btn btn-success">Güncelle</button>
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
