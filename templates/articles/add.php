<?php include __DIR__ . '/../header.php'; ?>
<div class="container">
    <div class="col-md-12">
        <h1 style="margin-top: 3rem">Создание новой статьи</h1>
        <?php if (!empty($error)): ?>
            <div class="text-danger"><?= $error ?></div>
        <?php endif; ?>
        <div class="col-md-6 col-md-offset-3" style="margin-top: 3rem">
            <form action="/articles/add" method="post">
                <div class="form-group">
                    <label for="name">Название статьи</label>
                    <input class="form-control" type="text" name="name" id="name" value="<?= $_POST['name'] ?? '' ?>" size="50"><br>
                </div>

                <div class="form-group">
                    <label for="image">Фото для статьи</label>
                    <input class="form-control" type="file" name="image" id="image" value="<?= $_POST['image'] ?? '' ?>" size="50"><br>
                </div>

                <div class="form-group">
                    <label for="catId">ID категории статьи</label>
                    <input class="form-control" type="text" name="catId" id="catId" value="<?= $_POST['catId'] ?? '' ?>" size="50"><br>
                </div>

                <div class="form-group">
                    <label for="tags">ID тега статьи</label>
                    <input class="form-control" type="text" name="tags" id="tags" value="<?= $_POST['tags'] ?? '' ?>" size="50"><br>
                </div>

                <div class="form-group">
                    <label for="text">Текст статьи</label><br>
                    <textarea class="form-control" name="text" id="text" rows="10" cols="80"><?= $_POST['text'] ?? '' ?></textarea><br>
                </div>

                <input class="btn btn-success" type="submit" value="Создать">
            </form>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>