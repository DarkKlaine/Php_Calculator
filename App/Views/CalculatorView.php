<?php

namespace App;

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
        }

        echo '</body></html>';
    }

    private function printHeader():void
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

    private function printForm():void
    {
        echo "<h1>PHP Calculator</h1>";
        echo "<form method='post'>";
        echo "<input type='text' name='userInput' placeholder='Введите выражение' required>";
        echo "<button type='submit'>Вычислить</button>";
        echo "</form><br>";
    }
}
