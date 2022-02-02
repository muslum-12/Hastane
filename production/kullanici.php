<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$kullanicisor=$db->prepare("SELECT * FROM tmp_me_users");
$kullanicisor->execute();
?>
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kullanıcı Listeleme <small>,
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
              <a href="Kullanici-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
            </div>
          </div>
          <div class="x_content">
            

     
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Doktor Adı<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="kullanici_ara" name="kullanici_ara" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>  
         
            <!-- Div İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Kayıt Tarih</th>
                  <th>Ad </th>
                  <th>Soyad </th>
                  <th>Mail Adresi</th>
                  <th>Kullanıcı Adı</th>
                  <th>Şifre</th>    
                  <th>Kullanıcı Yetkisi</th>              
                  <th>İşlemler</th>        
                </tr>
              </thead>
              <tbody>
                <?php 
                while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)) {?>
                <tr>
                  <td><?php echo $kullanicicek['ctime'] ?></td>
                  <td><?php echo $kullanicicek['name'] ?></td>
                  <td><?php echo $kullanicicek['surname'] ?></td>
                  <td><?php echo $kullanicicek['tmu_mail'] ?></td>
                  <td><?php echo $kullanicicek['tmu_name'] ?></td>
                  <td><?php echo $kullanicicek['password'] ?></td>
                  <td><center><?php 
                     if ($kullanicicek['tmu_type']==0) {?> 
                    <button class="btn btn-success btn-xs">Doktor</button>
                    <?php } else if ($kullanicicek['tmu_type']==1) { ?>
                    <button class="btn btn-danger btn-xs">Vezne </button>
                    <?php }  else {?>
                      <button class="btn btn-warning btn-xs"> Yönetici</button>
                 <?php } ?>                  
                    </center></td>
                  <td><center><a href="kullanici-duzenle.php?tmu_id=<?php echo $kullanicicek['tmu_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                  <td><center><a href="../netting/kullanici.php?tmu_id=<?php echo $kullanicicek['tmu_id']; ?>&kullanicisil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
                </tr>
                <?php  }
                ?>
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
$("#kullanici_ara").keyup(function()
{
  kullaniciara=$("#kullanici_ara").val();
  console.log(kullaniciara);
    $.ajax({
       type: "POST",
       url: "../netting/KullaniciBul.php",
       data: {'kullaniciara' : kullaniciara},
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

});
</script>
<?php include 'footer.php'; ?>
