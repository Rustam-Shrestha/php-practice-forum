<?php
    echo "logging out...";
    echo"haha";
    session_start();
    session_destroy();
    header("Location: /practice/forum")

?>