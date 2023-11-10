<?php
/**
 * @var WebTemplateEngine $this
 */

use Engine\Views\WebTemplateEngine;

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
            text-align: center;
        }

        a {
            color: #FFF8E7;
        }
    </style>
</head>
<body>
<h1><?php echo $this->vars['title'] ?></h1>
<?php $this->injectTplFile() ?>
</body>
</html>
