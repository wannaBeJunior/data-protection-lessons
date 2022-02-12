<? require_once 'functions.php' ?>
<?php
$secondResult = -1;
if($_POST['FIRST'])
{
	$firstResult = isPrime($_POST['FIRST']);
}
if($_POST['SECOND'])
{
	$secondResult = EulerFunction($_POST['SECOND']);
}
if($_POST['THIRD_A'])
{
	$thirdResult = abmx($_POST['THIRD_A'], $_POST['THIRD_B'], $_POST['THIRD_M']);
}
if($_POST['4th_nums'] && $_POST['4th_rems'])
{
	$chineseTheorem = chineseTheorem($_POST['4th_nums'], $_POST['4th_rems']);
}
if($_POST['5th_a'] && $_POST['5th_p'])
{
    $lejandr = doLejandr($_POST['5th_a'], $_POST['5th_p']);
}
if($_POST['6th_a'] && $_POST['6th_p'])
{
	$cf = cf($_POST['6th_a'], $_POST['6th_p']);
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data protection - 1 lesson</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<style>
    .alert {
        margin-top: 5px;
    }
</style>
<body>
<div class="container" id="first">
    <form action="index.php" method="post">
        <p class="h2">Первое задание:</p>
        <label>Введите число:</label>
        <input type="number" name="FIRST" value="<?=$_POST['FIRST']?:''?>">
        <input type="submit">
        <?
        if($firstResult)
		{
            ?>
            <div class="alert alert-primary" role="alert">
                <?=$firstResult?>
            </div>
            <?
        }
        ?>
    </form>
</div>
<div class="container" id="second">
    <form action="index.php" method="post">
        <p class="h2">Второе задание:</p>
        <label>Введите число:</label>
        <input type="number" name="SECOND" value="<?=$_POST['SECOND']?:''?>">
        <input type="submit">
		<?
		if($secondResult > -1)
		{
			?>
            <div class="alert alert-primary" role="alert">
				<?=$secondResult?>
            </div>
			<?
		}
		?>
    </form>
</div>
<div class="container" id="third">
    <form action="index.php" method="post">
        <p class="h2">Третье задание:</p>
        <label>Ввведите а:</label>
        <input type="number" name="THIRD_A" value="<?=$_POST['THIRD_A']?:''?>">
        <label>Ввведите b:</label>
        <input type="number" name="THIRD_B" value="<?=$_POST['THIRD_B']?:''?>">
        <label>Ввведите m:</label>
        <input type="number" name="THIRD_M" value="<?=$_POST['THIRD_M']?:''?>">
        <input type="submit">
		<?
		if(!is_null($thirdResult))
		{
			?>
            <div class="alert alert-primary" role="alert">
				<?=$thirdResult?>
            </div>
			<?
		}
		?>
    </form>
</div>
<div class="container" id="4th">
    <form action="index.php" method="post">
        <p class="h2">Четвертое задание:</p>
        <p>x ≡ r[0] mod m[0]</p>
        <p>x ≡ r[1] mod m[1]</p>
        <label>Ввведите числа r через запятую:</label>
        <input type="text" name="4th_nums" value="<?=$_POST['4th_nums']?:''?>">
        <label>Ввведите числа m через запятую:</label>
        <input type="text" name="4th_rems" value="<?=$_POST['4th_rems']?:''?>">
        <input type="submit">
		<?
		if(!is_null($chineseTheorem))
		{
			?>
            <div class="alert alert-primary" role="alert">
				<?=$chineseTheorem?>
            </div>
			<?
		}
		?>
    </form>
</div>
<div class="container" id="5th">
    <form action="index.php" method="post">
        <p class="h2">Пятое задание:</p>
        <label>Ввведите a:</label>
        <input type="text" name="5th_a" value="<?=$_POST['5th_a']?:''?>">
        <label>Ввведите p:</label>
        <input type="text" name="5th_p" value="<?=$_POST['5th_p']?:''?>">
        <input type="submit">
		<?
		if(!is_null($lejandr))
		{
			?>
            <div class="alert alert-primary" role="alert">
				<?=$lejandr?>
            </div>
			<?
		}
		?>
    </form>
</div>
<div class="container" id="6th">
    <form action="index.php" method="post">
        <p class="h2">Шестое задание:</p>
        <label>Ввведите числитель:</label>
        <input type="text" name="6th_a" value="<?=$_POST['6th_a']?:''?>">
        <label>Ввведите знаменатель:</label>
        <input type="text" name="6th_p" value="<?=$_POST['6th_p']?:''?>">
        <input type="submit">
		<?
		if(!is_null($cf))
		{
			?>
            <div class="alert alert-primary" role="alert">
				<?=$cf?>
            </div>
			<?
		}
		?>
    </form>
</div>
</body>
</html>
