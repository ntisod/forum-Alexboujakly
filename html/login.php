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
    <?php
      // define variables and set to empty values
      $emailErr = $psswdErr = "";
      $email = $psswd = "";
      $err=false; 
    //Kontrollera om man kommer till sidan för första gången
    if ($_SERVER["REQUEST_METHOD"] != "POST") 
    {
       // Visa i sådana fall inloggningsformulär
        require"../templates/loginform.php";
    }else{    
    //annars
        //Om man har skrivit in e-postadress
        if (empty($_POST["email"])) {
            $emailErr = "E-postadress är obligatoriskt";
            $err=true;
        } else {
            $email = test_input($_POST["email"]);
            //kontrollera om e-postadress finns i databasen 
            if(!test_if_email_exists($email))
            {
                $emailErr = "E-postadressen finns inte registrerad ";
                $err=true;
            }
                
            //Kontrollera om lösenordet är bra 
            if (empty($_POST["psswd"])) {
                $psswdErr = "ange lösenord";
                $err=true;
            } else {                
                $psswd = test_input($_POST["psswd"]);
            }
            //Hämta det registrerade krypterade lösenordet från databasen.
            if(!$err){
                require("../includes/settings.php");

                //Testa om det går att ansluta till databasen
                try {
                    //Skapa anslutningsobjekt
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    //Förbered SQL-kommando

                    $sql = "SELECT password FROM users WHERE email='$email' LIMIT 1";
                    $stmt=$conn->prepare($sql);
                    //skickar frågan till databasen 
                    $stmt->execute();
                    //taremot resultat från databas
                    $result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $result=$stmt->fetch();
                }
                catch(PDOException $e) {
                    //Om något i anslutningen går fel
                    echo "Error: " . $e->getMessage();
                    $err=true;
                }
                //Stäng anslutningen
                $conn = null;
            }
            if(!$err){
            //Kolla om det inskrivna lösenordet stämmer med det från databasen.
                $verified=password_verify($psswd,$result['password']);
                if($verified){
                    echo"du är inloggad";
                }else{  
                //Annars
                    //Ange felmeddelande och att fel uppstått            
                    $emailErr = "fel lösenord eller användarnamn";
                    $err=true;
                }
            }
        }        //Annars
                    //Ange felmeddelande och att fel uppstått            
        if($err){
              // Visa i sådana fall inloggningsformulär
        require"../templates/loginform.php";
        }
        
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

