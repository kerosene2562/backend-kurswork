<?php
    $this->Title = 'Create thread';
?>
<link rel="stylesheet" href="/lost_island/css/addThread.css">
<div class="create_container">
    <div class="create_thread_block">
        <div class="img_container">
            <img src="/lost_island/assets/images/thread_boys.gif" class="thread_boys" alt="thread_boys">
        </div>
        <div class="warning_container">
            <p class="warning_text">Перед публікацією нового треду ознайомитись з <a href="/lost_island/threads/rules" class="ref_rules">правилами</a> сайту</p>
        </div>
        <div class="form_block">
            <form method="POST" action="add" enctype="multipart/form-data">
                <?php if(!empty($error_message)) : ?>
                    <div class="alert alert-danger" role="alert">
                    <?= $error_message ?>
                    </div>
                <?php endif; ?>  
                <textarea name="title" id="title" placeholder="Заголовок може містити не більше 255 знаків..."></textarea>
                <div class="text_buttons">
                    <button type="button" class="text_button" onclick="format('bold')"><b>B</b></button>
                    <button type="button" class="text_button" onclick="format('italic')"><i>I</i></button>
                    <button type="button" class="text_button" onclick="format('underline')"><u>U</u></button>
                    <button type="button" class="text_button" onclick="format('strikeThrough')"><s>S</s></button>
                    <button type="button" class="text_button" onclick="setTag('sub')">A<sub>a</sub></button>
                    <button type="button" class="text_button" onclick="setTag('sup')">A<sup>a</sup></button>
                    <button type="button" class="text_button" onclick="setTag('a')"><p style="color: orange; padding: 0; margin: 0;">ref</p></button>
                    <button type="button" class="text_button" onclick="setSpoiler()">Sp</button>
                </div>
                <div id="description" contenteditable="true"></div>
                <input type="hidden" name="description" id="description_sender">
                <label for="files_loader" id="files_label">Завантажити файли</label>
                <input type="file" id="files_loader" name="imgs_refs[]" accept=".jpg,.mp4,.gif,.png,.webp" multiple>
                <select type="text" id="category_id" name="category_id">
                    <option value="-">->оберіть категорію<-</option>
                    <?php foreach($categories as $categorie) : ?>
                        <option value="<?=$categorie["id"]?>"><?=$categorie["name"]?></option>
                    <?php endforeach; ?>
                </select>
                <div class="recaptcha_block">
                    <div class="g-recaptcha" data-sitekey="6LcQGl0rAAAAAJz_-sPJfQpJpts7bQm_JHKR-bjE" data-theme="dark"></div>
                </div>
                <button type="submit" id="submit_button">Опублікувати</button>
            </form>
        </div>
    </div>
</div>
<script src="/lost_island/scripts/addThread.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
