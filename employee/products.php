<?php
require('../system/helper.php');
checkEmployeeLogin();

$selectCategoriesSql = 'SELECT * FROM main_categories order by id DESC';
$selectCategoriesResult = runQuery($selectCategoriesSql);


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
    $insertSql = "INSERT INTO `sub_categories`(`name`,`main_id`) VALUES ('{$_POST['name']}','{$_POST['main_id']}')";
    runQuery($insertSql);
    header("Location: subCategories.php");
}

if (isset($_POST['method']) && isset($_POST['id']) && $_POST['method'] == 'edit') {
    $updateSql = "UPDATE sub_categories SET `name` = '{$_POST['name']}',`main_id`='{$_POST['main_id']}' WHERE `id` = '{$_POST['id']}'";

    runQuery($updateSql);
    header("Location: subCategories.php");
}

if (isset($_GET['method']) && $_GET['method'] == 'DELETE' && isset($_GET['id'])) {
    $deleteID = $_GET['id'];
    $sql = "DELETE FROM sub_categories WHERE id = '{$deleteID}'";
    runQuery($sql);
    header('Location: subCategories.php');
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
                                    <th class="text-secondary opacity-7">العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if ($selectSubCategoriesResult->num_rows > 0) {
                                    while ($row = $selectSubCategoriesResult->fetch_assoc()) {

                                        $selectMainCategorySql = "SELECT * FROM main_categories where id = {$row['main_id']}";
                                        $selectMainCategoryResult = runQuery($selectMainCategorySql);
                                        ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $selectMainCategoryResult->fetch_assoc()['name'] ?></td>
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
                                            <div class="modal-dialog">
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
                                                                <div class="col-6">
                                                                    <div class="mb-2">
                                                                        <label class="form-label">Name</label>
                                                                        <input class="form-control border-1" type="text"
                                                                               required name="name"
                                                                               placeholder="Name"
                                                                               value="<?php echo $row['name'] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="mb-2">
                                                                        <label class="form-label">Main Category</label>
                                                                        <select class="form-control" required
                                                                                name="main_id">
                                                                            <option value="" selected disabled>Chose
                                                                                Main Category
                                                                            </option>

                                                                            <?php if ($selectCategoriesResult->num_rows > 0) {
                                                                                while ($subRow = $selectCategoriesResult->fetch_assoc()) {
                                                                                    ?>
                                                                                    <option value="<?php echo $subRow['id'] ?>" <?php echo $subRow['id'] == $row['main_id'] ? 'selected' : '' ?>><?php echo $subRow['name'] ?></option>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
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
                    <form action="" id="AddForm" method="post">
                        <input name="method" value="create" type="hidden">
                        <div class="row">
                            <div class="col-6">
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
                                    <textarea name="description" class="form-control" required ></textarea>
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
            var newOption = "<option>إختر القسم الفرعي</option>"

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