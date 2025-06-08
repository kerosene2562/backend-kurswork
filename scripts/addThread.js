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