<?php include __DIR__ . '/../header.php'?>
<div class="content">
    <div class="container">
        <div class="content-grids">
            <div class="col-md-8 content-main">
                <h2><?= $tag->getName() ?></h2>
                <?= isset($error) ? $error : '' ?>
                <div class="content-grid">
                    <?php if ($articles !== null): ?>
                        <?php foreach ($articles as $article): ?>
                            <div class="content-grid-info">
                                <div class="post-info">
                                    <h4><a href="/articles/<?= $article->getId()?>"><?= $article->getName()?></a></h4>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <?php foreach ($pagination->buttons as $button) : ?>
                            <?php if ($button->isActive) : ?>
                                <a href = '?page=<?=$button->page?>'><?=$button->text?></a>
                            <?php else : ?>
                                <span style="color:#555555"><?=$button->text?></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!---->
<?php include __DIR__ . '/../footer.php'?>
