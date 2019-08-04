<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta author="Jonathan Cuotto">

    <title>Transport-AR - Inicio de sesion</title>
	
<!--     CSS
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="{{ url('assets') }}/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('assets') }}/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ url('assets') }}/css/form-elements.css">
   	<link rel="stylesheet" href="{{ url('templates') }}/css/login.css">


	<link href="{{ url('templates') }}/css/login.css" rel="stylesheet">


	Favicon and touch icons
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ url('assets') }}/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ url('assets') }}/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ url('assets') }}/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="{{ url('assets') }}/ico/apple-touch-icon-57-precomposed.png">

 -->
    <style type="text/css">
    /*
        @import url('https://rsms.me/inter/inter-ui.css');
::selection {
  background: #2D2F36;
}
::-webkit-selection {
  background: #2D2F36;
}
::-moz-selection {
  background: #2D2F36;
}
body {
  background: white;
  font-family: 'Inter UI', sans-serif;
  margin: 0;
  padding: 20px;
}
.page {
  background: #e2e2e5;
  background: #646671;
  display: flex;
  flex-direction: column;
  height: calc(100% - 40px);
  position: absolute;
  place-content: center;
  width: calc(100% - 40px);
}
@media (max-width: 767px) {
  .page {
    height: auto;
    margin-bottom: 20px;
    padding-bottom: 20px;
  }
}
.container {
  display: flex;
  height: 320px;
  margin: 0 auto;
  width: 640px;
}
@media (max-width: 767px) {
  .container {
    flex-direction: column;
    height: 630px;
    width: 320px;
  }
}
.left {
  background: white;
  height: calc(100% - 40px);
  top: 20px;
  position: relative;
  width: 50%;
}
@media (max-width: 767px) {
  .left {
    height: 100%;
    left: 20px;
    width: calc(100% - 40px);
    max-height: 270px;
  }
}
.login {
  font-size: 40px;
  font-weight: 900;
  margin: 0px 40px 30px;
  text-align: center;
}
@media (max-width: 767px) {
  .login {
    margin: 0px 40px 0px;
  }
}
    
.eula {
  color: #999;
  font-size: 14px;
  line-height: 1.5;
  /*margin: 40px;
}
.right {
  background: #474A59;
  box-shadow: 0px 0px 40px 16px rgba(0,0,0,0.22);
  color: #F1F1F2;
  position: relative;
  width: 50%;
}
@media (max-width: 767px) {
  .right {
    flex-shrink: 0;
    height: 100%;
    width: 100%;
    max-height: 350px;
  }
}
svg {
  position: absolute;
  width: 320px;
}
path {
  fill: none;
  stroke: url(#linearGradient);;
  stroke-width: 4;
  stroke-dasharray: 240 1386;
}
.form {
  margin: 40px;
  position: absolute;
  text-align: center;
}
label {
  color:  #c2c2c5;
  display: block;
  font-size: 14px;
  height: 16px;
  margin-top: 20px;
  margin-bottom: 5px;
  text-align: left;
}
input {
  background: transparent;
  border: 0;
  color: #f2f2f2;
  font-size: 20px;
  height: 30px;
  line-height: 30px;
  outline: none !important;
  width: 100%;
}
input::-moz-focus-inner { 
  border: 0; 
}
#password-input{
    border-bottom: 4px solid #e2e2e5;
}
#submit {
    color: #fff;
    margin-top: 40px;
    transition: color 300ms;
    width: auto!important;

    background: #fff;
    border-radius: 25px;
    color: #474A59;
    font-size: 18px;
    padding: 0px 20px;
}
#submit:focus {
  color: #f2f2f2;
}
#submit:active {
  color: #d0d0d2;
}
*/


@import url(https://fonts.googleapis.com/css?family=Exo:100,200,400);
@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:700,400,300);

body{
    margin: 0;
    padding: 0;
    background: #fff;

    color: #fff;
    font-family: Arial;
    font-size: 12px;
}

.body{
    position: absolute;
    top: -0px;
    left: -0px;
    right: -0px;
    bottom: -0px;
    width: auto;
    height: auto;
    /*background-image: url(http://ginva.com/wp-content/uploads/2012/07/city-skyline-wallpapers-008.jpg);*/
    background-image: url({{url('images/carview2.png')}});
    background-size: cover;
    -webkit-filter: blur(5px);
    z-index: 0;
}

.grad{
    position: absolute;
    top: -0px;
    left: -0px;
    right: -0px;
    bottom: -0px;
    width: auto;
    height: auto;
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
    z-index: 1;
    opacity: 0.7;
}

.header{
    position: absolute;
    top: calc(50% - 35px);
    left: calc(50% - 255px);
    z-index: 2;
}

.header div{
    float: left;
    color: #fff;
    font-family: 'Exo', sans-serif;
    font-size: 35px;
    font-weight: 200;
}

