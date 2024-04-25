<?php
require('system/helper.php');
checkLogin();
$updateSql = "UPDATE cart JOIN products ON cart.product_id = products.id SET cart.price = products.price";
runQuery($updateSql);

$selectSumSql = "SELECT SUM(qty * price) AS total_sum FROM cart WHERE `user_id` = '{$_SESSION['user']['id']}'";
$selectSumResult = runQuery($selectSumSql);

$selectCartSql = "SELECT * FROM cart WHERE `user_id` = '{$_SESSION['user']['id']}'order by id ";

$selectCartResult = runQuery($selectCartSql);


$allCart = [];

if ($selectCartResult->num_rows > 0) {
    while ($row = $selectCartResult->fetch_assoc()) {
        $selectProductSql = "SELECT * FROM products where id = {$row['product_id']}";
        $selectProductResult = runQuery($selectProductSql);
        $product = $selectProductResult->fetch_assoc();
        $smallObject = $row;
        $smallObject['product'] = $product;
        $allCart[] = $smallObject;
    }
}


if (isset($_POST['submit'])) {
    $insertMain = "INSERT INTO `orders` (`user_id`,`grand_total`,`created_at`)VALUES ('{$_SESSION['user']['id']}','{$selectSumResult->fetch_assoc()['total_sum']}',CURRENT_TIMESTAMP)";
    runQuery($insertMain);

    $getLastIdSql = "SELECT * FROM `orders` order by id  DESC";
    $orderId = runQuery($getLastIdSql)->fetch_assoc()['id'];
    foreach ($allCart as $detail){
        $netTotal = $detail['qty']*$detail['price'];
        $insertProducts = "INSERT INTO `order_details` (`order_id`,`product_id`,`qty`,`price`,`net_total`) VALUES ('{$orderId}','{$detail['product_id']}','{$detail['qty']}','{$detail['price']}','{$netTotal}')";
        runQuery($insertProducts);
    }
    $deleteSql = "DELETE FROM cart WHERE `user_id` = '{$_SESSION['user']['id']}'";
    runQuery($deleteSql);
    header("LOCATION: payOrder.php?id={$orderId}");
    die();
}

if (isset($_GET['method']) && $_GET['method'] == 'DELETE' && isset($_GET['id'])) {
    $deleteID = $_GET['id'];
    $sql = "DELETE FROM cart WHERE id = '{$deleteID}'";
    runQuery($sql);
    header('Location: cart.php');
}
if (isset($_GET['method']) && $_GET['method'] == 'UPDATE' && isset($_GET['id']) && isset($_GET['qty'])) {
    $deleteID = $_GET['id'];
    $sql = "UPDATE cart SET `qty`={$_GET['qty']} WHERE id = '{$_GET['id']}'";
    runQuery($sql);
    header('Location: cart.php');
}

?>

?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Astro description">
    <meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <meta name="generator" content="Astro v4.4.7">
    <title>Gift Genius | السلة </title>
    <?php
    include 'layout/assets/css.php';
    ?>
    <link rel="stylesheet" href="./assets/css/cart-D8-10WCZ.css"/>
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
        <div class="container"><h1 class="title capitalize pb-5 text-center fs-r-36 fw-700 line-normal"> السلة <span
                        id="userName"></span></h1>
            <ul class="d-flex items-center  relative">
                <li class="defPage "><a href="index.php" class=""> الصفحة الرئيسية </a></li>
                <li class="separator"></li>
                <li class="linkPage"> السلة</li>
            </ul>
        </div>
    </section>
    <section class="cart">
        <div class="container">
            <div class="row items-start"> <!-- right side -->
                <div class="col-5-lg col-12-md col-12-sm"> <!-- start right -->
                    <div class="price-box round-8 relative mx-6">
                        <?php
                        foreach ($allCart as $row) {
                            $product = $row['product'];
                            ?>
                            <div class="box-price d-flex items-center justify-between py-10 px-6"> <!-- itemsNumber -->
                                <p
                                        class="itemsNumber fs-18 fw-500"><?php echo $product['title'] ?></p>
                                <p class="total fs-18 fw-500"><?php echo($row['qty'] * $product['price']) ?> ر.س</p>
                                <!-- totlal  --> </div>
                            <hr> <!--  -->
                            <?php
                        }

                        if (count($allCart)){
                        ?>
                        <div class="box-price d-flex items-center justify-between py-10 px-6"> <!-- itemsNumber --> <p
                                    class="fs-24 fw-700">الاجمالي</p>
                            <p class="total itemsNumber fs-24 fw-700"><?php echo $selectSumResult->fetch_assoc()['total_sum'] ?>
                                ر.س</p> <!-- totlal  --> </div>
                        <hr>
                        <form action="" method="post" class="d-flex items-center justify-center mx-auto py-10 px-6">
                            <button class="btn btn-skew round-6" name="submit" value="1" type="submit" style="padding: 15px"
                                    aria-label="ادفع الان">ادفع الان</button>
                        </form> <!--  --> </div> <!-- end right --> </div> <!-- left side -->
                <?php
                }
                ?>
                <div class="col-7-lg col-12-md col-12-sm"> <!-- start -left -->
                    <?php
                    foreach ($allCart as $row) {
                        $product = $row['product'];
                        ?>
                        <div class="pro-box d-flex items-center justify-between round-8 py-10 px-6 relative">
                            <!-- img pro -->
                            <div class="pro-details d-flex items-center">
                                <div class="img-pro"><img src="<?php echo $product['image'] ?>" alt="img"
                                                          width="450" height="450" loading="lazy" decoding="async">
                                </div>
                                <p class="name fs-20 fw-700"><?php echo $product['title'] ?></p></div>
                            <!-- quantiy -->
                            <div class="form-group relative">
                                <a href="?method=UPDATE&qty=<?php echo ($row['qty'] >= $product['qty']) ? $row['qty'] : $row['qty'] + 1 ?>&id=<?php echo $row['id'] ?>"
                                   class="btn absolute right-0 top-50 more" type="button" aria-label="more">
                                    +
                                </a>
                                <input type="text" id="quantiy" name="quantiy" value="<?php echo $row['qty'] ?>"
                                       class="text-center round-6">
                                <a href="?method=UPDATE&qty=<?php echo ($row['qty'] <= 1) ? $row['qty'] : $row['qty'] - 1 ?>&id=<?php echo $row['id'] ?>"
                                   class="btn absolute left-0 top-50 mins" type="button" aria-label="more">
                                    -
                                </a>
                            </div> <!-- prices -->
                            <div class="total-prices"><span
                                        class="price fs-30 fw-700"><?php echo($row['qty'] * $product['price']) ?></span>
                                <span
                                        class="price-ks">ر.س</span>
                            </div> <!-- button delete -->
                            <a href="?method=DELETE&id=<?php echo $row['id'] ?>"
                               class="confirmation btn absolute delete-btn top-0 left-0" type="button"
                               aria-label="delete">
                                <svg width="1em" height="1em" viewBox="0 0 24 24" data-icon="delete">
                                    <symbol id="ai:local:delete">
                                        <path fill="currentColor"
                                              d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z"/>
                                    </symbol>
                                    <use xlink:href="#ai:local:delete"></use>
                                </svg>
                            </a>
                        </div> <!-- end left side --> <!-- start -left -->
                        <?php
                    }
                    ?>
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
<script>
    var elemsConfirmation = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {

        if (!confirm('Are you sure?')) e.preventDefault();
    };
    for (var i = 0, l = elemsConfirmation.length; i < l; i++) {
        elemsConfirmation[i].addEventListener('click', confirmIt, false);
    }
</script>
</body>
</html>