<?php
    include 'conexao.php';

    $descricao = $_POST["txt_descricao"];
    $quantidade = $_POST["txt_estoque"];

    $sql = mysql_query("SELECT * FROM produtos
                        WHERE descricao='$descricao'");

    if (mysql_num_rows($sql) == 0) {
        echo "PRODUTO NÃO ENCONTRADO!";
        echo "<br><a href='controle_produtos.php'>VOLTAR</a>";
        return;
    }

    $linha = mysql_fetch_array($sql);

    if ($quantidade <= 0 || $quantidade > $linha["estoque"]) {
        echo "QUANTIDADE INVÁLIDA OU ESTOQUE INSUFICIENTE!";
        echo "<br><a href='controle_produtos.php'>VOLTAR</a>";
        return;
    }

    $valor_total = $linha["valor_venda"] * $quantidade;

    $lucro = ($linha["valor_venda"] - $linha["valor_compra"]) * $quantidade;

    $novo_estoque = $linha["estoque"] - $quantidade;

    mysql_query("UPDATE produtos SET estoque='$novo_estoque'
                 WHERE id='".$linha["id"]."'");

    mysql_query("INSERT INTO vendas
                 (produto_id, quantidade, valor_total, lucro)
                 VALUES
                 ('".$linha["id"]."', '$quantidade', '$valor_total', '$lucro')");

    echo "<center>";
    echo "<hr>";
    echo "VENDA REALIZADA COM SUCESSO!";
    echo "<hr>";
    echo "<br>";
    echo "Quantidade vendida: ".$quantidade;
    echo "<br>";
    echo "Valor total: R$ ".number_format($valor_total, 2, ',', '.');
    echo "<br>";
    echo "Lucro: R$ ".number_format($lucro, 2, ',', '.');
    echo "<br><br>";
    echo "<a href='controle_produtos.php'>VOLTAR AO INVENTÁRIO</a>";
?>