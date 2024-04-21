<?php
require('../system/helper.php');
checkEmployeeLogin();

$selectProductsSql = 'SELECT * FROM products order by id DESC';
$selectProductsResult = runQuery($selectProductsSql);


$selectCategoriesSql2 = 'SELECT * FROM main_categories order by id DESC';
$selectCategoriesResult2 = runQuery($selectCategoriesSql2);


$selectSubCategoriesSql = 'SELECT * FROM sub_categories order by id DESC';
$selectSubCategoriesResult = runQuery($selectSubCategoriesSql);

$subCategoriesArray = [];
if ($selectSubCategoriesResult->num_rows > 0) {
    while ($row = $selectSubCategoriesResult->fetch_assoc()) {
        $subCategoriesArray[] = $row;
    }
}
// Encode the PHP array into JSON format
$subCategoriesJson = json_encode($subCategoriesArray);


if (isset($_POST['method']) && $_POST['method'] == 'create') {

    $imagePath = "";
    if (isset($_FILES['image']) && $_FILES['image']) {
        $errors = array();
        $file_name = (time() * 2) . '.jpg';
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        if ($file_size > 2097152) {
            header("Location: products.php?error=The image size must be less than 2MB");
        }
        if (move_uploaded_file($file_tmp, "../uploads/products/" . $file_name)) {
            $imagePath = "uploads/products/" . $file_name;
        }
    }


    $insertSql = "INSERT INTO `products`(`title`,`category_id`,`sub_category_id`,`image`,`price`,`qty`,`description`) VALUES ('{$_POST['title']}','{$_POST['category_id']}','{$_POST['sub_category_id']}','{$imagePath}','{$_POST['price']}','{$_POST['qty']}','{$_POST['description']}')";

    runQuery($insertSql);
    header("Location: products.php");
}

if (isset($_POST['method']) && isset($_POST['id']) && $_POST['method'] == 'edit') {
    $imagePath = "";
    if (isset($_FILES['image']) && $_FILES['image']) {
        $errors = array();
        $file_name = (time() * 2) . '.jpg';
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        if ($file_size > 2097152) {
            header("Location: products.php?error=The image size must be less than 2MB");
        }
        if (move_uploaded_file($file_tmp, "../uploads/products/" . $file_name)) {
            $imagePath = "uploads/products/" . $file_name;
        }
    }


    $updateSql = "UPDATE Set `products`(`title`,`category_id`,`sub_category_id`,`image`,`price`,`qty`,`description`) VALUES ('{$_POST['title']}','{$_POST['category_id']}','{$_POST['sub_category_id']}','{$imagePath}','{$_POST['price']}','{$_POST['qty']}','{$_POST['description']}')";


    runQuery($updateSql);
    header("Location: subCategories.php");
}

