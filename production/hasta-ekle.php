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
            <h2> Hasta Kayıt Etme Formu<small>,

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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kurum Seçin <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php
                    $tmo_id=$hastacek['tmo_id'];
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
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adı<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="pat_name" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>   
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Soyadı<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="pat_surname" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TCKN<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="number" id="first-name" name="pat_identity" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pasaport Numarası<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="pat_passport" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Doğum Tarihi<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="date" id="first-name" name="pat_birthday" required="required" class="form-control col-md-7 col-xs-12"  min="1965-12-31">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cinsiyeti <span class="required">*</span>
              </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="heard" class="form-control" name="pat_gender" required>
                  <option value="0">Erkek</option>
                  <option value="1" >Kadın</option>
                 </select>
                </div>

            <div class="ln_solid"></div>
             <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="HastaEkle" class="btn btn-success">Kaydet</button>
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
