<div class="text-center">
    <h3 class="">Калькулятор</h3>
</div>

<div class="form-body">
    <form class="row g-3" id="calculator" method="post" action="<?php echo $this->vars['Calculate'] ?>">
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
    </form>
</div>

<div style="text-align: center">
    <center><table>
            <tr>
                <td style="height: 4px;">
                </td>
            </tr>
        <tr>
            <td style="height: 43px;">
                <button style="width: 46px" class="btn btn-light" id="1" onclick="addText('1')" data-text="1">1</button>
                <button style="width: 46px" class="btn btn-light" id="2" onclick="addText('2')" data-text="2">2</button>
                <button style="width: 46px" class="btn btn-light" id="3" onclick="addText('3')" data-text="3">3</button>
                <button style="width: 46px" class="btn btn-light" id="4" onclick="addText('4')" data-text="4">4</button>
                <button style="width: 46px" class="btn btn-light" id="5" onclick="addText('5')" data-text="5">5</button>
                <button style="width: 46px" class="btn btn-light" id="plus" onclick="addText('plus')" data-text=" + ">+</button>
                <button style="width: 46px" class="btn btn-light" id="minus" onclick="addText('minus')" data-text=" - ">-</button>
                <button style="width: 46px" class="btn btn-light" id="open" onclick="addText('open')" data-text="(">(</button>
            </td>
        </tr>
        <tr>
            <td style="height: 43px;">
                <button style="width: 46px" class="btn btn-light" id="6" onclick="addText('6')" data-text="6">6</button>
                <button style="width: 46px" class="btn btn-light" id="7" onclick="addText('7')" data-text="7">7</button>
                <button style="width: 46px" class="btn btn-light" id="8" onclick="addText('8')" data-text="8">8</button>
                <button style="width: 46px" class="btn btn-light" id="9" onclick="addText('9')" data-text="9">9</button>
                <button style="width: 46px" class="btn btn-light" id="0" onclick="addText('0')" data-text="0">0</button>
                <button style="width: 46px" class="btn btn-light" id="multiply" onclick="addText('multiply')" data-text=" * ">*</button>
                <button style="width: 46px" class="btn btn-light" id="divide" onclick="addText('divide')" data-text=" / ">/</button>
                <button style="width: 46px" class="btn btn-light" id="close" onclick="addText('close')" data-text=")">)</button>
            </td>
        </tr>
        <tr>
            <td style="height: 43px;">
                <button style="width: 59px" class="btn btn-light" id="pow" onclick="addText('pow')" data-text=" pow ">x^y</button>
                <button style="width: 58px" class="btn btn-light" id="sin" onclick="addText('sin')" data-text=" sin ">sin</button>
                <button style="width: 58px" class="btn btn-light" id="cos" onclick="addText('cos')" data-text=" cos ">cos</button>
                <button style="width: 59px" class="btn btn-light" id="tan" onclick="addText('tan')" data-text=" tan ">tan</button>
                <button style="width: 46px" class="btn btn-light" id="dot" onclick="addText('dot')" data-text=".">.</button>
                <button style="width: 96px" class="btn btn-success" type="submit" form="calculator">=</button>
            </td>
        </tr>
    </table></center>
</div>


