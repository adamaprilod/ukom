<?php
// Start the session
session_start();
// Check if user is not logged in
if (!isset($_SESSION['login']) || $_SESSION['login'] != 'login') {
    echo "<script>
    alert('Anda belum Login');
    location.href='index.php'; // Redirect to login page
    </script>";
    exit(); // Stop further execution
}
?>
<?php include ('navbar.php') ?>
<main role="main">
    <section class="mt-4 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Mau Buat Apa?</h5>
                            <a class="btn btn-info mr-2" href="album.php" role="button">Buat Album</a> <!-- Add right margin to separate buttons -->
                            <a class="btn btn-danger" href="login_regis/edit_profile.php" role="button">Upload Foto</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include('footer.php') ?>
