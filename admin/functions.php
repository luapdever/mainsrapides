<?php

function connected() {
    if(isset($_SESSION['role'])) {
        return true;
    } else {
        return false;
    }
}

?>