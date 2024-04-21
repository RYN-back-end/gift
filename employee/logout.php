<?php
require('../system/helper.php');
checkEmployeeLogin();

$_SESSION['employee'] = [];
header('Location: login.php');
