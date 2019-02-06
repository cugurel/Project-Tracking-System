<?php 
session_start();
header('Content-Type: application/json; charset=utf-8');
header('Content-Type:text/html; charset=UTF-8');
if(isset($_SESSION['oturum_kontrol'])){
if($_SESSION['oturum_kontrol'] == "giris_yapildi")
{
    header('Location:index.php');
    exit();
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Skyneb Proje Takibi</title>

    <!-- Bootstrap -->
    <link href="./vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="./vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="./vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="./vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="./build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form id="login" method="post" action="" onsubmit="return false;">
              <h1>Skyneb Proje Takibi</h1>
              <div id="cevap">
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Eposta Adresiniz" autocomplete="off" name="eposta" required />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Şifreniz" autocomplete="off" name="sifre" required />
              </div>
              <div>
               <input type="submit" name="Gönder">
                <a class="reset_pass" href="#">Şifremi unuttum!</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Sitede yeni misiniz?
                  <a href="#signup" class="to_register"> Hesap Oluştur! </a>
                </p>

                <div class="clearfix"></div>
                <br />

                
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <input type="submit" name="Submit">
              </div>

              <div class="clearfix"></div>

        
            </form>
          </section>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="./vendors/jquery/dist/jquery.js"></script>
    <script type="text/javascript">
      $('#login').on('submit', function() {
        var frmValue = $(this).serialize();
        $.post('./action.php?action=login', frmValue,
        function(data) {
          var data = jQuery.trim(data);
            if(data=="Tamam"){
             window.location.href = './index.php';
            }else{
              $('#cevap').html(data);
            }

        });
});

    </script>
  </body>
</html>
 