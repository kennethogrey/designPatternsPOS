<?php

namespace App;

require 'nav.php';

class Users
{
    private static $instance = null;

    //private constructor to prevent instantiation
    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Users();
        }
        return self::$instance;
    }

    public function allUsers()
    {
        include 'mysql.php';
        $email = $_SESSION["email"];

        //execute the SQL query to select all products
        $sql = "SELECT * FROM users WHERE email != '$email'";
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
                                                Users
                                            </h2>
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
                                                                        <th>Email</th>
                                                                        <th>Role</th>
                                                                        <th class="w-auto"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    while ($row = $result->fetch_assoc()) {
                                                                    ?>
                                                                        <tr>
                                                                            <td><?php echo $row["id"] ?></td>
                                                                            <td><?php echo $row["email"] ?></td>
                                                                            <td class="text-muted"><?php echo $row["user_role"] ?></td>
                                                                            <td>
                                                                                <div class="btn-list flex-nowrap">
                                                                                    <div class="dropdown">
                                                                                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                            Actions
                                                                                        </button>
                                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                                            <a class="dropdown-item btn btn-info" href="" onclick="event.preventDefault();
                                                                                    document.getElementById('edit-form-<?php echo $row['id']; ?>').submit();">
                                                                                                Edit User
                                                                                            </a>
                                                                                            <form id="edit-form-<?php echo $row["id"]; ?>" action="edit_user.php" method="POST" class="d-none">
                                                                                                <input type="text" class="form-control" name="user_id" value="<?php echo $row["id"]; ?>">
                                                                                            </form>

                                                                                            <a class="dropdown-item btn btn-danger" href="" onclick="event.preventDefault();
                                                                                    document.getElementById('delete-form-<?php echo $row['id']; ?>').submit();">
                                                                                                Delete User
                                                                                            </a>
                                                                                            <form id="delete-form-<?php echo $row['id']; ?>" action="delete_user.php" method="POST" class="d-none">
                                                                                                <input type="text" class="form-control" name="user_id" value="<?php echo $row["id"]; ?>">
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
                                        Users
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
                                                                            <h1>No Users in the database</h1>
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

$users  = Users::getInstance();
echo $users->allUsers();
require 'footer.php';

?>