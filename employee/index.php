<?php
require('../system/helper.php');
checkEmployeeLogin();
$selectOrdersSql = "SELECT * FROM `orders`  order by id";
$selectOrdersResult = runQuery($selectOrdersSql);
$allOrders = [];
if ($selectOrdersResult->num_rows > 0) {
    while ($row = $selectOrdersResult->fetch_assoc()) {
        $allOrders[] = $row;
    }
}
if (isset($_GET['method']) && $_GET['method'] == 'UPDATE' && isset($_GET['id']) && isset($_GET['status'])) {
    $deleteID = $_GET['id'];
    $sql = "UPDATE `orders` SET `status`= '{$_GET['status']}' WHERE id = '{$_GET['id']}'";
    runQuery($sql);
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../favicon.svg">
    <title>
        Gift Genius | الطلبات
    </title>
    <!--     Fonts and icons     -->
    <?php
    include 'layout/assets/css.php';
    ?>

</head>
<style>
    .table-div {
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
<body class="g-sidenav-show rtl  bg-gray-200">
<?php
include 'layout/inc/sidebar.php'
?>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php
    include 'layout/inc/header.php';
    ?>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">الطلبات</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        رقم الطلب
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        اسم العميل
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        حالة الطلب
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        تاريخ الطلب
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        المبلغ الاجمالي
                                    </th>
                                    <th class="text-secondary opacity-7">المنتجات</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($allOrders as $key => $order) {

                                    $selectOrderDetailsSql = "SELECT * FROM `order_details` WHERE `order_id` = '{$order['id']}'";
                                    $selectOrderDetailResult = runQuery($selectOrderDetailsSql);
                                    $user = runQuery("SELECT * FROM `users` WHERE `id` = '{$_SESSION['user']['id']}'")->fetch_assoc();
                                    ?>
                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td><?php echo $user['name'] ?></td>
                                        <td><?php
                                            if ($order['status'] == 'new') {
                                                echo "<a href='?method=UPDATE&id={$order['id']}&status=accepted' class='btn btn-success'>قبول</a><a  href='?method=UPDATE&id={$order['id']}&status=refused' class='btn btn-danger'>رفض</a>";
                                            } elseif ($order['status'] == 'accepted') {
                                                echo "<a href='?method=UPDATE&id={$order['id']}&status=in_progress' class='btn btn-success'>تجهيز</a>";
                                            }  elseif ($order['status'] == 'in_progress') {
                                                echo "<a href='?method=UPDATE&id={$order['id']}&status=on_way' class='btn btn-success'>شحن</a>";
                                            } elseif ($order['status'] == 'on_way') {
                                                echo "<a href='?method=UPDATE&id={$order['id']}&status=ended' class='btn btn-success'>إنهاء</a>";
                                            } elseif ($order['status'] == 'ended') {
                                                echo 'تم الإنهاء';
                                            }
                                            ?></td>
                                        <td><?php echo date('Y-m-d h:i A', strtotime($order['created_at'])) ?></td>
                                        <td><?php echo $order['grand_total'] ?> ر.س</td>
                                        <td>
                                            <button class="btn btn-info" data-bs-toggle='modal'
                                                    data-bs-target='#products<?php echo $order['id'] ?>'>
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15"
                                                     x="0"
                                                     y="0" viewBox="0 0 488.85 488.85"
                                                     style="enable-background:new 0 0 512 512" xml:space="preserve"><g>
                                                        <path d="M244.425 98.725c-93.4 0-178.1 51.1-240.6 134.1-5.1 6.8-5.1 16.3 0 23.1 62.5 83.1 147.2 134.2 240.6 134.2s178.1-51.1 240.6-134.1c5.1-6.8 5.1-16.3 0-23.1-62.5-83.1-147.2-134.2-240.6-134.2zm6.7 248.3c-62 3.9-113.2-47.2-109.3-109.3 3.2-51.2 44.7-92.7 95.9-95.9 62-3.9 113.2 47.2 109.3 109.3-3.3 51.1-44.8 92.6-95.9 95.9zm-3.1-47.4c-33.4 2.1-61-25.4-58.8-58.8 1.7-27.6 24.1-49.9 51.7-51.7 33.4-2.1 61 25.4 58.8 58.8-1.8 27.7-24.2 50-51.7 51.7z"
                                                              fill="white" opacity="1" data-original="white"></path>
                                                    </g></svg>
                                            </button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="products<?php echo $order['id'] ?>" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">تفاصيل الطلب رقم <?php echo $order['id']?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
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
                                                                    <div class="table-cell"><img style="width: 50px;height: 50px" onclick="window.open(this.src)" src="../<?php echo $product['image']?>"></div>
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
                                        </div>
                                    </div>
                                    <?php
                                } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include 'layout/inc/footer.php';
        ?>
    </div>

    <!-- End Navbar -->
</main>
<?php
include 'layout/assets/js.php';
?>

</body>

</html>