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
        $firstnameErr = $lastnameErr = $emailErr = $psswdErr = $genderErr = "";
        $firstname = $lastname = $email = $psswd = $gender = $comment = $website = "";
        $err=false;
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
        // Man kommer inte till sidan för första gången
            if (empty($_POST["firstname"])) 
            {
                $firstnameErr = "Förnamn är obligatoriskt";
                $err=true;
            } else {
                $firstname = test_input($_POST["firstname"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) 
                {
                    $firstnameErr = "Använd bara bokstäver och mellanslag";
                    $err=true;
                }
            }
            if (empty($_POST["lastname"])) {
                $lastnameErr = "Efternamn är obligatoriskt";
                $err=true;
            } else {
                $lastname = test_input($_POST["lastname"]);
            }

            if (empty($_POST["email"])) {
                $emailErr = "E-postadress är obligatoriskt";
                $err=true;
            } else {
                $email = test_input($_POST["email"]);
                if(test_if_email_exists($email))
                {
                    $emailErr = "E-postadressen finns redan";
                    $err=true;
                }
                    

                    if (empty($_POST["psswd"])) {
                        $psswdErr = "lösenord är obligatoriskt";
                        $err=true;
                    } else {                

                        $psswd = test_input($_POST["psswd"]);
                        // kryptera lösenord 
                        $hashed = password_hash($psswd, PASSWORD_DEFAULT);
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
                    echo $psswd . "<br>";
                    echo $website . "<br>";
                    echo $comment . "<br>";
                    echo $gender . "<br>";

                    if($err){
                        require("../templates/userdata.php");    
                    }else{
                        echo "<p>Jippi, inga fel!</p>";
                        //Spara dina värden till databasen
                        //Hämta hemliga värden
                        require("../includes/settings.php");

                        //Testa om det går att ansluta till databasen
                        try {
                            //Skapa anslutningsobjekt
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                            //Förbered SQL-kommando

                            $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$hashed')";
                            $conn->exec($sql);

                        }
                        catch(PDOException $e) {
                            //Om något i anslutningen går fel
                            echo "Error: " . $e->getMessage();
                        }
                        //Stäng anslutningen
                        $conn = null;
        
                    }
                }
            
        } else{
            // Man kommer till sidan för första gången
            require("../templates/userdata.php");
        }


        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function test_if_email_exists($email):bool{
            //Hämta hemliga värden
            require("../includes/settings.php");
            
            //Testa om det går att ansluta till databasen
            try {
                //Skapa anslutningsobjekt
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                //Förbered SQL-kommando
                $sql = "SELECT email FROM users WHERE email='$email'  LIMIT 1";
                $stmt = $conn->prepare($sql);
                //Skicka frågan till databasen
                $stmt->execute();
 
                // Ta emot resultatet från databasen
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
 
                $row1 = $stmt->fetch();
                if(empty($row1)){
                    echo "E-postadressen finns inte.";
                    return false;
                }
                else{
                    echo "E-postadressen finns.";
                    return true;
                }
            }
            catch(PDOException $e) {
                //Om något i anslutningen går fel
                echo "Error: " . $e->getMessage();
            }
            //Stäng anslutningen
            $conn = null;
        }

    ?>    




    <?php require '../templates/footer.php'; ?>

</body>
</html>

