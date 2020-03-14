<?php
require_once "../init.php";

$username = isset($_POST["username"]) ? htmlspecialchars($_POST["username"]) : null;
$password = isset($_POST["password"]) ? htmlspecialchars($_POST["password"]) : null;

$req = $db->prepare("SELECT * FROM users WHERE username = ?");
$req->execute([$password]);
$data = $req->fetch();


if($data) {

    var_dump($data);

    if (password_verify($password, $data['password'])) {
        header("Location: ../register.php");
    } else {
        echo 'Wrong password';
    }

}else{
    echo 'error';
}