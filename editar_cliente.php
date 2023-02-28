<?php
include('./conexao.php');

// obtendo o ID via GET pela url e transformando o ID em int
$id = intval($_GET['id']);
$sql = "SELECT * FROM clientes WHERE id = '$id'";
$query_client = $db->query($sql) or die($db->error);
$client = $query_client->fetch_assoc();

function limpar_texto($str)
{
    return preg_replace("/[^0-9]/", "", $str);
}


$erro = false;

if (count($_POST) > 0) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data_nasc = $_POST['data_nasc'];

    if (empty($nome)) {
        $erro = "Preencha o nome!";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Email incorreto, preencha da forma certa (user@gmail.com)!";
    }

    if (!empty($data_nasc)) {
        $pedacos = explode('/', $data_nasc);
        if (count($pedacos) < 3 || empty(($pedacos))) {
            $erro = "A data de Nascimento deve seguir o padrão DD/MM/YY";
        } else {
        }
    }

    if (!empty($telefone)) {
        $telefone = limpar_texto($telefone);
        if (strlen($telefone) != 11) {
            $erro = "O telefone deve ser preenchido no padrão (11) 98653-1492";
        }
    }
    if ($erro) {
?>

        <div class="alert alert-danger" role="alert">
            <?php echo $erro; ?>
        </div>

        <?php

    } else {
        // fazendo o update do cliente 
        $sql = "UPDATE clientes SET nome = '$nome', email = '$email',  telefone = '$telefone', data_nasc = '$data_nasc' WHERE id = '$id'";

        $con = $db->query($sql) or die($db->error);
        if ($con) {
        ?>

            <div class="alert alert-success" role="alert">
                <p><b>Cliente Atualizado com sucesso!</b></p>
            </div>

<?php
            unset($_POST);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/cadastro.css">
    <title>Cadastro Cliente</title>
</head>

<body>
    <div class="container">
        <div class="title">
            <h1>Editar Clientes</h1>
            <a class="btn btn-danger" href="clientes.php">Voltar para a lista</a>
        </div>
        <form class="" action="" method="POST">
            <div>
                <label for="">Nome</label>
                <input class="form-control" value="<?php echo $client['nome']; ?>" type="text" name="nome">
            </div>
            <br>
            <div>
                <label for="">Email</label>
                <input class="form-control" value="<?php echo $client['email']; ?>" type="text" name="email">
            </div>
            <br>
            <div>
                <label for="">Telefone</label>
                <input class="form-control" value="<?php if (!empty($client['telefone'])) echo formatar_telefone($client['telefone']); ?>" placeholder="(00) 00000-0000" type="text" name="telefone">
            </div>
            <br>
            <div>
                <label for="">Data de Nascimento</label>
                <input class="form-control" value="<?php if (!empty($client['data_nasc'])) echo formatar_data($client['data_nasc']); ?>" type="text" name="data_nasc">
            </div>

            <div class="d-grid gap-2">
                <input class="btn btn-success mt-4 " type="submit" value="Atualizar">
            </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

</html>