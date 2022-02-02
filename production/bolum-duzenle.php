<?php 
include 'header.php'; 
$bolumsor=$db->prepare("SELECT * FROM tmp_me_dept where tmd_id=:id");
$bolumsor->execute(array(
  'id' => $_GET['tmd_id']
  ));
$bolumcek=$bolumsor->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Bölüm  Düzenleme İşlemi <small>,

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
                $zaman=explode(" ",$hizmetcek['ctime']);
                ?>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kayıt Tarihi <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="" id="first-name" name="ctime" disabled="" value="<?php echo $zaman[0]; ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hizmet Tipi Yetki<span class="required">*</span></label>
                 <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="heard" class="form-control" name="dept_type" required>
                        <option value="1"<?php echo $hizmetcek['dept_type'] == '1' ? 'selected=""' : ''; ?>>Acil</option>
                        <option value="2"<?php echo $hizmetcek['dept_type'] == '2' ? 'selected=""' : ''; ?>>Poliklinik</option>
                        <option value="3"<?php echo $hizmetcek['dept_type'] == '3' ? 'selected=""' : ''; ?>>Yoğun Bakım</option>
                        <option value="4"<?php echo $hizmetcek['dept_type'] == '4' ? 'selected=""' : ''; ?>>Amelyathane</option>                       
                    </select>
                 </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hizmet Adı<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="dept_name" value="<?php echo $bolumcek['dept_name'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bölüm Durumu<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                 <select id="heard" class="form-control" name="dept_status" required>
                    <option value="0" <?php echo $bolumcek['dept_status'] == '0' ? 'selected=""' : ''; ?>>Pasif</option>
                    <option value="1" <?php if ($bolumcek['dept_status']==1) { echo 'selected=""'; } ?>>Aktif</option>
                 </select>
               </div>
              </div>
             <input type="hidden" name="tmd_id" value="<?php echo $bolumcek['tmd_id'] ?>"> 
             <div class="ln_solid"></div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="bolumduzenle" class="btn btn-success">Güncelle</button>
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
