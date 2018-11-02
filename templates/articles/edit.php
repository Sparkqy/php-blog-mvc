<?php include __DIR__ . '/../header.php'; ?>
    <div class="container">
        <div class="col-md-12">
            <?php if (!empty($error)): ?>
                <div class="text-danger"><?= $error ?></div>
            <?php endif; ?>
            <div class="col-md-6 col-md-offset-3" style="margin-top: 3rem">
                <h1>Редактирование статьи <?= $article->getName() ?></h1>
                <form action="/articles/<?= $article->getId() ?>/edit" method="post">
                    <div class="form-group">
                        <label for="name">Название статьи</label>
                        <input class="form-control" type="text" name="name" id="name" value="<?= $_POST['name'] ?? $article->getName() ?>" size="50"><br>
                    </div>

                    <div class="form-group">
                        <label for="catId">ID категории статьи</label>
                        <input class="form-control" type="text" name="catId" id="catId" value="<?= $_POST['catId'] ?? $article->getCatId() ?>" size="50"><br>
                    </div>

                    <div class="form-group">
                        <label for="tags">ID тега статьи</label>
                        <input class="form-control" type="text" name="tags" id="tags" value="<?= $_POST['tags'] ?? $article->getTagId() ?>" size="50"><br>
                    </div>

                    <div class="form-group">
                        <label for="text">Текст статьи</label><br>
                        <textarea class="form-control" name="text" id="text" rows="10" cols="80"><?= $_POST['text'] ?? $article->getText() ?></textarea><br>
                    </div>

                    <input class="btn btn-success" type="submit" value="Обновить">
                </form>
            </div>
        </div>
    </div>
<?php include __DIR__ . '/../footer.php'; ?>