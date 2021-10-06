<?
  session_start();
  unset($_SESSION["iIdUsuario"]);//liberarán las variables de sesión registradas 
  session_destroy();//libera la sesión actual, elimina cualquier dato de la sesión
  header("Location: ../Styles/index.php");
  exit;
?>