<div class="text-center">
    <h3 class="">Калькулятор</h3>
</div>

<div class="form-body">
    <form class="row g-3" method="post" action="/calculate">
        <div class="col-12">
            <label for="inputExpression" class="form-label"></label>
            <pre style="font-family: monospace; text-align: center; font-size: 18px;">
<?php
if (empty($this->vars['result']) === false || $this->vars['result'] === '0') {
    echo 'Выражение: ' . $this->vars['input'] . PHP_EOL;
    echo 'Результат: ' . $this->vars['result'] . PHP_EOL;
} else {
    echo 'Поддерживает следующие функции:' . PHP_EOL;
    echo '+, -, /, *, pow, sin, cos, tan' . PHP_EOL;
    echo 'Умеет вычислять сложные выражения' . PHP_EOL;
}
?></pre>
            <input type="text" class="form-control" id="inputExpression" name="userInput" placeholder="Введите выражение" required>
        </div>
        <div class="col-12">
            <div class="d-grid">
                <button type="submit" class="btn btn-light">Вычислить</button>
            </div>
        </div>
    </form>
</div>