<?php
require('system/helper.php');
checkLogin();

if (isset($_POST['name'])) {
    $imagePath = "";
    if (isset($_FILES['image']) && $_FILES['image']) {
        $errors = array();
        $file_name = (time() * 2) . '.jpg';
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        if ($file_size > 2097152) {
            header("Location: register.php?error=The image size must be less than 2MB");
        }
        if (move_uploaded_file($file_tmp, "uploads/users/" . $file_name)) {
            $imagePath = "uploads/users/" . $file_name;
        }
    }

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $insertSql = "INSERT INTO `users`(`user_name`, `name`, `phone`, `address`,`image`,  `password`) VALUES ('{$_POST['user_name']}','{$_POST['name']}','{$_POST['phone']}','{$_POST['address']}','{$imagePath}','{$password}')";
    runQuery($insertSql);
    $getLastIdSql = "SELECT * FROM `users` order by id  DESC";
    $result = runQuery($getLastIdSql);
    $row = $result->fetch_assoc();

    $_SESSION['user']['id'] = $row['id'];
    $_SESSION['user']['name'] = $row['name'];
    $_SESSION['user']['image'] = $row['image'];
    $_SESSION['user']['user_name'] = $row['user_name'];
    $_SESSION['user']['phone'] = $row['phone'];
    $_SESSION['user']['loggedin'] = true;
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Astro description">
    <meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <meta name="generator" content="Astro v4.4.7">
    <title>Gift Genius | register</title>
    <?php
    include 'layout/assets/css.php';
    ?>
    <link rel="stylesheet" href="./assets/css/Categories-YAZY97fB.css"/>
    <link rel="stylesheet" href="./assets/css/signIn-BC0CRRii.css"/>
    <script type="module" src="./assets/js/hoisted-DKwnRAIk.js"></script>
</head>
<body>
<?php
include 'layout/inc/header.php';
?>
<main class="relative Main">
    <div class="imgContainer absolute"><img src="./assets/images/gifts-BUF_XeJj_ZXqNN.webp" alt="bg" class="img-cover"
                                            loading="eager" width="450" height="450" decoding="async"></div>
    <div class="container d-flex items-start justify-center  mt-14 AuthMain">
        <section class="slideAuth relative mx-auto">
            <div class=" overflow-hidden" id="container"> <!-- <LoginInForm /> -->
                <div class="signUp Form pt-6" id="SignUp">
                    <form action="" method="post"><h1 class="text-center fs-r-30 fw-800 mb-6 line-relaxed">أنشئ حسابك</h1>
                        <div class="formGroup relative mb-7"><input type="text" name="name" id="userName"
                                                                    class="round-4 pr-5" required> <label for="userName"
                                                                                                          class="absolute top-50 right-5">الاسم
                                بالكامل</label></div>
                        <div class="formGroup relative mb-7"><input type="text" name="user_name" id="userEmail"
                                                                    class="round-4 pr-5" required> <label
                                    for="userEmail" class="absolute top-50 right-5">اسم المستخدم</label></div>
                        <div class="formGroup relative mb-7"><input type="number" name="phone" id="userPhone"
                                                                    class="round-4 pr-5" required> <label
                                    for="userPhone" class="absolute top-50 right-5">رقم الهاتف</label></div>
                        <div class="formGroup relative mb-7"><input type="text" name="address" id="adders"
                                                                    class="round-4 pr-5" required> <label for="adders"
                                                                                                          class="absolute top-50 right-5">العنوان </label>
                        </div>
                        <div class="formGroup relative mb-7"><input type="password" name="password"
                                                                    id="userPassword" class="round-4 pr-5" required>
                            <label for="userPassword" class="absolute top-50 right-5">كلمة المرور</label></div>
                        <button class="btn mt-5 btn-popup px-10 py-5 round-6 fs-18 d-flex items-center justify-center mx-auto mt-14"
                                type="submit" aria-label="sign in">
                            التسجيل
                        </button>
                        <p class="text-center mt-6 fs-14 changeResponsive">
                            هل لديك حساب؟ <a href="#SignIn" class="fw-800 signUpBtn">تسجيل الدخول</a></p></form>
                </div> <!-- <AuthText /> --> </div>
        </section>
    </div>
</main>
<footer>
    <div class="container d-flex items-start justify-between">
        <div class="footer-ul about-us"><p class="title fs-24 fw-700">اعرف عنا</p>
            <p class="dec line-relaxed fs-16">
                نحن نقدم لك احدث منتجات الهدايا التي تتناسب مع جميع المناسبات بافضل
                الاسعار
            </p></div> <!--  -->
        <div class="footer-ul contact-us"><p class="title fs-24 fw-700">تواصل معانا</p>
            <p class="dec line-relaxed fs-16">gifts@gmail.com</p>
            <p class="dec line-relaxed fs-16 pt-4">gifts-2@gmail.com</p></div> <!--  -->
        <div class="footer-ul news"><p class="title fs-24 fw-700">احدث العروض</p>
            <p class="dec line-relaxed fs-16">ادخل بريدك لكي يصلك منا احدث العروض</p>
            <form action="index.php">
                <div class="from-group relative mt-7"><input type="email" placeholder="البريد الالكتروني"
                                                             class="round-4 pr-5">
                    <button class="btn  btn-skew sendEmails round-4 px-9  top-0 left-0" type="submit"
                            aria-label="send email">
                        ارسل
                    </button>
                </div>
            </form>
        </div>
    </div>
</footer>
</body>
</html>