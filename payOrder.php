<?php
require('system/helper.php');
checkLogin();


$selectSumSql = "SELECT SUM(qty * price) AS total_sum FROM cart WHERE `user_id` = '{$_SESSION['user']['id']}'";
$selectSumResult = runQuery($selectSumSql);

if (isset($_POST['name'])) {

    $insertSql = "INSERT INTO `payments` (`name`,`no`,`date`,`cvv`,`user_id`,`order_id`) VALUES ('{$_POST['name']}','{$_POST['no']}','{$_POST['year']}-{$_POST['month']}','{$_POST['cvv']}','{$_SESSION['user']['id']}','{$_POST['order_id']}')";
    runQuery($insertSql);

    $insertMain = "INSERT INTO `orders` (`user_id`,`grand_total`,`created_at`,`name`,`phone`,`address`)VALUES ('{$_SESSION['user']['id']}','{$selectSumResult->fetch_assoc()['total_sum']}',CURRENT_TIMESTAMP,'{$_POST['user_name']}','{$_POST['user_phone']}','{$_POST['user_address']}')";
    runQuery($insertMain);

    $getLastIdSql = "SELECT * FROM `orders` order by id  DESC";
    $orderId = runQuery($getLastIdSql)->fetch_assoc()['id'];


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


    foreach ($allCart as $detail){
        $netTotal = $detail['qty']*$detail['price'];
        $insertProducts = "INSERT INTO `order_details` (`order_id`,`product_id`,`qty`,`price`,`net_total`) VALUES ('{$orderId}','{$detail['product_id']}','{$detail['qty']}','{$detail['price']}','{$netTotal}')";
        runQuery($insertProducts);
    }
    $deleteSql = "DELETE FROM cart WHERE `user_id` = '{$_SESSION['user']['id']}'";
    runQuery($deleteSql);

    header("Location:index.php");
    die();
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
    <title>Gift Genius | الدفع </title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            direction: rtl;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading text-right">
                    <h3 class="panel-title">بيانات الدفع</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="POST" action="">

                        <div class="row">
                            <div class="col-xs-6 col-md-6">
                                <div class="form-group">
                                    <label for="cardHolderName" class="control-label">رقم الهاتف</label>
                                    <input type="number" class="form-control" name="user_name" id="cardHolderName"
                                           placeholder="رقم الهاتف"
                                           required>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-6">
                                <div class="form-group">
                                    <label for="cardHolderName" class="control-label">الإسم</label>
                                    <input type="text" class="form-control" name="user_phone" id="cardHolderName"
                                           placeholder="الإسم"
                                           required>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="cardHolderName" class="control-label">العنوان</label>
                            <input type="text" class="form-control" name="user_address" id="cardHolderName"
                                   placeholder="العنوان"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="cardHolderName" class="control-label">اسم حامل البطاقة</label>
                            <input type="text" class="form-control" name="name" id="cardHolderName"
                                   placeholder="اسم حامل البطاقة"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="cardNumber" class="control-label">رقم البطاقة</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="no" minlength="19" maxlength="19"
                                       id="cardNumber"
                                       placeholder="رقم البطاقة الصحيح"
                                       required autofocus>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3 col-md-3">
                                <div class="form-group">
                                    <label for="expityMonth">الشهر</label>
                                    <input type="text" class="form-control" name="month" id="expityMonth" maxlength="2"
                                           minlength="2"
                                           placeholder="MM" required>
                                </div>
                            </div>
                            <div class="col-xs-3 col-md-3">
                                <div class="form-group">
                                    <label for="expityMonth">السنة</label>
                                    <input type="text" class="form-control" id="expityYear" name="year" maxlength="2"
                                           minlength="2"
                                           placeholder="YY" required>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-6">
                                <div class="form-group">
                                    <label for="cvCode">CVV</label>
                                    <input type="text" maxlength="3" minlength="3" class="form-control" id="cvCode"
                                           name="cvv" placeholder="CV"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-lg btn-block">
                                دفع <?php echo $selectSumResult->fetch_assoc()['total_sum'] ?> ر.س
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#cardNumber').on('input', function () {
            var cardNumber = $(this).val().replace(/ /g, ''); // إزالة المسافات إذا كانت موجودة
            var formattedCardNumber = '';
            for (var i = 0; i < cardNumber.length; i++) {
                if (i % 4 === 0 && i !== 0) {
                    formattedCardNumber += ' '; // إضافة مسافة كل 4 أرقام
                }
                formattedCardNumber += cardNumber[i];
            }
            $(this).val(formattedCardNumber);
        });
    });
</script>
</body>
</html>
