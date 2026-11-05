<?php
    include 'conexao.php';

    $id = $_GET["id"];

    mysql_query("DELETE FROM vendas WHERE produto_id='$id'");

    $sql = mysql_query("DELETE FROM produtos WHERE id='$id'");

    echo "<center>";
    echo "<hr>";
    echo "PRODUTO EXCLUIDO COM SUCESSO!";
    echo "<hr>";
    echo "<br>";
    echo "<a href='controle_produtos.php'>VOLTAR AO INVENTÁRIO</a>";
?>