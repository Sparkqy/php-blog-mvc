<?php include __DIR__ . '/../includes/header.php'; ?>
<section class="s-content s-content--narrow">

    <div class="row">

        <div class="col-full s-content__main">
            <h3>Editing article "<?= $article->getName() ?>"</h3>
            <p>id - <?= $article->getId() ?></p>

            <?php if (!empty($error)): ?>
                <p><?= $error ?></p>
            <?php endif; ?>
            <div class="s-content__post-thumb">
                <h5>Article images:</h5>
                <img src="/<?= $article->getMainImage() ?>" alt="<? $article->getName() ?>">
                <?php foreach ($article->getAdditionalImages() as $image): ?>
                    <img src="/<?= $image ?>" alt="<?= $article->getName ?>">
                <?php endforeach; ?>
            </div>
            <form name="eForm" id="eForm" method="POST" action="/articles/<?= $article->getId() ?>/edit"
                  enctype="multipart/form-data">

                <fieldset>

                    <div class="form-field">
                        <label for="eName">Article name:</label>
                        <input name="eName" id="eName" type="text" class="full-width"
                               placeholder="Edit article title name."
                               value="<?= $_POST['eName'] ?? $article->getName() ?>">
                    </div>

                    <div class="form-field">
                        <label for="eCatId">Related category:</label>
                        <select name="eCatId" id="eCatId" class="full-width">
                            <?php foreach ($categories as $c): ?>
                                <?php if ($c->getId() == $article->getCatId()): ?>
                                    <option value="<?= $_POST['eCatId'] ?? $c->getId() ?>"
                                            selected><?= $c->getName() ?></option>
                                <?php else: ?>
                                    <option value="<?= $_POST['eCatId'] ?? $c->getId() ?>"><?= $c->getName() ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-field">
                        <label for="eTagId">Related tags:</label>
                        <?php if (!empty($tags)): ?>
                            <?php foreach ($tags as $tag): ?>
                                <p><b><?= $tag->getName() ?></b></p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No tags yet.</p>
                        <?php endif; ?>
                        <?php foreach ($tagsAll as $tag): ?>
                            <input type="checkbox" name="eTagId[]"
                                   value="<?= $_POST['eTagId'] ?? $tag->getId() ?>"><?= $tag->getName() ?>
                        <?php endforeach; ?>
                    </div>

                    <div class="form-field">
                        <label for="eShortDesc">Article description:</label>
                        <textarea name="eShortDesc" id="eShortDesc"
                                  class="full-width"><?= $_POST['eShortDesc'] ?? $article->getShortDescription() ?></textarea>
                    </div>

                    <div class="form-field">
                        <label for="eText">Article text:</label>
                        <textarea name="eText" id="eText"
                                  class="full-width"><?= $_POST['eText'] ?? $article->getText() ?></textarea>
                    </div>

                    <div class="form-field">
                        <label for="eImages">Article images:</label>
                        <input name="eImages[]" id="eImages" type="file" multiple>
                    </div>

                    <button type="submit" class="btn btn--primary full-width">Edit</button>

                </fieldset>
            </form> <!-- end form -->


        </div> <!-- end s-content__main -->

    </div> <!-- end row -->

</section> <!-- s-content -->
<?php include __DIR__ . '/../includes/footer.php'; ?>
