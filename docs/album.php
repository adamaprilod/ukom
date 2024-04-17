<?php
session_start();
include ('db/conn.php'); // Make sure to include your database connection file

// Check if user is not logged in
if (!isset($_SESSION['login']) || $_SESSION['login'] != 'login') {
    echo "<script>
        alert('Anda belum Login');
        location.href='index.php'; // Redirect to login page
        </script>";
    exit(); // Stop further execution
}

if (isset($_POST['post'])) {
    $nama_album = mysqli_real_escape_string($conn, $_POST['nama_album']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $tgl_buat = $_POST['tanggal_buat'];
    $id_user = $_POST['id_user'];

    // Check if nama_album already exists
    $check_query = "SELECT * FROM album WHERE nama_album = '$nama_album'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        echo "
             <script>
                 alert('Album udah ada bro. ');
                 window.location.href = 'album.php';
             </script>";
        exit(); // Stop further execution
    }

    // Insert data into album table
    $insert_query = "INSERT INTO album (nama_album, deskripsi, tgl_buat, id_user) VALUES ('$nama_album', '$deskripsi', '$tgl_buat', '$id_user')";

    if (mysqli_query($conn, $insert_query)) {
        echo "
            <script>
                alert('Album berhasil dibuat!');
                window.location.href = 'album.php';
            </script>";
    } else {
        echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
    }
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
                            <h2 class="card-title">Buat Album Foto</h2>
                            <!-- form album -->
                            <form method="POST" enctype="multipart/form-data">
                                <!-- nama album -->
                                <div class="form-group">
                                    <label for="nama_album">Nama Album</label>
                                    <input type="text" class="form-control" id="nama_album" name="nama_album" required>
                                </div>
                                <!-- deskripsi -->
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"
                                        required></textarea>
                                </div>
                                <!-- tgl -->
                                <div class="form-group">
                                    <label for="tanggal_buat">Tanggal Buat</label>
                                    <input type="date" class="form-control" id="tanggal_buat" name="tanggal_buat"
                                        required>
                                </div>
                                <!-- pilih akun -->
                                <div class="form-group">
                                    <select class="form-control" name="id_user" id="id_user">
                                        <option>Pilih Akun</option>
                                        <?php
                                        $sql = mysqli_query($conn, "SELECT * FROM user WHERE id_user='$_SESSION[id_user];'");
                                        while ($data = mysqli_fetch_assoc($sql)) {
                                            ?>
                                            <option value="<?= $data['id_user'] ?>">(<?= $data['username'] ?>)</option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" name="post" class="btn btn-primary">Buat Album</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include ('footer.php') ?>