<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>PHP Sample Programs</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
遊び方<br>
マスをクリックすると、そのマスと上下左右のマスの色が変わります。<br>
全てのマスを同じ色にしましょう。<br><br>

<?php session_start();

// 再挑戦ボタンを押した時の初期化
if (isset($_POST['restart'])) {
    $_SESSION['play'] = NULL;
}
// 色を変える時に使う変数(これでif分を使わずにすむ)
$change[1]="2";
$change[2]="1";

// 初期配置。解無しを防ぐため、全赤の状態から適当に39回ボタンを押している
if ($_SESSION['play'] == NULL) {
    $_SESSION['play'] = 'play';
    $puzzle='1111111111111111111111111';
    
    for ($i=1; $i<=39; $i++) {
        $button=rand(1,25)-1;
        $puzzle=substr_replace($puzzle,$change[substr($puzzle,$button,1)],$button,1);

        if ($button%5 != 0) {
            $puzzle=substr_replace($puzzle,$change[substr($puzzle,$button-1,1)],$button-1,1);       
        }
        if ($button%5 != 4) {
            $puzzle=substr_replace($puzzle,$change[substr($puzzle,$button+1,1)],$button+1,1);       
        }
        if ($button > 4) {
            $puzzle=substr_replace($puzzle,$change[substr($puzzle,$button-5,1)],$button-5,1);       
        }
        if ($button < 20) {
            $puzzle=substr_replace($puzzle,$change[substr($puzzle,$button+5,1)],$button+5,1);       
        }
    }
} else {
    $puzzle=$_SESSION['puzzle'];
}



// ボタンを押したあとの処理
$button=$_POST['button'];
if (isset($button)) {
    $puzzle=substr_replace($puzzle,$change[substr($puzzle,$button,1)],$button,1);

    if ($button%5 != 0) {
        $puzzle=substr_replace($puzzle,$change[substr($puzzle,$button-1,1)],$button-1,1);       
    }
    if ($button%5 != 4) {
        $puzzle=substr_replace($puzzle,$change[substr($puzzle,$button+1,1)],$button+1,1);       
    }
    if ($button > 4) {
        $puzzle=substr_replace($puzzle,$change[substr($puzzle,$button-5,1)],$button-5,1);       
    }
    if ($button < 20) {
        $puzzle=substr_replace($puzzle,$change[substr($puzzle,$button+5,1)],$button+5,1);       
    }
}
?>
<form action="" method="post">
<?php 
for ($i=0; $i<=20; $i+=5):
    for ($j=0; $j<=4; $j++):
        $check=substr($puzzle,$i+$j,1); ?>
        <button type="submit" class="button<?php echo $check; ?>" name="button" value="<?php echo $i+$j; ?>"></button>
        <?php endfor;
        echo '<br>';
    endfor; 
?>
</form>

<form action="" method="post">
    <button type="submit" name="restart">再挑戦</button>
</form>

<?php
if ($puzzle=="1111111111111111111111111" || $puzzle=="2222222222222222222222222") {
    echo '<p class="big">おめでとう！</p>';
}

$_SESSION['puzzle']=$puzzle;
?>

<br>
<br>
<a href="index.html">トップページへ</a>




<!-- cssの書き換え -->
<style type="text/css">
.button1 {
    width: 50px;
    height: 50px;
    margin-left: 0px;
    background-color: red;
}
.button2 {
    width: 50px;
    height: 50px;
    margin-left: 0px;
    background-color: blue;
}
.big {
    font-size: 3rem;
}

</style>

</body>
</html>
