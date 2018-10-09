<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Мой блог' ?></title>
    <link href="/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="/css/style.css" rel='stylesheet' type='text/css' />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!----webfonts---->
    <link href='http://fonts.googleapis.com/css?family=Oswald:100,400,300,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,300italic' rel='stylesheet' type='text/css'>
    <!----//webfonts---->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/main.js"></script>
</head>

<body style="height: 100vh;">
    <!---header---->
    <div class="header">
        <div class="container">
            <div class="logo">
                <a href="/"><img src="/img/logo.jpg" title="" /></a>
            </div>
            <!---start-top-nav---->
            <div class="top-menu col-md-8">
                <div class="search">
                    <form>
                        <input type="text" placeholder="" required="">
                        <input type="submit" value="" />
                    </form>
                </div>
                <span class="menu"> </span>
                <ul>
                    <li class="active"><a href="/">На главную</a></li>
                    <?php if (!empty($user) && $user->getRole() === 'admin'): ?>
                    <li><a href="/admin">Страница админки</a></li>    
                    <?php endif; ?>
                    
                    <?= !empty($user) ? '<li class="pull-right">Привет, ' . $user->getNickname() .  "</li>" : "<li class='pull-right'><a href='/users/login'>Войти</a></li>
                        <li class='pull-right'><a href='/users/register'>Зарегестрироваться</a></li>" ?>
                    <div class="clearfix"> </div>
                </ul>
            </div>
            <div class="clearfix"></div>
            <script>
            $("span.menu").click(function() {
                $(".top-menu ul").slideToggle("slow", function() {});
            });
            </script>
            <!---//End-top-nav---->
        </div>
    </div>