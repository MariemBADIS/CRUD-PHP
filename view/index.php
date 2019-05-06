<?php
require_once '../config/config.php';

function __autoload($class) {
    $filename = "../model/" . $class . ".php";
    include_once($filename);
}

if (isset($_GET['del'])) {

    $id = $_GET['del'];

    $customer = new Customer();

    $customer->destroy($id);
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <title>Document</title>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <div class="row mt-4">
            <div class="container">
                <button type="button" class="btn btn-primary float-right"><a style="color: #fff;" href="create.php">Create</a></button>
            </div>
        </div>

        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="jumbotron">
                        <h4 class="mb-4">All Customer</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $customer = new Customer();

                                $rows = $customer->select();

                                if (count($rows >= 1)) {
                                    foreach ($rows as $row) {
                                        ?>
                                        <tr>
                                            <th scope = "row"><?php echo $row['id']; ?></th>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['lastname']; ?></td>
                                            <td><?php echo $row['city']; ?></td>
                                            <td>
                                                <a class = "btn btn-sm btn-primary mr-4" href =edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                                                <a class = "btn btn-sm btn-danger" href ="index.php?del=<?php echo $row['id']; ?>">Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>