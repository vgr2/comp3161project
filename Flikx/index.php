<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>Bootply.com - Landing Page</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
        
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" type="text/css" rel="stylesheet" />


<!-- CSS code from Bootply.com editor -->
        
<style type="text/css">

html,body {
  height:100%;
}

h1 {
  font-family: Arial,sans-serif
  font-size:80px;
  color:#DDCCEE;
}

.lead {
	color:#DDCCEE;
}


/* Custom container */
.container-full {
  margin: 0 auto;
  width: 100%;
  min-height:100%;
  background-color:#110022;
  color:#eee;
  overflow:hidden;
}

.container-full a {
  color:#efefef;
  text-decoration:none;
}

.v-center {
  margin-top:7%;
}
  
        </style>
    </head>
    
    <!-- HTML code from Bootply.com editor -->
    
    <body  >
        
        <div class="container-full">

      <div class="row">
       
        <div class="col-lg-12 text-center v-center">
          
          <h1>Hello Guest</h1>
          <p class="lead">Welcome to Flikx!</p>
          <div style="color: red;">
            <?php 
            // print_r($_GET);
            if (isset($_GET['error'])){
              echo $_GET['error'];
            } ?>
          </div>
          <br><br><br>
          
          <form class="col-lg-12">
            <div class="input-group" style="width:340px;text-align:center;margin:0 auto;">
              <span><button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#loginModal" style="margin-right: 30px">Sign In</button></span>
            <!-- <input class="form-control input-lg" title="Don't worry. We hate spam, and will not share your email with anyone." placeholder="Enter your email address" type="text"> -->
              <span><button class="btn btn-lg btn-primary" type="button" data-toggle="modal" data-target="#signupModal">Sign Up</button></span>
            </div>
          </form>
        </div>
        
      </div> <!-- /row -->
  
  	<br><br><br><br><br>

  <!--login modal-->
<div id="loginModal" class="modal fade" tabindex="-1" role="dialog"  aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center" style="color: black;">Login</h1>
      </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block" method= "post" action="login.php">
            <div class="form-group">
              <input type="text" name="username" class="form-control input-lg" placeholder="Username">
            </div>
            <div class="form-group">
              <input type="password" name="password" class="form-control input-lg" placeholder="Password">
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block">Sign In</button>
              <span class="pull-right"><a href="#"><span data-toggle="modal" data-target="#signupModal" style="color: grey;">Register</a></span>
            </div>
          </form>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
      </div>  
      </div>
  </div>
  </div>
</div>


  <!-- SIGNUP MODEL -->
<div id="signupModal" class="modal fade" tabindex="-1" role="dialog"  aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center" style="color: black">Sign Up</h1>
      </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block" method="post" action="signup.php">
            <div class="form-group">
              <input name="username" type="text" class="form-control input-lg" placeholder="Username">
            </div>
            <div class="form-group">
              <input name="password" type="text" class="form-control input-lg" placeholder="Password">
            </div>
            <div class="form-group">
              <input name="firstname" type="text" class="form-control input-lg" style="width: 49%; float: left; margin-bottom: 15px;" placeholder="First Name">
              <input name="lastname" type="text" class="form-control input-lg" style="width: 49%; float: right; margin-bottom: 15px;" placeholder="Last Name">
            </div>
            <div class="form-group" style="padding-top: 20px;">
              <input name="email" type="text" class="form-control input-lg" placeholder="Email">
            </div>
            <div class="form-group">
              <input name="dob" type="date" class="form-control input-lg" placeholder="Date-of-Birth (1990/01/01)">
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block">Register</button>
            </div>
          </form>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
      </div>  
      </div>
  </div>
  </div>
</div>


</div> <!-- /container full -->

        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


        <script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>





        
        <!-- JavaScript jQuery code from Bootply.com editor -->
        
        
    </body>
</html>