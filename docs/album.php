<?php
// Start the session
session_start();
?>
<?php include('db/conn.php')?>
<?php include ('navbar.php') ?>

<main role="main">
    <section class="mt-4 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Buat Album Foto</h5>
                            <form method="POST" action="process_album.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nama_album">Nama Album</label>
                                    <input type="text" class="form-control" id="nama_album" name="nama_album" required>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_buat">Tanggal Buat</label>
                                    <input type="date" class="form-control" id="tanggal_buat" name="tanggal_buat" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Buat Album</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include('footer.php') ?>
