<?php include __DIR__ . '/../includes/header.php'; ?>
    <section class="s-content s-content--narrow">

        <div class="row">

            <div class="col-full s-content__main">
                <h3>Add article</h3>

                <?php if (!empty($error)): ?>
                    <p><?= $error ?></p>
                <?php endif; ?>

                <form name="aForm" id="aForm" method="POST" action="/articles/add" enctype="multipart/form-data">
                    <fieldset>

                        <div class="form-field">
                            <label for="aName">Article name:</label>
                            <input name="aName" id="aName" type="text" class="full-width"
                                   value="<?= $_POST['aName'] ?? '' ?>">
                        </div>

                        <div class="form-field">
                            <label for="aCatId">Related category:</label>
                            <select name="aCatId" id="aCatId" class="full-width">
                                <?php foreach ($categories as $c): ?>
                                    <option value="<?= $c->getId() ?>"><?= $c->getName() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-field">
                            <label for="aTagId">Related tags:</label>
                            <?php foreach ($tagsAll as $tag): ?>
                                <input type="checkbox" name="aTagId[]"
                                       value="<?= $tag->getId() ?>"><?= $tag->getName() ?>
                            <?php endforeach; ?>
                        </div>

                        <div class="form-field">
                            <label for="aShortDesc">Article description:</label>
                            <textarea name="aShortDesc" id="aShortDesc" class="full-width">
                                <?= $_POST['aShortDesc'] ?? '' ?>
                            </textarea>
                        </div>

                        <div class="form-field">
                            <label for="aText">Article text:</label>
                            <textarea name="aText" id="aText" class="full-width">
                                <?= $_POST['aText'] ?? '' ?>
                            </textarea>
                        </div>

                        <div class="form-field">
                            <label for="aImages">Article images:</label>
                            <input name="aImages[]" id="aImages" type="file" multiple>
                        </div>

                        <button type="submit" class="btn btn--primary full-width">Add</button>

                    </fieldset>
                </form> <!-- end form -->
            </div>
        </div>

        </div>

    </section>
<?php include __DIR__ . '/../includes/sectionExtra.php' ?>
<?php include __DIR__ . '/../includes/footer.php'; ?>