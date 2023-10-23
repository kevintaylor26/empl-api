<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@if (!Auth::user())
    <script>
        window.location.href = '/';
    </script>
@elseif (Auth::user()->user_type == 0)
    <script>
        window.location.href = '/home';
    </script>
@else

    <head>
        <meta charset="utf-8">
        <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="description" content="Admin page of Site" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="og:site_name" content="Data Company" />
        <meta name="og:title" content="DATA COMPANY" />
        <meta name="og:url" content="https://emaildata.co/" />
        <meta name="og:image" content="https://emaildata.co/images/datacompnay.jpeg" />
        <meta name="og:type" content="website" />
        <meta name="og:image:type" content="image/jpeg" />
        <title>@yield('title') - Data Company Administrator</title>
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

        <link rel="stylesheet" type="text/css" href="/css/toastify.min.css">

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
        <!-- Wow Toast -->
        <script type="text/javascript" src="js/toastify.js"></script>
        <!--  Custom JavaScript -->
        <script src="js/custom.js"></script>

        <script>
            const toastMessage = (type, msg) => {
                Toastify({
                    text: msg,
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "center", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: type == 'warning' ? "#ff9966" : type == 'error' ? '#CC3300' : '#428bca',
                    },
                    onClick: function() {} // Callback after click
                }).showToast();
            }
        </script>
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
                                <a class="navbar-brand" href="/admin_panel">
                                    <img class="img-fluid" src="images/logo_black.png" alt="img">
                                    {{-- <span style="margin-left: 10px">Data Company</span> --}}
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
                                        @if (Auth::user())
                                            <li class="nav-item dropdown" style="display: flex; align-items: center;">
                                                <a class=" nav-instant-access nav-link d-inline-block"
                                                    style="padding: 5px 30px; font-size: 17px;"
                                                    href="#">
                                                    <span>
                                                        Management
                                                    </span>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="admin_panel">
                                                        <i class="fa fa-trademark mr-2" aria-hidden="true"
                                                            style="font-size: 25px;"></i>
                                                        Trading Data
                                                    </a>
                                                    <a class="dropdown-item" href="users_management">
                                                        <i class="fa fa-users mr-2" aria-hidden="true"
                                                            style="font-size: 25px;"></i>
                                                        Users
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="nav-item dropdown" style="display: flex; align-items: center;">
                                                <a class=" nav-instant-access nav-link d-inline-block"
                                                    style="padding: 5px 30px; font-size: 17px;"
                                                    href="javascript:void()">
                                                    <span>
                                                        <i class="fa fa-user-circle-o mr-1" aria-hidden="true"
                                                            style="font-size: 30px;"></i>
                                                        {{ Auth::user()->email }}
                                                    </span>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="javascript:void()"
                                                        data-toggle="modal" data-target="#userInfoModal">
                                                        <i class="fa fa-info-circle mr-2" aria-hidden="true"
                                                            style="font-size: 25px;"></i>
                                                        Account Info
                                                    </a>
                                                    <a class="dropdown-item" href="home">
                                                        <i class="fa fa-home mr-2" aria-hidden="true"
                                                            style="font-size: 25px;"></i>
                                                        Homepage
                                                    </a>
                                                    <a class="dropdown-item" href="signout">
                                                        <i class="fa fa-sign-out mr-2" aria-hidden="true"
                                                            style="font-size: 25px;"></i>
                                                        <span style="color: red">Sign Out</span>
                                                    </a>
                                                </div>
                                            </li>
                                        @else
                                            <li class="nav-item" style="display: flex; align-items: center;">
                                                <a class="iq-button iq-gradient-btn d-inline-block"
                                                    style="padding: 5px 30px; font-size: 17px;" href="signin">
                                                    <span>
                                                        <i class="fa fa-user mr-1" aria-hidden="true"></i>
                                                        Login
                                                    </span>
                                                </a>
                                            </li>
                                        @endif

                                    </ul>

                                </div>

                            </nav>
                        </div>
                    </div>
                </div>
            </header>

            <main style="min-height: calc('100vh' - '100px')">
                <div class="container mx-auto px-8 py-16">
                    @yield('content')
                </div>
            </main>
            @auth
                <div id="userInfoModal" tabindex="-1" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Account Information</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6 text-right">
                                        <span>Email:</span>
                                    </div>
                                    <div class="col-6">
                                        <span>{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                                <div class="row text-center mt-3" style="justify-content: center" id="dvBtnChangePsd">
                                    <div class="col-6">
                                        <a class="btn-normal iq-button d-flex" style="align-items: center"
                                            href="javascript:showUpdatePassword(true)">
                                            <i class="fa fa-key mr-2"></i>
                                            <span>Change Password</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="password-info mt-3" id="dvUpdatePassword" style="display: none;">
                                    <div class="row align-center">
                                        <div class="col-6 text-right">
                                            <span>Old Password:</span>
                                        </div>
                                        <div class="col-6">
                                            <input type="password" id="oldPassword">
                                        </div>
                                    </div>
                                    <div class="row align-center mt-1">
                                        <div class="col-6 text-right">
                                            <span>New Password:</span>
                                        </div>
                                        <div class="col-6">
                                            <input type="password" id="newPassword">
                                        </div>
                                    </div>
                                    <div class="row align-center mt-1">
                                        <div class="col-6 text-right">
                                            <span>Confirm New Password:</span>
                                        </div>
                                        <div class="col-6">
                                            <input type="password" id="newConfirmPassword">
                                        </div>
                                    </div>
                                    <div class="row align-center mt-3" style="justify-content: center">
                                        <a class="btn btn-update d-flex" style="align-items: center"
                                            href="javascript:updatePassword()">
                                            <span>Update</span>
                                        </a>
                                        <a class="btn d-flex ml-2" style="align-items: center"
                                            href="javascript:showUpdatePassword(false)">
                                            <span>Cancel</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function showUserInfo() {
                        $('#userInfoModal').modal('show');
                    }

                    function updatePassword() {
                        const url = "{{ route('api.auth.changePassword') }}";
                        if (!$('#oldPassword').val()) {
                            toastMessage('error', 'Please type old password');
                            $('#oldPassword').focus();
                            return;
                        }
                        if (!$('#newPassword').val()) {
                            toastMessage('error', 'Please type new password');
                            $('#newPassword').focus();
                            return;
                        }
                        if (!$('#newConfirmPassword').val()) {
                            toastMessage('error', 'Please type confirm password');
                            $('#newConfirmPassword').focus();
                            return;
                        } else if ($('#newPassword').val() != $('#newConfirmPassword').val()) {
                            toastMessage('error', 'Password does not matches!');
                            $('#newConfirmPassword').focus();
                            return;
                        }
                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                email: $('#email').val(),
                                oldPassword: $('#oldPassword').val(),
                                newPassword: $('#newPassword').val()
                            },
                            success: function(res) {
                                if (res.code) {
                                    toastMessage('error', res.message ?? 'An error occured while updating password');
                                } else {
                                    toastMessage('success', 'Updated password successfully!');
                                }
                            },
                            error: function(msg) {
                                toastMessage('error', msg.message ?? 'An error occured while updating password');
                            }
                        });
                    }

                    function showUpdatePassword(val) {
                        if (val) {
                            $('#dvUpdatePassword').show();
                            $('#dvBtnChangePsd').hide();
                        } else {
                            $('#dvUpdatePassword').hide();
                            $('#dvBtnChangePsd').show();
                        }
                    }
                </script>
            @endauth
            <footer class="footer3 admin-footer">
                <img src="images/footer-pattern.png" class="img-fluid footer-pattern" alt="#">
                <div class="footer-topbar" style="padding: 20px 0px; margin-bottom: 0px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                <div class="widget mb-0">
                                    <div class="textwidget">
                                        <div class="row ">
                                            <div
                                                class="col-lg-6 col-md-12  mb-4 mb-lg-0 text-lg-center text-lg-left align-self-center">
                                                <h4 class="text-white mb-3 subscribe-title">Subscribe for Newsletter
                                                </h4>
                                                <p class="mb-0 text-white">It is a long established fact that a reader
                                                    will
                                                    be distracted.</p>
                                            </div>
                                            <div class="col-lg-6 pl-lg-5 align-self-center">
                                                <form class="mc4wp-form mc4wp-form-517" method="post">
                                                    <div class="mc4wp-form-fields">
                                                        <input type="email" name="EMAIL" placeholder="Email"
                                                            required="">
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

@endif
