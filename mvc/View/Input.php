<?php if (isset($_COOKIE['login']) && isset($_COOKIE['password'])):
    $refUser = new liw\mvc\Controller\LoginIn();
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
                font-size: 120px;
            }
            input {
                font-size: 30px;
            }
        </style>
    </head>
    <body>
    <form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
        <h1><?php print $current; ?></h1>
        <input type="submit" name="plus" value="plus">
    </form>
    <br>
    <form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
        <input type="submit" name="exit" value="Выйти">
    </form>
    </body>
    </html>
<?php else:
    print 'Вы не имеете доступа к этой странице!';
endif;