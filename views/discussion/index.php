<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$Title?></title>
    <link rel="stylesheet" href="/lost_island/css/discussion.css">
</head>
<body>
    <div id="modal_overlay"></div>
    <div id="modal_reply_window">
        <div id="modal_close_button_block">
            <button id="modal_close_button" onclick="close_modal_window()">&times;</button>
        </div>
        <div id="img_vault_boys">
            <img id="be_nice_img" src="/lost_island/assets/images/be_nice.png" alt="be_nice">
        </div>
        <form id="reply_form" action="add" method="POST" enctype="multipart/form-data">
            <input name="thread_id" type="hidden" value="<?=$threadTitle[0]["id"]?>">
            <p id="replyed_to"></p>
            <textarea name="comment" id="comment_textarea" placeholder="Коментар може містити максимум 15000 символів..."></textarea>
            <div id="uploader">
                <label for="imgs" id="imgs_loader">Завантажити файл</label>
                <input type="file" id="imgs" name="imgs_refs[]" multiple>
            </div>
            <button type="submit" id="sub_button">Залишити коментар</button>
        </form>
    </div>

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
                    <div class="imgs_block">
                        <?php foreach($imgs as $img) : ?>
                            <div>
                                <div class="img_container">
                                    <img src="/lost_island/pics/<?=$img?>" alt="<?= $img ?>">
                                </div>
                                <p><a class="img_name_text" href="#"><?=$img?></a></p>
                            </div>
                        <?php endforeach; ?>
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
                            <p class="comment_info_text">Анонімний коментар №<?=$comment["id"]?></p>
                            <?php if(!is_null($comment["parent_comment_id"])) : ?>
                                <p class="comment_info_text"> | відповідь на <a href=""><?=$comment["parent_comment_id"]?></a></p>
                            <?php endif; ?>
                            <p class="comment_info_text"> | <?=$comment["post_datetime"]?></p>
                        </div>
                        <div class="comment_actions_block">
                            <button class="action_button" onclick="replyTo(<?= $comment['id'] ?>)">відповісти</button>
                            <button class="action_button">поскаржитись</button>
                        </div>
                    </div>
                    <?php if(isset($comment["imgs_refs"])) : ?>
                        <div class="imgs_block">
                            <?php foreach(explode(" ", $comment["imgs_refs"]) as $img) : ?>
                                <div>
                                    <div class="img_container">
                                        <img src="/lost_island/pics/<?=$img?>" alt="<?= $img ?>">
                                    </div>
                                    <p><a class="img_name_text" href="#"><?=$img?></a></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif;?>
                    <div class="comment_text_block">
                        <p class="comment_text"><?=$comment["comment"]?></p>
                    </div>
                </div>
            <?php endforeach; ?>
            <button id onclick="replyTo('відповідь на тред')">Залишити коментар</button>
        </div>
    </div>
    <button id="myButton">оновити</button>
    <div id="result">jas;dlkf</div>
    <script src="/lost_island/scripts/discussion.js"></script>
</body>
</html>