<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/chat.css">
    <title>Chat</title>
</head>
<body>
    <main>
        <table border="1">
            <thead>
                <tr>
                    <th>
                        User Name
                    </th>
                    <th>
                        E-mail
                    </th>
                    <th>
                        Message
                    </th>
                    <th>
                        File
                    </th>
                    <th>
                        Time
                    </th>
                </tr>
            </thead>
            <tbody>
            <?php require_once "../../Controller/printMessageData.php";?>
            </tbody>
        </table>
        <form action="../../Controller/processMessageData.php" method="post" enctype="multipart/form-data">
            <textarea placeholder="Введите что-нибудь..." name="message" required></textarea>
            <div class="buttons">
                <input type="submit" value="Отправить" name="send_button" class="send_button">
                <input type="file" value="Выбратиь файл" name="choose_button" class="choose_button">
            </div>
        </form>
        <form method="get">
            <select name="selected_option" onchange="this.form.submit()">
                <option disabled selected>Способы сортировки</option>
                <option disabled>По дате:</option>
                <option value="T_ASC">Time (возрастание)</option>
                <option value="T_DESC">Time (убывание)</option>
                <option disabled>По почте:</option>
                <option value="E_ASC">Email (возрастание)</option>
                <option value="E_DESC">Email (убывание)</option>
                <option disabled>По имени user'a:</option>
                <option value="N_ASC">Name (возрастание)</option>
                <option value="N_DESC">Name (убывание)</option>
            </select>
        </form>
    </main>
</body>
</html>