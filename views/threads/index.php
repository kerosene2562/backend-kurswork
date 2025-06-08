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
        <?php
            $statsComments = [];
            $statsMedia = [];
            foreach($comments as $comment)
            {
                if(array_key_exists($comment["thread_id"], $statsComments))
                {
                    $statsComments[$comment["thread_id"]]++;
                    $statsMedia[$comment["thread_id"]] += count(json_decode($comment["imgs_refs"]));
                }
                else
                {
                    $statsMedia[$comment["thread_id"]] = count(json_decode($comment["imgs_refs"]));
                    $statsComments[$comment["thread_id"]] = 1;
                }
            }
        ?>
        <?php foreach($threads as $thread) : ?>
            <?php
                if(!isset($statsComments[$thread["id"]]))  
                {
                    $statsComments[$thread["id"]] = 1;
                    $statsMedia[$thread["id"]] = 0;
                }  
                if(isset($statsMedia[$thread["id"]]))  
                {
                    $statsMedia[$thread["id"]] += count(json_decode($thread["imgs_refs"]));
                }
            ?>
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
                        <p class="text">Постів <?=$statsComments[$thread["id"]]?> / Файлів <?=$statsMedia[$thread["id"]]?></p>
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