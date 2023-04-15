<?php
session_start();
if ($_SESSION["email"] != "") {
    $email = $_SESSION["email"];
} else {
    header("Location:http://localhost/pos/index.php");
}
require "mysql.php";
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $role = $row['user_role'];
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>POS-Home</title>
    <!-- CSS files -->
    <link href="./dist/css/tabler.min.css" rel="stylesheet" />
    <link href="./dist/css/tabler-flags.min.css" rel="stylesheet" />
    <link href="./dist/css/tabler-payments.min.css" rel="stylesheet" />
    <link href="./dist/css/tabler-vendors.min.css" rel="stylesheet" />
    <link href="./dist/css/demo.min.css" rel="stylesheet" />
    <script src="./dist/libs/apexcharts/dist/apexcharts.min.js"></script>
</head>

<body>
    <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <a href="index.php" style="text-decoration:none">
                    <h1>Ben Kiwanuka POS</h1>
                </a>
            </h1>
        </div>
    </header>
    <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar navbar-light">
                <div class="container-xl">
                    <ul class="navbar-nav">
                        <li class="nav-item <?php if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == "/pos/dashboard.php") {echo "active"; }?>">
                            <a class="nav-link" href="./dashboard.php">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <polyline points="5 12 3 12 12 3 21 12 19 12"></polyline>
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Home
                                </span>
                            </a>
                        </li>
                        <li class="nav-item <?php if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == "/pos/reports.php") {echo "active"; }?>" <?php if($role != "admin"){echo "hidden"; }?>>
                            <a class="nav-link" href="./reports.php">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                    <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                    <path d="M9 17v-5" />
                                    <path d="M12 17v-1" />
                                    <path d="M15 17v-3" />
                                </svg>
                                </span>
                                <span class="nav-link-title">
                                    Reports
                                </span>
                            </a>
                        </li>
                        <li class="nav-item <?php if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == "/pos/cart.php") {echo "active"; }?>">
                            <a class="nav-link " href="/pos/cart.php">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                                </span>
                                <span class="nav-link-title">
                                    Cart
                                </span>
                            </a>
                        </li>
                        <li class="nav-item dropdown <?php if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == "/pos/product_form.php") {echo "active"; }?>" <?php if($role != "admin"){echo "hidden"; }?>>
                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-producthunt" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10 16v-8h2.5a2.5 2.5 0 1 1 0 5h-2.5"></path>
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                </svg>
                                </span>
                                <span class="nav-link-title">
                                    Products
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="./product_form.php">
                                            Add Products
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <li class="nav-item dropdown <?php if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == "/pos/all_users.php" || parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH) == "/pos/user_form.php") {echo "active"; }?>" <?php if($role != "admin"){echo "hidden"; }?> >
                            <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                </svg>
                                </span>
                                <span class="nav-link-title">
                                    Users
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="./all_users.php">
                                    All Users
                                </a>
                                <a class="dropdown-item" href="./user_form.php">
                                    Add Users
                                </a>
                            </div>
                        </li>
                        
                    </ul>
                    <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                        <form action="logout.php" method="post">
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu" aria-expanded="false">
                                <div class="d-none d-xl-block ps-2">
                                    <div><?php echo $row["email"]; ?></div>
                                    <div class="mt-1 small text-muted"><?php echo $role; ?></div>
                                </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <button type="submit" name="logout" class="dropdown-item">Logout</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    