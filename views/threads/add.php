<?php
    $this->Title = 'create thread';
?>
<link rel="stylesheet" href="/lost_island/css/addThread.css">
<img src="/lost_island/assets/images/thread_boy.png" alt="thread_boy.png">
<div id="warning">
    <p>Перед публікацією нового треду Вам слід ознайомитись з <a href="#">правилами</a> сайту</p>
</div>
<div id="formBlock">
    <form method="POST" action="createThread" enctype="multipart/form-data">
        <textarea name="title" id="title"></textarea>
        <textarea name="description" id="description"></textarea>
        <label for="files" id="files_label">Завантажити файли</label>
        <input type="file" id="files" name="imgs_refs[]" multiple hidden>
        <input type="text" id="category_id" name="category_id">
        <button type="submit" id="submit_button">Опублікувати</button>
    </form>
</div>
