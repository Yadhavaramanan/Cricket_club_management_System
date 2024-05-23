<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket club players</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class ="container my-5">
        <h2>List of players</h2><br>
        <a class="btn btn-primary" href="/dbms/create.php" role="button"> Add player</a>
        <br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Score Points</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // database connection
                $servername="localhost";
                $username="root";
                $password="";
                $database="cricket_club";

                $connection = new mysqli($servername,$username,$password,$database);

                //if connection is failed
                if($connection->connect_error){
                    die("Connection Failed : " . $connection->connect_error);
                }

                $sql="SELECT * FROM players";
                $result = $connection->query($sql);

                if(!$result){
                    die("Invalied Query : " . $connection->error);
                }

                while($row = $result->fetch_assoc()){
                    echo"
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[name]</td>
                        <td>$row[age]</td>
                        <td>$row[email]</td>
                        <td>$row[score_point]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='/dbms/edit.php?id=$row[id]'>Edit</a>
                            <a class='btn btn-primary btn-sm' href='/dbms/delete.php?id=$row[id]'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
    
</body>
</html>