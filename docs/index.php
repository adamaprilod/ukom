<?php
// Start the session
session_start();
include("db/conn.php");
?>
<?php include('navbar.php') ?>
<main role="main">
	<section class="mt-4 mb-5">
		<div class="container mb-4">
			<div class="row">

			</div>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="card-columns">
					<?php
					// Query to fetch all photos from the database
					$sql = "SELECT judul_foto, lokasi_file FROM foto"; // Change the query as needed
					$result = mysqli_query($conn, $sql);

					// Check if query executed successfully and data is found
					if ($result && mysqli_num_rows($result) > 0) {
						// Loop through each photo
						while ($photo = mysqli_fetch_assoc($result)) {
					?>
							<div class="card card-pin">
								<img class="card-img" src="<?php echo $photo['lokasi_file']; ?>" alt="<?php echo $photo['judul_foto']; ?>">
								<div class="overlay">
									<h2 class="card-title title"><?php echo $photo['judul_foto']; ?></h2>
									<div class="more">
										<!-- Link to view more details of the photo, change the href as needed -->
										<a href="#" class="view-details" data-title="<?php echo $photo['judul_foto']; ?>" data-image="<?php echo $photo['lokasi_file']; ?>">
											<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> More
										</a>
									</div>
								</div>
							</div>
					<?php
						}
					} else {
						// Handle the case when no photo is found
						echo "No photos found.";
					}
					?>
					<!-- Modal for full-size image and comment form -->
					<div class="modal" id="photoModal" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="photoModalTitle"></h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<img class="full-size-img" id="photoModalImage" src="" alt="Full Size Image">
									<div class="btn-group" role="group" aria-label="Basic example">
										<button type="button" class="btn btn-secondary" id="likeButton"><i class="fa fa-thumbs-up"></i> Like</button>
									</div>
									<form class="comment-form mt-3">
										<div class="form-group">
											<label for="comment">Comment:</label>
											<textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
										</div>
										<button type="submit" class="btn btn-primary">Submit</button>
									</form>
								</div>
							</div>
						</div>
					</div>

					<script>
						document.addEventListener("DOMContentLoaded", function() {
							// Get the modal
							var modal = document.getElementById("photoModal");

							// Get all "view details" links
							var viewDetailsLinks = document.querySelectorAll(".view-details");

							// Loop through each link
							viewDetailsLinks.forEach(function(link) {
								// Add click event listener to each link
								link.addEventListener("click", function(event) {
									event.preventDefault();

									// Get the title and image URL from the link's data attributes
									var title = this.getAttribute("data-title");
									var imageUrl = this.getAttribute("data-image");

									// Update modal title and image
									var modalTitle = document.getElementById("photoModalTitle");
									var modalImage = document.getElementById("photoModalImage");
									modalTitle.textContent = title;
									modalImage.src = imageUrl;

									// Show the modal
									$(modal).modal("show");
								});
							});

							// Handle form submission
							var commentForm = modal.querySelector(".comment-form");
							commentForm.addEventListener("submit", function(event) {
								event.preventDefault(); // Prevent the form from submitting normally
								// You can handle form submission here, e.g., submit the comment via AJAX
								// ...
								// After submitting the comment, you may want to close the modal
								$(modal).modal("hide");
							});

							// Handle like button click
							var likeButton = modal.querySelector("#likeButton");
							likeButton.addEventListener("click", function(event) {
								// Implement your like functionality here
							});
						});
					</script>


				</div>
			</div>
		</div>
		</div>
	</section>

	<?php include('footer.php') ?>