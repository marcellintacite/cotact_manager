<?php
setCookie('identifiant', '', time() - 86400);
header("Location:index.php");
