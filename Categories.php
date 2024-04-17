<?php
require('system/helper.php');
$selectOtherProductsSql = "SELECT * FROM products WHERE sub_category_id =  '{$_GET['id']}'";
$selectOtherProductsResult = runQuery($selectOtherProductsSql);
$categorySql = "SELECT * FROM sub_categories WHERE id =  '{$_GET['id']}'";
$selectCategoryResult = runQuery($categorySql);
$category = $selectCategoryResult->fetch_assoc();

?>
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
    <link rel="stylesheet" href="./assets/css/Categories-CNS4Ug1L.css"/>
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
        <div class="container"><h1 class="title capitalize pb-5 text-center fs-r-36 fw-700 line-normal"> عيد الحب <span
                        id="userName"></span></h1>
            <ul class="d-flex items-center  relative">
                <li class="defPage "><a href="index.php" class=""> الصفحة الرئيسية </a></li>
                <li class="separator"></li>
                <li class="linkPage"><?php echo $category['name'] ?></li>
            </ul>
        </div>
    </section>
    <section class="LastProduct">
        <div class="mainHeading text-center"><h2 class="fs-48 fw-700 d-inline-block relative ">منتجات <?php echo $category['name'] ?> </h2>
        </div>
        <div class="container">
            <div class="row gap-row-1 gap-x-12">
                <?php if ($selectOtherProductsResult->num_rows > 0) {
                    while ($row = $selectOtherProductsResult->fetch_assoc()) {
                        ?>
                        <div class="col-3-lg col-6-md col-12-sm"><a
                                    href="productDetails.php?id=<?php echo $row['id'] ?>">
                                <div class="card round-8 d-flex">
                                    <div class="top mx-auto"><img src="<?php echo $row['image'] ?>"
                                                                  alt="img for product" class="img-cover" width="450"
                                                                  height="450" loading="lazy" decoding="async"></div>
                                    <div class="body mr-1">
                                        <div class="pb-5"><h3
                                                    class="fw-700 pb-1 fs-20"><?php echo $row['title'] ?> </h3>
                                            <p class="price  fw-700 fs-28"> <?php echo $row['price'] ?> ر.س </p></div>
                                        <p class="des fs-16 pb-6 fw-500 line-normal"> <?php echo $row['description'] ?> </p>
                                        <button class="btn btn-skew booking-btn mb-1 py-3 round-6 mx-auto d-flex items-center justify-center fs-18 fw-500"
                                                type="button" aria-label=" التفاصيل"> التفاصيل
                                        </button>
                                    </div> <!-- end --> </div>
                            </a></div>
                        <?php
                    }
                }
                ?>
            </div>
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