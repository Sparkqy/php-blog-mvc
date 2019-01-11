<?php include __DIR__ . '/../includes/header.php' ?>
<!-- s-content
================================================== -->
<section class="s-content">

    <?php if ($articles !== null): ?>
        <h2 class="text-center">Articles by <?= $category->getName() ?>:</h2>
    <?php else: ?>
        <h2 class="text-center">No articles by this category yet.</h2>
    <?php endif; ?>

    <div class="row masonry-wrap">

        <?php if ($articles !== null): ?>
        <div class="masonry">

            <div class="grid-sizer"></div>

            <?php foreach ($articles as $article): ?>
                <article class="masonry__brick entry format-standard" data-aos="fade-up">

                    <div class="entry__thumb">
                        <a href="/articles/<?= $article->getId() ?>" class="entry__thumb-link">
                            <img src="/<?= $article->getImg1() ?>" alt="<?= $article->getName() ?>">
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
                                <a href="/category/<?= $article->getCatId() ?>"><?= $article->getCategory()
                                        ->getName() ?></a>
                            </span>
                        </div>
                    </div>

                </article> <!-- end article -->
            <?php endforeach; ?>

        </div> <!-- end masonry -->
        <?php endif; ?>
    </div> <!-- end masonry-wrap -->

</section> <!-- s-content -->

<?php include __DIR__ . '/../includes/sectionExtra.php' ?>
<?php include __DIR__ . '/../includes/footer.php' ?>
