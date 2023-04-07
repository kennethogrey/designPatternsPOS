<?php

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
        $sql = "SELECT * FROM cart";
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
                                    <h2 class="page-title">
                                        Cart
                                    </h2>
                                    <div class="page-body">
                                        <div class="container-xl">
                                            <div class="row row-cards">
                                                <div class="col-12">
                                                    <?php
                                                    if (isset($_SESSION['status'])) {
                                                    ?>
                                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
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
                                                                        <th>Product</th=>
                                                                        <th>Price</th>
                                                                        <th>Quantity</th>
                                                                        <th>Bonus Features</th>
                                                                        <th>Category</th>
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
                                                                            <td>
                                                                                <form action="cart_crud.php" method="post">
                                                                                    <div class="row">
                                                                                        <div class="col">
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control" name="id" value="<?php echo $row['id'] ?>" hidden autocomplete="off">
                                                                                                <input type="text" class="form-control" name="quantity" value="<?php echo $row['quantity'] ?>" autocomplete="off">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-auto">
                                                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </td>
                                                                            <td class="text-muted"><?php echo $row["bonus_feature"] ?></td>
                                                                            <td class="text-muted"><?php echo $row["category"] ?></td>
                                                                            <td>
                                                                                <div class="btn-list flex-nowrap">
                                                                                    <div class="dropdown">
                                                                                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                            Actions
                                                                                        </button>
                                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                                            <a class="dropdown-item btn btn-danger" href="" onclick="event.preventDefault();
                                                                                                document.getElementById('delete-form').submit();">
                                                                                                Delete
                                                                                            </a>
                                                                                            <form id="delete-form" action="cart_crud.php" method="POST" class="d-none">
                                                                                                <input type="hidden" name="product_id" value="<?php echo $row["id"]; ?>">
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
                                            <div class="my-3">
                                                <form action="payment.php" method="post" class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">Checkout Method</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="form-group mb-3 ">
                                                                <label class="form-label">Select Payment Method</label>
                                                                <div>
                                                                    <select class="form-select" required name="payment_method">
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="Credit Card">Credit Card</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer text-end">
                                                        <button type="submit" class="btn btn-success ms-auto">Proceed</button>
                                                    </div>
                                                </form>
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
                                                                            <h1>No Products in the cart</h1>
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