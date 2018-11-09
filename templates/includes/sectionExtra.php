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
            <h3>About Creator</h3>

            <p>
                Hi, my name is Koliadenko Ilya! I'm from Kiev, 20 y.o and I like to create different sites.
                I call myself a full stack web-developer but my mom calls me a sparrow (idk why).
                Ok, let's talk about business! My dev skills: HTML5, CSS (SCSS), JS (not really best language for me),
                PHP7 (my passion), MySQL. Soon I'm going to learn some PHP frameworks like Slime or Laravel,
                I don't know which one to choose first because they are both fire for sure. <br>
                This site was created for learning objectives. All code is on my GitHub.
            </p>

            <ul class="about__social">
                <li>
                    <a href="#0"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="#0"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="#0"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="#0"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                </li>
            </ul> <!-- end header__social -->
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