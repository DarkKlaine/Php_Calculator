<?php

namespace App\Views;

class CalculatorView
{

    public function render(string $inputString, string $outputString): void
    {
        echo '<!DOCTYPE html><html lang="ru">';
        $this->printHeader();
        echo '<body>';
        $this->printForm();

        if (empty($outputString) === false || $outputString == '0') {
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
        echo "<head><title>PHP Calculator</title>";
        echo "<style>";
        echo "body {";
        echo "    font-family: \"Courier New\", monospace;";
        echo "}";
        echo "</style>";
        echo "</head>";
        echo "<h1>PHP Calculator</h1>";
    }

    private function printForm(): void
    {

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
        echo 'История:<br>' . $history;
        echo '<br><a href="/">Назад</a>';
        echo '</body></html>';
    }
}
