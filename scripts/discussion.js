function replyTo(id)
{
    document.getElementById("modal_reply_window").style.display = 'block';
    document.getElementById("imgs").value = null;
    document.getElementById("comment_textarea").value = "";
    document.getElementById('modal_overlay').style.display = 'block';
    document.body.style.overflow = "hidden";
    if(!isNaN(id))
    {
        document.getElementById('replyed_to').textContent = "Відповідь на коментар №" + id;
        let form = document.getElementById('reply_form');
        let input = document.createElement('input');
        input.name = "parent_comment_id";
        input.id = "parent_comment_id";
        input.value = id;
        input.type = "hidden";
        form.appendChild(input);
    }
    else
    {
        let i = document.getElementById('parent_comment_id');
        if(i)
        {
            i.remove();
        }
        document.getElementById('replyed_to').textContent = "Відповідь на тред";
    }
}

function close_modal_window()
{
    document.getElementById("modal_reply_window").style.display = 'none';
    document.getElementById('modal_overlay').style.display = 'none';
    document.body.style.overflow = "visible";

    getDiscussion();
}

function getDiscussion()
{
    let threadId = document.querySelector('input[name="thread_id"]').value;
    fetch(`/lost_island/discussion/getDiscussion?thread_id=${threadId}`)
        .then(response => response.json())
        .then(comments => {
            const result = document.getElementById("comments");
            result.innerHTML = ""; 
            comments.forEach(comment => {
                let commentBlock = document.createElement('div');
                commentBlock.classList.add('comment_block');

                let commentInfoBlock = document.createElement('div');
                commentInfoBlock.classList.add('comment_info_block');

                let commentTextInfoBlock = document.createElement('div');
                commentTextInfoBlock.classList.add('comment_info_text_block');

                let commentInfoText = document.createElement('p');
                commentInfoText.classList.add('comment_info_text');
                commentInfoText.innerHTML = "Анонімний коментар №" + comment['id'];
                commentTextInfoBlock.appendChild(commentInfoText);
                
                if(comment['parent_comment_id'] != null)
                {
                    let commentReplyTo = document.createElement('p');
                    commentReplyTo.classList.add('comment_info_text');
                    let refReplyedTo = document.createElement('a');
                    refReplyedTo.href = "#";
                    refReplyedTo.innerHTML = comment['parent_comment_id'];
                    commentReplyTo.innerHTML = " | відповідь на <";
                    commentReplyTo.appendChild(refReplyedTo);
                    commentReplyTo.innerHTML += ">";
                    commentTextInfoBlock.appendChild(commentReplyTo);
                }

                let commentInfoDate = document.createElement('p');
                commentInfoDate.classList.add('comment_info_text');
                commentInfoDate.innerHTML = " | " + comment['post_datetime'];
                commentTextInfoBlock.appendChild(commentInfoDate);

                commentInfoBlock.appendChild(commentTextInfoBlock);

                let commentActionsBlock = document.createElement('div');
                commentActionsBlock.classList.add('comment_actions_block');

                let replyButton = document.createElement('button');
                replyButton.classList.add('action_button');
                replyButton.innerHTML = "відповісти";
                replyButton.onclick = function(){replyTo(comment["id"])};
                commentActionsBlock.appendChild(replyButton);

                let reportButton = document.createElement('button');
                reportButton.classList.add('action_button');
                reportButton.innerHTML = "поскаржитись";
                //reportButton.onclick = reportTo(comment["id"]);
                commentActionsBlock.appendChild(reportButton);

                commentInfoBlock.appendChild(commentActionsBlock);
                commentBlock.appendChild(commentInfoBlock);

                let imgsBlock = document.createElement('div');
                imgsBlock.classList.add('imgs_block');

                if(comment['imgs_refs'] != null)
                {
                    let imgsArr = comment['imgs_refs'].split(" ");
                    imgsArr.forEach((imgRef) => {
                        let div = document.createElement('div');

                        let imgContainer = document.createElement('div');
                        imgContainer.classList.add('img_container');

                        let img = document.createElement('img');
                        img.src = "/lost_island/pics/" + imgRef;
                        img.alt = imgRef;
                        imgContainer.appendChild(img);
                        div.appendChild(imgContainer);

                        let aImgRef = document.createElement('a');
                        aImgRef.classList.add('img_name_text');
                        aImgRef.innerHTML = imgRef;
                        aImgRef.href = "#";
                        div.appendChild(aImgRef);

                        imgsBlock.appendChild(div);
                    });
                    commentBlock.appendChild(imgsBlock);
                }
                let commentTextBlock = document.createElement('div');
                commentTextBlock.classList.add('comment_text_block');

                let commentText = document.createElement('p');
                commentText.classList.add('comment_text');
                commentText.innerHTML = comment['comment'];
                commentTextBlock.appendChild(commentText);

                commentBlock.appendChild(commentTextBlock);
            
                result.appendChild(commentBlock);
            });
        })
}
document.getElementById('reply_form').addEventListener('submit', function(event) {
    event.preventDefault();
  
    const form = event.target;
    const formData = new FormData(form);
  
    fetch(form.action, {
      method: 'POST',
      body: formData
    })
    getDiscussion();
  });