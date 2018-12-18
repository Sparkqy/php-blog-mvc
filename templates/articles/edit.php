<?php include __DIR__ . '/../includes/header.php'; ?>
<section class="s-content s-content--narrow">

    <div class="row">

        <div class="col-full s-content__main">

            <div class="article__admin">
                <h4>Category ID = Category name:</h4>
                <ul>
                    <?php foreach ($categoryList as $category): ?>
                        <li><?= $category->getId() ?> = <?= $category->getName() ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <h3>Editing article "<?= $article->getName() ?>".</h3>
            <p>id - <?= $article->getId() ?></p>

            <?php if (!empty($error)): ?>
                <p><?= $error ?></p>
            <?php endif; ?>

            <form name="eForm" id="eForm" method="POST" action="/articles/<?= $article->getId() ?>/edit">
                <fieldset>

                    <div class="form-field">
                        <label for="eName">Article name:</label>
                        <input name="eName" id="eName" type="text" class="full-width"
                               placeholder="Edit article title name."
                               value="<?= $_POST['eName'] ?? $article->getName() ?>">
                    </div>

                    <div class="form-field">
                        <label for="eCatId">Article category ID:</label>
                        <input name="eCatId" id="eCatId" type="text" class="full-width"
                               placeholder="Edit article category ID"
                               value="<?= $_POST['eCatId'] ?? $article->getCatId() ?>">
                    </div>

                    <div class="form-field">
                        <label for="eText">Article text:</label>
                        <textarea name="eText" id="eText"
                                  class="full-width"><?= $_POST['eText'] ?? $article->getText() ?></textarea>
                    </div>

                    <button type="submit" class="btn btn--primary full-width">Edit</button>

                </fieldset>
            </form> <!-- end form -->


        </div> <!-- end s-content__main -->

    </div> <!-- end row -->

</section> <!-- s-content -->
<?php include __DIR__ . '/../includes/footer.php'; ?>
