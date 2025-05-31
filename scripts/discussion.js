function replyTo(id)
{
    document.getElementById("modal_reply_window").style.display = 'block';
    document.getElementById('modal_overlay').style.display = 'block';
    document.body.style.overflow = "hidden";
    if(!isNaN(id))
    {
        document.getElementById('replyed_to').textContent = "Відповідь на коментар №" + id;
        let form = document.getElementById('reply_form');
        let input = document.createElement('input');
        input.name = "parent_comment_id";
        input.value = id;
        input.type = "hidden";
        form.appendChild(input);
    }
    else
    {
        document.getElementById('replyed_to').textContent = "Відповідь на тред";
    }
}

function close_modal_window()
{
    document.getElementById("modal_reply_window").style.display = 'none';
    document.getElementById('modal_overlay').style.display = 'none';
    document.body.style.overflow = "visible";
}

document.getElementById("myButton").addEventListener("click", function () {
    fetch("/lost_island/discussion/method", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ data: "тестові дані" })
    })
    .then(response => response.text())
    .then(result => {
        document.getElementById("result").innerHTML = result;
    })
    .catch(error => {
        console.error("Помилка:", error);
    });
});