<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"
        integrity="sha512-0S+nbAYis87iX26mmj/+fWt1MmaKCv80H+Mbo+Ne7ES4I6rxswpfnC6PxmLiw33Ywj2ghbtTw0FkLbMWqh4F7Q=="
        crossorigin="anonymous" />

    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/css/adminlte.min.css"
        integrity="sha512-rVZC4rf0Piwtw/LsgwXxKXzWq3L0P6atiQKBNuXYRbg2FoRbSTIY0k2DxuJcs7dk4e/ShtMzglHKBOJxW8EQyQ=="
        crossorigin="anonymous" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <!-- /.login-logo -->
        <div class="login-logo">
            <div class="row">
                <img class="logo-aena w-50 ml-2" src={{asset('images/logo-aena-black.png')}} title="AENA GPI" />
            </div>
        </div>

        <!-- /.login-box-body -->
        <div class="card">
            <div class="card-body login-card-body">
                <div class="col-12 description-text">
                    Bienvenido a GPI (Gestor de Proyectos Internacionales)
                </div>
                <div class="col-12">
                    <hr>
                </div>
                <form method="post" action="{{ url('/login') }}" autocomplete="false">
                    @csrf

                    <div class="col-12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="form-input form-control" name="email"
                            value="{{ old('email') }}" placeholder="user" autocomplete="off" required autofocus readonly
                            onfocus="this.removeAttribute('readonly');" />
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="col-12 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="form-control form-input" placeholder="password"
                            name="password" autocomplete="off" required readonly
                            onfocus="this.removeAttribute('readonly');" />

                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button id="submitButton" class="form-button" type="submit">login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <p class="footer">
            La información contenida en esta plataforma puede tener carácter confidencial. El trabajador se compromete a mantener absoluta confidencialidad y a no desvelar ni emplear, directa o indirectamente, la documentación, los procedimientos, proyectos, métodos, aplicaciones, análisis y cualquier otra información propia y/o de terceros a los que haya tenido acceso como consecuencia del desempeño de sus funciones.
        </p>
    </div>

    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/js/adminlte.min.js"
        integrity="sha512-++c7zGcm18AhH83pOIETVReg0dr1Yn8XTRw+0bWSIWAVCAwz1s2PwnSj4z/OOyKlwSXc4RLg3nnjR22q0dhEyA=="
        crossorigin="anonymous">
    </script>

</body>

</html>
