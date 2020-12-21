<?php
if ( empty(session_id()) )
    session_start();
session_destroy();
header('Location: /views/welcome.php');
exit();