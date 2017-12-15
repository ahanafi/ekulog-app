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
                background: #1E4E7E !important;
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
                background: #2c3e50;
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
                <img src="/images/icons.png" alt="" class="icons">
                <div class="title m-b-md">
                    Ekulog Application
                </div>

                <div class="links">
                    @if (Auth::guest())
                        <a href="/login">Login</a>
                        <a href="/register">Register</a>
                    @else
                        <a href="/home">Dashboard</a>
                        <a href="/register">Data</a>
                        <a href="/report">Laporan</a>
                        <a href="/deposit">Deposit</a>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
