<?php 
 header("Access-Control-Allow-Origin: *");
$host = 'http://correllsoftware.com'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Company Login</title>

    <link href="<?php echo $host; ?>/css/style.default.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="signin">


<section>

    <div class="panel panel-signin">
        <div class="panel-body">
            <div class="logo text-center">
                <img src="images/logo-primary.png" alt="Chain Logo" >
            </div>
            <br />
            <h4 class="text-center mb5">Company Login</h4>
            <p class="text-center">Sign in to your company account</p>

            <div class="mb30"></div>
            <?php
            if(isset($_GET['msg'])){
                echo '<div class="alert alert-danger">';
                echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                echo '<strong>Login Failed!</strong> invalid username or password.';
                echo '</div>';
            }
            ?>
<form action="company-login-function" method="post">
    <div class="input-group mb15">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input type="text" class="form-control" placeholder="Username" name="data[user_name]">
    </div><!-- input-group -->
    <div class="input-group mb15">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <input type="password" class="form-control" placeholder="Password" name="data[password]">
    </div><!-- input-group -->

    <div class="clearfix">
        <div class="pull-left">
            <div class="ckbox ckbox-primary mt10">
                <input type="checkbox" id="rememberMe" value="1">
                <label for="rememberMe">Remember Me</label>
            </div>
        </div>
    </div>


    </div><!-- panel-body -->
    <div class="panel-footer">
        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
    </div><!-- panel-footer -->
    </div><!-- panel -->
</form>

</section>


<script src="<?php echo $host; ?>/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo $host; ?>/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo $host; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo $host; ?>/js/modernizr.min.js"></script>
<script src="<?php echo $host; ?>/js/pace.min.js"></script>
<script src="<?php echo $host; ?>/js/retina.min.js"></script>
<script src="<?php echo $host; ?>/js/jquery.cookies.js"></script>

<script src="<?php echo $host; ?>/js/custom.js"></script>

</body>
</html>
