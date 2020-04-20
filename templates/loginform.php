<form action="<?php echo $_SERVER["PHP_SELF"];?>" method = "post" class="w3-container">
        <h2>Logga in</h2>
        <label for="email" class="w3-text-purple">Epost:</label>
        <input type = "text" name="email" class="w3-input w3-border w3-light-grey" value="<?php echo $email;?>"><span class="error">* 
            <?php echo $emailErr;?></span><br><br>
        <label for="psswd" class="w3-text-purple">Lösenord:</label> 
        <input type = "password" name="psswd" class="w3-input w3-border w3-light-grey" 
        ><span class="error"> <?php echo $psswdErr;?></span><br><br>
        <input type = "submit" class="w3-button w3-purple">

    </form>