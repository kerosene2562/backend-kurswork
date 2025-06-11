<?php
    $this->Title = $threadTitle["title"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$Title?></title>
    <link rel="stylesheet" href="/lost_island/css/discussion.css">
    <link rel="stylesheet" href="/lost_island/css/editor.css">
</head>
<body onload="getDiscussion()">
    <div id="modal_overlay" onclick="close_modal_window()"></div>
    <div id="modal_reply_window">
        <div id="modal_close_button_block">
            <button id="modal_close_button" onclick="close_modal_window()">&times;</button>
        </div>
        <div id="img_vault_boys">
            <img id="be_nice_img" src="/lost_island/assets/images/be_nice.gif" alt="be_nice">
        </div>
        <form id="reply_form" action="add" method="POST" enctype="multipart/form-data">
            <input name="thread_id" type="hidden" value="<?=$threadTitle["id"]?>">
            <p id="replyed_to"></p>
            <textarea name="comment" id="comment_textarea" placeholder="Коментар може містити максимум 15000 символів..."></textarea>
            <div id="imgs_block"></div>
            <div id="uploader">
                <label for="imgs" id="imgs_loader">Завантажити файл</label>
                <input type="file" id="imgs" name="imgs_refs[]" accept=".jpg,.mp4,.gif,.png,.webp" multiple hidden>
            </div>
            <div class="recaptcha_block">
                <div class="g-recaptcha" data-sitekey="6LcQGl0rAAAAAJz_-sPJfQpJpts7bQm_JHKR-bjE" data-theme="dark"></div>
            </div>
            <button type="submit" id="sub_button" onclick="close_modal_window()">Залишити коментар</button>
        </form>
    </div>

    <div id="modal_report_window">
        <div id="modal_close_button_block">
            <button id="modal_close_button" onclick="close_modal_window()">&times;</button>
        </div>
        <div id="img_vault_boys">
            <img id="report_img" src="/lost_island/assets/images/report_boy.gif" alt="report_boy">
        </div>
        <p id="reported_on"></p>
        <form id="report_form" action="report" method="POST" enctype="multipart/form-data">
            <input type="text" name="reportedOnId" id="reportedOnId">
            <input type="text" name="reportedType" id="reportedType" value="false">
            <textarea name="reason" id="reason" placeholder="Скарга може містити максимум 15000 символів..."></textarea>
            <div class="recaptcha_block">
                <div class="g-recaptcha" data-sitekey="6LcQGl0rAAAAAJz_-sPJfQpJpts7bQm_JHKR-bjE" data-theme="dark"></div>
            </div>
            <button type="submit" id="sub_button" onclick="close_modal_window()">Надіслати репорт</button>
        </form>
    </div>

    <div id="modal_media">
        <div class="media_info" id="media_top_info">
            <p id="top_info"></p>
        </div>
        <div id="img_container">
            <img id="media_img" class="media" src="" alt="зображення">
            <video id="media_video" class="media" controls width="300" autoplay></video>
        </div>
        <div class="media_info" onclick="close_media()">
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
                    <p class="title_text"><?= $threadTitle["title"] ?></p>
                    <button class="action_button_report" onclick="reportOn(<?=$threadTitle['id']?>)"><img class="action_img" src="/lost_island/assets/images/report.png" alt="report"></button>
                </div>
                <div class="content_title">
                    <div class="imgs_block">
                        <?php $imgs = json_decode($threadTitle["imgs_refs"]);?>
                        <?php foreach($imgs as $media) : ?>
                            <div>
                                <div class="img_container">
                                    <?php if(explode(".", $media)[1] == "mp4") : ?>
                                        <video src="/lost_island/pics/<?=$media?>" alt="Відео треду">
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
            <div id="bottom_actions_block">
                <button id="comment_thread_button" onclick="replyTo('відповідь на тред')">Залишити коментар</button>
                <button id="updateDiscussionButton" onclick="getDiscussion()"><img id="updateDiscussionImg" class="action_img" src="/lost_island/assets/images/update.png" alt="update"></button>
            </div>
        </div>
    </div>
    
    <script src="/lost_island/scripts/discussion.js"></script>
    <script>
        window.addEventListener('load', () => {
        let hash = window.location.hash;
        if (hash) 
        {
            setTimeout(() => {
            let target = document.querySelector(hash);
            if (target) 
            {
                target.scrollIntoView({ behavior: 'smooth' });
                target.style.backgroundColor = 'rgb(128, 80, 80)'; 
            }
            }, 100);
            setTimeout(() => {
            let target = document.querySelector(hash);
            if (target) 
            {
                target.style.backgroundColor = 'rgb(44, 44, 44)'; 
            }
            }, 2000);
        }
        });
    </script>
</body>
</html>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>