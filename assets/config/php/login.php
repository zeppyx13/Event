<?php
session_start();
include './backend.php';

if (isset($_POST["login"])) {
    $email = $_POST['email'];
    $pw = $_POST['password'];
    $result = mysqli_query($konek, "SELECT * FROM user WHERE Email = '$email'");
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pw, $row['Password'])) {
            if ($row['lvl'] == "admin") {
                $_SESSION['admin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $row['id'];
                $_SESSION['lvl'] = "admin";
                $_SESSION['login'] = true;

                header("location:../../../admin/");
            } else if ($row['lvl'] == "user") {
                $_SESSION['user'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['lvl'] = "user";
                $_SESSION['login'] = true;
                header("location:../../../dashboard/");
            } else {
                header("location:../../../");
                return false;
            }
        }
        echo "
        <script>
            alert('Password salah');
            document.location.href='../../../';
        </script>";
        exit;
    }
    echo "
    <script>
        alert('Email salah/tidak ada');
        document.location.href='../../../';
    </script>";
    exit;
}
