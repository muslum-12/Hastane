<?php 
include 'header.php'; 
$hastasor=$db->prepare("SELECT * FROM tmp_me_patient where tmp_id=:id");
$hastasor->execute(array(
  'id' => $_GET['tmp_id']
  ));

$hastacek=$hastasor->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Hasta Düzenleme formu <small>,

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
                $zaman=explode(" ",$hastacek['ctime']);
                ?>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kayıt Tarihi <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="" id="first-name" name="ctime" disabled="" value="<?php echo $zaman[0]; ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

             <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kurum Seçin<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                   <?php                
                    $tmp_id=$hastacek['tmo_id'];
                    $kurumsor=$db->prepare("SELECT * FROM tmp_me_organisation where org_satatus=:org_satatus order by org_name ");
                    $kurumsor->execute(array(                
                      'org_satatus' => 1
                    ))                        
                    ?>                  
                    <select id="heard" class="form-control" name="tmo_id" required>
                      <?php 
                        while($kurumcek=$kurumsor->fetch(PDO::FETCH_ASSOC)){
                      ?>          
                   <option <?php if ($tmo_id==$tmp_id) { echo  "selected='select'"; }?> value="<?php echo $kurumcek['tmo_id']; ?>" ><?php echo $kurumcek['org_name'];?> </option>    
                   <?php } ?>                     
                  </select>
                 </div>
                </div>        

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adı<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="pat_name" value="<?php echo $hastacek['pat_name'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Soyadı<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="pat_surname" value="<?php echo $hastacek['pat_surname'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tckn<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="" id="first-name" name="pat_identity" value="<?php echo $hastacek['pat_identity'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pasaport<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="pat_passport" value="<?php echo $hastacek['pat_passport'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

                        
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Doğum Tarihi<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="" id="first-name" name="pat_birthday" value="<?php echo $hastacek['pat_birthday'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cinsiyeti<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                 <select id="heard" class="form-control" name="pat_gender" required>
                    <option value="0" <?php echo $hastacek['pat_gender'] == '0' ? 'selected=""' : ''; ?>>Erkek</option>
                    <option value="1" <?php if ($hastacek['pat_gender']==1) { echo 'selected=""'; } ?>>Kadın</option>
                 </select>
               </div>
             </div>


        
             <input type="hidden" name="tmp_id" value="<?php echo $hastacek['tmp_id'] ?>"> 
             <div class="ln_solid"></div>
             <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="HastaDuzenle" class="btn btn-success">Güncelle</button>
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
