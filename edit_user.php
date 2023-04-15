<?php
require 'nav.php';

$id = intval($_POST['user_id']);
include 'mysql.php';

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>
<div class="wrapper">
    <div class="page-wrapper">
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Add User
                        </h2>
                        <div class="page-body">
                            <div class="container-xl">
                                <div class="row row-cards">
                                    <div class="col-12">
                                        <form action="update_user.php" method="post" class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">User Form</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="mb-3">
                                                        <label class="form-label">User email</label>
                                                        <input type="text" class="form-control" required name="user_id" hidden value="<?php echo $row["id"] ?>">
                                                        <input type="text" class="form-control" required name="email" value="<?php echo $row["email"] ?>" placeholder="Enter user email">
                                                    </div>
                                                    <div class="form-group mb-3 ">
                                                        <label class="form-label">User Role</label>
                                                        <div>
                                                            <select class="form-select" required name="role">
                                                                <option value="admin">Admin</option>
                                                                <option value="cashier">Cashier</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">User Password</label>
                                                        <input type="password" required class="form-control" name="pwd" placeholder="Enter user password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-end">
                                                <div class="d-flex">
                                                    <a href="dashboard.php" class="btn btn-danger">Cancel</a>
                                                    <button type="submit" class="btn btn-primary ms-auto">Update User</button>
                                                </div>
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
</div>
<?php 
    }
    require 'footer.php' 
?>