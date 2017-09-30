<?php if (isset($_COOKIE['login'])):
    $refUser = new liw\mvc\Controller\Profile\Authorization\LoginIn();
    $refUser->getPassword();
    $checkRealUser = $refUser->refPassword(); ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            body {
                text-align: center;
            }
            h1 {
                font-size: 50px;
            }
            input {
                font-size: 30px;
                margin-top: 40px;
            }
            .profile span {
            	font-size: 40px;
            }

            .bg-i-p {
                width: 300px;
                height: 250px;
                margin-top: 20px;
                display: inline-block;
                text-align: center;
                margin-bottom: 0;
            }
            .bg-i-p img {
                -webkit-background-size: cover;
                background-size: cover;
                width: 100%;
                height: 100%;
            }
        </style>
    </head>
    <body>
    <h1>Ваш профиль.</h1>
    <div class="profile">
    	<span>Ваш логин: <?php print $logUser; ?></span>
    	<br>
    	<span>Дата рождения: <?php print $ageUser; ?> </span>
    	<br>
        <span>Уровень ваших привелегий: <?php print $privilege; ?> </span>
        <br>
    	<span>Ваш аватар: <br>
            <?php if ($photoUser == '0'): ?>
           <form action="<?=$_SERVER['SCRIPT_NAME']?>" enctype="multipart/form-data" method="post">
               <input type="file" name="loadFile" value="Загрузить фото профиля">
               <input type="submit" name="load" value="Загрузить">
           </form>
           <?php else: ?>
           <div class="bg-i-p"><img src="<?php print $photoUser; ?>" alt="YourPhoto"></div>
                <br>
           <?php endif; ?>
            <?php if ($privilege === 'admin'): ?>
            <a href="Article.php">Добавить/Посмотреть статьи</a>
            <?php else: ?>
            <a href="Article.php">Посмотреть статьи</a>
            <?php endif; ?>
        </span>
    </div>
    <form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
        <input type="submit" name="exit" value="Выйти">
    </form>
    </body>
    </html>
<?php else:
    print 'Вы не имеете доступа к этой странице!';
endif;