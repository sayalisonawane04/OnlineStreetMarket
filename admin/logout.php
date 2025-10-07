<?php
session_start();
session_unset();
session_destroy();
header("Location:http://localhost/html/CITY_STREET_MART/");
exit();
?>