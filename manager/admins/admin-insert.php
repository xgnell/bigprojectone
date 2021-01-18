<?php
    define("MENU_OPTION", "admin");
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(1);

    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <title>Quản lý admin</title>
</head>
<body>
    <!-- Header menu -->
    <?php include_once($root_path . "/manager/templates/header.php"); ?>
    <div class="page-body">
        <!-- Slide menu -->
        <?php include_once($root_path . "/manager/templates/menu.php"); ?>
        <!-- Main content -->
        <div class="page-content">
            <!-- Admin insertion form -->
            <form action="/manager/admins/admin-insert-process.php" method="POST">
                Tên: <input type="text" name="name"><br>
                Giới tính: <select name="gender">
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                </select>
                Ngày tháng năm sinh: <input type="date" name="birth"><br>
                Điện thoại: <input type="text" name="phone"><br>
                Email: <input type="text" name="email"><br>
                Mật khẩu: <input type="password" name="passwd"><br>

                <?php
                    // Get admin ranks
                    $admin_ranks = sql_query("
                        SELECT *
                        FROM admin_ranks;
                    ");
                ?>

                <!-- Chỉ có super admin mới được chọn -->
                Chọn cấp độ: <select name="rank">
                    <!-- Generate rank level options -->
                    <?php foreach ($admin_ranks as $admin_rank): ?>
                        <option value="<?= $admin_rank["id"] ?>"><?= $admin_rank["name"] ?></option>
                    <?php endforeach ?>
                </select>
                
                <br>
                <input type="submit" value="Thêm admin">
                <input type="reset" value="Làm lại">
            </form>
        </div>
    </div>
</body>
</html>
