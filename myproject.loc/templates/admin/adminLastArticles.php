<?php include __DIR__ . '/../header.php'?>
<div class="content">
    <div class="container">
        <div class="content-grids">
            <div class="col-md-8 content-main">
                <div class="content-grid">
                    <?php if ($articles !== null): ?>
                        <?php foreach ($articles as $article): ?>
                            <div class="content-grid-info">
                                <div class="post-info">
                                    <h4><a href="/articles/<?= $article->getId()?>"><?= $article->getName()?></a></h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php foreach ($pagination->buttons as $button) :
                        if ($button->isActive) : ?>
                            <a href = '?page=<?=$button->page?>'><?=$button->text?></a>
                        <?php else : ?>
                            <span style="color:#555555"><?=$button->text?></span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'?>
