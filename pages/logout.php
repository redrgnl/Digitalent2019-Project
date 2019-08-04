<?php

// mengaktifkan session
session_start();

//menghapus session
session_unset();

//menghapus semua session
session_destroy();

session_write_close();

setcookie(session_name(),'',0,'/');

session_regenerate_id(true);

//redirect ke halaman login
header ("location: login.php");

//EOF