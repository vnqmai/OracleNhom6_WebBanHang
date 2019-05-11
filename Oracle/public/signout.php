
<?php
session_start();
if(isset($_SESSION['username']))
{
   unset($_SESSION['username']);
}
if(isset($_SESSION['iduser']))
{
   unset($_SESSION['iduser']);
}
// etc.
header('Location: index.php');
exit();