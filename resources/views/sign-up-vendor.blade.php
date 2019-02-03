<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sign Up Vendor</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Montserrat|Montserrat+Alternates" rel="stylesheet">

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('/css/main.css') }}" />
        <link rel="stylesheet" href="{{ asset('/css/foundation.min.css') }}" />

    </head>
    <body>
        <header>
            <div class="title-bar" data-responsive-toggle="top-menu" data-hide-for="medium">
                <button class="menu-icon" type="button" data-toggle="top-menu"></button>
                <div class="title-bar-title">Menu</div>
            </div>

            <div class="top-bar" id="top-menu">
                <div class="top-bar-left">
                    <ul class="dropdown menu" data-dropdown-menu>
                        <li class="menu-text"><a href="#">Bodas & Quinceañera</a></li>
                        <li class="menu-item"><a href="#">Venues</a></li>
                        <li class="menu-item"><a href="#">Category</a></li>
                        <li class="menu-item"><a href="#">Vendors</a></li>
                        <li class="menu-item"><a href="#">Foro</a></li>
                        <li class="menu-item"><a href="#">Testimonies</a></li>
                        <li class="menu-item"><a href="#">Blog</a></li>
                        <li class="menu-item"><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="top-bar-right text-center">
                    <ul class="menu">
                        <li class="montserrat-bold header-are-you-vendor">Are you a vendor?</li>
                    </ul>
                    <div class="montserrat-bold display-inline">
                        <a href="#">Login</a>
                    </div>
                    <div class="header-text-separator montserrat-bold display-inline">
                        |
                    </div>
                    <div class="montserrat-bold display-inline">
                        <a href="#">Join now</a>
                    </div>
                </div>
            </div>
        </header>

        @if (isset($response))
            <div class="reveal" id="success-sign-up" data-reveal>
                <h1>Registration</h1>
                <p class="lead">Thank you for registering, check your inbox to start enjoying bodas and quinceañera</p>
                <button class="close-button" data-close aria-label="Close reveal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    $('#success-sign-up').foundation('open');
                })
            </script>
        @endif

        <section class="left-social-icons text-center">
            <div>
                <img src="{{ asset('/img/twitter.svg') }}" alt="Twitter">
            </div>
            <div>
                <img src="{{ asset('/img/facebook.svg') }}" alt="Facebook">
            </div>
            <div>
                <img src="{{ asset('/img/instagram.png') }}" alt="Instagram">
            </div>
            <div class="color-white montserrat-bold">
                ES
            </div>
        </section>

        <section class="grid-container grid-x grid-padding-x section-container">
            <div class="cell medium-5 small-12">
                <div class="free-vendor-message">
                    <div class="sign-up-left-image">
                        <div class="sign-up-left-image-cover"></div>
                        <img src="{{ asset('/img/sign-Up-Vendor-IMAGE_02.jpg') }}" alt="" />
                    </div>
                    <div class="sign-up-left-text">
                        <h3 class="montserrat-bold text-left">
                            Create your free vendor accounting
                        </h3>
                        <label class="color-white">Build your online presence and collect reviews with a custon Storefront.</label>
                    </div>
                </div>
            </div>

            <form class="sign-up cell medium-7 small-12" method="post" action="{{ action('SignUp@saveVendor') }}">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ csrf_field() }}
                <div class="grid-container grid-x grid-padding-x">
                    <div class="cell large-offset-2 medium-offset-0 small-offset-0 large-10 medium-12 small-12">
                        <div class="grid-x grid-padding-x">
                            <div class="small-12 cell">
                                <legend>
                                    Log In Information
                                </legend>
                            </div>
                            <div class="small-12 cell">
                                <input data-tooltip tabindex="1" title="Enter your name" data-position="right" data-alignment="bottom" name="name" type="text" value="" placeholder="Name" maxlength="150" />
                            </div>
                            <div class="small-12 cell">
                                <input data-tooltip tabindex="1" title="Enter your email" data-position="right" data-alignment="bottom" name="email" type="email" placeholder="Email" maxlength="150" />
                            </div>
                            <div class="small-12 cell">
                                <input data-tooltip tabindex="1" title="Password must contain at least 6 characters and is case sensitive" data-position="right" data-alignment="bottom" name="password" type="password" placeholder="Password" maxlength="100" />
                            </div>
                            <div class="small-12 cell">
                                <input data-tooltip tabindex="1" title="The password must match" data-position="right" data-alignment="bottom" name="confirm_password" type="password" placeholder="Confirm your password" maxlength="100" />
                            </div>
                            <div class="small-12 cell">
                                <input data-tooltip tabindex="1" title="Enter your phone number" data-position="right" data-alignment="bottom" name="phone" type="number" placeholder="Phone" maxlength="15" />
                            </div>
                        </div>
                    </div>

                    <div class="cell large-offset-2 medium-offset-0 small-offset-0 large-10 medium-12 small-12">
                        <div class="grid-x grid-padding-x">
                            <div class="small-12 cell">
                                <legend>
                                    Business Information
                                </legend>
                            </div>
                            <div class="small-12 cell">
                                <input name="business_name" type="text" placeholder="Business Name" maxlength="150" />
                            </div>
                            <div class="small-12 cell">
                                <label class="select-container relative">
                                    <select class="relative" name="business_type" id="business_type">
                                        <option selected value="0">Business Type</option>
                                        <option value="1">First Type</option>
                                        <option value="2">Second Type</option>
                                        <option value="3">Third Type</option>
                                    </select>
                                </label>
                            </div>
                            <div class="small-12 cell">
                                <label class="select-container relative">
                                    <select name="category" id="category">
                                        <option value="">Category</option>
                                        <option value="1">First Type</option>
                                        <option value="2">Second Type</option>
                                        <option value="3">Third Type</option>
                                    </select>
                                </label>
                            </div>
                            
                            <div class="small-12 cell">
                                <label class="form-services">Services: </label>
                                <div class="grid-x grid-padding-x">
                                <?php
                                    $services = \App\Service::all()->sortBy("name");
                                ?>
                                @foreach ($services as $service)
                                    <div class="cell small-6">
                                        <input value="{{ $service->id }}" name="service_allowed[]" id="service-{{ $service->id }}" type="checkbox"><label for="service-{{ $service->id }}">{{ $service->name }}</label>
                                    </div>
                                @endforeach
                                </div>
                            </div>

                            <div class="small-12 cell margin-top-1">
                                <label class="select-container relative">
                                    <select name="suscription_type" id="suscription_type">
                                        <option value="">Suscription Type</option>
                                        <option value="1">First Type</option>
                                        <option value="2">Second Type</option>
                                        <option value="3">Third Type</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="cell large-offset-0 medium-offset-0 small-offset-0 small-12 medium-12 large-12 footer-terms">
                        <div class="grid-x grid-padding-x">
                            <div class="cell small-12">
                                By clicking 'Create account' you agree to Bodas y Quinceañera <a href="#" class="yellow-color">Terms of Use</a> and <a href="#" class="yellow-color">Privacy Policy</a>
                            </div>
                        </div>
                    </div>

                    <div class="cell large-offset-2 medium-offset-0 small-offset-0 large-10 medium-12 small-12">
                        <div class="grid-x grid-padding-x">
                            <div class="cell small-12">
                                <button type="submit" class="button expanded large button-yellow-color">Create Account</button>
                            </div>
                        </div>
                    </div>

                    <div class="cell large-offset-2 medium-offset-0 small-offset-0 large-10 medium-12 small-12">
                        <div class="grid-x grid-padding-x">
                            <div class="cell small-12">
                                <label class="already-have-account text-center">Already have an account? <a href="#">Log In</a></label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>

        <footer class="text-center grid-container fluid">
            <div class="grid-x grid-margin-x">
                <div class="cell large-offset-2 medium-offset-0 small-offset-0 small-12 medium-12 large-8">
                    <div class="row">
                        <div class="columns medium-12">
                            <h3 class="footer-subscribe-text">
                                Subscribe our Newslatter
                            </h3>
                            <label class="color-white size-16">To get all the latest news about us</label>
                        </div>
                    </div>

                    <div class="grid-x grid-margin-x">
                        <div class="cell large-offset-3 medium-offset-1 small-offset-0 large-6 medium-10 small-12">
                            <div class="input-group">
                                <input class="input-group-field footer-subscribe-input" type="mail" maxlength="100" placeholder="Your email address here..." />
                                <div class="input-group-button">
                                    <input type="button" class="button button-yellow-color color-white" value="Subscribe" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row footer-icons">
                        <div class="columns medium-12">
                            <img src="{{ asset('/img/facebook.svg') }}" alt="Facebook" />
                            <img src="{{ asset('/img/instagram.png') }}" alt="Instagram" />
                            <img src="{{ asset('/img/twitter.svg') }}" alt="Twitter" />
                        </div>
                    </div>


                    <div class="grid-x grid-margin-x">
                        <div class="cell large-offset-3 medium-offset-1 small-offset-0 large-6 medium-10 small-12 footer-bottom-menu">
                            <span>
                                <a href="#">Venues </a>
                            </span>
                            <span>
                                <a href="#">Category </a>
                            </span>
                            <span>
                                <a href="#">Vendors </a>
                            </span>
                            <span>
                                <a href="#">Foro </a>
                            </span>
                            <span>
                                <a href="#">Testimonies </a>
                            </span>
                            <span>
                                <a href="#">Blog </a>
                            </span>
                            <span>
                                <a href="#">Contact </a>
                            </span>
                            <span>
                                <a href="#">Quiénes somos </a>
                            </span>
                            <span>
                                <a href="#">Términos y condiciones </a>
                            </span>
                            <span>
                                <a href="#">Preguntas frecuentes </a>
                            </span>
                        </div>
                    </div>

                    <div class="row copy">
                        <div class="cell medium-12">
                            <label class="color-white">&copy {{ date('Y') }} DiproGT, Guatemala City</label>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script src="{{ asset('/js/vendor/jquery.js') }}"></script>
        <script src="{{ asset('/js/vendor/foundation.min.js') }}"></script>
        <script src="{{ asset('/js/vendor/what-input.js') }}"></script>
        <script src="{{ asset('/js/app.js') }}"></script>
    </body>
</html>
