


 

<!DOCTYPE html>
<html>      
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" type="text/css" href="asset/admin.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
      <div class="container">
      	<div class="d-flex justify-content-center h-100">
      		<div class="card">
      			<div class="card-header">
      				<h3>Sign in</h3>
      				<div class="d-flex justify-content-end social-icon">
      					<span><i class="fab fa-facebook-square" style="width: 24px"></i></span>
      					<span><i class="fab fa-google-plus-square" style="height: 24px"></i></span>
      				</div>
      			</div>
      			<div class="card-body">
      				<form method="POST" action="logincheck.php">
                                    <div class="input-group from-group">
                                          <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user" class="25px"></i></span>
                                          </div>
                                          <input type="text" class="form-control" name="name" placeholder="username">
                                    </div><br>
                                    <div class="input-group from-group">
                                          <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                          </div>
                                          <input type="password" class="form-control" name="pass" placeholder="password">
                                    </div>
                                    <div class="row align-items-center remember">
                                          <input type="checkbox" >Remember password?
                                    </div>
                                    <div class="from-group">
                                          <button type="loginSubmit" name="loginSubmit" value="Login " class="btn float-right login_btn">Login</button>
                                    </div>
      				</form>
      			</div>
      			<div class="card-footer">
      				<div class="d-flex justify-content-center links">
      					Don't have an account?<a href="#">Sign up</a>
      				</div>
      				<div class="d-flex justify-content-center">
      					<a href="#">Forgot your password?</a>
      				</div>
      			</div>
      		</div>
      	</div>
      </div>
</body>
</html>
