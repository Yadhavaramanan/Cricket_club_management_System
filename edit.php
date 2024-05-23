<?php
$servername="localhost";
$username="root";
$password="";
$database="cricket_club";

$connection = new mysqli($servername,$username,$password,$database);

$id = "";
$name="";
$age="";
$email="";
$score_point="";

$errorMessage = "";
$successmessage = "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // GET METHOD : show the data of the player

    if(!isset($_GET['id'])){
        header("location: /dbms/index.php");
        exit;
    }

    $id = $_GET['id'];

    $sql = "SELECT * FROM players WHERE id = $id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location :/dbms/index.php");
        exit;
    }

    
    $name = $row["name"];
    $age = $row["age"];
    $email =  $row["email"];
    $score_point = $row["score_point"];
}
else{
    //POST METHOD : update the data of the player

    $id = $_POST["id"];
    $name = $_POST["name"];
    $age = $_POST["age"];
    $email =  $_POST["email"];
    $score_point = $_POST["score_point"];

    do{
        if ( empty($id) ||empty($name) || empty($age) || empty($email) || empty($score_point) ) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql="UPDATE players SET name = '$name', age = '$age', email = '$email', score_point = '$score_point' WHERE id=$id";
        $result = $connection->query($sql);
    
        if(!$result){
           $errorMessage = "Invalid query: " . $connection->error;
           break;
        }

        $successmessage = "Update Successfully Completed";
        echo "<script>
                alert('$successmessage');
                window.location.href = '/dbms/index.php';
              </script>";

        //header("location: /dbms/index.php");
        //exit;


    }while(false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cricket club</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


</head>
<body>
    <div class="container my-5">

        <h2>New Player</h2>
        <?php
     
        if (!empty($errorMessage) ) {
            echo"
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></button>
            </div>
            "; 
        }

        ?>

        <form method="post">
            <input type="hidden" name='id' value="<?php echo $id ?>">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Age</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="age" value="<?php echo $age ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Score point</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="score_point" value="<?php echo $score_point ?>">
                </div>
            </div>

            <?php
            /*if(!empty($successmessage)){
                echo"
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successmessage</strong>
                            <button type='button' class='btn-close' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";

            }*/
            ?>

            
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/dbms/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>