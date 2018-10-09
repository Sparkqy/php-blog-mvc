<?php include __DIR__ . '/../header.php'; ?>
    <div class="single">
        <div class="container">
            <div class="col-md-8 single-main">
                <div class="single-grid">
                    <?php if (!empty($user) && $user->getRole() === 'admin'): ?>
                        <h4>Администрирование статьи:</h4>
                        <a href="/articles/<?= $article->getId() ?>/edit" class="btn btn-default" >Редактировать статью</a>
                        <a href="/articles/<?= $article->getId() ?>/delete" class="btn btn-danger">Удалить статью</a>
                    <?php endif; ?>
                    <h1><?= $article->getName() ?></h1>
                    <?php foreach ($tags as $tag): ?>
                        <span>#<?= $tag->getTagName() ?></span>
                    <?php endforeach; ?>
                    <img src="/<?= $article->getImgPath() ?>" alt="">
                    <p><?= $article->getText() ?></p>
                    <p>Сейчас читают: <?= $viewsAtm ?> Всего прочитали: <?= $viewsTotal ?></p>
                </div>
                <ul class="comment-list">
                    <li>
                        <img src="/img/avatar.png" class="img-responsive" alt="">
                        <h5 class="post-author_head">Статья опубликова <?= $article->getCreatedAt() ?> пользователем <?= $author ?></h5>
                        <div class="clearfix"></div>
                    </li>
                </ul>
                <div class="content-form">
                <?php if (!empty($comments)): ?>
                    <h3>Комментарии:</h3>
                    <ul class="comment-list" style="padding: 15px;">
                    <?php if (!empty($comments)): ?>
                        <?php foreach ($comments as $comment): ?>
                        <h5 class="post-author_head" style="margin-bottom: 5px;"><?= $comment->getName() ?>:</h5>
                        <li style="padding-left: 10px;"><?= $comment->getText() ?></li>
                        <hr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </ul>
                <?php else: ?>
                    <h3>Комментариев к этой статье еще нет</h3>
                <?php endif; ?>
                </div>

                <div class="content-form">
                    <h3>Написать комментарий:</h3>
                    <?= !empty($error) ? '<p>' . $error .'</p>' : '' ?>
                    <form action="/articles/<?= $article->getId() ?>/comment" method="POST">
                        <caption><?= (!empty($user)) ? 'Никнейм : ' . $user->getNickname() : '' ?></caption>
                        <textarea placeholder="введите сообщение" name="text" value="<?= $_POST['text'] ?>"></textarea>
                        <?php if (!empty($user)): ?>
                        <input type="submit" value="Отправить"/>
                        <?php else: ?>
                        <p>Комментарий может оставить только авторизированный пользователь</p>
                        <?php endif; ?>

                        <input type="hidden" name="user_name" value="<?= $user->getNickname() ?>">
                        <input type="hidden" name="user_id" value="<?= $user->getId() ?>">
                        <input type="hidden" name="article_id" value="<?= $article->getId() ?>">
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<?php include __DIR__ . '/../footer.php'; ?>