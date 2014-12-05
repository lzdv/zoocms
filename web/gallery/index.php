<?php

function get_files($d){
	$f = array();
	$dir = @opendir($d);
	while ($fn = @readdir($dir)){
		if ($fn=='.' || $fn=='..') continue;
		$f[] = $d.$fn;
	}
	if (count($f))
		sort($f);
	return $f;
}

$imgs = get_files('img/');
$act = (int)(isset($_GET['p'])?$_GET['p']:0);
if (($act < 0) || ($act > (count($imgs)-1)))
	$act = 0;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Rocche Malatestiane - Pagina <?php echo $act; ?>/<?php echo count($imgs); ?></title>
		<style>
		body,html {margin:0;padding:0;}
		.container {display:block;}
		.container img {display:block;margin:0 auto;}
		</style>
	</head>
	<body>
		<div class="container">
			<a href="?p=<?php echo ($act >= count($imgs)?1:$act+1);?>"><img src="<?php echo $imgs[$act]; ?>"></a>
		</div>
	</body>
</html>