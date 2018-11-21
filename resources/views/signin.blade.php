@if (Auth::check())
<script>window.location = "/home";</script>
@else 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link href="{{ secure_asset('css/style.css') }}" rel="stylesheet">
    <title>Login/Register Form</title>
</head>
<body>
<div class="container">
       <div class="row">
          <div class="loginPanel">
             <div class="">
                <center>
                   <h1 class="logo" style="color:orange">Login</h1>
                </center>
             </div>
             <div class="panel panel-info">
                <div class="panel-heading">
                   <center>
                   <h3 class="wellcome">Welcome to Book App!</h3>
                   </center>
                </div>
                <br>
                <div class="panel-body">
                   <div class="row">
                      <div class="col-md-5" >
                         <a href="{{ secure_url('google/redirect') }}" class="google btn"><i class="fab fa-google"></i>
                           Sign In with Google+
                         </a><br/><br>
                         <a href="{{ secure_url('facebook/redirect') }}" class="fb btn">
                         <i class="fab fa-facebook-f"></i>  Sign In with Facebook
                         </a><br/><br>

                      </div>
                      <div class="col-md-7" style="border-left:1px solid #ccc;height:220px">
                      <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                            <fieldset>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                  <input id="email" type="email" class="form-control" placeholder="Enter Email" name="email" value="{{ old('email') }}" required autofocus>
                                  @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                 </div>
                                 <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                 <input id="password" type="password" class="form-control" placeholder="Enter Password" name="password" required>

                                          @if ($errors->has('password'))
                                             <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                             </span>
                                          @endif
                               </div>
                               <div class="spacing"><a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a><br/></div>
                               <button type="submit" class="btn btn-info">
                                    Sign In
                                </button>
                                <a class ="btn btn-primary" href="{{ secure_url('/register') }}">Register</a>
                            </fieldset>
                         </form>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
@endif