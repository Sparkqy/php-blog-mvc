<?php include __DIR__ . '/../includes/header.php'; ?>
    <!-- s-content
     ================================================== -->
    <section class="s-content s-content--narrow s-content--no-padding-bottom">

        <?php if (!empty($user) && $user->getRole() === 'admin'): ?>
            <div class="article__admin">
                <h4>Control options (admin):</h4>
                <a href="/articles/<?= $article->getId() ?>/edit" class="btn btn--primary" >Edit</a>
                <a href="/articles/<?= $article->getId() ?>/delete" class="btn btn--danger">Delete</a>
            </div>
        <?php endif; ?>

        <article class="row format-standard">

        <div class="s-content__header col-full">
            <h1 class="s-content__header-title">
                <?= $article->getName() ?>
            </h1>
            <ul class="s-content__header-meta">
                <li class="date"><?= date('l F, Y', strtotime($article->getCreatedAt())) ?></li>
                <li><?= $article->getCategory()->getName() ?></li>
                <br>
                <li><?= $views->getViews() ?> views</li>
            </ul>

        </div> <!-- end s-content__header -->

        <div class="s-content__media col-full">
            <div class="s-content__post-thumb">
                <img src="/<?= $article->getImgPath() ?>" alt="">
            </div>
        </div> <!-- end s-content__media -->

        <div class="col-full s-content__main">

            <p>
                <?= $article->getText() ?>
            </p>

            <p class="s-content__tags">
                <span>Post Tags</span>

                <?php if (empty($tags)): ?>
                <i>Article has no tags.</i>
                <?php endif; ?>

                <?php if (!empty($tags)): ?>
                <span class="s-content__tag-list">
                    <?php foreach ($tags as $tag): ?>
                        <a href="#0"><?= $tag->getName() ?></a>
                    <?php endforeach; ?>
                </span>
                <?php endif; ?>
            </p> <!-- end s-content__tags -->

            <div class="s-content__author">
                <img src="/images/avatars/user-03.jpg" alt="">

                <div class="s-content__author-about">
                    <h4 class="s-content__author-name">
                        <a href="#0"><?= $article->getAuthor()->getNickname() ?></a>
                    </h4>

                    <ul class="s-content__author-social">
                        <li><a href="#0">Facebook</a></li>
                        <li><a href="#0">Twitter</a></li>
                        <li><a href="#0">GooglePlus</a></li>
                        <li><a href="#0">Instagram</a></li>
                    </ul>
                </div>
            </div>

            <div class="s-content__pagenav">
                <div class="s-content__nav">
                    <div class="s-content__prev">
                        <a href="#0" rel="prev">
                            <span>Previous Post</span>
                            Tips on Minimalist Design
                        </a>
                    </div>
                    <div class="s-content__next">
                        <a href="#0" rel="next">
                            <span>Next Post</span>
                            Less Is More
                        </a>
                    </div>
                </div>
            </div> <!-- end s-content__pagenav -->

        </div> <!-- end s-content__main -->

    </article>


    <!-- comments
    ================================================== -->
    <div class="comments-wrap">

    <div id="comments" class="row">
    <div class="col-full">
    <?php if (!empty($comments)): ?>
    <h3 class="h2">5 Comments</h3>

    <!-- commentlist -->
        <ol class="commentlist">

            <?php foreach ($comments as $comment): ?>
                <li class="depth-1 comment">

                    <div class="comment__avatar">
                        <img width="50" height="50" class="avatar" src="images/avatars/user-01.jpg" alt="">
                    </div>

                    <div class="comment__content">

                        <div class="comment__info">
                            <cite><?= $comment->getName() ?></cite>

                            <div class="comment__meta">
                                <time class="comment__time">Dec 16, 2017 @ 23:05</time>
                            </div>
                        </div>

                        <div class="comment__text">
                            <p>
                                <?= $comment->getText() ?>
                            </p>
                        </div>

                    </div>

                </li> <!-- end comment level 1 -->
            <?php endforeach; ?>

        </ol> <!-- end commentlist -->
    <?php else: ?>
        <h3 class="h2">0 Comments</h3>
    <?php endif; ?>

    <!-- respond
    ================================================== -->
    <div class="respond">

        <h3 class="h2">Add Comment</h3>
        <?= !empty($error) ? '<p>' . $error .'</p>' : '' ?>
        <form name="contactForm" id="contactForm" method="POST" action="/articles/<?= $article->getId() ?>/comment">
            <fieldset>
                <input type="hidden" name="user_name" value="<?= !empty($user) ? $user->getNickname() : '' ?>">
                <input type="hidden" name="user_id" value="<?= !empty($user) ? $user->getId() : '' ?>">
                <input type="hidden" name="article_id" value="<?= $article->getId() ?>">
                <caption><?= (!empty($user)) ? 'Никнейм : ' . $user->getNickname() : '' ?></caption>

                <div class="message form-field">
                    <textarea name="cMessage" id="cMessage" class="full-width" placeholder="Your Message"></textarea>
                </div>

                <?php if (!empty($user)): ?>
                    <button type="submit" class="submit btn--primary btn--large full-width">Submit</button>
                <?php else: ?>
                    <h3 class="h2">Only authorized users can post a message.</h3>
                <?php endif; ?>
            </fieldset>
        </form> <!-- end form -->

    </div> <!-- end respond -->

    </div> <!-- end col-full -->

    </div> <!-- end row comments -->
    </div> <!-- end comments-wrap -->

    </section> <!-- s-content -->

<?php include __DIR__ . '/../includes/sectionExtra.php'; ?>
<?php include __DIR__ . '/../includes/footer.php'; ?>