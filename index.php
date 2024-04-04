<!DOCTYPE html>
<html>
  <head>
    <title>DTR Generator</title>
    <style>
      body{
        background-image: url('dist/img/cityhigh/bg1.jpg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
      }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="util/signin.js"></script> 
  </head>
  <body>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
      <div class="card" style="width: 35rem;">
        <div class="card-header">
          <img src="./dist/img/cityhigh/school-logo.png" style="width: 15%;" class="mx-auto d-block">
        </div>
        <div class="card-body">
          <form id='signin'>
            <div class="alert alert-danger d-none" id='alert' role="alert">
              Access Denied
            </div>
            <div class="form-floating mb-4">
              <input type="text" class="form-control" id="username" name="username" placeholder="username">
              <label for="username">Username</label>
            </div>
            <div class="form-floating mb-5">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
              <label for="password">Password</label>
            </div>
            <button type="submit" class="btn btn-success btn-lg btn-md w-100 mb-4">Log in</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