.header div span{
    color: #5379fa !important;
}

.login{
    position: absolute;
    top: calc(50% - 75px);
    left: calc(50% - 50px);
    height: 150px;
    width: 350px;
    padding: 10px;
    z-index: 2;
}

.login input[type=text]{
    width: 250px;
    height: 30px;
    background: transparent;
    border: 1px solid rgba(255,255,255,0.6);
    border-radius: 2px;
    color: #fff;
    font-family: 'Exo', sans-serif;
    font-size: 16px;
    font-weight: 400;
    padding: 4px;
}

.login input[type=password]{
    width: 250px;
    height: 30px;
    background: transparent;
    border: 1px solid rgba(255,255,255,0.6);
    border-radius: 2px;
    color: #fff;
    font-family: 'Exo', sans-serif;
    font-size: 16px;
    font-weight: 400;
    padding: 4px;
    margin-top: 10px;
}

.login input[type=submit]{
    width: 260px;
    height: 35px;
    background: #fff;
    border: 1px solid #fff;
    cursor: pointer;
    border-radius: 2px;
    color: #a18d6c;
    font-family: 'Exo', sans-serif;
    font-size: 16px;
    font-weight: 400;
    padding: 6px;
    margin-top: 10px;
}

.login input[type=submit]:hover{
    opacity: 0.8;
}

.login input[type=submit]:active{
    opacity: 0.6;
}

.login input[type=text]:focus{
    outline: none;
    border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=password]:focus{
    outline: none;
    border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=button]:focus{
    outline: none;
}

::-webkit-input-placeholder{
   color: rgba(255,255,255,0.6);
}

::-moz-input-placeholder{
   color: rgba(255,255,255,0.6);
}
    </style>

</head>
<body>

    <div class="body"></div>
        <div class="grad"></div>
        <div class="header">
            <div>Transport-<span>AR</span></div>
        </div>
        <br>
        <div class="login">
            <form action="{{url('login')}}" method="post">
                {{ csrf_field() }}
                <input type="text" placeholder="Usuario" name="email"><br>
                <input type="password" placeholder="Contrasena" name="password"><br>
                <input type="submit" value="Iniciar Sesión">
            </form>
        </div>




    <!-- <div class="page">
        <div class="container">
            <div class="left">
                <div style="text-align: left;">
                    <img src="{{url('images')}}/uneg_logo.png" style="width: 64px;">
                </div>
                <div class="login">Transport-AR</div>
                <div class="eula" style="text-align: center;">
                    Ingresa tus datos para entrar al panel administrativo.
                </div>
                
            </div>
            <div class="right">
                <svg viewBox="0 0 320 300">
                    <defs>

                        <linearGradient
                              inkscape:collect="always"
                              id="linearGradient"
                              x1="13"
                              y1="193.49992"
                              x2="307"
                              y2="193.49992"
                              gradientUnits="userSpaceOnUse">
                            <stop
                                style="stop-color:#e2e2e5;"
                                offset="0"
                                id="stop876" />
                            <stop
                                style="stop-color:#e2e2e5;"
                                offset="1"
                                id="stop878" />
                        </linearGradient>

                    </defs>
                    <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
                </svg>
                <div class="form">
                    <form action="{{url('login')}}" method="post">
                        {{ csrf_field() }}
                        <label for="email">Email</label>
                        <input type="email" id="email">
                        <label for="password">Contraseña</label>
                        <input id="password-input" type="password" id="contrasena">
                        <input type="submit" id="submit" value="Iniciar Sesión">
                    </form>
                </div>
            </div>
        </div>
    </div> -->

<!--  -->


<!-- 
	 Top content
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
 
                @if (session('status'))
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Bootstrap</strong> Login Form</h1>
                            <div class="description alert alert-dark">
                                <p>
                                    {{ session('status') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login</h3>
                            		<p>Enter your username and password to log on:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="{{url('/login')}}" method="post" class="login-form">
			                    	{{ csrf_field() }}
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Email</label>
			                        	<input type="text" name="email" placeholder="Email..." class="form-username form-control" id="form-username">

			                        	<span class="text-danger" style="font-size: 13px;">{{ $errors->first('email') }}</span>
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">

			                        	<span class="text-danger" style="font-size: 13px;">{{ $errors->first('password') }}</span>
			                        </div>
			                        <button type="submit" class="btn">Sign in!</button>
			                    </form>
		                    </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>


        Javascript
        <script src="{{ url('assets') }}/js/jquery-1.11.1.min.js"></script>
        <script src="{{ url('assets') }}/bootstrap/js/bootstrap.min.js"></script>
        <script src="{{ url('assets') }}/js/jquery.backstretch.min.js"></script>
        <script src="{{ url('assets') }}/js/scripts.js"></script>
        --> 
</body>
</html>