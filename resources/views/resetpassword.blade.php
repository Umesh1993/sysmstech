<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SYSMATECH</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{{asset('css/metisMenu.min.css')}}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{asset('css/startmin.css')}}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body>
       
        <div class="container">
            <div class="row">
             
              <div class="col-md-4 col-md-offset-4">
                        @if($errors->any())
                        <div class="alert alert-danger" style="margin-top:25px">
                        {{$errors->first()}}
                        </div>
                        @endif
                    <div class="login-panel panel panel-default">
                       
                        <div class="panel-heading">
                            <h3 class="panel-title">Reset Password</h3>
                        </div>
                        <div class="panel-body">
                        <form action="{{ url('reset-password') }}" method="POST">
                          @csrf
                          <input type="hidden" name="token" value="{{ $token }}">
  
                          <div class="col-lg-12">
                              <label class="col-lg-4">E-Mail Address</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="email" required autofocus>
                              </div>
                          </div>
  
                          <div class="col-lg-12">
                              <label class="col-lg-4">Password</label>
                              <div class="col-lg-8">
                                  <input type="password" id="password" class="form-control" name="password" required autofocus>
                              </div>
                          </div>
                          <div class="col-lg-12">
                              <label class="col-lg-4">Confirm Password</label>
                              <div class="col-lg-8">
                                  <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                              </div>
                          </div>

                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Reset Password
                              </button>
                          </div>
                      </form>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="{{asset('js/jquery.min.js')}}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{asset('js/bootstrap.min.js')}}"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{asset('js/metisMenu.min.js')}}"></script>

        <!-- Custom Theme JavaScript -->
        <script src="{{asset('js/startmin.js')}}"></script>

    </body>
</html>
