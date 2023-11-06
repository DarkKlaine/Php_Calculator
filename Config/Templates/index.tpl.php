<?php
/**
 * @var TemplateEngine $this
 */

use Engine\Views\TemplateEngine;

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?php echo $this->vars['title'] ?></title>
    <style>
        body {
            background-color: #3E2723;
            color: #FFF8E7;
            font-family: "Courier New", monospace;
        }

        a {
            color: #FFF8E7;
        }
    </style>
</head>
<body><center>
<h1><?php echo $this->vars['title'] ?></h1>
<?php $this->injectTplFile() ?>
    </center></body>
</html>
