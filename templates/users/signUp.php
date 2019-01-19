<?php include __DIR__ . '/../includes/header.php'; ?>
    <section class="s-content s-content--narrow">

        <div class="row">

            <div class="col-full s-content__main">

                <h3>Registration.</h3>

                <?php if (isset($rSuccess)): ?>
                    <p><?= $rSuccess ?></p>
                    <a href="/users/login" class="btn btn--primary">Log in</a>
                <?php endif; ?>

                <?php if (!empty($error)): ?>
                    <p><?= $error ?></p>
                <?php endif; ?>

                <form name="rForm" id="rForm" method="post" action="/users/register">
                    <fieldset>

                        <div class="form-field">
                            <input name="rNickname" type="text" id="rNickname" class="full-width"
                                   placeholder="Your Nickname" value="<?php $_POST['rNickname'] ?? '' ?>">
                        </div>

                        <div class="form-field">
                            <input name="rEmail" type="email" id="rEmail" class="full-width"
                                   placeholder="Your Email (Will Be Used As Login)" value="<?= $_POST['rEmail'] ?? '' ?>">
                        </div>

                        <div class="form-field">
                            <input name="rPassword" type="password" id="rPassword" class="full-width"
                                   placeholder="Your Password">
                        </div>

                        <div class="form-field">
                            <input name="rPasswordCheck" type="password" id="rPasswordCheck" class="full-width"
                                   placeholder="Repeat Your Password">
                        </div>

                        <button type="submit" class="submit btn btn--primary full-width">Sign Up</button>

                    </fieldset>
                </form> <!-- end form -->


            </div> <!-- end s-content__main -->

        </div> <!-- end row -->

    </section> <!-- s-content -->
<?php include __DIR__ . '/../includes/footer.php'; ?>