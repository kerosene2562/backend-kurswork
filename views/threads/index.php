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
<body>
    <div class="threads_block">
        <?php foreach($threads as $thread) : ?>
            <a class="thread_card_ref" href="/lost_island/discussion/index?thread_id=<?=$thread["id"]?>">
                <div class="thread_card">
                    <?php $media = json_decode($thread['imgs_refs'])[0]?>
                    <?php if(explode(".", $media)[1] == "mp4") : ?>
                        <div>
                            <video src="/lost_island/pics/<?=$media?>" class="card_img" alt="Головне зображення">
                        </div>
                        
                    <?php else : ?>
                        <img src="/lost_island/pics/<?=$media?>" class="card_img" alt="Головне зображення">
                    <?php endif; ?>
                    
                    <div class="post_data">
                        <p class="text"><?=$thread["created_at"]?></p>
                    </div>
                    <div>
                        <p class="text"></p>
                    </div>
                    <div class="card_text">
                        <p class="text"><?=$thread["title"]?></p>
                    </div>
                    <div class="card_desc">
                        <p class="text"><?=$thread["description"]?></p>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</body>
</html>