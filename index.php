<?php
require('system/helper.php');

$selectProductsSql = 'SELECT * FROM products order by id DESC LIMIT 8';
$selectProductsResult = runQuery($selectProductsSql);

?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Astro description">
    <meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <meta name="generator" content="Astro v4.4.7">
    <title>Gift Genius | الصفحة الرئيسية </title>
    <?php
    include 'layout/assets/css.php';
    ?>
    <link rel="stylesheet" href="./assets/css/Categories-YAZY97fB.css"/>
    <link rel="stylesheet" href="./assets/css/index-REGYwDWB.css"/>
    <script type="module" src="./assets/js/hoisted-DKwnRAIk.js"></script>
</head>
<body>
<?php
include 'layout/inc/header.php';
?>
<main>
    <section class="hero">
        <div class="container">
            <div class="row"> <!-- right -->
                <div class="col-4-lg col-12-md col-12-sm">
                    <div class="right-side"><h1 class="fw-700 mb-8"><span class="fs-30">مرحبا بكم في</span> <br>
                            Gifts Genius
                        </h1>
                        <p class="fs-28 fw-600">
                            حيث تكون كل مناسبة مميزة مع الهدية المثالية!
                        </p></div>
                </div> <!-- left -->
                <div class="col-8-lg col-12-md col-12-sm img-col">
                    <div class="img-container"><img src="./assets/images/banner-1-yLlslFNX_Zsr7sH.webp" alt="banner img"
                                                    width="1500" height="1000" loading="lazy" decoding="async"></div>
                </div> <!-- end row --> </div>
        </div>
    </section>
    <section class="LastProduct">
        <div class="mainHeading text-center"><h2 class="fs-48 fw-700 d-inline-block relative ">احدث المنتجات</h2></div>
        <div class="container">
            <div class="row gap-row-1 gap-x-12">
                <?php if ($selectProductsResult->num_rows > 0) {
                    while ($row = $selectProductsResult->fetch_assoc()) {
                        ?>
                        <!--                        <div class="col-3-lg col-6-md col-12-sm">-->
                        <!--                            <a href="productDetails.php?id=--><?php //echo $row['id'] ?><!--">-->
                        <!--                                <div class="card round-8 d-flex product-card">-->
                        <!--                                    <div class="top mx-auto"><img src="-->
                        <?php //echo $row['image'] ?><!--"-->
                        <!--                                                                  alt="img for product" class="img-cover" width="450"-->
                        <!--                                                                  height="450" loading="lazy" decoding="async">-->
                        <!--                                    </div>-->
                        <!--                                    <div class="body mr-1">-->
                        <!--                                        <div class="pb-5">-->
                        <!--                                            <h3 class="fw-700 pb-1 fs-20">-->
                        <?php //echo $row['title'] ?><!-- </h3>-->
                        <!--                                            <p class="price  fw-700 fs-28"> -->
                        <?php //echo $row['price'] ?><!-- ر.س </p></div>-->
                        <!--                                        <p class="des fs-16 pb-6 fw-500 line-normal"> -->
                        <?php //echo $row['description'] ?><!-- </p>-->
                        <!--                                        <button class="btn btn-skew booking-btn mb-1 py-3 round-6 mx-auto d-flex items-center justify-center fs-18 fw-500"-->
                        <!--                                                type="button" aria-label=" التفاصيل"> التفاصيل-->
                        <!--                                        </button>-->
                        <!--                                    </div>-->
                        <!--                                </div>-->
                        <!--                            </a>-->
                        <!--                        </div>-->
                        <div class="col-3-lg col-6-md col-12-sm">
                            <a href="productDetails.php?id=<?php echo $row['id'] ?>">
                                <div class='product-card'>
                                    <img src='<?php echo $row['image'] ?>'
                                         class='card__img'>
                                    <h2 class='card__title'><?php echo $row['title'] ?></h2>
                                    <div class='card__content'>
                                        <div class='card__sizeContainer'>
                                            <p class="card__sizeTitle price fw-700 fs-28"> <?php echo $row['price'] ?>
                                                ر.س </p>
                                        </div>
                                        <div class='card__colorContainer'>
                                            <p class='card__colorTitle'>
                                                <?php
                                                $description = $row['description'];
                                                echo strlen($description) > 120 ? substr($description, 0, 120) . '...' : $description;
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                    <button class="card__link btn btn-skew booking-btn round-8 fs-18 fw-500"
                                            type="button" aria-label=" التفاصيل"> التفاصيل
                                    </button>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <section class="steps">
        <div class="mainHeading text-center"><h2 class="fs-48 fw-700 d-inline-block relative ">خطوات العمل</h2></div>
        <div class="container">
            <div class="row">
                <div class="col-3-lg col-6-md col-12-sm">
                    <div class="box d-flex items-start mt-14">
                        <div class="icon-box">
                            <svg width="24" height="24" viewBox="0 0 24 24" data-icon="gift-icon">
                                <symbol id="ai:local:gift-icon">
                                    <path fill="currentColor"
                                          d="M11 14v8H7a3 3 0 0 1-3-3v-4a1 1 0 0 1 1-1zm8 0a1 1 0 0 1 1 1v4a3 3 0 0 1-3 3h-4v-8zM16.5 2a3.5 3.5 0 0 1 3.163 5H20a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-7V7h-2v5H4a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h.337A3.486 3.486 0 0 1 4 5.5C4 3.567 5.567 2 7.483 2c1.755-.03 3.312 1.092 4.381 2.934l.136.243c1.033-1.914 2.56-3.114 4.291-3.175zm-9 2a1.5 1.5 0 0 0 0 3h3.143C9.902 5.095 8.694 3.98 7.5 4m8.983 0c-1.18-.02-2.385 1.096-3.126 3H16.5a1.5 1.5 0 1 0-.017-3"/>
                                </symbol>
                                <use xlink:href="#ai:local:gift-icon"></use>
                            </svg>
                        </div>
                        <div class="details-box pr-5"><h3 class="fs-36 fw-700 line-relaxed">ختار الهدية</h3>
                            <p class="fs-18 fw-500 line-relaxed">
                                تقدم مجموعة متنوعة من الهدايا لجميع المناسبات
                            </p></div>
                    </div>
                </div>
                <div class="col-3-lg col-6-md col-12-sm">
                    <div class="box d-flex items-start mt-14">
                        <div class="icon-box">
                            <svg width="24" height="24" viewBox="0 0 512 512" data-icon="cart2">
                                <symbol id="ai:local:cart2">
                                    <circle cx="176" cy="416" r="32" fill="currentColor"/>
                                    <circle cx="400" cy="416" r="32" fill="currentColor"/>
                                    <path fill="currentColor"
                                          d="M167.78 304h261.34l38.4-192H133.89l-8.47-48H32v32h66.58l48 272H432v-32H173.42z"/>
                                </symbol>
                                <use xlink:href="#ai:local:cart2"></use>
                            </svg>
                        </div>
                        <div class="details-box pr-5"><h3 class="fs-36 fw-700 line-relaxed">اشتري الهدية</h3>
                            <p class="fs-18 fw-500 line-relaxed">يمكنك التسوق والدفع لدينا بافضل الطرق</p></div>
                    </div>
                </div>
                <div class="col-3-lg col-6-md col-12-sm">
                    <div class="box d-flex items-start mt-14">
                        <div class="icon-box">
                            <svg width="24" height="24" viewBox="0 0 24 24" data-icon="car">
                                <symbol id="ai:local:car">
                                    <path fill="currentColor"
                                          d="M21.6 11.22 17 7.52V5a1.91 1.91 0 0 0-1.81-2H3.79A1.91 1.91 0 0 0 2 5v10a2 2 0 0 0 1.2 1.88 3 3 0 1 0 5.6.12h6.36a3 3 0 1 0 5.64 0h.2a1 1 0 0 0 1-1v-4a1 1 0 0 0-.4-.78M20 12.48V15h-3v-4.92ZM7 18a1 1 0 1 1-1-1 1 1 0 0 1 1 1m12 0a1 1 0 1 1-1-1 1 1 0 0 1 1 1"/>
                                </symbol>
                                <use xlink:href="#ai:local:car"></use>
                            </svg>
                        </div>
                        <div class="details-box pr-5"><h3 class="fs-36 fw-700 line-relaxed">ارسال الهدية</h3>
                            <p class="fs-18 fw-500 line-relaxed">
                                يمكنك ارسال الهدية للشخص الذي تريد ما عليك سوى اخطارنا بالمعلومات
                                المطلوبة
                            </p></div>
                    </div>
                </div>
                <div class="col-3-lg col-6-md col-12-sm">
                    <div class="box d-flex items-start mt-14">
                        <div class="icon-box">
                            <svg width="24" height="24" viewBox="0 0 24 24" data-icon="car">
                                <use xlink:href="#ai:local:car"></use>
                            </svg>
                        </div>
                        <div class="details-box pr-5"><h3 class="fs-36 fw-700 line-relaxed"> يقترح هدية </h3>
                            <p class="fs-18 fw-500 line-relaxed">
                                اذا كنت لا تجيد اختيار الهدايا المناسبة يكن للذكاء الاصطناعي لدينا مساعدتك
                            </p></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
include 'layout/inc/footer.php';
?>
</body>
</html>