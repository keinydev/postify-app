<?php 

if (isset($_SESSION['notice'])) {
    echo "<div class='notif'>".$_SESSION['notice']."</div>";
    unset($_SESSION['notice']);
}