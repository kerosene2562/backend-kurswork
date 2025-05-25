<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$Title?></title>
    <link rel="stylesheet" href="/lost_island/css/discussion.css">
</head>
<body>
    <div class="content">
        <div class="catalog_block">
            <p class="comment_info_text"> тут буде розміщено сайдбар з різними каталогами для швидкого переходу між сторінками</p>
        </div>

        <div class="duscussion_block">
            <div class="titleDiscussion">
                <div class="title">
                    <p><?= $threadTitle[0]["title"] ?></p>
                </div>
                <div class="content_title">
                    <div>
                        <div class="img_container">
                            <img src="/lost_island/pics/<?=$threadTitle[0]["imgs_refs"]?>" alt="<?= $threadTitle[0]["imgs_refs"] ?>">
                        </div>
                        <p><a class="img_name_text" href="#"><?=$threadTitle[0]["imgs_refs"]?></a></p>
                    </div>
                    <div class="description">
                        <p><?= $threadTitle[0]["description"] ?></p>
                    </div>
                </div>
                <div class="title_created_at">
                    <p><?=$threadTitle[0]["created_at"]?></p>
                </div>
            </div>
            <?php foreach($selectedDiscussion as $comment) : ?>
                <div class="comment_block">
                    <div class="comment_info_block">
                        <div class="comment_info_text_block">
                            <p class="comment_info_text">Anonim comment <?=$comment["id"]?></p>
                            <?php if(!is_null($comment["parent_comment_id"])) : ?>
                                <p class="comment_info_text">replyed to <a href=""><?=$comment["parent_comment_id"]?></a></p>
                            <?php endif; ?>
                            <p class="comment_info_text"><?=$comment["post_datetime"]?></p>
                        </div>
                        <div class="comment_actions_block">
                            <button class="action_button">reply</button>
                            <button class="action_button">report</button>
                        </div>
                    </div>
                    
                    <div class="comment_text_block">
                        <p class="comment_text"><?=$comment["comment"]?></p>
                    </div>
                </div>
                
            <?php endforeach; ?>
            <form action="add" method="POST">
                <input name="thread_id" type="hidden" value="<?=$threadTitle[0]["id"]?>">
                <input name="comment" type="text">
                <button type="submit">залишити коментар</button>
            </form>
        </div>
    </div>
</body>
</html>