
<?php
session_start();
setcookie ("IngresoVentas", "", time() - 3600);
session_unset();
session_destroy();
header("Location:https://saludaclinicas.com/App/Secure/POSV3");
?>



