<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Userdata</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>

    <?php require '../templates/header.php'; ?>

    <?php
        // define variables and set to empty values
        $firstnameErr = $lastnameErr = $emailErr = $genderErr = "";
        $firstname = $lastname = $email = $gender = $comment = $website = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST["firstname"])) {
                $firstnameErr = "Förnamn är obligatoriskt";
            } else {
                $firstname = test_input($_POST["firstname"]);
                // check if name only contains letters and whitespace
                 if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
                    $firstnameErr = "Använd bara bokstäver och mellanslag";
                 }
            }
            if (empty($_POST["lastname"])) {
                $lastnameErr = "Efternamn är obligatoriskt";
            } else {
                $lastname = test_input($_POST["lastname"]);
            }

            if (empty($_POST["email"])) {
                $emailErr = "E-postadress är obligatoriskt";
            } else {
                $email = test_input($_POST["email"]);
            }
            if (empty($_POST["website"])) {
                $website = "";
            } else {
                $website = test_input($_POST["website"]);
            }
            if (empty($_POST["comment"])) {
                $comment = "";
            } else {
                $comment = test_input($_POST["comment"]);
            }
            if (empty($_POST["gender"])) {
                $genderErr = "Val av kön är obligatoriskt";
            } else {
                $gender = test_input($_POST["gender"]);
            }

            echo $firstname . "<br>";
            echo $lastname . "<br>";
            echo $email . "<br>";
            echo $website . "<br>";
            echo $comment . "<br>";
            echo $gender . "<br>";
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>    

    <form action="<?php $_SERVER["PHP_SELF"];?>" method="post">
        <fieldset>
            <legend>Personliga uppgifter</legend>
            <label for="firstname">Förnamn:</label><br>
            <input type="text" name="firstname" value="<?php echo $firstname;?>"><span class="error">* 
            <?php echo $firstnameErr;?></span><br><br>
            <label for="lastname">Efternamn:</label><br>
            <input type="text" name="lastname" value="<?php echo $lastname;?>"><span class="error">* 
            <?php echo $lastnameErr;?></span><br><br>
            <label for="email">E-post:</label><br>
            <input type="email" name="email" value="<?php echo $email;?>"><span class="error">* 
            <?php echo $emailErr;?></span><br><br>
            <label for="website">Websajt:</label><br>
            <input type="url" name="website" value="<?php echo $website;?>"><br>
            <label for="comment">Kommentar:</label><br>
            <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea><br>
            <label for="gender">Kön:</label>
            <input type="radio" name="gender" 
                <?php if (isset($gender) && $gender=="female") echo "checked";?>
                value="female">Kvinna
            <input type="radio" name="gender"
                <?php if (isset($gender) && $gender=="male") echo "checked";?>
                value="male">Man
            <input type="radio" name="gender" 
                <?php if (isset($gender) && $gender=="other") echo "checked";?>
                value="other">Annat<span class="error">* 
            <?php echo $genderErr;?></span><br><br>
            <input type="submit" value="Registrera">

        </fieldset>

    </form>



    <?php require '../templates/footer.php'; ?>

</body>
</html>

