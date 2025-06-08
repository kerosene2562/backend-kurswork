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
            <form method="POST" action="createThread" enctype="multipart/form-data">
                <textarea name="title" id="title" placeholder="Заголовок може містити не більше 255 знаків..."></textarea>
                <textarea name="description" id="description" placeholder="Опис може містити не більше 15000 знаків..."></textarea>
                <label for="files_loader" id="files_label">Завантажити файли</label>
                <input type="file" id="files_loader" name="imgs_refs[]" multiple>
                <select type="text" id="category_id" name="category_id">
                    <option value="">->оберіть категорію<-</option>
                    <?php foreach($categories as $categorie) : ?>
                        <option value="<?=$categorie["id"]?>"><?=$categorie["name"]?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" id="submit_button">Опублікувати</button>
            </form>
        </div>
    </div>
</div>
<script src="/lost_island/scripts/addThread.js"></script>