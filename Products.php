<?php

namespace App;

require 'nav.php';

class Products
{
    private static $instance = null;

    //private constructor to prevent instantiation
    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Products();
        }
        return self::$instance;
    }

    public function allProducts()
    {
        include 'mysql.php';

        //execute the SQL query to select all products
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row

?>
            <div class="wrapper">
                <div class="page-wrapper">
                    <div class="container-xl">
                        <!-- Page title -->
                        <div class="page-header d-print-none">
                            <div class="row align-items-center">
                                <div class="col">
                                    <!-- <h2 class="page-title">
                                        Products
                                    </h2> -->
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h2 class="page-title">
                                                Products
                                            </h2>
                                        </div>
                                        <!-- Page title actions -->
                                        <div class="col-auto ms-auto d-print-none">
                                            <div class="btn-list">
                                                <form action="observer.php" method="post">
                                                    <div class="d-flex">
                                                        <input type="text" class="form-control" name="product_id" placeholder="Enter product ID">
                                                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="page-body">
                                        <div class="container-xl">
                                            <div class="row row-cards">
                                                <div class="col-12">
                                                    <?php
                                                    if (isset($_SESSION['status'])) {
                                                    ?>
                                                        <div class="alert alert-warning bg-info alert-dismissible fade show" role="alert">
                                                            <strong>Info:</strong><?php echo $_SESSION['status']; ?>
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    <?php
                                                        unset($_SESSION['status']);
                                                    }
                                                    ?>
                                                    <div class="card">
                                                        <div class="table-responsive">
                                                            <table class="table table-vcenter table-mobile-md card-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Id</th>
                                                                        <th>Product</th>
                                                                        <th>Price</th>
                                                                        <th>Bonus Features</th>
                                                                        <th>Category</th>
                                                                        <th>In stock</th>
                                                                        <th class="w-auto"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    while ($row = $result->fetch_assoc()) {
                                                                    ?>
                                                                        <tr>
                                                                            <td><?php echo $row["id"] ?></td>
                                                                            <td><?php echo $row["pname"] ?></td>
                                                                            <td class="text-muted"><?php echo $row["cost"] ?></td>
                                                                            <td class="text-muted"><?php echo $row["bonus_feature"] ?></td>
                                                                            <td class="text-muted"><?php echo $row["category"] ?></td>
                                                                            <td class="text-muted"><?php echo $row["quantity"] ?></td>
                                                                            <td>
                                                                                <div class="btn-list flex-nowrap">
                                                                                    <div class="dropdown">
                                                                                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                            Actions
                                                                                        </button>
                                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                                            <a class="dropdown-item btn btn-success" href="" onclick="event.preventDefault();
                                                                                    document.getElementById('cart-form-<?php echo $row['id']; ?>').submit();">
                                                                                                Add To Cart
                                                                                            </a>
                                                                                            <form id="cart-form-<?php echo $row["id"]; ?>" action="observer.php" method="POST" class="d-none">
                                                                                                <input type="text" class="form-control" name="product_id" value="<?php echo $row["id"]; ?>">
                                                                                            </form>

                                                                                            <a class="dropdown-item btn btn-info" href="" onclick="event.preventDefault();
                                                                                    document.getElementById('edit-form-<?php echo $row['id']; ?>').submit();">
                                                                                                Edit
                                                                                            </a>
                                                                                            <form id="edit-form-<?php echo $row["id"]; ?>" action="edit.php" method="POST" class="d-none">
                                                                                                <input type="text" class="form-control" name="product_id" value="<?php echo $row["id"]; ?>">
                                                                                            </form>

                                                                                            <a class="dropdown-item btn btn-danger" href="" onclick="event.preventDefault();
                                                                                    document.getElementById('delete-form-<?php echo $row['id']; ?>').submit();">
                                                                                                Delete
                                                                                            </a>
                                                                                            <form id="delete-form-<?php echo $row['id']; ?>" action="delete.php" method="POST" class="d-none">
                                                                                                <input type="text" class="form-control" name="product_id" value="<?php echo $row["id"]; ?>">
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="wrapper">
                <div class="page-wrapper">
                    <div class="container-xl">
                        <!-- Page title -->
                        <div class="page-header d-print-none">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h2 class="page-title">
                                        Products
                                    </h2>
                                    <div class="page-body">
                                        <div class="container-xl">
                                            <div class="row row-cards">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="table-responsive">
                                                            <table class="table table-vcenter table-mobile-md card-table">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="w-full text-center">
                                                                            <h1>No Products in the store</h1>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }

        $conn->close();
    }
}

$products  = Products::getInstance();
echo $products->allProducts();
require 'footer.php';

?>