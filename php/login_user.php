<?php
require_once "../init.php";

$username = isset($_POST["username"]) ? htmlspecialchars($_POST["username"]) : null;
$password = isset($_POST["password"]) ? htmlspecialchars($_POST["password"]) : null;

$req = $db->prepare("SELECT * FROM users WHERE username = ?");
$req->execute([$username]);
$data = $req->fetch();

if($data) {

    // Get passwords
    $password_peppered = hash_hmac("sha256", $password, $config["SECURITY"]["pepper"]);

    // Check passwords
    if (!password_verify($password_peppered, $data["password"])) {

        redirectTo("../login.php?error=1");

    } else {

        redirectTo("../index.php");
    }

}else{
    echo 'error';
}