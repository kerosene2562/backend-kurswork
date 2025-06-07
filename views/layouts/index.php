<?php
    /**@var string $Title */
    /**@var string $Content */
    if(empty($Title))
        $Title = '';
    if(empty($Content))
        $Content = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/lost_island/css/style.css">
    <title><?= $Title ?></title>
</head>
<body>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
                </a>
                
                <ul id="header_text_and_logo" class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <a href="/lost_island/categories/index">
                        <img id="header_mini_logo" src="/lost_island/assets/images/lost_island.jpg" alt="lost_island">
                    </a>
                    <li><a href="/lost_island/categories/index" class="nav-link px-2 link-secondary"><p id="header_logo_text">Lost_island</p></a></li>
                </ul>
                <?php if(strpos($_SERVER['REQUEST_URI'], '/threads/')) : ?>
                    <div class="create_thread">
                        <a href="/lost_island/threads/add"><button class="create_thread_button">Створити тред</button></a>
                    </div>
                <?php endif; ?>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control" placeholder="Пошук треда" aria-label="Search">
                </form>
            </div>
        </div>
    </header>
    <div>
        <?= $Content ?>
    </div>
        <footer class="footer">
            <p class="footer_text">
                Усі права та авторські права на цій сторінці належать власникам авторських прав. Автор публікації (особа, яка завантажила цю інформацію) 
                несе особисту відповідальність за будь-яку опубліковану інформацію. Усі коментарі належать особі, яка їх надіслала. 
                Якщо ви знайдете інформацію, опубліковану з порушенням правил, будь ласка, повідомте нас.
            </p>
        </footer>
</body>
</html>