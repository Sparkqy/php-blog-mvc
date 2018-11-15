<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Sparky-blog</title>
    <meta name="description" content="Blog">
    <meta name="author" content="Sparky">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/vendor.css">
    <link rel="stylesheet" href="/css/main.css">

    <!-- script
    ================================================== -->
    <script src="/js/modernizr.js"></script>
    <script src="/js/pace.min.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">

</head>

<body id="top">

    <!-- pageheader
    ================================================== -->
    <section class="s-pageheader s-pageheader--home">

        <header class="header">
            <div class="header__content row">

                <div class="header__logo">
                    <a class="logo" href="/">
                        <img src="/images/logo.svg" alt="Homepage">
                    </a>
                </div> <!-- end header__logo -->

                <ul class="header__social">
                    <li>
                        <a href="https://www.facebook.com/profile.php?id=100015266477096"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/in/%D0%B8%D0%BB%D1%8C%D1%8F-%D0%BA%D0%BE%D0%BB%D1%8F%D0%B4%D0%B5%D0%BD%D0%BA%D0%BE-23a9a8170/"><i class="fa fa-linkedin"></i></a>
                    </li>
                    <li>
                        <a href="https://github.com/SparkyGit"><i class="fa fa-github"></i></a>
                    </li>
                </ul> <!-- end header__social -->

                <a class="header__search-trigger" href="#0"></a>

                <div class="header__search">

                    <form role="search" method="GET" class="header__search-form" action="/search">
                        <label>
                            <span class="hide-content">Search for:</span>
                            <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="Search for:" autocomplete="off">
                        </label>
                        <input type="submit" class="search-submit" value="Search">
                    </form>
        
                    <a href="#0" title="Close Search" class="header__overlay-close">Close</a>

                </div>  <!-- end header__search -->


                <a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>

                <nav class="header__nav-wrap">

                    <h2 class="header__nav-heading h6">Site Navigation</h2>

                    <ul class="header__nav">
                        <li class="current"><a href="/" title="">Home</a></li>
                        <li class="has-children">
                            <a href="#0" title="">Categories</a>
                            <ul class="sub-menu">

                            <?php foreach ($categories as $category): ?>
                                <li>
                                    <a href="/category/<?= $category->getId() ?>" title=""><?= $category->getName() ?></a>
                                </li>
                            <?php endforeach; ?>

                            </ul>
                        </li>
                        <li><a href="style-guide.html" title="">Styles</a></li>
                        <li><a href="/about" title="">About</a></li>
                        <li><a href="/contact" title="">Contact</a></li>

                        <?php if (!empty($user) && $user->getRole() === 'admin'): ?>
                            <button class="btn btn--pill">
                                <a href="/admin">Admin panel</a>
                            </button>
                        <?php endif; ?>

                        <?php if (!empty($user)): ?>
                            <div class="pull-right">
                                <li>Hi, <?= $user->getNickname() ?></li>
                                <li><a href='/users/logout'>Sign Out</a></li>
                            </div>
                        <?php else: ?>
                            <div class="pull-right">
                                <li><a href='/users/register'>Register</a></li>
                                <li><a href='/users/login'>Log in</a></li>
                            </div>
                        <?php endif; ?>

                    </ul> <!-- end header__nav -->

                    <a href="#0" title="Close Menu" class="header__overlay-close close-mobile-menu">Close</a>

                </nav> <!-- end header__nav-wrap -->

            </div> <!-- header-content -->
        </header> <!-- header -->
  
