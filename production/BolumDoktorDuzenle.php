<?php 

include 'header.php'; 
$Bdoktorsor=$db->prepare("SELECT * FROM tmp_me_dep_doc where tmdd_id =:id");
$Bdoktorsor->execute(array(
  'id' => $_GET['tmdd_id']
 ));
$Bdoktorcek=$Bdoktorsor->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2> Bölüm Doktorları Düzenleme Formu <small>,
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

            $zaman=explode(" ",$Bdoktorcek['ctime']);

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
                    $tmdd_id =$Bdoktorcek['tmd_id'];
                    $bolumsor=$db->prepare("SELECT * FROM tmp_me_dept where dept_status=:dept_status order by dept_name");
                    $bolumsor->execute(array(                
                   'dept_status' => 1                    
                    ));
                    ?>                  
                 <select class="select2_multiple form-control"  name="tmd_id">
                      <?php 
                          while($bolumcek=$bolumsor->fetch(PDO::FETCH_ASSOC)){
                          $tmd_id=$bolumcek['tmd_id'];
                      ?>          
                <option <?php if ($tmd_id==$tmdd_id) { echo "selected='select'"; } ?> value="<?php echo $bolumcek['tms_id']; ?>"><?php echo $bolumcek['dept_name']; ?></option>   
                   <?php } ?>                     
                 </select>
               </div>
             </div>



             <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Doktor Adı Seçin<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php              
                    $tmdd_id =$Bdoktorcek['tmu_id'];
                    $kullanicisor=$db->prepare("SELECT * FROM tmp_me_users where tmu_type=:tmu_type order by tmu_name");
                    $kullanicisor->execute(array(                
                      'tmu_type' =>0               
                    )); 
                     ?>                                    
                 <select class="select2_multiple form-control"name="tmu_id">
                      <?php 
                         while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)){
                         $tmu_id=$kullanicicek['tmu_id'];
                      ?>          
                   <option <?php if ($tmu_id==$tmdd_id) { echo "selected='select'"; } ?> value="<?php echo $kullanicicek['tmu_id']; ?>"><?php echo $kullanicicek['name']." ".$kullanicicek['surname']; ?></option>
                   <?php } ?>                     
                 </select>
               </div>
             </div>

          

              <input type="hidden" name="tmdd_id" value="<?php echo $Bdoktorcek['tmdd_id'];?>"> 
        
           
            <div class="ln_solid"></div>
             <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="BolumDoktorDuzenle" class="btn btn-success">Kaydet</button>
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
