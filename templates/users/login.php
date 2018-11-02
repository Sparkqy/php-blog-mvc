<?php include __DIR__ . '/../headerMain.php'; ?>
    <div class="container sticky-footer">
        <div class="col-md-12">
            <?php if (!empty($error)): ?>
                <div style="background-color: red;padding: 5px;margin: 15px"><?= $error ?></div>
            <?php endif; ?>
            <form class="col-md-6 col-md-offset-3" action="/users/login" method="post">
                <h1 class="text-center" style="margin-top: 55px;">Вход</h1>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" value="<?= $_POST['email'] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input class="form-control" type="password" name="password" value="<?= $_POST['password'] ?? '' ?>">
                </div>
                <input class="btn btn-success" type="submit" value="Войти">
            </form>
        </div>
    </div>
<?php include __DIR__ . '/../footer.php'; ?>