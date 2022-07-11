<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>How To Delete Multiple Records in MySQL Using PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark">
    <div class="container mt-5">
        <?php
        if (isset($_SESSION["msg"]) && !empty($_SESSION["msg"])) {
            $msg = $_SESSION["msg"];
            echo "<div class='alert alert-danger' role='alert'>" . $msg . "</div>";
            unset($_SESSION['msg']);
            session_destroy();
        }
        ?>
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">How To Delete Multiple Records in MySQL Using PHP - Mywebtuts.com</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="api/delete.php">
                    <table class="table table-striped table-bordered table-hover text-center">
                        <tr>
                            <th width="10px">#</th>
                            <th width="10px">id</th>
                            <th width="50%">name</th>
                            <th>email</th>
                        </tr>
                        <?php
                        include('conn.php');

                        $query = mysqli_query($conn, "select * from `products`");
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td align="center"><input type="checkbox" value="<?php echo $row['pid']; ?>" name="checkbox[]"></td>
                                <td><?php echo $row['pid']; ?></td>
                                <td><?php echo $row['SKU']; ?></td>
                                <td><?php echo $row['Price']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>Delete</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>