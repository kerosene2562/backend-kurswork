document.querySelector('input[name = "imgs_refs[]"]').addEventListener('change', showLoadedImgs);

function showLoadedImgs() {
    let files = this.files;
    document.getElementById("files_label").innerHTML = "";
    Array.from(files).forEach((file) => {
        let mediaContainer = document.createElement('div');
        mediaContainer.classList.add('uploaded_img_container');

        let media;
        if (file["type"] == "video/mp4") {
            media = document.createElement('video');
        }
        else {
            media = document.createElement('img');
        }

        media.src = URL.createObjectURL(file);
        media.alt = file.name;
        media.classList.add('media');
        mediaContainer.appendChild(media);

        document.getElementById("files_label").appendChild(mediaContainer);
    });
}

let titleMaxLen = 255;
let descMaxLen = 15000;
let title = document.getElementById('title');
let desc = document.getElementById('description');

title.addEventListener('input', () => {
    if (title.value.length > titleMaxLen) {
        title.value = title.value.slice(0, titleMaxLen);
    }
});

desc.addEventListener('input', () => {
    if (desc.innerHTML.length > descMaxLen) {
        desc.innerHTML = desc.innerHTML.slice(0, descMaxLen);
    }
});

document.querySelector('form').addEventListener('submit', function (e) {
    let filesInput = document.getElementById('files_loader');
    if (filesInput.files.length < 1) {
        e.preventDefault();
        alert('Будь ласка, завантажте принаймні один файл!');
    }
    if (filesInput.files.length > 4) {
        e.preventDefault();
        alert('Максимум 4 файли!');
    }
});

document.getElementById('description').addEventListener('input', () => {
    document.getElementById('description_sender').value = document.getElementById('description').innerHTML;
})

function format(command) {
    document.execCommand(command);
}

function setTag(tag) {
    let selection = window.getSelection();
    let text = selection.getRangeAt(0);
    if (text.toString().length > 0) {
        let newTag = document.createElement(tag);
        newTag.innerHTML = selection.toString();
        if (tag == 'a') {
            newTag.href = selection.toString();
            newTag.target = "_blank";
        }
        text.deleteContents();
        text.insertNode(newTag);
    }
}

function setSpoiler() {
    let selection = window.getSelection();
    let text = selection.getRangeAt(0);
    if (text.toString().length > 0) {
        let newSpoiler = document.createElement('span');
        newSpoiler.innerHTML = selection.toString();
        newSpoiler.classList.add('spoiler');
        text.deleteContents();
        text.insertNode(newSpoiler);
    }
}