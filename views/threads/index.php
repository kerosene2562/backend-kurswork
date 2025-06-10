<?php
    $this->Title = 'threads';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/lost_island/css/threads.css">
    <title><?= $Title ?></title>
</head>
<body onload="getThreads()">
    <div class="tools_block">
        <div class="tools">
            <input type="text" id="category_id" style="display:none;" value = "<?=$category_id?>">
            <input type="text" id="search">
            <select id="sort_by">
                <option value="time">по часу</option>
                <option value="bamp">по популярності</option>
            </select>
            <a href="/lost_island/threads/add"><button id="create_thread_button">Створити тред</button></a>
        </div>
    </div>
    <div id="threads_block"></div>
    <script src="/lost_island/scripts/threads.js"></script>
</body>
</html>