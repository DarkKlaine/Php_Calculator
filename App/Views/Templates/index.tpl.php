<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?php echo $this->vars['title'] ?></title>
    <style>
        body {
            font-family: "Courier New", monospace;
        }
    </style>
</head>
<body>
<h1><?php echo $this->vars['title'] ?></h1>
<?php $this->injectTplFile() ?>
</body>
</html>
