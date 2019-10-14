<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>

    <?php require '../templates/header.php'; ?>

    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method = "post" class="w3-container">
        <h2>Logga in</h2>
        <label for="name" class="w3-text-purple">Namn:</label>
        <input type = "text" name="name" class="w3-input w3-border w3-light-grey">
        <label for="password" class="w3-text-purple">Lösenord:</label> 
        <input type = "password" name="password" class="w3-input w3-border w3-light-grey">
        <input type = "submit" class="w3-button w3-purple">

    </form>

    <?php require '../templates/footer.php'; ?>

</body>
</html>

