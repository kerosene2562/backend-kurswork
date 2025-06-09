function getThreads() {
    let category_id = document.getElementById('category_id').value;
    let input = document.getElementById('search').value;
    let sort_by = document.getElementById('sort_by').value;
    let threads_block = document.getElementById('threads_block');
    threads_block.innerHTML = "";
    fetch(`/lost_island/threads/getThreads?category_id=${category_id}&search=${input}&sort_by=${sort_by}`)
        .then(response => response.json())
        .then(threads => {
            threads.forEach(thread => {
                let refToThread = document.createElement('a');
                refToThread.classList.add('thread_card_ref');
                refToThread.href = `/lost_island/discussion/index?thread_id=${thread['id']}`;

                let thread_card = document.createElement('div');
                thread_card.classList.add('thread_card');

                let threadMediaCount = JSON.parse(thread["imgs_refs"]).length;
                let threadMedia = JSON.parse(thread["imgs_refs"]);
                let mainMedia = threadMedia[0].split(".");
                if (mainMedia[1] == "mp4") {
                    let div = document.createElement('div');
                    let video = document.createElement('video');
                    video.src = `/lost_island/pics/${threadMedia[0]}`;
                    video.classList.add('card_img');
                    video.alt = "Головне зображення";
                    div.appendChild(video);
                    thread_card.appendChild(div);
                }
                else {
                    let div = document.createElement('div');
                    let img = document.createElement('img');
                    img.src = `/lost_island/pics/${threadMedia[0]}`;
                    img.classList.add('card_img');
                    img.alt = "Головне зображення";
                    div.appendChild(img);
                    thread_card.appendChild(div);
                }

                let post_data = document.createElement('div');
                post_data.classList.add('post_data');
                let post_text = document.createElement('p');
                post_text.classList.add('text');
                post_text.innerHTML = thread["created_at"];
                post_data.appendChild(post_text);
                thread_card.appendChild(post_data);

                let div_stats = document.createElement('div');
                let stats_text = document.createElement('p');
                stats_text.classList.add('text');
                stats_text.innerHTML = `Постів ${thread['statsCom'] + 1} / Файлів ${threadMediaCount + thread['statsMedia']}`;
                div_stats.appendChild(stats_text);
                thread_card.append(div_stats);

                let title_block = document.createElement('div');
                title_block.classList.add('card_text');
                let title_text = document.createElement('p');
                title_text.classList.add('text');
                title_text.innerHTML = `${thread['title']}`;
                title_block.appendChild(title_text);
                thread_card.appendChild(title_block);

                let card_desc = document.createElement('div');
                card_desc.classList.add("card_desc");
                thread_desc = document.createElement('p');
                thread_desc.classList.add('text');
                thread_desc.innerHTML = `${thread['description']}`;
                card_desc.appendChild(thread_desc);
                thread_card.appendChild(card_desc);

                refToThread.appendChild(thread_card);
                threads_block.appendChild(refToThread);
            })
        })
}

document.getElementById('search').oninput = getThreads;
document.getElementById('sort_by').addEventListener('change', getThreads);