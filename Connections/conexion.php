<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conexion = "SistemaTours.db.13968598.hostedresource.com";
$database_conexion = "SistemaTours";
$username_conexion = "SistemaTours";
$password_conexion = "ToursG2013@@";
$conexion = mysqli_connect($hostname_conexion, $username_conexion, $password_conexion) or trigger_error(mysqli_error(),E_USER_ERROR);
?>