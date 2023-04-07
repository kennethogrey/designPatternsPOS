<?php require 'nav.php' ?>
<div class="wrapper">
    <div class="page-wrapper">
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Add Products
                        </h2>
                        <div class="page-body">
                            <div class="container-xl">
                                <div class="row row-cards">
                                    <div class="col-12">
                                        <form action="Factory.php" method="post" class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Product Form</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="mb-3">
                                                        <label class="form-label">Product name</label>
                                                        <input type="text" class="form-control" required name="name" placeholder="Enter name of the product">
                                                    </div>
                                                    <div class="form-group mb-3 ">
                                                        <label class="form-label">Select</label>
                                                        <div>
                                                            <select class="form-select" required name="category">
                                                                <option value="Electronics">Electronics</option>
                                                                <option value="Clothing">Clothing</option>
                                                                <option value="Groceries">Groceries</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Product Price</label>
                                                        <input type="text" required class="form-control" name="cost" placeholder="Enter price @each product">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Product quantity</label>
                                                        <input type="text" class="form-control" required name="quantity" placeholder="Enter quantity of the product">
                                                    </div>
                                                    <div class="mb-3 d-flex flex-wrap nowrap">
                                                        <label class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="gift_wrapping">
                                                            <span class="form-check-label">Grift Wrap</span>
                                                        </label>
                                                        <label class="form-check" style="margin-left: 10px;">
                                                            <input class="form-check-input" type="checkbox" name="express_shipping">
                                                            <span class="form-check-label">Express Shipping</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-end">
                                                <div class="d-flex">
                                                    <a href="index.php" class="btn btn-danger">Cancel</a>
                                                    <button type="submit" class="btn btn-primary ms-auto">Create Product</button>
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
<?php require 'footer.php' ?>