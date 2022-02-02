<?php 

include 'header.php'; 


$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_id=:id");
$kullanicisor->execute(array(
  'id' => $_GET['kullanici_id']
  ));

$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Hizmet ekleme Formu<small>,

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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hizmet Tipi<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="heard" class="form-control" name="servic_type" required>
                  <option value="">Hizmet Tipi Seçin</option>
                  <option value="1">radyoloji</option>
                  <option value="2">Tomografi</option>
                  <option value="3">Rötgen</option>
                  <option value="4">Acil</option>
                  <option value="5">Aşı odası</option>
                  <option value="6">Kan alma</option>
                 </select>
               </div>
              </div>       
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hizmet Adı<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="" id="first-name" name="servic_name" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>       
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı Tipi<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="heard" class="form-control" name="servic_satatus" required>
                  <option value="0">Pasif</option>
                  <option value="1" >Aktif</option>
                 </select>
               </div>
              </div>
            <div class="ln_solid"></div>
             <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="hizmetekle" class="btn btn-success">Kaydet</button>
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
