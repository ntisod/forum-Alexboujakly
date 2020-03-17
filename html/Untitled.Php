<?php
$cookie_name = "user";
$cookie_value = "Alex";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); 
?>
<html>
<body>

<?php
if(isset($_COOKIE[$cookie_name])) {
    echo "kakan som heter'" . $cookie_name . "' finns inte";
} else {
    echo "kakan som heter '" . $cookie_name . "' finns";
    echo "värde är " . $_COOKIE[$cookie_name];
}
?>

</body>
</html>


