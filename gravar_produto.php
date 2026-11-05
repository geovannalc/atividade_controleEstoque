<?php
    include 'conexao.php';

    $descricao = $_POST["txt_descricao"];
    $categoria = $_POST["txt_categoria"];
    $compra = $_POST["txt_compra"];
    $venda = $_POST["txt_venda"];
    $estoque = $_POST["txt_estoque"];

    if ($descricao == "" || $categoria == "" || $compra == "" || $venda == "" || $estoque == "") {
        echo "Preencha todos os campos!";
        echo "<br><a href='controle_produtos.php'>VOLTAR</a>";
        return;
    }

    $sql = mysql_query("INSERT INTO produtos
                        (descricao, categoria, valor_compra, valor_venda, estoque)
                        VALUES
                        ('$descricao', '$categoria', '$compra', '$venda', '$estoque')");

    if ($sql) {
        echo "<center>";
        echo "<hr>";
        echo "PRODUTO CADASTRADO COM SUCESSO!";
        echo "<hr>";
        echo "<br>";
        echo "<a href='controle_produtos.php'>VOLTAR AO INVENTÁRIO</a>";
    }
    else {
        echo mysql_error();
    }
?>