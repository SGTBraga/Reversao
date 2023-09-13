<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SISTEMA DE REVERSÃO</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <!--                <a href="#"><b>LESP</b></a>-->
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body" align="center">
                @include('layout.includes.mensagens')
                <img src="{{ asset('images/dom_DIRAD.png') }}" align="center" width="60px">
                <br>
                <br>
                <p><strong>SISTEMA DE REVERSÃO</strong></p>
                <br>
                <br>
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <div class="form-group row">


                        <div>
                            <input class="form-control" name="CPF" id="CPF" required autofocus placeholder="CPF" data-inputmask="'mask': '999.999.999-99'">
                        </div>
                    </div>

                    <div class="form-group row">


                        <div>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Senha">

                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox"> Lembrar-me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- /.social-auth-links -->

                <a href="{{ route('login.showFormResetSenha')}}">Esqueci minha senha</a><br>
                <br>
                <br>
                <a href="{{ asset('docs/termo_compromisso_reversao.pdf') }}" title="Enviar pelo SAU para a DIRAD escolhendo o objeto REVERSÃO" target="_blank">Termo de Compromisso</a>
                <br>
                <br>
                Caso esteja uilizando o navegador Internet Explorer 9 ou anterior, atualize o navegador para pelo menos o IE 10 ou tente uma versão atual do Firefox ou Chrome.
                <br>
                <br>
                <img src="{{ asset('images/domPpsis.png') }}" align="center" width="30px"><br>
                Assessoria de Sistemas - SDPP
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery 3 -->
        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <!-- iCheck -->
        <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>

        <!-- jQuery-Mask-Plugin -->
        <script src="{{ asset('plugins/jQuery-Mask-Plugin/jquery.mask.js') }}"></script>
        <script>
$(document).ready(function () {
    $('#CPF').mask('000.000.000-00', {reverse: true});
});

$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
    });
});
        </script>
    </body>
</html>
