<footer class="footer pt-5 pb-5 text-center">
        
        <div class="container">
            
              <div class="socials-media">
        
                <ul class="list-unstyled">
                  <li class="d-inline-block ml-1 mr-1"><a href="https://www.facebook.com/adamaprilodz" class="text-dark"><i class="fa-brands fa-facebook"></i></a></li>
                  <li class="d-inline-block ml-1 mr-1"><a href="https://twitter.com/aprilodadams69" class="text-dark"><i class="fa-brands fa-twitter"></i></a></li>
                  <li class="d-inline-block ml-1 mr-1"><a href="https://www.instagram.com/adam_aprilod/" class="text-dark"><i class="fa-brands fa-square-instagram"></i></a></li>
                </ul>
        
              </div>
              <p>©  <span class="credits font-weight-bold">        
                Adam Aprilod Zulfikar | 2024
              </span>
              </p>
        
        
            </div>
            
        </footer>    
        </main>
        <?php
// Check if the user is logged in
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    // User is logged in, display navigation links for logged-in users
    echo '
    <script>
        document.querySelectorAll(".for-logged-in").forEach(element => {
            element.style.display = "block";
        });
        document.querySelectorAll(".for-not-logged-in").forEach(element => {
            element.style.display = "none";
        });
    </script>
    ';
} else {
    // User is not logged in, display navigation links for non-logged-in users
    echo '
    <script>
        document.querySelectorAll(".for-logged-in").forEach(element => {
            element.style.display = "none";
        });
        document.querySelectorAll(".for-not-logged-in").forEach(element => {
            element.style.display = "block";
        });
    </script>
    ';
}
?> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.nav-link').click(function() {
            $('.nav-link').removeClass('active');
            $(this).addClass('active');
        });
    });
    </script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/theme.js"></script>
    
</body>
    
</html>
