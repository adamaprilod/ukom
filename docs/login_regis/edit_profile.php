<?php
include '../db/conn.php';
session_start();
// Check if user is not logged in
if ($_SESSION['login']) {
    $id_user = $_SESSION['id_user'];
} else {
    // Handle the case when an admin is editing another user's profile
    if (isset($_GET['id_user'])) {
        $id_user = $_GET['id_user'];
    } else {
        // Redirect or handle error when id_user is not provided in the URL
    }
}


if (isset($_POST['regis'])) {
    $username = strtolower(stripslashes($_POST['username']));
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $no_hp = htmlspecialchars($_POST['no_hp']);

    // Check if the password matches the confirmation password
    if ($password !== $password2) {
        echo "
        <script>
            alert('Konfirmasi Password Salah');
            document.location.href='registrasi.php';
        </script>
        ";
        return false;
    }
    // Encrypt the password
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE user SET
            username='$username',
            `password` ='$password',
            nama='$nama',
            email='$email',
            no_hp='$no_hp'
            WHERE id_user='" . $_SESSION['id_user'] . "'
            ";
    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('Data user Berhasil DiUpdate');
                document.location.href='../profile.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Data user Gagal Update');
                document.location.href='edit_profile.php';
            </script>
            ";
    }
}

$data = mysqli_query($conn, "SELECT *
FROM user WHERE id_user='$id_user'");
$edit = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Edit Akun</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
</head>
<body class="my-login-page">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    </nav>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="https://png.pngtree.com/png-vector/20190508/ourmid/pngtree-gallery-vector-icon-png-image_1028015.jpg" alt="bootstrap 4 login page">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Edit Akun</h4>
							<form method="POST" class="my-login-validation" novalidate="">
							<!-- username -->
							<div class="form-group">
									<label for="username">Username</label>
									<input id="username-" type="text" class="form-control" value="<?= $edit['username']; ?>" name="username" required>
									<div class="invalid-feedback">
										Isi Usernamemu
									</div>
								</div>
								<!-- password -->
								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
									<div class="invalid-feedback">
										Password!!!!!
									</div>
								</div>
								<!-- password -->
								<div class="form-group">
									<label for="password">Ulang Password</label>
									<input id="ulangpassword" type="password" class="form-control" name="password2" required data-eye>
									<div class="invalid-feedback">
										Ulang Password!!!!!
									</div>
								</div>
								<!-- email -->
								<div class="form-group">
									<label for="email">Email</label>
									<input id="email" type="email" class="form-control" value="<?= $edit['email']; ?>" name="email" required>
									<div class="invalid-feedback">
										Isi Emailnya yang bener coy!
									</div>
								</div>
								<!-- nama -->
								<div class="form-group">
									<label for="name">Nama</label>
									<input id="name" type="text" class="form-control" value="<?= $edit['nama']; ?>" name="nama" required autofocus>
									<div class="invalid-feedback">
										Siapa Namamu Tuan/Nyonya?
									</div>
								</div>
								<!-- no.hp -->
								<div class="form-group">
									<label for="no_hp">No HP</label>
									<input id="no_hp" type="text" class="form-control" value="<?= $edit['no_hp']; ?>" name="no_hp" required>
									<div class="invalid-feedback">
										Bagi nomormu dong sayang~~~
									</div>
								</div>
								<div class="form-group m-0">
									<button type="submit" name="regis" class="btn btn-primary btn-block">
										Update
									</button>
								</div>
								<div class="mt-4 text-center">
									<a href="../index.php">Kembali ke Home</a>
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
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
</body>
</html>