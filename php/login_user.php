<?php
require_once "../init.php";

$config["DB"]["user"] = isset($_POST["username"]) ? htmlspecialchars($_POST["username"]) : null;
$config["DB"]["password"] = isset($_POST["password"]) ? htmlspecialchars($_POST["password"]) : null;

$req = $db->prepare("SELECT * FROM users WHERE username = ?");
$req->execute([$config["DB"]["user"]]);
$data = $req->fetch();


if($data) {

    var_dump($data);

    if (password_verify($config["DB"]["password"], $data['password'])) {
        header("Location: ../register.php");
    } else {
        echo 'Wrong password';
    }

}else{
    echo 'error';
}