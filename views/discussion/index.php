<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$Title?></title>
    <link rel="stylesheet" href="/lost_island/css/discussion.css">
</head>
<body onload="getDiscussion()">
    <div id="modal_overlay" onclick="close_modal_window()"></div>
    <div id="modal_reply_window">
        <div id="modal_close_button_block">
            <button id="modal_close_button" onclick="close_modal_window()">&times;</button>
        </div>
        <div id="img_vault_boys">
            <img id="be_nice_img" src="/lost_island/assets/images/be_nice.png" alt="be_nice">
        </div>
        <form id="reply_form" action="add" method="POST" enctype="multipart/form-data">
            <input name="thread_id" type="hidden" value="<?=$threadTitle["id"]?>">
            <p id="replyed_to"></p>
            <textarea name="comment" id="comment_textarea" placeholder="Коментар може містити максимум 15000 символів..."></textarea>
            <div id="uploader">
                <label for="imgs" id="imgs_loader">Завантажити файл</label>
                <input type="file" id="imgs" name="imgs_refs[]" multiple hidden>
            </div>
            <button type="submit" id="sub_button" onclick="close_modal_window()">Залишити коментар</button>
        </form>
    </div>

    <div id="modal_media">
        <div id="media_info">
            <p id="top_info"></p>
        </div>
        <div id="img_container">
            <img id="media_img" class="media" src="" alt="зображення">
            <video id="media_video" class="media" controls width="300" autoplay></video>
        </div>
        <div id="media_info">
            <p id="bottom_info"></p>
        </div>
    </div>

    <div class="content">
        <div class="catalog_block">
            <p>Каталог тем:</p>
            <?php foreach($Categories as $category) : ?>
                <a href="/lost_island/threads/index?category_id=<?=$category["id"]?>">-- <?=$category["name"]?></a><br>
            <?php endforeach; ?>
        </div>

        <div class="duscussion_block">
            <div class="titleDiscussion">
                <div class="title">
                    <p><?= $threadTitle["title"] ?></p>
                </div>
                <div class="content_title">
                    <div class="imgs_block">
                        <?php $imgs = json_decode($threadTitle["imgs_refs"]);?>
                        <?php foreach($imgs as $media) : ?>
                            <div>
                                <div class="img_container">
                                    <?php if(explode(".", $media)[1] == "mp4") : ?>
                                        <video src="/lost_island/pics/<?=$media?>" controls alt="Відео треду">
                                    <?php else : ?>
                                        <img src="/lost_island/pics/<?=$media?>" alt="Зображення треду">
                                    <?php endif;?>
                                </div>
                                <p><a class="img_name_text" href="#"><?=explode("/", $media)[1]?></a></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="description">
                        <p><?= nl2br($threadTitle["description"]) ?></p>
                    </div>
                </div>
                <div class="title_created_at">
                    <p><?=$threadTitle["created_at"]?></p>
                </div>
            </div>
            <div id="comments"></div>
            <button id onclick="replyTo('відповідь на тред')">Залишити коментар</button>
        </div>
    </div>
    <button id="updateDiscussionButton" onclick="getDiscussion()">Оновити</button>
    <script src="/lost_island/scripts/discussion.js"></script>
</body>
</html>