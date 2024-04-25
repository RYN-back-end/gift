<?php
require('system/helper.php');
checkLogin();


if (isset($_POST['name']) && isset($_POST['order_id'])) {
    $insertSql = "INSERT INTO `payments` (`name`,`no`,`date`,`cvv`,`user_id`,`order_id`) VALUES ('{$_POST['name']}','{$_POST['no']}','{$_POST['year']}-{$_POST['month']}','{$_POST['cvv']}','{$_SESSION['user']['id']}','{$_POST['order_id']}')";
    runQuery($insertSql);
    header("Location:index.php");
    die();
}


if (isset($_GET['id'])) {
    $order = runQuery("SELECT * FROM `orders` WHERE `id` = '{$_GET['id']}'");
    if ($order->num_rows > 0) {
        $order = $order->fetch_assoc();
    } else {
        header("Location:index.php");
        die();
    }
} else {
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
                        <input type="hidden" name="order_id" value="<?php echo $_GET['id'] ?>">
                        <div class="form-group">
                            <label for="cardHolderName" class="control-label">اسم حامل البطاقة</label>
                            <input type="text" class="form-control" name="name" id="cardHolderName"
                                   placeholder="اسم حامل البطاقة"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="cardNumber" class="control-label">رقم البطاقة</label>
                            <div class="input-group">
                                <input type="text"  class="form-control" name="no" minlength="19" maxlength="19" id="cardNumber"
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
                                    <input type="text" maxlength="3" minlength="3" class="form-control" id="cvCode" name="cvv" placeholder="CV"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-lg btn-block">
                                دفع <?php echo $order['grand_total'] ?> ر.س
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
    $(document).ready(function(){
        $('#cardNumber').on('input', function() {
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
