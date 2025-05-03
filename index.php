<?php
    spl_autoload_register(static function ($className){
        $path = str_replace('\\', '/', $className.'.php');
        if(file_exists($path))
            include_once($path);
    });

    $router = new core\Router($_GET['route']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    penis
</body>
</html>