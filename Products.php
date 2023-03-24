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
                                                                <thead>
                                                                    <tr>
                                                                        <th>Product Id</th>
                                                                        <th>Product Name</th>
                                                                        <th>Product Price</th>
                                                                        <th>Product Category</th>
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
                                                                            <td class="text-muted"><?php echo $row["category"] ?></td>
                                                                            <td>
                                                                                <div class="btn-list flex-nowrap">
                                                                                    <div class="dropdown">
                                                                                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                            Actions
                                                                                        </button>
                                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                                            <form action="singleton.php" method="post">

                                                                                            </form>
                                                                                            <a class="dropdown-item" href="#">
                                                                                                Delete
                                                                                            </a>
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
            echo "0 results";
        }

        $conn->close();
    }
}

$products  = Products::getInstance();
echo $products->allProducts();
require 'footer.php';

?>