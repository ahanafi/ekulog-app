<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ekulog Application</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="/images/icons.png">

        <!-- Styles -->
        <style>
            html, body {
                background: #d62c1a !important;
                color: #fff;
                font-family: 'Raleway';
                font-weight: 100;
                height: 90vh;
                margin: 0;
            }

            .full-height {
                height: 90vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #fff;
                padding: 10px 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .links > a:hover{
                background: #A12114;
                transition: 0.5s;
                border-radius: 2.5%;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <img src="/images/404.png" alt="" class="icons" width="35%">
                <div class="title m-b-md">
                    NOT FOUND!
                </div>

                <div class="links">
                    @if (Auth::guest())
                        <a href="/login">LOGIN</a>
                        <a href="/register">REGISTER</a>
                    @else
                        <a href="/home">DASHBOARD</a>
                        <a href="/logout">LOGOUT</a>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
