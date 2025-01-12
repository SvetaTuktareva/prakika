<?php

if(isset($_SESSION['users'])) {
    if (isset($_SESSION['users']['login'])) {


} else {
    header("Location:main.php");
}


}
else {
    header("Location:main.php");
}
?>
