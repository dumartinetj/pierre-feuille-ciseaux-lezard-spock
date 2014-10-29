<! DOCTYPE html >
<html>
	<head>
		<meta charset ="UTF-8">
		<title ><?php echo $pagetitle; ?></title>
	</head>
	<body>
		<?php
		require VIEW_PATH.$nom.DS.'vue'.ucfirst($vue).ucfirst($nom).'.php';
		?>
	</body >
</html >