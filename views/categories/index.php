<?php
    $this->Title = "lost_island";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link rel="stylesheet" href="/lost_island/css/style.css">
</head>
<body>
    <div id="categories_content">
        <div>
            <img id="categories_logo" src="/lost_island/assets/images/lost_island.jpg" alt="lost_island">
        </div>
        <div class ="default_text">
            <b> lost_island </b>- українська платформа для анонімних обговорень різних тем, де кожна думка має право на існування. Тут
            немає реєстрації та підписок, що дає тобі можливість висловити свою думку та знати, що ти в безпеці, але це не 
            дає змоги порушувати <a href="/lost_island/categories/rules">правил</a>. Всі тематики тредів знаходяться знизу та мають чітку тематику. 
            Все, що не заборонено окремою тематикою - дозволено.
            <br><br>
            На даний момент створено <b> <?= $countOfTreads ?> </b> тредів. За весь час існування створено <b> <?= $countOfAllTreads ?> </b> тредів та 
            написано <b> <?= $countOfAllComments ?> </b> коментарів.
        </div>
        <div id="categories_block">
            <?php foreach($Categories as $category) : ?>
                <a href="/lost_island/threads/index?category_id=<?=$category["id"]?>"><?=$category["name"]?></a>
            <?php endforeach; ?>
        </div>
       
    </div>
</body>
</html>



