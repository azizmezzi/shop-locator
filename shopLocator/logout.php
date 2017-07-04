<?php

if(isset($_POST['logout'])){
    $_SESSION=array();
    header("Location:home.php");

}

?>
<form method="post" name="logout">
    <fieldset style="margin-left: 1000px">
    <legend >sign out</legend>
    <input type="submit" name="logout" value="deconnecté">
    </fieldset>
</form>
