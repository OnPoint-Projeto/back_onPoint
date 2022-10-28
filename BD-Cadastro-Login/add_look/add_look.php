<?php
session_start();
// puxa o id do usuario
$id_usuario = $_SESSION['teste'];
// inicia a conxao
$con = mysqli_connect("localhost","root","","bd_onpoint") or die ("erro de conechao");
// busca os atribultos dos looks
$nome = mysqli_real_escape_string($con, $_POST['nome']);
$descricao = mysqli_real_escape_string($con, $_POST['descricao']);
$img1 = $_SESSION['img1'];
$img2 = $_SESSION['img2'];
$img3 = $_SESSION['img3'];
$img4 = $_SESSION['img4'];

// insere os atribultos

$query_insert = "INSERT INTO look VALUES(NULL,'$nome','$descricao','$img1','$img2','$img3','$img4','$id_usuario');";
$query_run = mysqli_query($con, $query_insert);
// se funcionar ele insere a avisa que foi adicionado se n, avisa que deu erro
if($query_run){
    echo "<script type='text/javascript'>alert('look adicionado com sucesso!');";
    echo "javascript:window.location='./index.php';</script>";
}else{
    echo "<script type='text/javascript'>alert('FALHA AO ADICIONAR!');";
    echo "javascript:window.location='./index.php';</script>";
}

?>