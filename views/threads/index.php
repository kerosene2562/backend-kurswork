<?php
    $this->Title = 'список новин';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/lost_island/css/threads.css">
    <title><?= $Title ?></title>
</head>
<body>
    <div class="threads_block">
        <?php foreach($threads as $thread) : ?>
            <a href="/lost_island/discussion/index?thread_id=<?=$thread["id"]?>">
                <div class="thread_card">
                    <img class="card_img" src="/lost_island/pics/<?=$thread['imgs_refs']?>" alt="<?=$thread['imgs_refs']?>">
                    <div class="card_text">
                        <p><?=$thread["title"]?></p>
                    </div>
                    <div class="card_desc">
                        <p><?=$thread["description"]?></p>
                    </div>
                    <div class="post_data">
                        <p><?=$thread["created_at"]?></p>
                    </div>
                </div>
            </a>
            
        <?php endforeach; ?>
    </div>
</body>
</html>