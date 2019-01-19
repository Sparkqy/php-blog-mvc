<?php include __DIR__ . '/../includes/headerMain.php' ?>
<div class="pageheader-content row">
    <div class="col-full">

        <div class="featured">

            <div class="featured__column featured__column--big">

                <div class="entry" style="background-image:url('<?= $featuredArticleBig->getMainImage() ?>')">

                    <div class="entry__content">
                        <span class="entry__category">
                            <a href="/category/<?= $featuredArticleBig->getCatId() ?>">
                                <?= $featuredArticleBig->getCategory()->getName() ?>
                            </a>
                        </span>

                        <h1>
                            <a href="/articles/<?= $featuredArticleBig->getId() ?>" title="">
                                <?= $featuredArticleBig->getName() ?>
                            </a>
                        </h1>

                        <div class="entry__info">
                            <a href="" class="entry__profile-pic">
                                <img class="avatar" src="images/avatars/user-03.jpg" alt="">
                            </a>

                            <ul class="entry__meta">
                                <li><a href="#0"><?= $featuredArticleBig->getAuthor()->getNickname() ?></a></li>
                                <li><?= date('l F, Y', strtotime($featuredArticleBig->getCreatedAt())) ?></li>
                            </ul>
                        </div>
                    </div> <!-- end entry__content -->

                </div> <!-- end entry -->

            </div> <!-- end featured__big -->

            <div class="featured__column featured__column--small">
                <?php foreach ($featuredArticles as $article): ?>
                    <div class="entry" style="background-image:url('<?= $article->getMainImage() ?>')">

                        <div class="entry__content">
                            <span class="entry__category"><a
                                        href="/category/<?= $article->getCatId() ?>"><?= $article->getCategory()
                                        ->getName() ?></a></span>

                            <h1><a href="/articles/<?= $article->getId() ?>" title=""><?= $article->getName() ?></a>
                            </h1>

                            <div class="entry__info">
                                <a href="" class="entry__profile-pic">
                                    <img class="avatar" src="images/avatars/user-03.jpg"
                                         alt="<?= $article->getAuthor()->getNickname() ?>">
                                </a>

                                <ul class="entry__meta">
                                    <li><a href="#0"><?= $article->getAuthor()->getNickname() ?></a></li>
                                    <li><?= date('l F, Y', strtotime($article->getCreatedAt())) ?></li>
                                </ul>
                            </div>
                        </div> <!-- end entry__content -->

                    </div> <!-- end entry -->
                <?php endforeach; ?>
            </div> <!-- end featured__small -->
        </div> <!-- end featured -->

    </div> <!-- end col-full -->
</div> <!-- end pageheader-content row -->

</section> <!-- end s-pageheader -->


<!-- s-content
================================================== -->
<section class="s-content">

    <div class="row masonry-wrap">

        <h2 class="text-center">Articles:</h2>

        <div class="masonry">

            <div class="grid-sizer"></div>

            <?php if ($articles !== null): ?>
                <?php foreach ($articles as $article): ?>
                    <article class="masonry__brick entry format-standard" data-aos="fade-up">
                        <div class="entry__thumb">
                            <a href="/articles/<?= $article->getId() ?>" class="entry__thumb-link">
                                <img src="<?= $article->getMainImage() ?>" alt="<?= $article->getName() ?>">
                            </a>
                        </div>

                        <div class="entry__text">
                            <div class="entry__header">

                                <div class="entry__date">
                                    <?= date('l F, Y', strtotime($article->getCreatedAt())) ?>
                                </div>
                                <h1 class="entry__title">
                                    <a href="/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a>
                                </h1>

                            </div>
                            <div class="entry__excerpt">
                                <p>
                                    <?= substr($article->getShortDescription(), 0, 100) ?>...
                                </p>
                            </div>
                            <div class="entry__meta">
                            <span class="entry__meta-links">
                                <a href="/category/<?= $article->getCatId() ?>">
                                    <?= $article->getCategory()->getName() ?>
                                </a>
                            </span>
                            </div>
                        </div>

                    </article> <!-- end article -->
                <?php endforeach; ?>
            <?php endif; ?>

        </div> <!-- end masonry -->
    </div> <!-- end masonry-wrap -->

    <?php if ($articles !== null): ?>
        <div class="row">
            <div class="col-full">

                <nav class="pgn">
                    <ul>
                        <li>
                            <span class="pgn__num"></span>
                        </li>

                    </ul>
                </nav>

            </div>
        </div>
    <?php endif; ?>

</section> <!-- s-content -->

<?php include __DIR__ . '/../includes/sectionExtra.php'; ?>
<?php include __DIR__ . '/../includes/footer.php' ?>

