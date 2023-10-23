<span style="font-family: Courier; ">PHP Calculator</span><br/><br/>

<form action="" method="post">
    <input type="text" name="userInput"/>
    <input type="submit" value="Вычислить"/>
</form>

<?php

require_once('../vendor/autoload.php');

if ($_POST) {

    $input = $_POST['userInput'];
    print_r('<span style="font-family: Courier; ">Выражение: ' . $input);
    print_r('<br/>Результат: ');
    $result = (new App\Controller)->countIt($input);
    print_r($result);

    print_r('<br/><br/>История: </span>');
    $logArray = file('../log/calculations.log');
    for ($i = 0; $i < count($logArray); $i++) {
        print_r('<span style="font-family: Courier; "><br/>' . str_replace(' ', '&nbsp', $logArray[$i]) . '</span>');
    }

}
?>