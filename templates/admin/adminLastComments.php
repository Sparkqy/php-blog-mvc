<?php include __DIR__ . '/../headerMain.php' ?>
    <div class="content">
        <div class="container">
            <div class="content-grids">
                <div class="col-md-8 content-main">
                    <div class="content-grid">
                        <h1>Последние 10 комментариев на сайте:</h1>
                        <ul class="comment-list" style="padding: 15px;">
                            <?php if (!empty($recentComments)): ?>
                                <?php foreach ($recentComments as $comment): ?>
                                    <h5 class="post-author_head" style="margin-bottom: 5px;">Комментарий оставил <b><?= $comment->getName() ?></b>
                                    </h5>
                                    <li><a href="/articles/<?= $comment->getArticleId() ?>">Перейти на страничку со статьей</a></li>
                                    <li style="padding-left: 10px;"><?= $comment->getText() ?></li>
                                    <hr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
<?php include __DIR__ . '/../footer.php' ?>