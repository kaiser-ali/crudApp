<!DOCTYPE html>
<html lang="en">
<head>
    <title>crud app</title>
    <meta charset="utf8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
    <?php require_once 'connection.php' ?>

    <?php $conn  = new mysqli('localhost', 'root', '', 'crudapp')
        or die($conn->error);
        $sql = "SELECT Id, firstName, lastName FROM data";

        $result = $conn->query($sql);

    ?>

    <?php if(isset($_SESSION["message"])) : ?>

    <div class="alert alert-<?=$_SESSION["msg_type"] ?>"> 
        <?php
            echo $_SESSION["message"];
            unset($_SESSION["message"]);
        ?>
    </div>
    <?php endif; ?>


    <div class="col-md-4 col-lg-6">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>First Name </th>
                    <th>Last Name</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>

            <?php

                    while($row = $result->fetch_assoc()): 
            ?>
            <tr>
                <td><?php echo $row['firstName']; ?></td>
                <td><?php echo $row['lastName']; ?></td>
                <td>
                        <a href="crud.php?edit=<?php echo $row['Id']; ?>"
                        class="btn btn-info">Edit</a>
                        <a href="connection.php?delete=<?php echo $row['Id'] ?>"
                        class="btn btn-danger">Delete</a>
                </td>
            </tr>

            <?php endwhile; ?>
        </table>
    </div>



        <div class="col-md-4 col-lg-6 justify-content-center">
            <form action="connection.php" method="post">
                        <input type="hidden" name="id"
                         value="<?php  echo $id ?>" >
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" name="fName" class="form-control"
                        placeholder="Enter First Name..." 
                        value="<?php echo $firstName; ?> "id="fName">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lName" class="form-control"
                        placeholder="Enter Last Name..." 
                        value="<?php echo $lastName; ?> "id="lName">
                    </div>
                    <div class="form-group">
                    <?php if($update == true) : ?>
                        <button type="submit" name="submit" class="btn btn-info">update
                        </button>
                    <?php else : ?>
                        <button type="submit" name="submit" class="btn btn-primary">submit
                        </button>
                    <?php endif; ?>
                    </div>
            </form>
        </div>

    </div>




</body>
</html>