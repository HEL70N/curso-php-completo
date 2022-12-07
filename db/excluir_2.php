<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="titulo">Excluir Registros #02</div>

<?php
require_once "conexao.php";

$registros = [];
$conexao = novaConexao();

if ($_GET['excluir']) {
    $excluirSQL = "DELETE FROM cadastro WHERE id = ?";
    $stmt = $conexao->prepare($excluirSQL);
    $stmt->bind_param("i", $_GET['excluir']);
    $stmt->execute();
}

$sql = "SELECT id, nome, nascimento, email FROM cadastro";
$resultado = $conexao->query($sql);

if ($resultado->num_rows > 0) {
    while ($linha = $resultado->fetch_assoc()) {
        $registros[] = $linha;
    }
} else if ($conexao->error) {
    echo "Erro: " . $conexao->error;
}

$conexao->close();
?>

<table class="table table-hover table-striped table-bordered">
    <thead>
        <th>Código</th>
        <th>Nome</th>
        <th>Nascimento</th>
        <th>Email</th>
        <th>Acções</th>
    </thead>
    <tbody>
        <?php foreach ($registros as $registro) : ?>
            <tr>
                <td><?= $registro['id'] ?></td>
                <td><?= $registro['nome'] ?></td>
                <td>
                    <?=
                    date('d/m/Y', strtotime($registro['nascimento']));
                    ?>
                </td>
                <td><?= $registro['email'] ?></td>
                <td>
                    <a href="/projectos/cod3r/exercicio.php?dir=db&file=excluir_2&excluir=<?= $registro['id'] ?>" class="btn btn-danger">
                        Excluir
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<style>
    table * {
        font-size: 1.2rem;
    }
</style>