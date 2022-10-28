<?php

    session_start();
    // puxa o id do uduario (que é o mesmo do querda roupa sem exceção pelo trigger no bd)
    $id_usuario = $_SESSION['teste'];
    // abre a conexao
    $con = mysqli_connect("localhost","root","","bd_onpoint") or die ("erro de conechao");
    $query_select = "SELECT * from ajudar WHERE id_usuarior = '$id_usuario';";
    $result = $con->query($query_select);
    if($result->num_rows >0){
        // imprime os dados do evento na tela
        $row = $result->fetch_assoc();
        $id_ajudado = $row['id_usuarioe'];
        echo "evento: " . $row['evento'] . "<br>";
        echo "estilo: " . $row['estilo'] ."<br>";
        echo "horario: " . $row['horario'] ."<br>";
        echo "clima: " . $row['clima'] ."<br>";
        echo "descricao: " . $row['descricao'] ."<br>";

        // puxa o nome e o blob(blob é uma imagem em formato de string) do item de quem pediu ajuda
        $query = "SELECT nome,arquivo FROM item WHERE id_guarda = '$id_ajudado';";
        $query_run = mysqli_query($con,$query);
        // se der certo, ele atribui a um arry
        if(mysqli_num_rows($query_run) > 0){
            $item = mysqli_fetch_array($query_run);
        }
        
    }
    else{
        echo "<script type='text/javascript'>alert('SEM PEDIDOS DE AJUDA');";
        echo "javascript:window.location='../home/index.html';</script>";
    }
    
?>
<body>
    <form action="add_look.php" method="post">
        nome: <input type="text" name="nome">
        descricao: <input type="textarea" name="descricao">
        <div id="look">

        </div>
        <button>confirmar</button>
    </form>

    <?php
    // imprime os itens para adicionar a um look
    foreach($query_run as $item){
        ?>
            <tr>
                <td>
                    <a href="">
                        <div>
                            <?= $item['nome'];?><br>
                            <!-- a linha abaixo é o metodo utilizado para imprimir o blob em forma de imagem -->
                            <img src = "data:image/png;base64,<?= $item['arquivo'] ?>" width = "50px" height = "50px"/> 
                        </div>
                    </a>
                </td>
            </tr>
        <?php
        
        
    }
    // quando adicionar as imagens na div favor atribuir o blob de cada imagem tambem
    // ex.: $img1 = "blob img1";
    // $_SESSION['img1'] = $img1;
    // $_SESSION['img2'] = $img2;
    // $_SESSION['img3'] = $img3;
    // $_SESSION['img4'] = $img4;
    ?>
    
    

</body>