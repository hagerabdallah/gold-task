<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
    <link href="{{asset('admin/vendors/bootstrap/dist/css')}}/bootstrap.min.css" rel="stylesheet">


</head>
<body style="background-color:rgb(248, 248, 248) !important">
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-group" style="margin-top: 45px">
                 <h4>Admin Login</h4><hr>
                 <form action="{{ route('admin.hadlelogin') }}" method="post">  
                    @csrf
                    @include('dashboard.admin.inc.errors')  
                     <div class="form-group">
                         <label for="email">Email</label>
                         <input type="text" class="form-control" name="email" placeholder="Enter email address" value="{{ old('email') }}">
                     </div>
                     <div class="form-group">
                         <label for="password">Password</label>
                         <input type="password" class="form-control" name="password" placeholder="Enter password" value="{{ old('password') }}">
                     </div>
                     <div class="form-group">
                       <button type="submit" class="btn btn-primary">Login</button>
                     </div>
                 </form>
            </div>
        </div>
    </div>
</body>
</html>