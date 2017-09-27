<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .add {
            display: none;
            z-index: 999;
            position: absolute;
        }
        .addArticle:hover {
            text-decoration: underline;
            color: #4cae4c;
            cursor: pointer;
        }
        .hides {
            display: none;
            z-index: 999;
            position: absolute;
        }
        .hides:hover {
            text-decoration: underline;
            color: #4cae4c;
            cursor: pointer;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<h1><?php print $headerArticle; ?></h1>
<br>
<p><?php print $article; ?></p>
<?php if ($privilege === 'admin'): ?>
<p class="addArticle">Добавить статью новостей</p>
<div class="add">
    <form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
        <p>Заголовок статьи</p>
        <textarea type="text" name="HeaderArticle" cols="50" autofocus></textarea>
        <br>
        <br>
        <p>Текст статьи</p>
        <textarea name="Article" rows="7" cols="50"></textarea>
        <br>
        <br>
        <input type="submit" name="addArticle" style="display: block;">
    </form>
    <p class="hides">Скрыть форму.</p>
</div>
<?php endif; ?>
</body>
<script type="application/javascript">
    $('.addArticle').bind('click', function(){
        $('.add').show();
        $('.hides').show();
    });
    $('.hides').bind('click', function () {
       $('.add').hide();
       $('.hides').hide();
    });
</script>
</html>