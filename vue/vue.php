<! DOCTYPE html >
<html>
	<head>
		<meta charset ="UTF-8">
		<title ><?php echo $pagetitle; ?></title>
	</head>
	<body>
		<?php
		require VIEW_PATH.$page.DS.'vue'.ucfirst($vue).ucfirst($page).'.php';
		?>
	</body >
</html >