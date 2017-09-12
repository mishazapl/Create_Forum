<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
    Login
    <br>
    <input type="text" name="log">
    <br>
    Pass
    <br>
    <input type="text" name="pass">
    <br>
    Age format 22-03-2000 <br> min 5 age max 80 age
    <br>
    <input type="text" name="age">
    <br>
    <input type="submit" name="sub">
</form>
<br>
<a href="index.php">LoginIn</a>
</body>
</html>