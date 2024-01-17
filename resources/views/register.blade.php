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
       
    <div class="container" style="margin-top:50px">
        <div class="row">
            <div class="col-lg-6">
                @if($errors->any())
                    <div class="alert alert-danger" style="margin-top:25px">
                    {{$errors->first()}}
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Registeration page
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <form method="POST" action="{{url('register-form')}}">
                                @csrf
                                <div class="col-lg-6 form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label>Mobile No</label>
                                    <input type="text" name="mobile_no" pattern="[0-9]{10}" class="form-control">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <button type="submit" name="submit" class="btn btn-success" value="submit">Submit</button>
                                </div>
                            </form>
                        </div>
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
