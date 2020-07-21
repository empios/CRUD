<!doctype html>
<html lang="en">

<head>
    <title>CRUD PHP</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <?php require_once 'databaseController.php'; ?>


    <?php 
    if (isset($_SESSION['message'])):
    ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">

        <?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);
    ?>
    </div>

    <?php endif ?>

    <div class="container">
        <?php
    $mysqlCon = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqlCon));
    $result = $mysqlCon->query("SELECT * from crud") or die ($mysqlCon->error);
    ?>


        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Imię</th>
                        <th>Wzrost</th>
                        <th colspan="2">Opcje</th>
                    </tr>
                </thead>
                <?php 
                while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['imie'];?></td>
                    <td><?php echo $row['wzrost'];?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id'];?>" class="btn btn-info">Edytuj</a>
                        <a href="databaseController.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Usuń</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>

    <div class="row justify-content-center" style="margin-top: 8%;">
        <form action="databaseController.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="container form-group">
            <div class="col">
                <div class="row">
                    <label>Imię</label>
                    <input type="text" name="name" class="form-control form-control-sm" value="<?php echo $name?>"
                        placeholder="Podaj imię">
                </div>
                <div class="row">
                    <label>Wzrost</label>
                    <input type="number" name="height" class="form-control form-control-sm" value="<?php echo $height?>"
                        placeholder="0">
                </div>
            </div>
    </div>
    <div class="row justify-content-center" style="margin-top: 1%;">
        <?php 
                        if ($update == true):
                        ?>
        <button type="submit" class="btn btn-warning" name="update">Edytuj</button>
        <?php else: ?>
        <button type="submit" class="btn btn-primary" name="dodaj">Dodaj</button>
        <?php endif; ?>
    </div>
    </div>
    </div>
    </div>
    </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>