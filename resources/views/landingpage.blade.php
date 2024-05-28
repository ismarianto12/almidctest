<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
        }

        .btn {
            border-radius: 20px;
        }

        .container {
            max-width: 1024px;
            margin: auto;
            text-align: center;
        }

        .code-section::before {
            box-shadow: 10px 10px 10px #ddd;
        }

        .code-section {
            background: #fff;
            padding: 20px;
            width: 50%;
            margin: 0 auto;
            border-radius: 10px 10px 10px;
            border: 2px dashed #796135;
            margin-top: 4.5rem;
        }

        .code-section p {
            margin: 0;
            font-size: 1.5rem;
            line-height: 2;
        }

        .btn-copy {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 10px;
        }

        .footer-logo {
            margin-top: 50px;
        }

        footer {
            margin-top: 50px;
            padding: 20px 0;
            background: #f8f9fa;
        }

        .navbar-toggler:focus {
            text-decoration: none;
            outline: 0;
            box-shadow: unset !important;
        }

        .navbar-toggler {
            padding: var(--bs-navbar-toggler-padding-y) var(--bs-navbar-toggler-padding-x);
            font-size: var(--bs-navbar-toggler-font-size);
            line-height: 1;
            color: var(--bs-navbar-color);
            background-color: transparent;
            border: unset !important;
            border-radius: unset !important;
            transition: var(--bs-navbar-toggler-transition);
        }

        .btn-login,
        .btn-register {
            border-radius: 20px;
            padding: 5px 20px;
            margin-left: 10px;
        }

        .btn-login {
            background-color: #ffc107;
            color: #343a40;
        }

        .btn-register {
            background-color: white;
            color: #343a40;
        }

        .btn-login:hover,
        .btn-register:hover {
            opacity: 0.8;
        }

        .navbar {
            background-color: white;
        }

        .navbar-brand img {
            height: 40px;
        }

        .btn-primary {
            background: orange;
            border: unset;
        }

        .navbar-nav .nav-link {
            color: #000 !important;
            margin-right: 20px;
        }

        .navbar-nav .nav-link:hover {
            color: #007bff !important;
        }

        .btn-login,
        .btn-register {
            background: orange;
            border-radius: 20px;
            padding: 5px 20px;
            margin-left: 10px;
        }

        .btn-login {
            background: orange;
            color: white;
        }

        .btn-register {
            background-color: #6c757d;
            color: white;
        }

        .btn-login:hover,
        .btn-register:hover {
            opacity: 0.8;
        }

        .product_picture {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .skeleton {
            overflow: hidden;
        }

        .thumb1-image {
            object-fit: cover;
        }

        .wd100 {
            width: 100%;
            background: orange;
            box-shadow: 10px 10px 10px #dddd;
        }

        .wd50 {
            width: 10%;
            background: orange;
            box-shadow: 10px 10px 10px #dddd;
            margin: 0.1rem;
            padding: 0.1rem;
        }

        .form-group {
            text-align: left;
        }

        a {
            text-decoration: none;
            color: #000;
        }

        a:hover,
        a:focus {
            text-decoration: none;
            color: #eb9d0d;

        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://img.buyflowers.com.sg/assets/images/logo.webp" alt="Logo" style="width:100%">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#construction">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                @if (Auth::user())
                    <a href="#" class="btn btn-login">Profile</a>
                    <a href="#" id="logout" class="btn btn-register">Logout</a>
                @else
                    <button class="btn btn-primary wd50" id="render_login" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasWithBothOptions"
                        aria-controls="offcanvasWithBothOptions">Login</button>
                    &nbsp;
                    <button class="btn btn-primary wd50" id="render_register" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasWithBothOptions"
                        aria-controls="offcanvasWithBothOptions">Register</button>
                @endif

            </div>
        </div>
    </nav>
    <br /><br />
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="margin-top: 20px">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://img.floweradvisor.com/b/33ee0e02a453d58b2c8710c0b271737c.webp?v=20240510131001"
                    class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://img.floweradvisor.com/p/t/fa1a58f649ff48cb185a6b80d600ac33.webp?v=20231207165727"
                    class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://img.floweradvisor.com/b/b56fc3dfa52402db936a44ab4af02515.webp?v=20240307180122"
                    class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container">


        <br />
        <h3>Welcome to Flower Advisor</h3>


        <div class="code-section">
            <p>Use code: <strong>HALLOW10</strong></p>
            <button class="btn btn-copy wd100 bg-orange" onclick="copyCode()">Copy Code</button>
        </div>

        <br /><br />

        <div class="row content-products">
            <div class="col-md-3 popular-occasion" data-nth="Hand Bouquets">
                <a href="https://www.floweradvisor.com.ph/collections/hand-bouquets" aria-label="Carousel Occasions"
                    rel="dofollow">
                    <div class="skeleton" style="border-radius: 50%; width: 100%; ">
                        <picture class="product_picture">
                            <source media="(max-width: 768px)"
                                srcset="https://img.floweradvisor.com/p/m/3db5c9afd4701d33302d005b92f2e6b1.webp?v=20230823171141">
                            <img src="https://img.floweradvisor.com/p/t/3db5c9afd4701d33302d005b92f2e6b1.webp?v=20230823171141"
                                class="thumb1-image" alt="Hand Bouquets" loading="lazy" width="60%"
                                height="60%">
                        </picture>
                    </div>
                    <h6 class="text text-center">Hand Bouquets</h6>
                </a>
            </div>
            <div class="col-md-3 popular-occasion" data-nth="Best Seller">
                <a href="https://www.floweradvisor.com.ph/collections/best-seller" aria-label="Carousel Occasions"
                    rel="dofollow">
                    <div class="skeleton" style="border-radius: 50%; width: 100%; ">
                        <picture class="product_picture">
                            <source media="(max-width: 768px)"
                                srcset="https://img.floweradvisor.com/p/m/c14e41d82bf789e19fc992678cc8c324.webp?v=20230823165318">
                            <img src="https://img.floweradvisor.com/p/t/c14e41d82bf789e19fc992678cc8c324.webp?v=20230823165318"
                                class="thumb1-image" alt="Best Seller" loading="lazy" width="60%"
                                height="60%">
                        </picture>
                    </div>
                    <h6 class="text text-center">Best Seller</h6>
                </a>
            </div>
            <div class="col-md-3 popular-occasion" data-nth="Get Well Soon">
                <a href="https://www.floweradvisor.com.ph/collections/get-well-soon" aria-label="Carousel Occasions"
                    rel="dofollow">
                    <div class="skeleton" style="border-radius: 50%; width: 100%; ">
                        <picture class="product_picture">
                            <source media="(max-width: 768px)"
                                srcset="https://img.floweradvisor.com/p/m/592ad4ca4c135e8cb98e83afae2163fb.webp?v=20231006162722">
                            <img src="https://img.floweradvisor.com/p/t/592ad4ca4c135e8cb98e83afae2163fb.webp?v=20231006162722"
                                class="thumb1-image" alt="Get Well Soon" loading="lazy" width="60%"
                                height="60%">
                        </picture>
                    </div>
                    <h6 class="text text-center">Get Well Soon</h6>
                </a>
            </div>
            <div class="col-md-3 popular-occasion" data-nth="Birthday">
                <a href="https://www.floweradvisor.com.ph/collections/birthday" aria-label="Carousel Occasions"
                    rel="dofollow">
                    <div class="skeleton" style="border-radius: 50%; width: 100%; ">
                        <picture class="product_picture">
                            <source media="(max-width: 768px)"
                                srcset="https://img.floweradvisor.com/p/m/436f51a9aa4fa55cfc42672c20b80799.webp?v=20230823171256">
                            <img src="https://img.floweradvisor.com/p/t/436f51a9aa4fa55cfc42672c20b80799.webp?v=20230823171256"
                                class="thumb1-image" alt="Birthday" loading="lazy" width="60%" height="60%">
                        </picture>
                    </div>
                    <h6 class="text text-center">Birthday</h6>
                </a>
            </div>
            <!-- Add more items as needed -->
        </div>
        <br /><br />

        <a href="https://itunes.apple.com/us/app/online-florist-floweradvisor/id1185232807" target="_blank">
            <img src="data:image/png;base64,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"
                alt="App Store" class="img-fluid my-4" style='width:14%'>
        </a>
        <br />
        <div class="container">
            <a href="https://www.floweradvisor.com.ph/flowersphilippines" class="btn btn-primary wd100"
                target="_blank">Make Someone’s
                Day</a>
        </div>
    </div>


    {{-- <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling"
        aria-controls="offcanvasScrolling">Enable body scrolling</button>
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">Enable backdrop
        (default)</button> --}}


    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
        id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Colored with scrolling</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <p>Try scrolling the rest of the page to see this option in action.</p>
        </div>
    </div>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop"
        aria-labelledby="offcanvasWithBackdropLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Offcanvas with backdrop</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <p>.....</p>
        </div>
    </div>
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
        aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Loading ...</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" id="parsingrenderformaction">
        </div>
    </div>

    <footer class="text-center">
        <div class="footer-logo">
            <a href="https://www.floweradvisor.com.ph" target="_blank">
                <img src="https://img.buyflowers.com.sg/assets/images/logo.webp" alt="Flower Advisor">
            </a>
        </div>
    </footer>

    <script>
        function copyCode() {
            const code = "HALLOW10";
            navigator.clipboard.writeText(code).then(() => {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Code copied to clipboard!",
                    showConfirmButton: false,
                    timer: 1500
                });
            }).catch(err => {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Code copied to clipboard!",
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        }
        $(document).on('submit', '#loginacti', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Check password...',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
            });
            Swal.showLoading();
            $.ajax({
                url: $(this).attr('action'),
                method: 'post',
                data: $(this).serialize(),
                chace: false,
                asynch: false,
                success: function(data, JqXHR) {
                    Swal.fire('Success', 'BerhasilLogin', 'success');
                    window.location.href = '?contract=2022';
                    console.log(JqXHR);
                },
                error: function(data, JqXHR, err) {
                    err = '';
                    respon = data.responseJSON;
                    $.each(respon.errors, function(index, value) {
                        err += "<li>" + value + "</li>";
                    });
                    Swal.fire({
                        title: 'Opp ada kesalahan',
                        html: err,
                        icon: 'error',
                        confirmButtonText: 'Cool'
                    })
                }
            });
        });
        $(document).on('submit', '#forgot_cacti', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Check password...',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
            });
            Swal.showLoading();
            $.ajax({
                url: $(this).attr('action'),
                method: 'post',
                data: $(this).serialize(),
                chace: false,
                asynch: false,
                success: function(data, JqXHR) {
                    Swal.fire('Success', 'Send email notif to reset Password', 'success');
                },
                error: function(data, JqXHR, err) {
                    err = '';
                    respon = data.responseJSON;
                    $.each(respon.errors, function(index, value) {
                        err += "<li>" + value + "</li>";
                    });
                    Swal.fire({
                        title: 'Opp ada kesalahan',
                        html: err,
                        icon: 'error',
                        confirmButtonText: 'Cool'
                    })
                }
            });
        });

        $(document).on('click', '#logout', function(e) {

            Swal.fire({
                title: "Kamu Yakin",
                text: "Berhasil logout",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {


                    e.preventDefault();
                    Swal.fire({
                        title: 'Sedang Proses Logout',
                        allowOutsideClick: false,
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                    Swal.showLoading();
                    $.ajax({
                        url: '{{ Url('/logout') }}',
                        method: 'post',
                        data: $(this).serialize(),
                        chace: false,
                        asynch: false,
                        success: function(data, JqXHR) {
                            window.location.href = '?action=Loguot';
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Logout Berhasil.",
                                icon: "success"
                            });
                        },
                        error: function(data, JqXHR, err) {
                            err = '';
                            respon = data.responseJSON;
                            $.each(respon.errors, function(index, value) {
                                err += "<li>" + value + "</li>";
                            });
                            Swal.fire({
                                title: 'Opp ada kesalahan',
                                html: err,
                                icon: 'error',
                                confirmButtonText: 'Cool'
                            })
                        }
                    });

                }
            });
        });
        $(document).on('submit', '#register', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Please Wait...',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
            });
            Swal.showLoading();
            $.ajax({
                url: '{{ Url('registeract') }}',
                method: 'post',
                data: $(this).serialize(),
                chace: false,
                asynch: false,
                success: function(data, JqXHR) {
                    Swal.fire('Success', 'Berhasil Register Silahkan Login', 'success');

                    $('#parsingrenderformaction').html(`<form method="POST" action="{{ route('login') }}" id="loginacti" class="form-hocrizontal">
<div class="login-form">
    <div class="form-group">
        <label for="username" class="form-label"><b>Username</b></label>
        <input id="username" name="username" value="{{ old('email') }}" type="text"
            class="form-control" required>
        @if ($errors->has('username'))
            <b>
                <strong style="color: red">{{ $errors->first('username') }}</strong>
            </b>
        @endif
    </div>
    <div class="form-group">
        <label for="password" class="form-label"><b>Password</b></label>

        <div class="position-relative">
            <input id="password" name="password" type="password"
                class="form-control @error('password') is-invalid @enderror" required>
            @if ($errors->has('password'))
                <b>
                    <strong style="color: red">{{ $errors->first('password') }}</strong>
                </b>
            @endif
            <div class=" show-password">
                <i class="icon-eye"></i>
            </div>
        </div>
    </div>
    <div class="form-group" id="forgot_pass">
        <br />
     <p style="cursor:pointer">Forgot Password </p>
    </div>
    <br />
    <button href="#" class="btn btn-secondary col-md-5 float-right mt-3 mt-sm-0 fw-bold">Sign
        In</button>
</div>
</form>`);
                },
                error: function(data, JqXHR, err) {
                    err = '';
                    respon = data.responseJSON;
                    $.each(respon.errors, function(index, value) {
                        err += "<li>" + value + "</li>";
                    });
                    Swal.fire({
                        title: 'Opp ada kesalahan',
                        html: err,
                        icon: 'error',
                        confirmButtonText: 'Cool'
                    })
                }
            });
        });
        $(document).on('click', '#render_register', function() {
            document.title = "Register Page";
            $('#offcanvasWithBothOptionsLabel').html('Register Apps');
            $('#parsingrenderformaction').html(`<div class="container register-container">
         <form class="form-horizontal" id="register">
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <br />
            <div class="g-recaptcha"
       data-sitekey="6LcgSAMTAAAAACc2C7rc6HB9ZmEX4SyB0bbAJvTG"
       data-callback="onSubmit"
       data-theme="light"
       data-badge="inline"

   ></div>
            <br />
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
    </div>`);
        });
        $(document).on('click', '#render_login', function() {
            document.title = "Login";
            $('#offcanvasWithBothOptionsLabel').html('Login Apps');
            $('#parsingrenderformaction').html(`<form method="POST" action="{{ route('login') }}" id="loginacti" class="form-hocrizontal">
<div class="login-form">
    <div class="form-group">
        <label for="username" class="form-label"><b>Username</b></label>
        <input id="username" name="username" value="{{ old('email') }}" type="text"
            class="form-control" required>
        @if ($errors->has('username'))
            <b>
                <strong style="color: red">{{ $errors->first('username') }}</strong>
            </b>
        @endif
    </div>
    <div class="form-group">
        <label for="password" class="form-label"><b>Password</b></label>

        <div class="position-relative">
            <input id="password" name="password" type="password"
                class="form-control @error('password') is-invalid @enderror" required>
            @if ($errors->has('password'))
                <b>
                    <strong style="color: red">{{ $errors->first('password') }}</strong>
                </b>
            @endif
            <div class=" show-password">
                <i class="icon-eye"></i>
            </div>
        </div>
    </div>
    <div class="form-group" id="forgot_pass">
        <p style="cursor:pointer">Forgot Password </p>
    </div>
    <br />
    <button href="#" class="btn btn-secondary col-md-5 float-right mt-3 mt-sm-0 fw-bold">Sign
        In</button>
</div>
</form>`);
        })

        $(document).on('click', '#forgot_pass', function() {
            document.title = "Lupa Password";
            $('#offcanvasWithBothOptionsLabel').html('Lupa Pasword');
            $('#parsingrenderformaction').html(`<form method="POST" action="{{ Url('forgotpassw') }}" id="forgot_cacti" class="form-hocrizontal">
<div class="login-form">
    <div class="form-group">
        <label for="username" class="form-label"><b>Email</b></label>
        <input id="email" name="email" value="{{ old('email') }}" type="text"
            class="form-control" required>
        @if ($errors->has('email'))
            <b>
                <strong style="color: red">{{ $errors->first('email') }}</strong>
            </b>
        @endif
    </div>

    <div class="form-group">
    </div>
    <br />
    <button type="submit" class="btn btn-secondary wd100">Kirim Kode Verifikasi</button>
</div>
</form>`);

        });

        function onload() {
            var element = document.getElementById('submit');
            element.onclick = validate;

            /* setTimeout(function(){
                 document.getElementById('field').value="toto";
                 document.getElementById('submit').click();
            }, 2000) */


        }
        onload()
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>

</body>

</html>
