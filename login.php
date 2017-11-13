<?php
require "resources/scripts/validate_session.php";
$_SESSION["key"] = hash("sha512", date("U"))
?>
<html>
<head>
    <link rel="shortcut icon" type="image/png" href="resources/img/favicon.png"/>
    <title>Filebrowser <?php echo $_SERVER["HTTP_HOST"] ?></title>

    <link rel="stylesheet" href="resources/css/style.css">


</head>

<body>
<div class="wrapper">
    <div class="container">
        <h1>Welcome</h1>
        <form class="form">
            <input name="key" style="display: none" value="<?=$_SESSION["key"]?>" class="key">
            <input required type="text" placeholder="Username" class="username">
            <input required type="password" placeholder="Password" class="password">
            <button type="submit" id="login-button">Login</button>
        </form>
    </div>

    <ul class="bg-bubbles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

<script src="resources/js/login.js"></script>

</body>
</html>
