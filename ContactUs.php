<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Astro description">
    <meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <meta name="generator" content="Astro v4.4.7">
    <title>Gift Genius | عيد الحب </title>
    <?php
    include 'layout/assets/css.php';
    ?>
    <link rel="stylesheet" href="./assets/css/Chat-Idi2oxdd.css"/>
    <link rel="stylesheet" href="./assets/css/Categories-YAZY97fB.css"/>
    <script type="module" src="./assets/js/hoisted-DKwnRAIk.js"></script>
</head>
<body>
<?php
include 'layout/inc/header.php';
?>
<main>
    <section class="breadcrumb relative overflow-hidden">
        <div class="img_Container absolute"></div>
        <div class="container"><h1 class="title capitalize pb-5 text-center fs-r-36 fw-700 line-normal"> تواصل معانا
                <span id="userName"></span></h1>
            <ul class="d-flex items-center  relative">
                <li class="defPage "><a href="index.php" class=""> الصفحة الرئيسية </a></li>
                <li class="separator"></li>
                <li class="linkPage"> تواصل معانا</li>
            </ul>
        </div>
    </section>
    <section class="contact">
        <div class="mainHeading text-center"><h2 class="fs-48 fw-700 d-inline-block relative ">تواصل معانا</h2></div>
        <div class="container">
            <form action="" class="round-6 mx-auto">
                <div class="formGroup relative mb-7"><input type="text" name="userName" id="userName"
                                                            class="round-4 pr-5" required> <label for="userName"
                                                                                                  class="absolute top-50 right-5">الاسم
                        بالكامل</label></div>
                <div class="formGroup relative mb-7"><input type="email" name="userEmail" id="userEmail"
                                                            class="round-4 pr-5" required> <label for="userEmail"
                                                                                                  class="absolute top-50 right-5">
                        البريد الاكتروني</label></div>
                <div class="formGroup relative mb-7"><input type="number" name="userPhone" id="userPhone"
                                                            class="round-4 pr-5" required> <label for="userPhone"
                                                                                                  class="absolute top-50 right-5">
                        رقم الهاتف </label></div>
                <div class="formGroup relative mb-7"><textarea name="UserMassage" id="massage"></textarea> <label
                            for="massage" class="absolute top-50 right-5">رسالتك</label></div>
                <div class="d-flex items-center justify-center mx-auto">
                    <button class="btn btn-skew fs-18 fw-800 py-4 px-14 round-6" type="submit" aria-label="contact us">
                        ارسال
                    </button>
                </div>
            </form>
        </div>
    </section>
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