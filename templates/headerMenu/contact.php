<?php include __DIR__ . '/../includes/header.php'; ?>
    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--narrow">

        <div class="row">

            <div class="s-content__header col-full">
                <h1 class="s-content__header-title">
                    Feel Free To Contact Me.
                </h1>
            </div> <!-- end s-content__header -->

            <div class="col-full s-content__main">

                <p class="lead">
                    My social media accounts:
                </p>

                <ul>
                    <li>
                        <i class="fa fa-2x fa-facebook-square"></i>
                        <a href="https://www.facebook.com/profile.php?id=100015266477096">My Facebook</a>
                    </li>
                    <li>
                        <i class="fa fa-2x fa-google"></i>
                        <a href="mailto:triiko21@gmail.com">Email me</a>
                    </li>
                    <li>
                        <i class="fa fa-2x fa-linkedin-square"></i>
                        <a href="https://www.linkedin.com/in/%D0%B8%D0%BB%D1%8C%D1%8F-%D0%BA%D0%BE%D0%BB%D1%8F%D0%B4%D0%B5%D0%BD%D0%BA%D0%BE-23a9a8170/">My LinkedLin</a>
                    </li>
                    <li>
                        <i class="fa fa-2x fa-github-square"></i>
                        <a href="https://github.com/SparkyGit">My GitHub</a>
                    </li>
                </ul>

                <div class="row">
                    <div class="col-six tab-full">
                        <h3>Place</h3>

                        <p>
                            Ukraine <br>
                            Kiev
                        </p>

                    </div>

                    <div class="col-six tab-full">
                        <h3>Contact Info</h3>

                        <p>
                            triiko21@gmail.com <br>
                            +38(099)429-82-52
                        </p>

                    </div>
                </div> <!-- end row -->

                <h3>Got any questions? Email me using the form below.</h3>

                <?php if(!empty($error)): ?>
                <p><?= $error ?></p>
                <?php endif; ?>

                <form name="cForm" id="cForm" method="post" action="/contact/contact-message">
                    <fieldset>

                        <div class="form-field">
                            <input name="cName" type="text" id="cName" class="full-width" placeholder="Your Name" value="<?php $_POST['cName']?>">
                        </div>

                        <div class="message form-field">
                            <textarea name="cMessage" id="cMessage" class="full-width" placeholder="Your Message"></textarea>
                        </div>

                        <button type="submit" class="submit btn btn--primary full-width">Submit</button>

                    </fieldset>
                </form> <!-- end form -->


            </div> <!-- end s-content__main -->

        </div> <!-- end row -->

    </section> <!-- s-content -->

<?php include __DIR__ . '/../includes/sectionExtra.php'; ?>
<?php include __DIR__ . '/../includes/footer.php'; ?>