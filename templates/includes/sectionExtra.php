<!-- s-extra
================================================== -->
<section class="s-extra">

    <div class="row top">

        <div class="col-eight md-six tab-full popular">
            <h3>Popular Posts</h3>

            <div class="block-1-2 block-m-full popular__posts">
                <?php foreach ($popularArticles as $article): ?>
                <article class="col-block popular__post">
                    <a href="/articles/<?= $article->getId() ?>" class="popular__thumb">
                        <img src="/images/thumbs/small/wheel-150.jpg" alt="">
                    </a>
                    <h5><a href="#0"><?= $article->getName() ?></a></h5>
                    <section class="popular__meta">
                        <span class="popular__author"><span>By</span> <a href="#0"><?= $article->getAuthor()->getNickname() ?></a></span>
                        <span class="popular__date"><span>on</span> <time><?= date('l F, Y', strtotime($article->getCreatedAt())) ?></time></span>
                    </section>
                </article>
                <?php endforeach; ?>
            </div> <!-- end popular_posts -->
        </div> <!-- end popular -->

        <div class="col-four md-six tab-full about">
            <h3>About Project</h3>

            <p>
                This website was created for educational purposes. All code is on github <a href="https://github.com/SparkyGit/php-blog-mvc">https://github.com/SparkyGit/php-blog-mvc</a>
            </p>
        </div> <!-- end about -->

    </div> <!-- end row -->

    <div class="row bottom tags-wrap">
        <div class="col-full tags">
            <h3>Tags</h3>

            <div class="tagcloud">
                <?php foreach ($tagsAll as $tag): ?>
                <a href="#0"><?= $tag->getName() ?></a>
                <?php endforeach; ?>
            </div> <!-- end tagcloud -->
        </div> <!-- end tags -->
    </div> <!-- end tags-wrap -->

</section> <!-- end s-extra -->