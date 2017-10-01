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
    <link rel="stylesheet" type="text/css" href="article.css">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12 text-left">
            <a href="index.php" id="prevSites">Вернуться на главную</a>
        </div>
        <div class="col-12 text-center">
        <?php if ($privilege === 'admin'): ?>
<p class="addArticle">Добавить статью новостей</p>
<div class="add">
    <form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
        <p>Заголовок статьи(не более 200 символов)</p>
        <textarea type="text" name="HeaderArticle" cols="50" autofocus></textarea>
        <br>
        <br>
        <p>Текст статьи(не более 600 символов)</p>
        <textarea name="Article" rows="7" cols="50"></textarea>
        <br>
        <br>
        <input type="submit" name="addArticle">
    </form>
    <p class="hides">Скрыть форму.</p>
</div>
<?php endif; ?>
        <div class="main">
        <h1 class="main-head">Последние опубликованные статьи: </h1>
<?php if ($resultArticle != null) {
    for ($i = 0; $i < count($resultArticle); $i++) {
        print "<h1 class='header'>" . $resultArticle[$i]["HeaderArticle"] . "</h1>";
        print "<p class='article'>" . $resultArticle[$i]["Article"] . "<p>";
        print "<strong class='creator'>Создатель " . $resultArticle[$i]["Creator"] . "<strong>";
        print "<br>";
        print "<p class='creator'>" . $resultArticle[$i]["Data"] . "</p>";
    }
}
?>
</div>
</div>
</div>
</div>
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