<?php session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <title>Авторизация</title>
    <link href="/assets/template/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/template/css/login.css">
</head>

<body>


<div class="container">
    <form class="form-signin login" action='/login/registr/' method='POST'>
        <h2 class="form-signin-heading">Регистрация</h2>
        <input type="text" class="form-control" placeholder="Логин" required autofocus name="login">
        <input type="password" class="form-control" placeholder="Пароль" required name="password">
        <button class="btn btn-lg btn-primary btn-block login" type="submit" name="do_registration" value="registration">Регистрация</button>
    </form>
    <div><h2><a href="/login/">Авторизация</a></h2></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="/assets/template/js/bootstrap.min.js"></script>
</body>

</html>