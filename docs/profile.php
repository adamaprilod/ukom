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
<?php include('navbar.php')?>
    <main role="main">
        
    
    <div class="jumbotron border-round-0 min-50vh" style="background-image:url(https://images.unsplash.com/photo-1522204657746-fccce0824cfd?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=84b5e9bea51f72c63862a0544f76e0a3&auto=format&fit=crop&w=1500&q=80);">
    </div>
    <div class="container mb-4">
    	<img src="assets/img/av.png" class="mt-neg100 mb-4 rounded-circle" width="128">
    	<h1 class="font-weight-bold title"><?php echo strtoupper($_SESSION['username']); ?></h1>
        <a class="btn btn-primary" href="login_regis/edit_profile.php" role="button">Edit Profile</a>
    </div>
    
        
    </main>

    <script src="assets/js/app.js"></script>
    <script src="assets/js/theme.js"></script>
    
   <?php include('footer.php')?>
</body>
    
</html>
