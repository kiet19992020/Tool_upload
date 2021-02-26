<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.form.js"></script>
</head>
<style>
	.hide{
		display: none;
	}
</style>
<body>
	<div class="container">
		<br />
		<br />
		<div class="panel panel-default">
			<div class="panel-heading"><b>
					<h3 align="center">File Upload</h3>
				</b></div>
			<div class="panel-body">

				<form id="uploadImage" action="upload.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>File Upload</label>
						<input type="file" name="images[]" multiple id="uploadFile" accept=".jpg, .png, .pdf" />
					</div>
					<div class="form-group">
						<input type="submit" id="uploadSubmit" name="submit" value="Upload" class="btn btn-info" />
						<p id="GFG_DOWN" style="color:green; font-size: 20px; font-weight: bold;">
						</p>
					</div>
					<div class="progress">
						<div class="progress-bar" id="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<div id="targetLayer" style="display:none;"></div>
				</form>
				<div id="loader-icon" style="display:none;"><img src="loader.gif" /></div>
				<div>
				</div>
				<div id="gallery">
					<?php
					// $images = glob("upload/*.*");
					// foreach ($images as $image) {
					// 	echo '<div class="col-md-1" align="center" ><img src="' . $image . '" width="100px" height="100px" style="margin-top:15px; padding:8px; border:1px solid #ccc;" /></div>';
					// }
					?>
				</div>
			</div>
		</div>
	</div>
	<div>
</body>
</html>

<script>
	$(document).ready(function() {
		$('#uploadImage').submit(function(event) {
			if ($('#uploadFile').val()) {
				event.preventDefault();
				$('#loader-icon').show();
				$('#targetLayer').hide();
				$(this).ajaxSubmit({
					target: '#targetLayer',
					beforeSubmit: function() {
						$('.progress-bar').width('80%');
					},
					uploadProgress: function(event, position, total, percentageComplete) {
						$('.progress-bar').animate({
							width: percentageComplete + '%'
						}, {
							duration: 500
						});
					},
					success: function() {
						$('#targetLayer').show();
						$('#loader-icon').hide();
					},
					resetForm: true
				});
			}
			return false;
		});
	});
</script>
<script>
	$('#GFG_UP').text("Choose file from system to get the fileSize");
	$('#uploadFile').on('change', function() {
		if (this.files[0].size > 10485760) {
			alert("Try to upload file less than 10MB!");
		} else {
			$('#GFG_DOWN').text(this.files[0].size + "bytes");
		}
	});
</script>