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

	if(isset($_POST['update-blog'])) {
		$sql = "UPDATE `blogs` SET `author`=:author, `date-created`=:date_created, `thumbnail`=:thumbnail, `title`=:title, `content`=:content WHERE id=:id";
		$result = $db->prepare($sql);
		$data = array(
			':author' => $_POST['author'],
			':date_created' => date('Y-m-d'),
			':thumbnail' => $_POST['thumbnail'],
			':title' => $_POST['title'],
			':content' => $_POST['content'],
			':id' => $_GET['id'],
		);
		if($result->execute($data)) {
			echo '<p class="alert alert-success">Blog updated succesfully.</p>';
		} else {
			echo '<p class="alert alert-danger">Failed to update blog.</p>';
		}
	}

	if(isset($_GET['id']) && is_numeric($_GET['id'])) {
		$sql = "SELECT * FROM `blogs` WHERE `id` = :id";
		$result = $db->prepare($sql);
		$result->execute(array(
			':id' => $_GET['id']
		));
		$blog = $result->fetch(PDO::FETCH_ASSOC);
		if(!$blog) {
			header("Location: create-blog.php");
		}
	} else {
		header("Location: create-blog.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Blog</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Edit Blog</h1>
		<form action="" method="post">
			<div class="form-group">
				<label>Author</label>
				<input type="text" name="author" class="form-control" value="<?= $blog['author'] ?>" placeholder="John Doe" required />
			</div>
			<div class="form-group">
				<label>Thumbnail URL</label>
				<input type="text" name="thumbnail" class="form-control" value="/figit/image/blogs/blog%20businessman.jpg" value="<?= $blog['thumbnail'] ?>" placeholder="https://www.thumbnail.com" required />
			</div>
			<div class="form-group">
				<label>Blog Title</label>
				<input type="text" name="title" class="form-control" value="<?= $blog['title'] ?>" placeholder="What we have done in last six weeks?" required />
			</div>
			<div class="form-group">
				<label>Blog Content</label>
				<textarea id="blog-content" name="content">
					<?= $blog['content'] ?>
				</textarea>
			</div>
			<div class="form-group">
				<button type="submit" name="update-blog" class="btn btn-primary">Save</button>
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