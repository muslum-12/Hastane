<?php 

include 'header.php'; 
$fhizmetsor=$db->prepare("SELECT * FROM tmp_me_servic_price where tmps_id =:id");
$fhizmetsor->execute(array(
  'id' => $_GET['tmps_id']
 ));
$fhizmetcek=$fhizmetsor->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2> Hizmet Fiyatı Düzenleme Formu <small>,

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

            $zaman=explode(" ",$fhizmetcek['ctime']);

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
                    $tmsp_id =$fhizmetcek['tmo_id'];
                    $kurumsor=$db->prepare("SELECT * FROM tmp_me_organisation where org_satatus=:org_satatus order by org_name");
                    $kurumsor->execute(array(                
                   'org_satatus' => 1                    
                    ));
                    ?>                  
                 <select class="select2_multiple form-control"required="" name="tmo_id">
                      <?php 
                          while($kurumcek=$kurumsor->fetch(PDO::FETCH_ASSOC)){
                          $tmo_id=$kurumcek['tmo_id'];
                      ?>          
                <option <?php if ($tmo_id==$tmps_id) { echo "selected='select'"; } ?> value="<?php echo $kurumcek['tmo_id']; ?>"><?php echo $kurumcek['org_name']; ?></option>   
                   <?php } ?>                     
                 </select>
               </div>
             </div>



             <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hizmet Adı Seçin<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php              
                    $tmsp_id =$fhizmetcek['tms_id'];
                    $hizmetsor=$db->prepare("SELECT * FROM tmp_me_services where servic_satatus=:servic_satatus order by servic_name");
                    $hizmetsor->execute(array(                
                      'servic_satatus' => 1                    
                    ));  ?>                                    
                 <select class="select2_multiple form-control"required="" name="tmo_id">
                      <?php 
                         while($hizmetcek=$hizmetsor->fetch(PDO::FETCH_ASSOC)){
                         $tms_id=$hizmetcek['tms_id'];
                      ?>          
                   <option <?php if ($tms_id==$tmps_id) { echo "selected='select'"; } ?> value="<?php echo $hizmetcek['tms_id']; ?>"><?php echo $hizmetcek['servic_name']; ?></option>
                   <?php } ?>                     
                 </select>
               </div>
             </div>

             <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hizmet Fiyatı<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="number" id="first-name" name="price" value="<?php echo $fhizmetcek['price'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <input type="hidden" name="tmps_id" value="<?php echo $fhizmetcek['tmps_id'];?>"> 
        
           
            <div class="ln_solid"></div>
             <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="HizmetFiyatDuzenle" class="btn btn-success">Kaydet</button>
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
