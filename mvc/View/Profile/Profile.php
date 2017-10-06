<?php if (isset($_COOKIE['login'])):
    $refUser = new liw\mvc\Controller\Profile\Authorization\LoginIn();
    $refUser->getPassword();
    $checkRealUser = $refUser->refPassword(); ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="profile.css">
        <title>Document</title>
        
    </head>
    <body>
      <div class="container">
        <div class="row">
          <div class="col-12 text-center main">
              <h1>Ваш профиль.</h1>
    <div class="profile">
        <span class="login">Ваш логин: <?php print $logUser; ?></span>
        <br>
        <span class="login">Дата рождения: <?php print $ageUser; ?> </span>
        <br>
        <span class="login">Уровень ваших привелегий: <?php print $_SESSION['privilege']; ?> </span>
        <br>
        <span class="login avatar">Ваш аватар: </span><br>
            <?php if ($photoUser == '0'): ?>
           <form action="<?=$_SERVER['SCRIPT_NAME']?>" enctype="multipart/form-data" method="post">
               <input type="file" name="loadFile" value="Загрузить фото профиля">
               <input type="submit" name="load" value="Загрузить">
           </form>
           <?php else: ?>
           <div class="bg-i-p"><img src="<?php print $photoUser; ?>" alt="YourPhoto"></div>
                <br>
           <?php endif; ?>
            <?php if ($_SESSION['privilege'] === 'admin'): ?>
            <a href="Article.php" class="privilege">Добавить/Посмотреть статьи</a>
                <br>
                <a href="ManageUser.php" class="privilege">Установить привилегии.</a>
            <?php else: ?>
            <a href="Article.php">Посмотреть статьи</a>
            <?php endif; ?>
        </span>
    </div>
    <form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
        <input type="submit" name="exit" class="exit" value="Выйти">
    </form>
           </div>
          </div>
        </div>
      </div>
    </body>
    </html>

<?php else:
    print 'Вы не имеете доступа к этой странице!';
endif;