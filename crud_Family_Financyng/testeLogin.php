<?php

session_start();

if(isset($_POST['submit']) && !empty($_POST['login'] && !empty($_POST['senha']))){

    include_once('config.php');
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuario WHERE login = '$login' and senha = '$senha'";
    $result = $pdo->query($sql);

    if(mysqli_num_rows($result) < 1){
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('Location: telaLogin.php');
    }
    else{
        $_SESSION['login'] = $login;
        $_SESSION['senha'] = $senha;
        header('Location: telaHome.php');
    }


}
else{
    header('Location: telaLogin.php');
}
?>