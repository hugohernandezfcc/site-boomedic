
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Boomedic</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="device-mockups/device-mockups.min.css">

    <!-- Custom styles for this template -->
    <link href="css/new-age.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Boomedic</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menú
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#download">@lang('main.download')</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#features">@lang('main.features')</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">@lang('main.contact')</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="/home">@lang('main.billing')</a>
            </li>
            <li class="nav-item">
              <form id="form" name="form" method="post">
              <select id="informationTest" onchange="functiontest(this);" class="nav-link js-scroll-trigger">
              </select>
            </form>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="masthead" style="background-image: url('img/fondo_head.png');width: 100%;">
      <div class="container h-100">
        <div class="row h-100">
          <div class="col-lg-7 my-auto">
            <div class="header-content mx-auto">
              <h1 class="mb-5">@lang('main.header')</h1>
              <a href="#download" class="btn btn-outline btn-xl js-scroll-trigger">@lang('main.btn_download')</a>
            </div>
          </div>
          <div class="col-lg-5 my-auto">
            <div class="device-container">
              <div class="device-mockup iphone6_plus portrait white">
                <div class="device">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </header>

    <section class="download text-center" id="download" style="background-image: url('img/fondo-01.jpg');width: 100%; color: white;">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mx-auto">
            <h2 class="section-heading">@lang('main.text_download1')</h2>
            <p>@lang('main.text_download2')</p>
            <div class="badges">
              <a class="badge-link" href="#"><img src="img/google-play-badge.svg" alt=""></a>
              <a class="badge-link" href="#"><img src="img/app-store-badge.svg" alt=""></a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="features" id="features">
      <div class="container">
        <div class="section-heading text-center">
          <h2>@lang('main.text_features1')</h2>
          <p class="text-muted">@lang('main.text_features2')</p>
          <hr>
        </div>
        <div class="row">
          <div class="col-lg-4 my-auto">
            <div class="device-container">
              <div class="device-mockup iphone6_plus portrait white">
                <div class="device">
                  <div class="button">
                    <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8 my-auto">
            <div class="container-fluid">
              
              <div class="row">
                <div class="col-lg-6" >
                  <div class="feature-item" >
                    <i class="icon-book-open text-primary"></i>
                    <h3>@lang('main.text_features3')</h3>
                    <p class="text-muted">@lang('main.text_features4')</p>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="feature-item">
                    <i class="icon-magnifier text-primary"></i>
                    <h3>@lang('main.text_features5')</h3>
                    <p class="text-muted">@lang('main.text_features6')</p>
                  </div>
                </div>
              </div>
              <center>
                  <div >
                    <div class="col-lg-6">
                      <div class="feature-item">
                        <i class="icon-credit-card text-primary"></i>
                        <h3>@lang('main.text_features7')</h3>
                        <p class="text-muted">@lang('main.text_features8')</p>
                      </div>
                    </div>
                  </div>
                </center>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="cta">
      <div class="cta-content">
        <div class="container">
          <h2>@lang('main.text_contact1')</h2>
          <a href="#contact" class="btn btn-outline btn-xl js-scroll-trigger" >@lang('main.btn_contact')</a>
        </div>
      </div>
      <div class="overlay"></div>
    </section>

    <section class="contact " id="contact" style="background-color: rgb(4,166,114); color: white;">
      <div class="container">
        <h2>@lang('main.text_contact2')</h2>
        <ul class="list-inline list-social">
          <li class="list-inline-item social-twitter">
            <a href="https://www.twitter.com">
              <i class="fa fa-twitter"></i>
            </a>
          </li>
          <li class="list-inline-item social-facebook">
            <a href="https://www.facebook.com">
              <i class="fa fa-facebook"></i>
            </a>
          </li>
          <li class="list-inline-item social-google-plus">
            <a href="#">
              <i class="fa fa-google-plus"></i>
            </a>
          </li>
        </ul>
        
    </section>

    <footer>
      <div class="container">
        <p>&copy; 2017 Start Bootstrap. All Rights Reserved.</p>
        <ul class="list-inline">
          <li class="list-inline-item">
            <a href="#">Privacy</a>
          </li>
          <li class="list-inline-item">
            <a href="#">Terms</a>
          </li>
          <li class="list-inline-item">
            <a href="#">FAQ</a>
          </li>
        </ul>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/new-age.min.js"></script>

  <script type="text/javascript">
    
    function functiontest(argument) {
        location.href = '/'+argument.value;
    }
    window.onload = function(){

        var campo = document.getElementById('informationTest');

        var url = window.location.href;
        let explodeURl = url.split('/');
        console.log(explodeURl); 
        var bandera=0;
        for (var i = explodeURl.length - 1; i >= 0; i--) {
            if (explodeURl[i] == 'es') {

                var opt = document.createElement('option');

                opt.value = 'es';
                opt.innerHTML = 'ESPAÑOL';
                opt.selected = true;
                opt.style="color:black";
                campo.appendChild(opt);

                var opt = document.createElement('option');

                opt.value = 'en';
                opt.innerHTML = 'ENGLISH';
                opt.style="color:black";
                campo.appendChild(opt);
                bandera=1;
                break;
            }else if(explodeURl[i] == 'en'){
                var opt = document.createElement('option');

                opt.value = 'en';
                opt.innerHTML = 'ENGLISH';
                opt.selected = true;
                opt.style="color:black";
                campo.appendChild(opt);

                var opt = document.createElement('option');
                opt.value = 'es';
                opt.innerHTML = 'ESPAÑOL';
                opt.style="color:black";
                campo.appendChild(opt);
                bandera=1;
                break;
            }
        }
        if(bandera==0){
          var opt = document.createElement('option');

          opt.value = 'es';
          opt.innerHTML = 'ESPAÑOL';
          opt.selected = true;
          opt.style="color:black";
          campo.appendChild(opt);

          var opt = document.createElement('option');

          opt.value = 'en';
          opt.innerHTML = 'ENGLISH';
          opt.style="color:black";
          campo.appendChild(opt);
        }
    }
  </script>
  </body>

</html>