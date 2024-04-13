<?php
require('../system/helper.php');
checkAdminLogin();

$selectCategoriesSql = 'SELECT * FROM main_categories order by id DESC';
$selectCategoriesResult = runQuery($selectCategoriesSql);

if (isset($_POST['method']) && $_POST['method'] == 'create') {
    $insertSql = "INSERT INTO `main_categories`(`name`) VALUES ('{$_POST['name']}')";
    runQuery($insertSql);
    header("Location: categories.php");
}

if (isset($_POST['method']) && isset($_POST['id']) && $_POST['method'] == 'edit') {
    $updateSql = "UPDATE main_categories SET `name` = '{$_POST['name']}' WHERE `id` = '{$_POST['id']}'";

    runQuery($updateSql);
    header("Location: categories.php");
}

if (isset($_GET['method']) && $_GET['method'] == 'DELETE' && isset($_GET['id'])) {
    $deleteID = $_GET['id'];
    $sql = "DELETE FROM main_categories WHERE id = '{$deleteID}'";
    runQuery($sql);
    header('Location: categories.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../favicon.svg">
    <title>
        Gift Genius | الأقسام الرئيسية
    </title>
    <?php
    include 'layout/assets/css.php';
    ?>

</head>

<body class="g-sidenav-show  bg-gray-200">
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
                            <h6 class="text-white text-capitalize ps-3">الأقسام الرئيسية</h6>
                        </div>
                    </div>
                    <?php echo indexButtons('Add Category') ?>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        id
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Name
                                    </th>
                                    <th class="text-secondary opacity-7">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if ($selectCategoriesResult->num_rows > 0) {
                                    while ($row = $selectCategoriesResult->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td>
                                                <a href="?method=DELETE&id=<?php echo $row['id'] ?>"
                                                   class="btn btn-danger confirmation"><i
                                                            class="material-icons opacity-10">delete</i></a>
                                            <a href="javascript:();"
                                               class="btn btn-info" data-bs-toggle='modal'
                                               data-bs-target='#editModal<?php echo $row['id'] ?>'><i
                                                        class="material-icons opacity-10">edit</i></a></td>
                                        </tr>

                                        <div class="modal fade" id="editModal<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" id="EditForm<?php echo $row['id'] ?>" method="post">
                                                            <input name="method" value="edit" type="hidden">
                                                            <input name="id" value="<?php echo $row['id'] ?>" type="hidden">
                                                            <div class="col-12">
                                                                <div class="mb-2">
                                                                    <label class="form-label">Name</label>
                                                                    <input class="form-control border-1" type="text" required name="name"
                                                                           placeholder="Name" value="<?php echo $row['name'] ?>">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" form="EditForm<?php echo $row['id'] ?>" class="btn btn-primary">Save</button>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="AddForm" method="post">
                        <input name="method" value="create" type="hidden">
                        <div class="col-12">
                            <div class="mb-2">
                                <label class="form-label">Name</label>
                                <input class="form-control border-1" type="text" required name="name"
                                       placeholder="Name">
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

</body>

</html>