<?php

include "mysql.php";
require 'nav.php';

$sql = "SELECT SUM(cost) AS total FROM cart";

$result = $conn->query($sql);

$row = $result->fetch_assoc();
$total = $row['total'];

$payment_method = $_POST['payment_method'];

$cvv = rand(100, 999);
$card_number = rand(100000000000, 999999999999);

$random_month = rand(1, 12); // Generate a random month number between 1 and 12
$random_year = rand(2024, 2100); // Generate a random year between 2024 and 2100
$expiry_date = date("m/Y", strtotime($random_year . '-' . $random_month . '-01')); // Combine the month and year and format the date

//first we define an interface for the payment method

interface PaymentStrategy
{
    public function pay($amount);
}

//Next, we'll create concrete classes for each payment option:

class CashPaymentStrategy implements PaymentStrategy
{
    public function pay($amount)
    {
?>
<div class="page-wrapper">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Receipt
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                        <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                            <rect x="7" y="13" width="10" height="8" rx="2"></rect>
                        </svg>
                        Print Receipt
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card card-lg">
                <div class="card-body">
                    <div class="row">
                        <table class="table table-transparent table-responsive">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 1%"></th>
                                    <th>Product</th>
                                    <th class="text-center" style="width: 1%">Qnt</th>
                                    <th class="text-end" style="width: 1%">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //execute the SQL query to select all products
                                include "mysql.php";
                                $sql = "SELECT * FROM cart";
                                $result = $conn->query($sql);
                                $counter = 1;

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td class="text-center"><?php echo $counter;
                                                                    $counter++; ?></td>
                                            <td>
                                                <p class="strong mb-1"><?php echo $row['pname'] ?></p>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['quantity'] ?>
                                            </td>
                                            <td class="text-end"><?php echo $row['cost'] ?></td>
                                        </tr>
                                    <?php
                                    }

                                    ?>
                                    <tr>
                                        <td colspan="4" class="font-weight-bold text-uppercase text-end">Total Due</td>
                                        <td class="font-weight-bold text-end">$
                                            <?php
                                                include "mysql.php";

                                                $sql = "SELECT SUM(cost) AS total FROM cart";

                                                $result = $conn->query($sql);

                                                $row = $result->fetch_assoc();
                                                $total = $row['total'];
                                                echo $total
                                            ?>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                        <p class="text-muted text-center mt-5">Thank you very much for doing business with us. We look forward to working with
                            you again!</p>
                    </div>
                    <form action="inventory_update.php" method="post">
                        <input class="form-check-input" type="text" name="payment_method" value="Cash" hidden>
                        <button type="submit" class="btn btn-primary ms-auto">Finish Transaction</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php

        }
    }
}

class CreditCardPaymentStrategy implements PaymentStrategy
{
    private $cardNumber;
    private $cvv;
    private $expirationDate;

    public function __construct($cardNumber, $cvv, $expirationDate)
    {
        $this->cardNumber = $cardNumber;
        $this->cvv = $cvv;
        $this->expirationDate = $expirationDate;
    }

    public function pay($amount)
    {
        ?>
        <div class="page-wrapper">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Receipt
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                        <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                            <rect x="7" y="13" width="10" height="8" rx="2"></rect>
                        </svg>
                        Print Receipt
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card card-lg">
                <div class="card-body">
                    <div class="row">
                        <table class="table table-transparent table-responsive">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 1%"></th>
                                    <th>Product</th>
                                    <th class="text-center" style="width: 1%">Qnt</th>
                                    <th class="text-end" style="width: 1%">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //execute the SQL query to select all products
                                include "mysql.php";
                                $sql = "SELECT * FROM cart";
                                $result = $conn->query($sql);
                                $counter = 1;

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td class="text-center"><?php echo $counter;
                                                                    $counter++; ?></td>
                                            <td>
                                                <p class="strong mb-1"><?php echo $row['pname'] ?></p>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['quantity'] ?>
                                            </td>
                                            <td class="text-end"><?php echo $row['cost'] ?></td>
                                        </tr>
                                    <?php
                                    }

                                    ?>
                                    <tr>
                                        <td colspan="4" class="font-weight-bold text-uppercase text-end">Total Due</td>
                                        <td class="font-weight-bold text-end">$
                                            <?php
                                                include "mysql.php";

                                                $sql = "SELECT SUM(cost) AS total FROM cart";

                                                $result = $conn->query($sql);

                                                $row = $result->fetch_assoc();
                                                $total = $row['total'];
                                                echo $total
                                            ?>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                        <p class="text-muted text-center mt-5">Thank you very much for doing business with us. We look forward to working with
                            you again!</p>
                    </div>
                    <form action="inventory_update.php" method="post">
                    <input class="form-check-input" type="text" name="payment_method" value="Credit Card" hidden>
                        <button type="submit" class="btn btn-primary ms-auto">Finish Transaction</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
                                }
    }
}

//Now we'll create a class that can take any payment strategy as input:

class PaymentContext
{
    private $paymentStrategy;

    public function __construct(PaymentStrategy $paymentStrategy)
    {
        $this->paymentStrategy = $paymentStrategy;
    }

    public function executePayment($amount)
    {
        $this->paymentStrategy->pay($amount);
    }
}

//Finally, we can use our payment context to execute payments with different strategies:

if ($payment_method == "Cash") {
    $cashPaymentStrategy = new CashPaymentStrategy();
    $paymentContext = new PaymentContext($cashPaymentStrategy);
    $paymentContext->executePayment($total); // Pays $100 in cash.
}

if ($payment_method == "Credit Card") {
    $creditCardPaymentStrategy = new CreditCardPaymentStrategy($card_number, $cvv, $expiry_date);
    $paymentContext = new PaymentContext($creditCardPaymentStrategy);
    $paymentContext->executePayment($total); // Pays $100 with credit card 1234 5678 9012 3456
}

$conn->close();
?>