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
            <label for="psswd">Lösenord:</label><br>
            <input type="password" name="psswd" value="<?php echo $psswd;?>"><span class="error">*
            <?php echo $psswdErr;?></span><br><br>
            
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
