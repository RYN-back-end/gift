<?php
require('../system/helper.php');
checkAdminLogin();

$_SESSION['admin'] = [];
header('Location: login.php');
