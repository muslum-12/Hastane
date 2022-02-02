<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
if(isset($_GET['arama'])){
$hastasor=$db->prepare("SELECT * FROM tmp_me_patient where pat_identity=:pat_identity");
$hastasor->execute(array(
    'tmo_id' =>$tmo_id
));
$say=$hastasor->rowCount();

}else{
    header("location:index.php?durum=bos");
}
?>
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Hastalar  Listesi <small>,
               <?php 
                if ($_GET['durum']=="ok") {?>
                <b style="color:green;">İşlem Başarılı...</b>
                <?php } elseif ($_GET['durum']=="no") {?>
                <b style="color:red;">İşlem Başarısız...</b>
                <?php }
               ?>
            </small></h2>
            <div class="clearfix"></div>
            <div align="right">
              <a href="hasta-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
            </div>
          </div>
      <!-- Hasta Arama İnput İşlemi -->
          <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hasta Ara<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-8">
                   <input type="text" id="hasta_ara" name="hasta_ara" required="required" class="form-control col-md-7 col-xs-12">
                </div>
          </div>
       
          <div class="x_content">        
            <!-- Div İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Kayıt Tarih</th>
                  <th>Kurumu </th>  
                  <th>Adı ve Soyadı </th> 
                  <th>TCKN</th>        
                  <th>Passaport</th>    
                  <th>Doğum Tarihi</th>     
                  <th>Cinsiyeti</th>        
                  <th>İşlemler</th>            
                </tr>
              </thead>
              <tbody>
               
              </tbody>
            </table>
            
          </div>
 
        </div>
      </div>
    </div>
 </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
  $(function(){

  
// Document is ready

$("#hasta_ara").keyup(function()
{
hastaara=$("#hasta_ara").val();
    $.ajax({
       type: "POST",
       url: "../netting/HastaBul.php",
       data: {'hastaara' : hastaara},
       dataType: "text",
       success: function(response)
       {
         cevap=jQuery.parseJSON(response);
           $("tbody").empty();
           console.log(cevap.deger);
           $("tbody").append(cevap.deger);
       }
    });

});



hastaara=$("#hasta_ara").val();
    $.ajax({
       type: "POST",
       url: "../netting/HastaBul.php",
       data: {'hastaara' : hastaara},
       dataType: "text",
       success: function(response)
       {
         cevap=jQuery.parseJSON(response);
           $("tbody").empty();
           console.log(cevap.deger);
           $("tbody").append(cevap.deger);
       }
    });


});
</script>
<?php include 'footer.php'; ?>
