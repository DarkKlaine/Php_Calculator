<?php

namespace App;

class CalculatorView
{
    private string $input;
    private ?string $result;
    private ?string $history;

    public function __construct(string $input, string $result = null, string $history = null)
    {
        $this->input = $input;
        $this->result = $result;
        $this->history = $history;
    }

    public function render(): void
    {
        echo '<html>';
        echo '<head>';
        echo '<title>PHP Calculator</title>';
        echo '</head>';
        echo '<body>';
        echo '<h1>PHP Calculator</h1>';
        echo '<form>';
        echo 'Поле для ввода: <input type="text" name="input"><br>';
        echo '<button type="submit">Вычислить</button>';
        echo '</form>';
        echo '<br>';

        if ($this->result !== null && $this->history !== null) {
            echo 'Выражение: ' . $this->input . '<br>';
            echo 'Результат: ' . $this->result . '<br>';
            echo '<br>';
            echo 'История: ' . $this->history . '<br>';
        }

        echo '</body>';
        echo '</html>';
    }
}