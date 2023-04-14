<?php
require "nav.php";
require "mysql.php";

// Define SQL query to sum up column
$sql = "SELECT SUM(quantity) AS total_quantity FROM products";

// Execute query and retrieve result
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_products = $row['total_quantity'];


// Define SQL query to sum up column
$sql = "SELECT SUM(quantity) AS total_quantity FROM sales";

// Execute query and retrieve result
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_sales = $row['total_quantity'];

$percentage_sales = number_format((($total_sales) / ($total_products + $total_sales)) * 100, 1);

// Define SQL query to sum up column
$sql = "SELECT SUM(cost) AS total_cost FROM sales";

// Execute query and retrieve result
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_cost = number_format($row['total_cost'], 2, '.', ',');

//cash and credit card

// Define SQL query to sum up column
$sql = "SELECT COUNT(*) AS cash FROM sales WHERE payment_method = 'Cash'";

// Execute query and retrieve result
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_cash = $row['cash'];


// Define SQL query to sum up column
$sql = "SELECT COUNT(*) AS credit FROM sales WHERE payment_method = 'Credit Card'";


// Execute query and retrieve result
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_credit = $row['credit'];

$percentage_cash = number_format((($total_cash) / ($total_cash + $total_credit)) * 100, 0);
$percentage_credit = number_format((($total_credit) / ($total_cash + $total_credit)) * 100, 0);

//histogram code
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
$chart_data = "";
while ($row = $result->fetch_assoc()) {
    $product_products[]  = $row['pname'];
    $quantity_products[] = $row['quantity'];
}

//sakes histogram
$sql = "SELECT pname, SUM(quantity) AS total_quantity FROM sales GROUP BY pname";
$result = $conn->query($sql);

// Check if the query returned any results
if ($result->num_rows > 0) {
    // Create an array to store the data
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $productname[]  = $row['pname'];
        $quantity[] = $row['total_quantity'];
    }
} else {
    // Handle the case where the query returned no results
    echo "No results found";
}
?>
<div class="wrapper">
    <div class="page-wrapper">
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Reports
                        </h2>
                        <div class="page-body">
                            <div class="container-xl">
                                <div class="row row-deck row-cards">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card bg-facebook">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="subheader text-white">Sales</div>
                                                </div>
                                                <div class="h1 mb-3"><?php echo $percentage_sales ?>%</div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card bg-azure">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="subheader text-black">Revenue</div>
                                                </div>
                                                <div class="d-flex align-items-baseline">
                                                    <div class="h1 mb-0 me-2">$<?php echo $total_cost ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card bg-dribbble">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="subheader text-white">Cash Payments</div>
                                                </div>
                                                <div class="d-flex align-items-baseline">
                                                    <div class="h1 mb-0 me-2"><?php echo $percentage_cash ?>%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card bg-github">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="subheader text-white">Credit Card Payments</div>
                                                </div>
                                                <div class="d-flex align-items-baseline">
                                                    <div class="h1 mb-0 me-2"><?php echo $percentage_credit ?>%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-cards mt-2">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h3 class="card-title">Inventory</h3>
                                                </div>
                                                <div id="products"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-cards mt-2">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h3 class="card-title">Sales</h3>
                                                </div>
                                                <div id="sales"></div>
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
?>

<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
        window.ApexCharts && (new ApexCharts(document.getElementById('products'), {
            chart: {
                type: "bar",
                fontFamily: 'inherit',
                height: 320,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: false
                },
            },
            plotOptions: {
                bar: {
                    columnWidth: '25%',
                }
            },
            dataLabels: {
                enabled: false,
            },
            fill: {
                opacity: 1,
            },
            series: [{
                name: "In Stock",
                data: <?php echo json_encode($quantity_products); ?>
            }],
            grid: {
                padding: {
                    top: -20,
                    right: 0,
                    left: -4,
                    bottom: -4
                },
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false
                },
                axisBorder: {
                    show: false,
                },
                categories: <?php echo json_encode($product_products); ?>,
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            colors: ["#206bc4"],
            legend: {
                show: false,
            },
        })).render();
    });
    // @formatter:on
</script>
<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
        window.ApexCharts && (new ApexCharts(document.getElementById('sales'), {
            chart: {
                type: "bar",
                fontFamily: 'inherit',
                height: 320,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: false
                },
            },
            plotOptions: {
                bar: {
                    columnWidth: '25%',
                }
            },
            dataLabels: {
                enabled: false,
            },
            fill: {
                opacity: 1,
            },
            series: [{
                name: "Total Sales",
                data:<?php echo json_encode($quantity)?>
            }],
            grid: {
                padding: {
                    top: -20,
                    right: 0,
                    left: -4,
                    bottom: -4
                },
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false
                },
                axisBorder: {
                    show: false,
                },
                categories:<?php echo json_encode($productname)?>,
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            colors: ["#f78e06"],
            legend: {
                show: false,
            },
        })).render();
    });
    // @formatter:on
</script>