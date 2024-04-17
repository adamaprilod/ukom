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
if (isset($_POST['submit'])) {
    $judul_foto = mysqli_real_escape_string($conn, $_POST['judul_foto']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $tgl_unggah = $_POST['tgl_unggah'];
    $id_album = $_POST['id_album'];
    $id_user = $_POST['id_user'];

    // File upload
    $photoName = $_FILES['photo']['name'];
    $photoTmpName = $_FILES['photo']['tmp_name'];
    $photoSize = $_FILES['photo']['size'];
    $photoError = $_FILES['photo']['error'];

    // Check if photo is uploaded without errors
    if ($photoError === 0) {
        // Generate unique filename to avoid overwriting existing files
        $photoNewName = uniqid('', true) . '_' . $photoName;
        $photoDestination = 'uploads/' . $photoNewName;

        // Move uploaded file to destination folder
        if (move_uploaded_file($photoTmpName, $photoDestination)) {
            // Insert data into database
            $insert_query = "INSERT INTO foto (judul_foto, deskripsi, tgl_unggah, lokasi_file, id_album, id_user) VALUES ('$judul_foto', '$deskripsi', '$tgl_unggah', '$photoDestination', '$id_album', '$id_user')";
            if (mysqli_query($conn, $insert_query)) {
                echo "
                <script>
                    alert('Photo berhasil diunggah!');
                    window.location.href = 'upload_foto.php';
                </script>";
            } else {
                echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error uploading photo.";
        }
    } else {
        echo "Error: " . $photoError;
    }
}
?>


<?php include ('navbar.php') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Upload Photo</h2>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <!-- judul foto -->
                        <div class="form-group">
                            <label for="judul_foto">Judul Foto</label>
                            <input type="text" class="form-control" id="judul_foto" name="judul_foto" required>
                        </div>
                        <!-- deskripsi -->
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                        </div>
                        <!-- tanggal upload -->
                        <div class="form-group">
                            <label for="tgl_unggah">Tanggal Unggah</label>
                            <input type="date" class="form-control" id="tgl_unggah" name="tgl_unggah" required>
                        </div>
                        <!-- pilih foto -->
                        <div class="form-group">
                            <label for="photo">Select Photo</label>
                            <input type="file" class="form-control-file" id="photo" name="photo"
                                accept=".png, .jpeg, .jpg" required>
                        </div>
                        <!-- pilih album -->
                        <div class="form-group">
                            <select class="form-control" name="id_album" id="id_album">
                                <option>Pilih Album</option>
                                <?php
                                $sql = mysqli_query($conn, "SELECT * FROM album");
                                while ($data = mysqli_fetch_assoc($sql)) {
                                    ?>
                                    <option value="<?= $data['id_album'] ?>"><?= $data['nama_album'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
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
                        <!-- Additional fields like id_album and id_user can be added here -->
                        <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include ('footer.php') ?>