<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | Canosoft Technology</title>
    <link rel="shortcut icon" type="image/x-icon"  href="<?php if(@$setting_data->favicon){?>{{asset('/images/uploads/settings/'.@$setting_data->favicon)}}<?php }else{ echo "assets/backend/images/canosoft-favicon.png"; }?>">

    <style>
        html {
            font-size: 62.5%;
        }

        body {
            font-size: 1.4rem;
        }

        /* =14px */
        h1 {
            font-size: 2.4rem;
        }

        /* =24px */
        .container__item {
            margin: 0 auto 40px;
        }

        .landing-page-container {
            width: 100%;
            min-height: 100%;
            height: 90rem;
            background-image: url("https://s29.postimg.org/vho8xb2pj/landing_bg.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: bottom;
            overflow: hidden;
            font-family: "Montserrat", sans-serif;
            color: #09383e;
        }

        .content__wrapper {
            max-width: 1200px;
            width: 90%;
            height: 100%;
            margin: 0 auto;
            position: relative;
        }

        .header {
            width: 100%;
            height: 2rem;
            padding: 4.5rem 0;
            display: block;
        }

        .menu-icon {
            width: 2.5rem;
            height: 1.5rem;
            display: inline-block;
            cursor: pointer;
        }

        .header__item {
            display: inline-block;
            float: left;
        }

        .menu-icon__line {
            width: 1.5rem;
            height: 0.2rem;
            background-color: #0c383e;
            display: block;
        }
        .menu-icon__line:before, .menu-icon__line:after {
            content: "";
            width: 1.5rem;
            height: 0.2rem;
            background-color: #0c383e;
            display: inline-block;
            position: relative;
        }
        .menu-icon__line:before {
            left: 0.5rem;
            top: -0.8rem;
        }
        .menu-icon__line:after {
            top: -1.8rem;
        }

        .heading {
            width: 90%;
            font-size: 2rem;
            font-weight: bold;
            margin: 0;
            line-height: 1.7rem;
            margin: 0 auto;
            text-align: center;
        }

        .social-container {
            width: 7.25rem;
            list-style: none;
            overflow: hidden;
            padding: 0;
            margin: 0;
            float: right;
        }
        .social-container .social__icon {
            float: left;
            cursor: pointer;
        }
        .social-container .social__icon.social__icon--dr {
            margin-left: 0.5rem;
        }
        .social-container .social__icon.social__icon--dr img {
            height: 2rem;
        }
        .social-container .social__icon.social__icon--in {
            margin-left: 0.75rem;
        }
        .social-container .social__icon.social__icon--in img {
            height: 2rem;
        }
        .social-container .social__icon.social__icon--fb img {
            height: 2rem;
            margin: 0rem;
        }

        .coords {
            font-size: 1rem;
            display: inline-block;
            transform: rotate(-90deg) translateY(50%);
            float: left;
            position: relative;
            top: 40%;
            letter-spacing: 0.2rem;
            left: -11.5rem;
            margin: 0;
        }

        .ellipses-container {
            width: 50rem;
            height: 50rem;
            border-radius: 50%;
            margin: 0 auto;
            position: relative;
            top: 10.5rem;
        }
        .ellipses-container .greeting {
            position: absolute;
            top: 22.6rem;
            left: 13rem;
            right: 0;
            margin: 0 auto;
            text-transform: uppercase;
            letter-spacing: 4rem;
            font-size: 2.2rem;
            font-weight: 400;
            opacity: 0.5;
        }
        .ellipses-container .greeting:after {
            content: "";
            width: 0.3rem;
            height: 0.3rem;
            border-radius: 50%;
            display: inline-block;
            background-color: #0c383e;
            position: relative;
            top: -0.65rem;
            left: -5.05rem;
        }

        .ellipses {
            border-radius: 50%;
            position: absolute;
            top: 0;
            border-style: solid;
        }

        .ellipses__outer--thin {
            width: 100%;
            height: 100%;
            border-width: 1px;
            border-color: rgba(9, 56, 62, 0.1);
            -webkit-animation: ellipsesOrbit 15s ease-in-out infinite;
            animation: ellipsesOrbit 15s ease-in-out infinite;
        }
        .ellipses__outer--thin:after {
            content: "";
            background-image: url("https://s29.postimg.org/5h0r4ftkn/ellipses_dial.png");
            background-repeat: no-repeat;
            background-position: center;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            position: absolute;
            opacity: 0.15;
        }

        .ellipses__outer--thick {
            width: 99.5%;
            height: 99.5%;
            border-color: #09383e transparent;
            border-width: 2px;
            transform: rotate(-45deg);
            -webkit-animation: ellipsesRotate 15s ease-in-out infinite;
            animation: ellipsesRotate 15s ease-in-out infinite;
        }

        .ellipses__orbit {
            width: 2.5rem;
            height: 2.5rem;
            border-width: 2px;
            border-color: #09383e;
            top: 5rem;
            right: 6.75rem;
        }
        .ellipses__orbit:before {
            content: "";
            width: 0.7rem;
            height: 0.7rem;
            border-radius: 50%;
            display: inline-block;
            background-color: #09383e;
            margin: 0 auto;
            left: 0;
            right: 0;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .scroller {
            width: 7.5rem;
            display: inline-block;
            float: right;
            position: relative;
            top: -22%;
            transform: translateY(50%);
            overflow: hidden;
        }
        .scroller .page-title {
            font-family: "Playfair Display", serif;
            letter-spacing: 0.5rem;
            display: inline-block;
            float: left;
            margin-top: 1rem;
        }
        .scroller .timeline {
            width: 1.5rem;
            height: 9rem;
            display: inline-block;
            float: right;
        }
        .scroller .timeline .timeline__unit {
            width: 100%;
            height: 0.1rem;
            display: block;
            background-color: #0c383e;
            margin: 0 0 2rem;
            opacity: 0.2;
        }
        .scroller .timeline .timeline__unit.timeline__unit--active {
            opacity: 1;
        }
        .scroller .timeline .timeline__unit.timeline__unit--active:after {
            opacity: 0.2;
        }
        .scroller .timeline .timeline__unit:after {
            content: "";
            width: 70%;
            height: 0.1rem;
            display: block;
            position: relative;
            float: right;
            background-color: #0c383e;
            top: 1rem;
        }

        @-webkit-keyframes ellipsesRotate {
            0% {
                transform: rotate(-45deg);
            }
            100% {
                transform: rotate(-405deg);
            }
        }

        @keyframes ellipsesRotate {
            0% {
                transform: rotate(-45deg);
            }
            100% {
                transform: rotate(-405deg);
            }
        }
        @-webkit-keyframes ellipsesOrbit {
            0% {
                transform: rotate(0);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        @keyframes ellipsesOrbit {
            0% {
                transform: rotate(0);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>

</head>

<body>
<div class="container">
    <div class="container__item landing-page-container">
        <div class="content__wrapper">

            <header class="header">
                <div class="menu-icon header__item">
                    <span class="menu-icon__line"></span>
                </div>

                <h1 class="heading header__item">CANOSOFT TECHNOLOGY</h1>

                <ul class="social-container header__item">
                    <li class="social__icon social__icon--dr">
                        @if (Route::has('login'))
                                @auth
                                <a href="{{ url('/home') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                         width="25" height="25"
                                         viewBox="0 0 172 172"
                                         style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#09383e"><path d="M59.125,0h-37.625c-11.87412,0 -21.5,9.62588 -21.5,21.5v37.625c0,11.87412 9.62588,21.5 21.5,21.5h37.625c11.87412,0 21.5,-9.62588 21.5,-21.5v-37.625c0,-11.87412 -9.62588,-21.5 -21.5,-21.5zM69.875,59.125c0,5.93706 -4.81294,10.75 -10.75,10.75h-37.625c-5.93706,0 -10.75,-4.81294 -10.75,-10.75v-37.625c0,-5.93706 4.81294,-10.75 10.75,-10.75h37.625c5.93706,0 10.75,4.81294 10.75,10.75zM150.5,0h-37.625c-11.87412,0 -21.5,9.62588 -21.5,21.5v37.625c0,11.87412 9.62588,21.5 21.5,21.5h37.625c11.87412,0 21.5,-9.62588 21.5,-21.5v-37.625c0,-11.87412 -9.62588,-21.5 -21.5,-21.5zM161.25,59.125c0,5.93706 -4.81294,10.75 -10.75,10.75h-37.625c-5.93706,0 -10.75,-4.81294 -10.75,-10.75v-37.625c0,-5.93706 4.81294,-10.75 10.75,-10.75h37.625c5.93706,0 10.75,4.81294 10.75,10.75zM59.125,91.375h-37.625c-11.87412,0 -21.5,9.62588 -21.5,21.5v37.625c0,11.87412 9.62588,21.5 21.5,21.5h37.625c11.87412,0 21.5,-9.62588 21.5,-21.5v-37.625c0,-11.87412 -9.62588,-21.5 -21.5,-21.5zM69.875,150.5c0,5.93706 -4.81294,10.75 -10.75,10.75h-37.625c-5.93706,0 -10.75,-4.81294 -10.75,-10.75v-37.625c0,-5.93706 4.81294,-10.75 10.75,-10.75h37.625c5.93706,0 10.75,4.81294 10.75,10.75zM150.5,91.375h-37.625c-11.87412,0 -21.5,9.62588 -21.5,21.5v37.625c0,11.87412 9.62588,21.5 21.5,21.5h37.625c11.87412,0 21.5,-9.62588 21.5,-21.5v-37.625c0,-11.87412 -9.62588,-21.5 -21.5,-21.5zM161.25,150.5c0,5.93706 -4.81294,10.75 -10.75,10.75h-37.625c-5.93706,0 -10.75,-4.81294 -10.75,-10.75v-37.625c0,-5.93706 4.81294,-10.75 10.75,-10.75h37.625c5.93706,0 10.75,4.81294 10.75,10.75z"></path></g></g></svg>
                                </a>
                                @else
                                    <a href="{{ route('login') }}">

                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                     width="25" height="25"
                                     viewBox="0 0 172 172"
                                     style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#09383e"><path d="M44.72,0c-5.65694,0 -10.32,4.65923 -10.32,10.32v65.36h6.88v-65.36c0,-1.94163 1.50142,-3.44 3.44,-3.44h116.96c1.93858,0 3.44,1.49837 3.44,3.44v151.36c0,1.9365 -1.5035,3.44 -3.44,3.44h-116.96c-1.9365,0 -3.44,-1.5035 -3.44,-3.44v-65.36h-6.88v65.36c0,5.65902 4.66098,10.32 10.32,10.32h116.96c5.65902,0 10.32,-4.66098 10.32,-10.32v-151.36c0,-5.66077 -4.66306,-10.32 -10.32,-10.32zM75.82781,45.06265c-1.39859,0.00309 -2.65612,0.85256 -3.18113,2.14887c-0.52501,1.29631 -0.21302,2.78145 0.78926,3.75691l31.58485,31.59156h-101.58078c-1.24059,-0.01754 -2.39452,0.63425 -3.01993,1.7058c-0.62541,1.07155 -0.62541,2.39684 0,3.46839c0.62541,1.07155 1.77935,1.72335 3.01993,1.7058h101.58078l-31.59156,31.59156c-0.89864,0.86282 -1.26063,2.14403 -0.94636,3.34954c0.31427,1.2055 1.25569,2.14693 2.4612,2.4612c1.20551,0.31427 2.48672,-0.04772 3.34954,-0.94636l39.89594,-39.89594l-39.88922,-39.89594c-0.64928,-0.66743 -1.54136,-1.04317 -2.4725,-1.04141z"></path></g></g></svg>
                                    </a>
                                @endauth
                        @endif

                    </li>
                </ul>
            </header>

            <p class="coords">27.701951468068174, 85.32219705501784</p>

            <div class="ellipses-container">

                <h2 class="greeting">Hello</h2>

                <div class="ellipses ellipses__outer--thin">

                    <div class="ellipses ellipses__orbit"></div>

                </div>

                <div class="ellipses ellipses__outer--thick"></div>
            </div>

            <div class="scroller">
                <p class="page-title">home</p>

                <div class="timeline">
                    <span class="timeline__unit"></span>
                    <span class="timeline__unit timeline__unit--active"></span>
                    <span class="timeline__unit"></span>
                </div>
            </div>
        </div>

    </div>

</div>

</body>

</html>
