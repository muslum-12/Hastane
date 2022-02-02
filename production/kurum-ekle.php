<?php 

include 'header.php'; 
$kurumsor=$db->prepare("SELECT * FROM tmp_me_organisation where tmo_id=:id");
$kurumsor->execute(array(
  'id' => $_GET['tmo_id']
  ));
$kurumcek=$kurumsor->fetch(PDO::FETCH_ASSOC);
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kurum ekleme Formu<small>,

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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kurum Adı<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="" id="first-name" name="org_name" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>       
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kurum  Durumu <span class="required">*</span>
              </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="heard" class="form-control" name="org_satatus" required>
                  <option value="0">Pasif</option>
                  <option value="1" >Aktif</option>
                 </select>
                </div>
              </div>
            <div class="ln_solid"></div>
             <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="kurumekle" class="btn btn-success">Kaydet</button>
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
