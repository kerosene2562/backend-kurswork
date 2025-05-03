<?php
    spl_autoload_register(static function ($className){
        $path = str_replace('\\', '/', $className.'.php');
        if(file_exists($path))
            include_once($path);
    });
    if(isset($_GET['route']))
    {
        $route = $_GET['route'];
    }
    else
    {
        $route = '';
    }
    $router = new core\Router($route);
    $router->run();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lost_island</title>
</head>
<body>
    new penis
</body>
</html>