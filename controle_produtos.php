<?php
    include 'conexao.php';

    $pesquisa = "";

    if (isset($_GET["txt_pesquisa"])) {
        $pesquisa = $_GET["txt_pesquisa"];
    }

    if ($pesquisa != "") {
        $sql = mysql_query("SELECT * FROM produtos
                            WHERE descricao LIKE '%$pesquisa%'
                            OR categoria LIKE '%$pesquisa%'
                            ORDER BY id DESC");
    }
    else {
        $sql = mysql_query("SELECT * FROM produtos ORDER BY id DESC");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Controle de Produtos</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h3>📦 Cadastro de Produto</h3>

    <form action="gravar_produto.php" method="POST">

        <div class="formulario">

            <div class="campo descricao">
                <label>Descrição</label>
                <input type="text" name="txt_descricao" placeholder="Nome do produto">
            </div>

            <div class="campo">
                <label>Categoria</label>
                <select name="txt_categoria">
                    <option value="">Selecione</option>
                    <option value="Informática">Informática</option>
                    <option value="Eletrônicos">Eletrônicos</option>
                    <option value="Escritório">Escritório</option>
                    <option value="Outros">Outros</option>
                </select>
            </div>

            <div class="campo">
                <label>Valor Compra (R$)</label>
                <input type="number" step="0.01" name="txt_compra" placeholder="0.00">
            </div>

            <div class="campo">
                <label>Valor Venda (R$)</label>
                <input type="number" step="0.01" name="txt_venda" placeholder="0.00">
            </div>

            <div class="campo quantidade">
                <label>Qtd. Estoque</label>
                <input type="number" name="txt_estoque" placeholder="0">
            </div>

        </div>

        <div class="botoes">
            <button type="submit">CADASTRAR PRODUTO</button>

            <button type="submit" formaction="vender.php">
                VENDER PRODUTO
            </button>
        </div>

    </form>

    <h3 id="inventario">📋 Inventário</h3>

    <form action="controle_produto.php" method="GET" class="pesquisa">
        <input type="text" name="txt_pesquisa"
               placeholder="Pesquisar por descrição ou categoria..."
               value="<?php echo $pesquisa; ?>">

        <button type="submit">🔍</button>
    </form>

    <table>

        <tr>
            <th>Descrição</th>
            <th>Categoria</th>
            <th>Venda</th>
            <th>Lucro Unit.</th>
            <th>Estoque</th>
            <th>Ações</th>
        </tr>

        <?php
            while ($linha = mysql_fetch_array($sql)) {
                $lucro = $linha["valor_venda"] - $linha["valor_compra"];
        ?>

        <tr>
            <td><?php echo $linha["descricao"]; ?></td>

            <td><?php echo $linha["categoria"]; ?></td>

            <td>R$ <?php echo number_format($linha["valor_venda"], 2, ',', '.'); ?></td>

            <td>R$ <?php echo number_format($lucro, 2, ',', '.'); ?></td>

            <td><?php echo $linha["estoque"]; ?></td>

            <td>
                <a class="excluir"
                   href="excluir.php?id=<?php echo $linha["id"]; ?>"
                   onclick="return confirm('Deseja excluir este produto?')">
                   ✖
                </a>
            </td>
        </tr>

        <?php
            }
        ?>

    </table>

</div>

</body>
</html>