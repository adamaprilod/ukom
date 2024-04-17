<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MaTrix Gallery</title>
    <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/theme.css">
	<!-- Fontawesome CDN -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <a class="navbar-brand font-weight-bolder mr-3" href="index.php"><img width="50px" height="50px"  src="https://png.pngtree.com/png-vector/20190508/ourmid/pngtree-gallery-vector-icon-png-image_1028015.jpg"></a>
    <button class="navbar-light navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsDefault" aria-controls="navbarsDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsDefault">
    	<ul class="navbar-nav ml-auto align-items-center">
    		<li class="nav-item">
    		<a class="nav-link active" href="index.php">Home</a>
    		</li>
    		<li class="nav-item">
    		<a class="nav-link active" href="post.html">Postingan</a>
    		</li>
			<li class="nav-item for-logged-in">
				<a class="nav-link active" href="buat.php">Buat</a>
			</li>
			<li class="nav-item for-not-logged-in">
			<a class="nav-link text-success  for-not-logged-in" href="login_regis/login.php">Log in</a>
			</li>
			<li class="nav-item for-not-logged-in">
			<a class="nav-link text-danger for-not-logged-in" href="login_regis/register.php">Sign Up</a>
			</li>
    		<li class="nav-item for-logged-in">
    		<a class="nav-link" href="profile.php"><img class="rounded-circle mr-2" src="assets/img/av.png" width="30"><span class="align-middle"><?php echo strtoupper($_SESSION['username']); ?></span></a>
    		</li>
			<li class="nav-item for-logged-in">
    		<a class="nav-link text-danger for-logged-in" href="http://localhost/galer/docs/logout.php">Log out</a>
    		</li>
    	</ul>
    </div>
    </nav> 