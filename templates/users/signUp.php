<?php include __DIR__ . '/../header.php'; ?>
    <div class="container">
        <div class="col-md-12">
            <?php if (!empty($error)): ?>
                <div style="color: red; padding: 15px; margin: 15px;"><?= $error ?></div>
            <?php endif; ?>
            <div class="col-md-6 col-md-offset-3" style="margin-top: 10px;">
                <h1 class="text-center">Регистрация</h1>
                <form action="/users/register" method="post">
                    <div class="form-group">
                        <label>Nickname</label>
                        <input class="form-control" type="text" name="nickname" value="<?= $_POST['nickname']?>">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="text" name="email" value="<?= $_POST['email']?>">
                    </div>

                    <div class="form-group">
                        <label>Пароль</label>
                        <input class="form-control" type="password" name="password" value="<?= $_POST['password']?>">
                    </div>

                    <input class="btn btn-success" type="submit" value="Зарегистрироваться">
                </form>
            </div>
        </div>
    </div>
<?php include __DIR__ . '/../footer.php'; ?>