if (isset($_GET['method']) && $_GET['method'] == 'DELETE' && isset($_GET['id'])) {
    $deleteID = $_GET['id'];
    $sql = "DELETE FROM products WHERE id = '{$deleteID}'";
    runQuery($sql);
    header('Location: products.php');
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
        Gift Genius | المنتجات
    </title>
    <?php
    include 'layout/assets/css.php';
    ?>

</head>

<body class="g-sidenav-show rtl bg-gray-200">
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
                            <h6 class="text-white text-capitalize ps-3">المنتجات</h6>
                        </div>
                    </div>
                    <?php echo indexButtons('إضافة منتج') ?>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        #
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        اسم المنتج
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        القسم الرئيسي
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        القسم الفرعي
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        السعر
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        الوصف
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        الكمية
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        الصورة
                                    </th>

                                    <th class="text-secondary opacity-7">العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if ($selectProductsResult->num_rows > 0) {
                                    while ($row = $selectProductsResult->fetch_assoc()) {

                                        $selectProductMainCategorySql = "SELECT * FROM main_categories where id = {$row['category_id']}";
                                        $selectProductMainCategoryResult = runQuery($selectProductMainCategorySql);
                                        $selectProductSubCategorySql = "SELECT * FROM sub_categories where id = {$row['sub_category_id']}";
                                        $selectProductSubCategoryResult = runQuery($selectProductSubCategorySql);
                                        ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['title'] ?></td>
                                            <td><?php echo $selectProductMainCategoryResult->fetch_assoc()['name'] ?></td>
                                            <td><?php echo $selectProductSubCategoryResult->fetch_assoc()['name'] ?></td>
                                            <td><?php echo $row['price'] ?></td>
                                            <td><?php echo $row['description'] ?></td>
                                            <td><?php echo $row['qty'] ?></td>
                                            <td><img src="../<?php echo $row['image'] ?>"
                                                     style="width: 100px;height: 80px"></td>
                                            <td>
                                                <a href="?method=DELETE&id=<?php echo $row['id'] ?>"
                                                   class="btn btn-danger confirmation"><i
                                                            class="material-icons opacity-10">delete</i></a>
                                                <a href="javascript:();"
                                                   class="btn btn-info" data-bs-toggle='modal'
                                                   data-bs-target='#editModal<?php echo $row['id'] ?>'><i
                                                            class="material-icons opacity-10">edit</i></a></td>
                                        </tr>

                                        <div class="modal fade" id="editModal<?php echo $row['id'] ?>" tabindex="-1"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit
                                                            Category</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" id="EditForm<?php echo $row['id'] ?>"
                                                              method="post">
                                                            <input name="method" value="edit" type="hidden">
                                                            <input name="id" value="<?php echo $row['id'] ?>"
                                                                   type="hidden">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <div class="mb-2">
                                                                        <label class="form-label">اسم المنتج</label>
                                                                        <input class="form-control border-1" type="text" required name="title"
                                                                               placeholder="اسم المنتج">
                                                                    </div>
                                                                </div>
                                                                <div class="col-3">
                                                                    <div class="mb-2">
                                                                        <label class="form-label">السعر</label>
                                                                        <input class="form-control border-1" type="number" required name="price"
                                                                               placeholder="السعر">
                                                                    </div>
                                                                </div>
                                                                <div class="col-3">
                                                                    <div class="mb-2">
                                                                        <label class="form-label">الكمية</label>
                                                                        <input class="form-control border-1" type="number" required name="qty"
                                                                               placeholder="الكمية">
                                                                    </div>
                                                                </div>
                                                                <div class="col-3">
                                                                    <div class="mb-2">
                                                                        <label class="form-label">القسم الرئيسي</label>
                                                                        <select class="form-control" required id="category_id_create" name="category_id">
                                                                            <option value="" selected disabled>اختر القسم الرئيسي</option>

                                                                            <?php if ($selectCategoriesResult2->num_rows > 0) {
                                                                                while ($SubRow2 = $selectCategoriesResult2->fetch_assoc()) {
                                                                                    ?>
                                                                                    <option value="<?php echo $SubRow2['id'] ?>"><?php echo $SubRow2['name'] ?></option>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3">
                                                                    <div class="mb-2">
                                                                        <label class="form-label">القسم الفرعي</label>
                                                                        <select class="form-control" required id="sub_category_id_create"
                                                                                name="sub_category_id">
                                                                            <option value="" selected disabled>اختر القسم الرئيسي اولاً</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="mb-2">
                                                                        <label class="form-label">الوصف</label>
                                                                        <textarea name="description" class="form-control" required></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3">
                                                                    <div class="mb-2">
                                                                        <label class="form-label">الصورة</label>
                                                                        <input name="image" type="file" class="form-control" required>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close
                                                        </button>
                                                        <button type="submit" form="EditForm<?php echo $row['id'] ?>"
                                                                class="btn btn-primary">
                                                            Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                }
                                ?>
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

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">إضافة منتج</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="AddForm" method="post" enctype="multipart/form-data">
                        <input name="method" value="create" type="hidden">
                        <div class="row">
                            <div class="col-3">
                                <div class="mb-2">
                                    <label class="form-label">اسم المنتج</label>
                                    <input class="form-control border-1" type="text" required name="title"
                                           placeholder="اسم المنتج">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-2">
                                    <label class="form-label">السعر</label>
                                    <input class="form-control border-1" type="number" required name="price"
                                           placeholder="السعر">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-2">
                                    <label class="form-label">الكمية</label>
                                    <input class="form-control border-1" type="number" required name="qty"
                                           placeholder="الكمية">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-2">
                                    <label class="form-label">القسم الرئيسي</label>
                                    <select class="form-control" required id="category_id_create" name="category_id">
                                        <option value="" selected disabled>اختر القسم الرئيسي</option>

                                        <?php if ($selectCategoriesResult2->num_rows > 0) {
                                            while ($SubRow2 = $selectCategoriesResult2->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $SubRow2['id'] ?>"><?php echo $SubRow2['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-2">
                                    <label class="form-label">القسم الفرعي</label>
                                    <select class="form-control" required id="sub_category_id_create"
                                            name="sub_category_id">
                                        <option value="" selected disabled>اختر القسم الرئيسي اولاً</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label class="form-label">الوصف</label>
                                    <textarea name="description" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-2">
                                    <label class="form-label">الصورة</label>
                                    <input name="image" type="file" class="form-control" required>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="AddForm" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- End Navbar -->
</main>
<?php
include 'layout/assets/js.php';
?>
<script src="./assets/js/jquery-3.7.1.js"></script>

<script>
    var arrayOfObjects = <?php echo $subCategoriesJson; ?>;
    $(document).on('change', '#category_id_create', function () {
        var id = $(this).val()
        var selectElement = document.getElementById('sub_category_id_create');

        var filteredArray = $.grep(arrayOfObjects, function (obj) {
            if (obj.main_id !== id) {
                return false;
            }
            return true;
        });
        if (filteredArray.length > 0) {
            var newOption = "<option value='' selected disabled>إختر القسم الفرعي</option>"

        } else {
            var newOption = "<option>لا يوجد بيانات إختر قسم اخر</option>"
        }
        selectElement.innerHTML = newOption
        filteredArray.forEach(function (option) {
            var optionElement = document.createElement('option');
            optionElement.value = option.id;
            optionElement.textContent = option.name;
            selectElement.appendChild(optionElement);
        });
    })
</script>

</body>

</html>