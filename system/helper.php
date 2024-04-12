<?php


$servername = "localhost";
$username = "root";
$password = "";
$database = "gift";
$conn = new mysqli($servername, $username, $password, $database);


if (!function_exists('runQuery')) {
    function runQuery($query)
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "gift";
        $conn = new mysqli($servername, $username, $password, $database);
        $conn->set_charset("utf8");

        return $conn->query($query);
    }
}
if (!function_exists('runOneQuery')) {
    function runOneQuery($query)
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "gift";
        $conn = new mysqli($servername, $username, $password, $database);
        return $conn->query($query)->fetch_assoc();
    }
}

if (!function_exists('checkLogin')) {
    function checkLogin()
    {
        session_start();
        if (!isset($_SESSION['user']['loggedin'])) {
            if (!str_contains($_SERVER['REQUEST_URI'], 'signIn.php') &&
                !str_contains($_SERVER['REQUEST_URI'], 'signUp.php')) {
                header('Location: signIn.php');
            }
        } elseif (str_contains($_SERVER['REQUEST_URI'], 'signIn.php') ||
            str_contains($_SERVER['REQUEST_URI'], 'signUp.php')) {
            header('Location: home.php');
        }

        if (isset($_SESSION['user']['loggedin'])) {
            $checkMyUserSql = "SELECT * FROM users WHERE id = '{$_SESSION['user']['id']}'";
            $checkMyUserResult = runQuery($checkMyUserSql);
            if ($checkMyUserResult->num_rows <= 0 && $_SESSION['user']['loggedin'] == true) {
                $_SESSION['user'] = [];
                header('Location: login.php');
            }
        }
    }
}
if (!function_exists('checkAdminLogin')) {
    function checkAdminLogin()
    {
        session_start();
        if (!isset($_SESSION['admin']['loggedin'])) {
            if (!str_contains($_SERVER['REQUEST_URI'], 'admin/login.php')) {
                header('Location: login.php');
            }
//            die('39');
        } elseif (str_contains($_SERVER['REQUEST_URI'], 'admin/login.php')) {
            header('Location: index.php');
        }
//        die('44');

        if (isset($_SESSION['admin']['loggedin'])) {
            $checkMyUserSql = "SELECT * FROM admins WHERE id = '{$_SESSION['admin']['id']}'";
            $checkMyUserResult = runQuery($checkMyUserSql);
            if ($checkMyUserResult->num_rows <= 0 && $_SESSION['admin']['loggedin'] == true) {
                $_SESSION['admin'] = [];
                header('Location: login.php');
            }
        }
    }
}
if (!function_exists('checkEmployeeLogin')) {
    function checkEmployeeLogin()
    {
        session_start();
        if (!isset($_SESSION['employee']['loggedin'])) {
            if (!str_contains($_SERVER['REQUEST_URI'], 'employee/login.php')) {
                header('Location: login.php');
            }
//            die('39');
        } elseif (str_contains($_SERVER['REQUEST_URI'], 'employee/login.php')) {
            header('Location: index.php');
        }
//        die('44');

        if (isset($_SESSION['employee']['loggedin'])) {
            $checkMyUserSql = "SELECT * FROM employees WHERE id = '{$_SESSION['employee']['id']}'";
            $checkMyUserResult = runQuery($checkMyUserSql);
            if ($checkMyUserResult->num_rows <= 0 && $_SESSION['employee']['loggedin'] == true) {
                $_SESSION['employee'] = [];
                header('Location: login.php');
            }
        }
    }
}

if (!function_exists('indexButtons')) {
    function indexButtons($buttonText)
    {
        $html = "  <div class='card-header'>
                    <!-- widgest  -->
                    <div class='d-flex align-items-center gap-3'>
                 ";
        if ($buttonText != null) {
            $html .= "
                        <a href='#!' class='btn btn-primary '  data-bs-toggle='modal' data-bs-target='#createModal'>{$buttonText}</a>";
        }
        return $html . " 
                    </div></div>";

    }
}
//$setting = runQuery("SELECT * FROM setting")->fetch_assoc();
