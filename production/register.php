





<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">


            <form action="../netting/kullanici.php" method="POST">

              <h1>Bizmet kayıt Sayfası</h1>
              <div>
                <input type="email" class="form-control" name="tmu_mail" placeholder="Mail Adresiniz" required="" />
              </div>
              <div>
                <input type="text" class="form-control" name="tmu_name" placeholder="kullanıcı Adınız" required="" />
              </div>
              <div>
                <input type="text" class="form-control" name="name" placeholder=" Adınız" required="" />
              </div>
              <div>
                <input type="text" class="form-control" name="surname" placeholder=" Soyadınız" required="" />
              </div>
              <div>
                <input type="password" class="form-control"name="passwordone" placeholder="Şifrenizi Girin" required="" />
              </div>
              <div>
                <input type="password" class="form-control"name="passwordtwo" placeholder="Şifrenizi Girin" required="" />
              </div>
              <div>
                <button  style="width: 70%;background-color: #73879C; clor:width" type ="submit" name="Kullanicikaydet" class="btn btn-default"> Gönder </button>
              </div>
              <div class="clearfix"></div>

              <div class="separator">
                
                <div class="clearfix"></div>
                <br />

                
              </div>
            </form>
          </section>
        </div>

      
      </div>
    </div>
  </body>
</html>
