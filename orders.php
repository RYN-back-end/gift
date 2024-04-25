<?php
require('system/helper.php');
checkLogin();
$selectOrdersSql = "SELECT * FROM `orders` WHERE `user_id` = '{$_SESSION['user']['id']}'";
$selectOrdersResult = runQuery($selectOrdersSql);
$allOrders = [];
if ($selectOrdersResult->num_rows > 0) {
    while ($row = $selectOrdersResult->fetch_assoc()) {
        $allOrders[] = $row;
    }
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
    <title>Gift Genius | السلة </title>
    <?php
    include 'layout/assets/css.php';
    ?>
    <link rel="stylesheet" href="./assets/css/cart-D8-10WCZ.css"/>
    <link rel="stylesheet" href="./assets/css/Categories-YAZY97fB.css"/>
    <script type="module" src="./assets/js/hoisted-DKwnRAIk.js"></script>
</head>
<style>
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 3; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 10% auto; /* 10% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
        border-radius: 10px; /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Box shadow */
    }

    /* Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    #table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #table td, #table th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #table tr:hover {
        background-color: #ddd;
    }

    #table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #CF556850;
        color: white;
    }

    .table {
        display: table;
        width: 100%;
        border-collapse: collapse;
    }

    .table-row {
        display: table-row;
    }

    .table-cell {
        display: table-cell;
        border: 1px solid #ddd;
        padding: 8px;
    }

    .header {
        font-weight: bold;
        background-color: #f2f2f2;
    }

</style>
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
                <li class="linkPage"> الطلبات</li>
            </ul>
        </div>
    </section>
    <section class="cart">
        <div class="container">
            <div class="row items-start"> <!-- right side -->
                <div class="col-12-lg col-12-md col-12-sm"> <!-- start right -->
                    <div class="price-box round-8 relative mx-6">


                        <table id="table">
                            <tr>
                                <th>#</th>
                                <th>تاريخ الطلب</th>
                                <th>الإجمالى</th>
                                <th>الحالة</th>
                                <th>المنتجات</th>
                            </tr>
                            <?php
                            foreach ($allOrders as $key => $order) {

                                $selectOrderDetailsSql = "SELECT * FROM `order_details` WHERE `order_id` = '{$order['id']}'";
                                $selectOrderDetailResult = runQuery($selectOrderDetailsSql);
                                ?>
                                <tr>
                                    <td><?php echo $key + 1 ?></td>
                                    <td><?php echo date('Y-m-d h:i A', strtotime($order['created_at'])) ?></td>
                                    <td><?php echo $order['grand_total'] ?> ر.س</td>
                                    <td><?php
                                        if ($order['status'] == 'new') {
                                            echo 'جديد';
                                        } elseif ($order['status'] == 'accepted') {
                                            echo 'تم القبول';
                                        } elseif ($order['status'] == 'refused') {
                                            echo 'تم الرفض';
                                        } elseif ($order['status'] == 'in_progress') {
                                            echo 'جاري التجهيز';
                                        } elseif ($order['status'] == 'on_way') {
                                            echo 'فى الطريق';
                                        } elseif ($order['status'] == 'ended') {
                                            echo 'تم الإنهاء';
                                        }
                                        ?></td>
                                    <td>
                                        <button class="btn btn-skew round-6 openModal"
                                                data-modal="myModal<?php echo $order['id'] ?>"
                                                style="padding: 5px;width: 35px">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" x="0"
                                                 y="0" viewBox="0 0 488.85 488.85"
                                                 style="enable-background:new 0 0 512 512" xml:space="preserve"><g>
                                                    <path d="M244.425 98.725c-93.4 0-178.1 51.1-240.6 134.1-5.1 6.8-5.1 16.3 0 23.1 62.5 83.1 147.2 134.2 240.6 134.2s178.1-51.1 240.6-134.1c5.1-6.8 5.1-16.3 0-23.1-62.5-83.1-147.2-134.2-240.6-134.2zm6.7 248.3c-62 3.9-113.2-47.2-109.3-109.3 3.2-51.2 44.7-92.7 95.9-95.9 62-3.9 113.2 47.2 109.3 109.3-3.3 51.1-44.8 92.6-95.9 95.9zm-3.1-47.4c-33.4 2.1-61-25.4-58.8-58.8 1.7-27.6 24.1-49.9 51.7-51.7 33.4-2.1 61 25.4 58.8 58.8-1.8 27.7-24.2 50-51.7 51.7z"
                                                          fill="white" opacity="1" data-original="white"></path>
                                                </g></svg>
                                        </button>
                                    </td>
                                </tr>
                                <div id="myModal<?php echo $order['id'] ?>" class="modal" style="display: none">

                                    <span class="close">&times;</span>

                                    <div class="modal-content">
                                        <div class="table">
                                            <div class="table-row header">
                                                <div class="table-cell">اسم المنتج</div>
                                                <div class="table-cell">الصورة</div>
                                                <div class="table-cell">السعر</div>
                                                <div class="table-cell">الكمية</div>
                                                <div class="table-cell">الإجمالى</div>
                                            </div>
                                            <?php
                                            if ($selectOrderDetailResult->num_rows > 0) {
                                                while ($orderDetail = $selectOrderDetailResult->fetch_assoc()) {
                                                    $product = runQuery("SELECT * FROM `products` WHERE `id` = '{$orderDetail['product_id']}'")->fetch_assoc();
                                                    ?>
                                                    <div class="table-row">
                                                        <div class="table-cell"><?php echo $product['title']?></div>
                                                        <div class="table-cell"><img style="width: 50px;height: 50px" onclick="window.open(this.src)" src="<?php echo $product['image']?>"></div>
                                                        <div class="table-cell"><?php echo $orderDetail['price']?> ر.س </div>
                                                        <div class="table-cell"><?php echo $orderDetail['qty']?>  </div>
                                                        <div class="table-cell"><?php echo $orderDetail['net_total']?> ر.س </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>

                                        </div>

                                    </div>

                                </div>
                                <?php
                            } ?>

                        </table>


                    </div>

                </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    var activeModal = null;
    $(document).on('click', '.openModal', function () {
        $('.modal').css('display', 'none')
        var modal = $(this).data('modal');
        $(`#${modal}`).css('display', 'block')
        activeModal = document.getElementById(`${modal}`);
    })

    window.onclick = function (event) {
        if (event.target == activeModal) {
            activeModal.style.display = "none";
        }
    }
</script>
</body>
</html>