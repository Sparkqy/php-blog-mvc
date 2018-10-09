<?php include __DIR__ . '/../header.php'?>
    <div class="content">
        <div class="container">
            <div class="content-grids">
                <div class="col-md-8 content-main">
                    <!--slider-->
                    <h2>Последние статьи на сайте:</h2>
                        <div class="owl-carousel owl-theme">
                            <?php foreach ($sliderArticles as $sliderArticle): ?>
                                <div class="item">
                                <img src="<?= $sliderArticle->getImgPath()?>" alt="">
                                    <h4 class="text-center">Статья создана: <?= $sliderArticle->getCreatedAt() ?></h4>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <!--slider-->
                    <div class="content-grid">
                    	<?php foreach ($categories as $category): ?>
                        	<div class="content-grid-info">
                            	<div class="post-info">
                                	<h2><a href="/category/<?= $category->getId()?>"><?= $category->getName()?></a></h2>
                                    <?php if (isset($articles[$category->getId()])): ?>
                                	<?php foreach ($articles[$category->getId()] as $article): ?>
        								<p><a href="/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a></p>
    								<?php endforeach; ?>
                                    <?php endif; ?>
                            	</div>
                        	</div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php include __DIR__ . '/../content-side.php' ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!---->
<?php include __DIR__ . '/../footer.php'?>

