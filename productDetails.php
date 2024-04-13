<?php
require('system/helper.php');

$selectProductsSql = "SELECT * FROM products WHERE id = {$_GET['id']}";
$selectProductsResult = runQuery($selectProductsSql);
$product = $selectProductsResult->fetch_assoc();

$selectOtherProductsSql = "SELECT * FROM products WHERE category_id = {$product['category_id']} and id != '{$_GET['id']}'";
$selectOtherProductsResult = runQuery($selectOtherProductsSql);


if (isset($_POST['id']) && isset($_POST['qty'])) {
    checkLogin();
    $userId = $_SESSION['user']['id'];
    $productId = $_POST['id'];
    $qty = $_POST['qty'];

    $checkIfExistsSql = "SELECT * FROM `cart` WHERE `user_id` = {$userId} and `product_id` = {$productId}";
    $checkIfExistsResult = runQuery($checkIfExistsSql);
    if ($checkIfExistsResult->num_rows > 0) {
        $oldId = $checkIfExistsResult->fetch_assoc()['id'];
        $sql = "UPDATE `cart` SET `qty` = {$qty} WHERE id = {$oldId}";
    } else {
        $sql = "INSERT INTO `cart`(`user_id`, `product_id`, `qty`) VALUES ('{$userId}','{$productId}','{$qty}')";
    }
    runQuery($sql);
    header("Location: productDetails.php?id={$productId}");

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
    <title>Gift Genius | تفاصيل المنتجات </title>
    <?php
    include 'layout/assets/css.php';
    ?>
    <link rel="stylesheet" href="./assets/css/produtsDetails-C88IZhRT.css"/>
    <link rel="stylesheet" href="./assets/css/Categories-YAZY97fB.css"/>
    <script type="module" src="./assets/js/hoisted-Bneh7CXG.js"></script>
</head>
<body>
<?php
include 'layout/inc/header.php';
?>
<main>
    <section class="breadcrumb relative overflow-hidden">
        <div class="img_Container absolute"></div>
        <div class="container"><h1 class="title capitalize pb-5 text-center fs-r-36 fw-700 line-normal"> الصفحة الرئيسية
                <span id="userName"></span></h1>
            <ul class="d-flex items-center  relative">
                <li class="defPage "><a href="index.php" class=""> تفاصيل المنتج </a></li>
                <li class="separator"></li>
                <li class="linkPage">الصفحة الرئيسية</li>
            </ul>
        </div>
    </section>
    <section class="detailsSection">
        <div class="container">
            <div class="row"> <!-- right-side -->
                <div class="col-5-lg col-12-md col-12-sm row-right">
                    <div class="right-side"><p
                                class="des name fs-48 fw-700 mb-6"><?php echo $product['title'] ?></php></p>
                        <p class="des price fs-36 fw-700 mb-6">
                            <?php echo $product['price'] ?>
                            <span class="fs-16 fw-500">ر.س</span></p>
                        <p class="des overview fw-500 fs-20 mb-6">
                            <?php echo $product['description'] ?>
                        </p>
                        <form class="mt-14 d-flex items-center" action="" method="post">
                            <button class="btn btn-skew  round-6 py-6 px-12 fs-18 fw-700"
                                    type="<?php echo $product['qty'] > 0 ? 'submit' : 'button'; ?>"
                                    aria-label=" اضف للسلة">
                                اضف للسلة
                            </button>
                            <input name="id" value="<?php echo $product['id'] ?>" type="hidden">
                            <div class="form-group relative">
                                <button class="btn absolute right-0 top-50 more changeQty" data-type="add"
                                        data-qty="<?php echo $product['qty'] ?>" type="button" aria-label="more">
                                    +
                                </button>
                                <input type="text" readonly id="quantiy" name="qty"
                                       value="<?php echo $product['qty'] > 0 ? 1 : 'المنتج غير متاح'; ?>"
                                       class="text-center">
                                <button class="btn absolute left-0 top-50 mins changeQty" data-type="min"
                                        data-qty="<?php echo $product['qty'] ?>" type="button" aria-label="more">
                                    -
                                </button>
                            </div>
                        </form>
                    </div>
                </div> <!-- left-side -->
                <div class="col-7-lg col-12-md col-12-sm row-left">
                    <div class="left-side">
                        <div class="full-img-container round-6 relative d-flex">
                            <div class="big-img"><img src="<?php echo $product['image'] ?>" alt="صورة المنتج"
                                                      class="round-6 mb-5" width="450" height="450" loading="lazy"
                                                      decoding="async"></div>
                            <!--                            <div class="d-flex items-center allImg">-->
                            <!--                                <div><img src="./assets/images/pro-B0GtClVE_Z1nvIT8.webp" alt="صورة المعلم"-->
                            <!--                                          class="round-6 mb-5" width="450" height="450" loading="lazy" decoding="async">-->
                            <!--                                </div>-->
                            <!--                                <div><img src="./assets/images/pro1-CU2DzlDO_1jb52n.webp" alt="صورة المعلم"-->
                            <!--                                          class="round-6 mb-5" width="450" height="450" loading="lazy" decoding="async">-->
                            <!--                                </div>-->
                            <!--                                <div><img src="./assets/images/pro-B0GtClVE_Z1nvIT8.webp" alt="صورة المعلم"-->
                            <!--                                          class="round-6 mb-5" width="450" height="450" loading="lazy" decoding="async">-->
                            <!--                                </div>-->
                            <!--                                <div><img src="./assets/images/pro1-CU2DzlDO_1jb52n.webp" alt="صورة المعلم"-->
                            <!--                                          class="round-6 mb-5" width="450" height="450" loading="lazy" decoding="async">-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                        </div>
                    </div>
                </div> <!-- end row --> </div>
        </div>
    </section>
    <?php if ($selectOtherProductsResult->num_rows > 0) {
        ?>
        <section class="LastProduct">
            <div class="mainHeading text-center"><h2 class="fs-48 fw-700 d-inline-block relative ">منتجات مشابه</h2>
            </div>
            <div class="container">
                <div class="row gap-row-1 gap-x-12">
                    <?php
                    while ($row = $selectOtherProductsResult->fetch_assoc()) {
                        ?>
                        <div class="col-3-lg col-6-md col-12-sm"><a
                                    href="productDetails.php?id=<?php echo $row['id'] ?>">
                                <div class="card round-8 relative">
                                    <div class="top mx-auto relative"><img
                                                src="<?php echo $row['image'] ?>"
                                                alt="img for product" class="img-cover" width="450"
                                                height="450" loading="lazy" decoding="async"></div>
                                    <div class="body mr-1 relative">
                                        <div class="pb-5 d-flex items-center justify-between"><h3
                                                    class="fw-700 pb-1 fs-24">
                                                <?php echo $row['title'] ?> </h3>
                                            <p class="price fw-700 fs-28"> <?php echo $row['price'] ?> <span
                                                        class="fw-500 fs-18">ر.س</span>
                                            </p></div>
                                        <p class="des fs-18 pb-6 fw-500 line-normal"> <?php echo $row['description'] ?></p>
                                        <button class="btn btn-skew booking-btn mb-1 py-3 round-6 mx-auto d-flex items-center justify-center fs-18 fw-500"
                                                type="button" aria-label=" التفاصيل"> التفاصيل
                                        </button>
                                    </div> <!-- end --> </div>
                            </a></div>
                        <?php

                    }
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
    ?>
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
<script>
    $(document).on('click', '.changeQty', function () {
        var qty = $(this).data('qty')
        var type = $(this).data('type')
        var elm = $(document).find('#quantiy')
        var oldQty = parseInt(elm.val() || 0)
        if (qty >= 1) {
            if (type == 'add' && (oldQty + 1) <= qty) {
                elm.val(oldQty + 1)
            } else if (type == 'min' && (oldQty - 1) >= 1) {
                elm.val(oldQty - 1)
            }
        } else {
            elm.val('المنتج غير متاح')
        }
    })
</script>
</body>
</html>