<?php
session_start();
include '../db/conn.php';

// Redirect to dashboard if user is already logged in using session
if (isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

// Check if cookie exists and try to log in with cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $stmt = mysqli_prepare($conn, "SELECT username FROM user WHERE id_user = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row && $key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
        header("Location: ../index.php");
        exit;
    }
}

// Attempt to log in with submitted form
if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
	

    $stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['username'] = $username;
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['login'] = true;

            if (isset($_POST['remember'])) {
                $secure_key = hash('sha256', $row['username']);
                setcookie('id', $row['id_user'], time() + 60, "/", null, true, true);
                setcookie('key', $secure_key, time() + 60, "/", null, true, true);
            }

            header("Location: ../index.php");
            exit;
        } else {
            echo "<script>alert('Password Salah!');</script>";
        }
    } else {
        echo "<script>alert('Username Tidak Ditemukan!');</script>";
    }
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Login Kang</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="https://png.pngtree.com/png-vector/20190508/ourmid/pngtree-gallery-vector-icon-png-image_1028015.jpg" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Login</h4>
							<form method="POST" class="my-login-validation" novalidate="">
								<!-- username -->
							<div class="form-group">
									<label for="username">Username</label>
									<input id="username-" type="text" class="form-control" name="username" required>
									<div class="invalid-feedback">
										Isi dulu usernamenya
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
								    <div class="invalid-feedback">
								    	Gile lu LOGIN tapi passwordnya kagak bener (-_-)
							    	</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" name="login" class="btn btn-primary btn-block">
										Login
									</button>
								</div>
								<div class="mt-4 text-center">
									Gak punya akun yaaa??? <a href="register.php">AYO BIKIN BARU!!!</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
					Copyright &copy; Adam &mdash; 2024
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
</body>
</html>
