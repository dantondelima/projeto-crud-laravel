<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Crud</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 15vh;
            }

            .flex-center {
                align-items: center;
                height:100px;
                margin-top: 5px;
                margin-bottom: 25px;
                display: flex;
                border-bottom:1px solid black;
                justify-content: center;
                width:100%;
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
                font-size: 64px;
                position:relative;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 25px;
                font-weight: 999;
                letter-spacing: .1rem;
                text-transform: uppercase;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                margin-right:-15px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
    <script  data-src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script> 
</head>
<body>
<div class="flex-center position-ref full-height">
            <div class="content">
                <div class="links">
                    <a href="{{ route('usuarios.lista')}}">Listar usuários</a>
                    <a href="{{ route('usuarios.novo')}}">Cadastrar usuários</a>
                    <a href="{{ route('categorias.lista')}}">Listar categorias</a>
                    <a href="{{ route('categorias.nova')}}">Cadastrar categorias</a>
                </div>
            </div>
        </div>
        
@yield('conteudo')
</body>
</html>

