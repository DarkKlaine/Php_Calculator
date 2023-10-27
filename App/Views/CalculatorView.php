<?php

namespace App\Views;

class CalculatorView
{

    public function render($inputString, $outputString): void
    {

        echo '<!DOCTYPE html><html lang="ru">';
        $this->printHeader();
        echo '<body>';
        $this->printForm();

        if (empty($outputString) === false) {
            echo 'Выражение: ' . $inputString . '<br>';
            echo 'Результат: ' . $outputString . '<br>';

        } else {
            echo 'Калькулятор поддерживает следующие функции:<br>';
            echo '+, -, /, *, pow, sin, cos, tan <br>';
        }

        echo '<br><a href="/history">История</a>';
        echo '</body></html>';
    }

    private function printHeader(): void
    {
        echo "<head>";
        echo "<title>PHP Calculator</title>";
        echo "<style>";
        echo "body {";
        echo "    font-family: \"Courier New\", monospace;";
        echo "}";
        echo "</style>";
        echo "</head>";
    }

    private function printForm(): void
    {
        echo "<h1>PHP Calculator</h1>";
        echo "<form method='post'>";
        echo "<input type='text' name='userInput' placeholder='Введите выражение' required>";
        echo "<button type='submit'>Вычислить</button>";
        echo "</form><br>";
    }

    public function renderHistory(string $history): void
    {
        echo '<!DOCTYPE html><html lang="ru">';
        $this->printHeader();
        echo '<body>';
        echo '<a href="/">Назад</a>';
        echo '<br>История:<br>' . $history;
        echo '</body></html>';
    }
}
