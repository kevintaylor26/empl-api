<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta
      name="description"
      content="You can find any marketing data"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="og:site_name" content="Data Company" />
    <meta name="og:title" content="DATA COMPANY" />
    <meta name="og:url" content="https://167.88.166.94:8080/" />
    <meta name="og:image" content="https://167.88.166.94:8080/images/datacompnay.jpeg" />
    <meta name="og:type" content="website" />
    <meta name="og:image:type" content="image/jpeg" />
    <title>@yield('title') - Data Company</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="css/typography.css">
    <!-- Style CSS -->
    <link rel='stylesheet' href='css/phifi-style.css' />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">

    <script src="js/jquery-3.4.1.js"></script>
    <!-- jQuery  for scroll me js -->
    <script src='js/jquery-min.js'></script>
    <!-- popper  -->
    <script src="js/popper.min.js"></script>
    <!--  bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Appear JavaScript -->
    <script src="js/appear.js"></script>
    <!-- Jquery-migrate JavaScript -->
    <script src='js/jquery-migrate.min.js'></script>
    <!-- countdownTimer JavaScript -->
    <script src='js/jQuery.countdownTimer.min.js'></script>
    <!-- Owl.carousel JavaScript -->
    <script src='js/owl.carousel.min.js'></script>
    <!-- Countdown JavaScript -->
    <script src='js/countdown.js'></script>
    <!-- Jquery.countTo JavaScript -->
    <script src='js/jquery.countTo.js'></script>
    <!-- Magnific-popup JavaScript -->
    <script src='js/jquery.magnific-popup.min.js'></script>
    <!-- Wow JavaScript -->
    <script src='js/wow.min.js'></script>
    <!--  Custom JavaScript -->
    <script src="js/custom.js"></script>
</head>

<body class="h-full">
    <div id="loading">
        <div id="loading-center">
            <div class="load-img">
                <img src="images/loading.gif" alt="loader">
            </div>
        </div>
    </div>
    <div id="preloader" style="display:none;">
        <div class="small1">
            <div class="small ball smallball1"></div>
            <div class="small ball smallball2"></div>
            <div class="small ball smallball3"></div>
            <div class="small ball smallball4"></div>
        </div>


        <div class="small2">
            <div class="small ball smallball5"></div>
            <div class="small ball smallball6"></div>
            <div class="small ball smallball7"></div>
            <div class="small ball smallball8"></div>
        </div>

        <div class="bigcon">
            <div class="big ball"></div>
        </div>

    </div>
    <div class="min-h-full">
        <!-- loading End -->
        <!-- Header -->
        <header id="main-header" class="header-main">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <a class="navbar-brand" href="index.html">
                                <img class="img-fluid" src="images/logo.png" alt="img">
                                <span style="margin-left: 10px">Data Company</span>
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="menu-btn d-inline-block" id="menu-btn">
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <span class="line"></span>
                                </span>
                                <span class="ion-navicon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto w-100 justify-content-end">
                                    <li class="nav-item" style="display: flex; align-items: center;">
                                        <a class="nav-link" href="signup" role="button">
                                            GET INSTANT ACCESS
                                        </a>
                                    </li>
                                    <li class="nav-item" style="display: flex; align-items: center;">
                                        <a class="iq-button iq-gradient-btn d-inline-block" style="padding: 5px 30px; font-size: 17px;" href="signin">
                                            <span>
                                                <i class="fa fa-user mr-1" aria-hidden="true"></i>
                                                Login
                                            </span>
                                        </a>
                                    </li>
                                </ul>

                            </div>

                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <div class="container mx-auto px-8 py-16">
                @yield('content')
            </div>
        </main>
        <footer class="footer3">
            <img src="images/footer-pattern.png" class="img-fluid footer-pattern" alt="#">
            <div class="footer-topbar" style="padding: 20px 0px; margin-bottom: 0px;">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="widget mb-0">
                           <div class="textwidget">
                              <div class="row ">
                                 <div class="col-lg-6 col-md-12  mb-4 mb-lg-0 text-lg-center text-lg-left align-self-center">
                                    <h4 class="text-white mb-3 subscribe-title">Subscribe for Newsletter</h4>
                                    <p class="mb-0 text-white">It is a long established fact that a reader will be distracted.</p>
                                 </div>
                                 <div class="col-lg-6 pl-lg-5 align-self-center">
                                    <form class="mc4wp-form mc4wp-form-517" method="post">
                                       <div class="mc4wp-form-fields">
                                          <input type="email" name="EMAIL" placeholder="Email" required="">
                                          <input type="submit" value="Subscribe">
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </footer>
    </div>
</body>

</html>
