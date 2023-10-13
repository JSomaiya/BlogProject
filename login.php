<?php
    require "config/database.php";

    if (isset($_POST['btnLogin'])) {
        $email = $_POST['txtEmail'];
        $pass = $_POST['txtPassword'];

        $sql = "SELECT * FROM users WHERE email = '$email'";

        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)){
            $passHash = $row["password_text"];
            
            if (password_verify($pass, $passHash)) {
                $_SESSION["email"] = $email;
                $_SESSION["is_logged_in"] = true;

                header("Location:index.php");

            } else {
                echo "Incorrect Password";
            }
        }
    }
?>

<?php include "inc/header.php"; ?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Email Address</span>
        <input type="email" class="form-control" placeholder="Email Address" aria-label="email" aria-describedby="basic-addon1" name="txtEmail" required>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Password</span>
        <input type="password" class="form-control" placeholder="Password" aria-label="password" aria-describedby="basic-addon1" name="txtPassword" required>
    </div>
    <div>
        <input type="submit" class="btn btn-primary" value="Login" name="btnLogin"/>
    </div>
</form>

<?php include "inc/footer.php"; ?>