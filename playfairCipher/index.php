<?php
require_once "lib/class.php";
$class = new playFairCipher();
if($_POST['msg'] && $_POST['keyWord'])
{
    $class->encrypt($_POST['msg'], $_POST['keyWord']);
}
?>
<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Playfair cipher</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<style>
        .alert {
            margin-top: 5px;
        }
	</style>
</head>
<body>
<div class="container">
	<form action="index.php" method="post">
		<p class="h2">Зашифровать сообщение:</p>
		<label>Введите сообщение:</label>
		<input type="text" name="msg" value="<?=$_POST['msg']?:''?>">
		<label>Введите ключевое слово:</label>
		<input type="text" name="keyWord" value="<?=$_POST['keyWord']?:''?>">
		<input type="submit">
		<?
		if($encrypted != '')
		{
			?>
			<div class="alert alert-primary" role="alert">
				<?=$encrypted?>
			</div>
			<?
		}
		?>
	</form>
</div>
<div class="container">
	<form action="index.php" method="post">
		<p class="h2">Расшифровать сообщение:</p>
		<label>Введите сообщение:</label>
		<input type="text" name="encrypted_msg" value="<?=$_POST['encrypted_msg']?:''?>">
		<!--<label>Введите сдвиг:</label>
        <input type="number" name="shift" value="<?/*=$_POST['shift']?:''*/?>">-->
		<input type="submit">
		<?
		if($decrypted != '')
		{
			?>
			<div class="alert alert-primary" role="alert">
				<?=$decrypted?>
			</div>
			<?
		}
		?>
	</form>
</div>
</body>
</html>