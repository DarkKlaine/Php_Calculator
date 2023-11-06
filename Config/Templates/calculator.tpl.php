<?php
/**
 * @see CalculatorView
 */
?>

<form method="post" action="/calculate">
    <input type="text" name="userInput" placeholder="Введите выражение" required>
    <button type="submit">Вычислить</button>
</form>
<br>
<?php
if (empty($this->vars['result']) === false || $this->vars['result'] === '0') {
    echo 'Выражение: ' . $this->vars['input'] . '<br>';
    echo 'Результат: ' . $this->vars['result'] . '<br>';
} else {
    echo 'Калькулятор поддерживает следующие функции:<br>';
    echo '+, -, /, *, pow, sin, cos, tan <br>';
}
?>
<br>
<a href="/history">Вся история</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/session">Моя история</a>
