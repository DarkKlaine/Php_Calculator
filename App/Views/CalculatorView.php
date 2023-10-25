<?php

namespace App;

class CalculatorView
{
    public function render($inputString, $outputString): void
    {
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<body>";
        echo "<h1>PHP Calculator</h1>";
        echo "<form method='post' action='index.php'>";
        echo "<input type='text' name='userInput' placeholder='Введите выражение' required>";
        echo "<button type='submit'>Вычислить</button>";
        echo "</form>";

        if (!empty($outputString)) {
            echo 'Выражение: ' . $inputString . '<br>';
            echo 'Результат: ' . $outputString . '<br>';
        }

        echo '</body>';
        echo '</html>';
    }
}