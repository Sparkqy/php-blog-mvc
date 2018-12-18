<?php include __DIR__ . '/../includes/header.php' ?>
<!-- s-content
================================================== -->
<section class="s-content">

    <div class="row masonry-wrap">

        <?php if (!empty($error)): ?>
            <h2 class="text-center"><?= $error ?></h2>
        <?php endif; ?>

        <?php if (isset($tag)): ?>
            <h2 class="text-center">Articles by <?= $tag->getName() ?>:</h2>
        <?php endif; ?>

        <div class="masonry">

            <div class="grid-sizer"></div>

            <?php if ($articles !== null): ?>
                <?php foreach ($articles as $article): ?>
                    <article class="masonry__brick entry format-standard" data-aos="fade-up">

                        <div class="entry__thumb">
                            <a href="/articles/<?= $article->getId() ?>" class="entry__thumb-link">
                                <img src="/<?= $article->getImgPath() ?>" alt="<?= $article->getName() ?>">
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
                                    <?= substr($article->getText(), 0, 100) ?>...
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
            <?php endif; ?>

        </div> <!-- end masonry -->
    </div> <!-- end masonry-wrap -->

    <?php if ($articles !== null): ?>
        <div class="row">
            <div class="col-full">

                <nav class="pgn">
                    <ul>
                        <?php foreach ($pagination->buttons as $button) : ?>
                            <?php if ($button->isActive) : ?>
                                <li><span class="pgn__num"><a href="?page=<?= $button->page ?>"><?= $button->text ?></a></span>
                                </li>
                            <?php else : ?>
                                <li><?= $button->text ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </nav>

            </div>
        </div>
    <?php endif; ?>

</section> <!-- s-content -->

<?php include __DIR__ . '/../includes/footer.php' ?>
