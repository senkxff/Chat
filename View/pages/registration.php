<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/registration.css">
    <title>Регистрация</title>
</head>
<body>
    <header class="header_text">
        <h1>Пройти регистрацию</h1>
    </header>
    <main class="form">
        <form action="../../Controller/processRegistrationData.php" method="POST">
            <input name="email" type="email" maxlength="20" placeholder="Введите email" required value="<?= htmlspecialchars($_POST["email"] ?? ""); ?>">
            <input name="password" type="password" maxlength="20" placeholder="Введите пароль" required value="<?= htmlspecialchars($_POST["password"] ?? ""); ?>">
            <input name="user_name" type="text" maxlength="20" placeholder="Введите Ваше имя" required value="<?= htmlspecialchars($_POST["user_name"] ?? ""); ?>">

            <input type="submit" name="entrance_button" value="Войти">
            <input type="submit" name="create_account" value="Создать аккаунт">
        </form>
    </main>
</body>
</html>