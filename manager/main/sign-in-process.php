<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];
require_once($root_path . "/config/db.php");

// Get sign in data
$admin_email = $_POST["email"];
$admin_passwd = $_POST["passwd"];

// Validate in database
$result = sql_query("
    SELECT *
    FROM admins
    WHERE email='$admin_email' AND passwd='$admin_passwd';
");

if (mysqli_num_rows($result) == 1) {
    // Sign in success
    $admin = mysqli_fetch_array($result);
    // Get admin rank
    $admin_rank = sql_query("
        SELECT name, level
        FROM admin_ranks
        WHERE id = {$admin["id_rank"]};
    ");
    $admin_rank = mysqli_fetch_array($admin_rank);

    session_start();
    $_SESSION["user"] = [
        "type" => "admin",
        "admin" => [
            "id" => $admin["id"],
            "name" => $admin["name"],
            "rank" => [
                "name" => $admin_rank["name"],
                "level" => $admin_rank["level"]
            ]
        ]
    ];
    header("location:/manager/main/main-manager.php");
} else {
    // Sign in failure
    ?>
    <!-- //////////////////////////// Failure page ////////////////////////////// -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign in failure</title>
    </head>
    <body>
        <h1>You typed wrong email or password</h1>
        <a href="/manager/main/sign-in.php">Back</a>
    </body>
    </html>
    <!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
<?php } ?>