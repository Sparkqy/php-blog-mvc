<?php include __DIR__ . '/../includes/header.php'; ?>
    <section class="s-content s-content--narrow">

        <div class="row">

            <div class="col-full s-content__main">

                <h3>Login.</h3>

                <?php if (!empty($error)): ?>
                    <p><?= $error ?></p>
                <?php endif; ?>

                <form name="lForm" id="lForm" method="post" action="/users/login">
                    <fieldset>

                        <div class="form-field">
                            <input name="lEmail" type="email" id="lEmail" class="full-width" placeholder="Your Email"
                                   value="<?= $_POST['lEmail'] ?? '' ?>">
                        </div>

                        <div class="form-field">
                            <input name="lPassword" type="password" id="lPassword" class="full-width"
                                   placeholder="Your Password">
                        </div>

                        <button type="submit" class="submit btn btn--primary full-width">Sign In</button>

                    </fieldset>
                </form> <!-- end form -->


            </div> <!-- end s-content__main -->

        </div> <!-- end row -->

    </section> <!-- s-content -->
<?php include __DIR__ . '/../includes/footer.php'; ?>