<?php
require_once '../config/config.php';

function __autoload($class) {
    $filename = "../model/" . $class . ".php";
    include_once($filename);
}

if (isset($_GET['id'])) {
    $uid = $_GET['id'];

    $customer = new Customer();

    $result = $customer->selectOne($uid);
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $city = $_POST['city'];
    $fields = [
        'name' => $name,
        'lastname' => $lastname,
        'city' => $city
    ];
    
    $id = $city = $_POST['id'];
    
    $customer = new Customer();

    $customer->update($fields, $id);
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

        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="jumbotron">
                        <h4 class="mb-4">Edit Customer</h4>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" aria-describedby="emailHelp" placeholder="Enter Name" 
                                       value="<?php echo $result['name']; ?>" >
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" name="lastname" aria-describedby="emailHelp" placeholder="Enter Last Name" 
                                       value="<?php echo $result['lastname']; ?>" >
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" name="city" aria-describedby="emailHelp" placeholder="Enter City" 
                                       value="<?php echo $result['city']; ?>" >
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>