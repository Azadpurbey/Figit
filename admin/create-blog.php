<?php
	try{
		require_once('../config/dbc.php');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(Exception $e) {
		$error = $e->getMessage();
	}

	if(isset($error)) {
		echo $error;
	}

	if(isset($_POST['save-blog'])) {
		$sql = "INSERT INTO `blogs` (`author`, `date-created`, `thumbnail`, `title`, `content`) VALUES (:author, :date_created, :thumbnail, :title, :content)";
		$result = $db->prepare($sql);
		$data = array(
			':author' => $_POST['author'],
			':date_created' => date('Y-m-d'),
			':thumbnail' => $_POST['thumbnail'],
			':title' => $_POST['title'],
			':content' => $_POST['content']
		);
		if($result->execute($data)) {
			echo '<p class="alert alert-success">Blog created succesfully.</p>';
		} else {
			echo '<p class="alert alert-danger">Failed to create blog.</p>';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Blog</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Create Blog</h1>
		<form action="" method="post">
			<div class="form-group">
				<label>Author</label>
				<input type="text" name="author" class="form-control" placeholder="John Doe" required />
			</div>
			<div class="form-group">
				<label>Thumbnail URL</label>
				<input type="text" name="thumbnail" class="form-control" value="/figit/image/blogs/blog%20businessman.jpg" placeholder="https://www.thumbnail.com" required />
			</div>
			<div class="form-group">
				<label>Blog Title</label>
				<input type="text" name="title" class="form-control" placeholder="What we have done in last six weeks?" required />
			</div>
			<div class="form-group">
				<label>Blog Content</label>
				<textarea id="blog-content" name="content"></textarea>
			</div>
			<div class="form-group">
				<button type="submit" name="save-blog" class="btn btn-primary">Save</button>
			</div>
		</form>
	</div>

	<script src="https://cdn.tiny.cloud/1/cnx31cvu3el7uu2l3s6z2kmd3ci4rbhcp99agu2zd25cx24z/tinymce/5/tinymce.min.js"></script>
	<script>
		tinymce.init({
			selector: '#blog-content'
		});
	</script>
</body>
</html>