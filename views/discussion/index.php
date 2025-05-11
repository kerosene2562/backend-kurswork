<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$Title?></title>
    <link rel="stylesheet" href="/lost_island/css/discussion.css">
</head>
<body>
    <div class="titleDiscussion">
        <div class="title">
            <p><?= $threadTitle[0]["title"] ?></p>
        </div>
        <div class="content">
            <img src="/lost_island/pics/<?=$threadTitle[0]["imgs_refs"]?>" alt="<?= $threadTitle[0]["imgs_refs"] ?>">
            <div class="description">
                <p><?= $threadTitle[0]["description"] ?></p>
            </div>
        </div>
        
    </div>
    <?php foreach($selectedDiscussion as $comment) : ?>
        <p><?=$comment["comment"]?></p>
    <?php endforeach; ?>
    <form action="add" method="POST">
        <input name="thread_id" type="hidden" value="<?=$threadTitle[0]["id"]?>">
        <input name="comment" type="text">
        <button type="submit">залишити коментар</button>
    </form>
</body>
</html>