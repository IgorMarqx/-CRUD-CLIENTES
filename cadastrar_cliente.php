<?php
include('./conexao.php');

function limpar_texto($str)
// Função para validação de telefone
{
    return preg_replace("/[^0-9]/", "", $str);
}

// variavel para erro
$erro = false;

// verificando se o contador é maior que 0
if (count($_POST) > 0) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data_nasc = $_POST['data_nasc'];

    // validação de erro para o nome
    if (empty($nome)) {
        $erro = "Preencha o nome!";
    }

    // validação de erro para o email, e filtro de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Email incorreto, preencha da forma certa (user@gmail.com)!";
    }

    // validação de erro para a data de nascimento, seguindo o padrão nacional
    if (!empty($data_nasc)) {
        $pedacos = explode('/', $data_nasc);
        if (count($pedacos) < 3 || empty(($pedacos))) {
            $erro = "A data de Nascimento deve seguir o padrão DD/MM/YY";
        } else {
            $data_nasc = implode('-', array_reverse($pedacos));
        }
    }

    // validação de erro para o telefone, seguindo o padrão nacional
    if (!empty($telefone)) {
        $telefone = limpar_texto($telefone);
        if (strlen($telefone) != 11) {
            $erro = "O telefone deve ser preenchido no padrão (11) 98653-1492";
        }
    }
    // Mostrando o erro personalizado com html e css
    if ($erro) {
?>

        <div class="alert alert-danger" role="alert">
            <?php echo $erro; ?>
        </div>

        <?php

    } else {
        // Inserindo o usuario no banco de dados
        $sql = "INSERT INTO clientes (nome, email, data_nasc, telefone, data_cadastro) values ('$nome', '$email', '$data_nasc', '$telefone', NOW())";

        $con = $db->query($sql) or die($db->error);
        // verificando e mostrando que o usuario foi cadastrado
        if ($con) {
        ?>

            <div class="alert alert-success" role="alert">
                <p><b>Cliente Cadastrado com sucesso!</b></p>
            </div>

<?php
            // zerando todos os inputs após cadastrar com sucesso
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
            <h1>Cadastro de Clientes</h1>
            <a class="btn btn-danger" href="clientes.php">Voltar para a lista</a>
        </div>

        <form class="" action="" method="POST">
            <div>
                <label for="">Nome <span style="color: red;">*</span></label>
                <input class="form-control" value="<?php if (isset($_POST['nome'])) echo $_POST['nome']; ?>" type="text" name="nome">
            </div>
            <br>
            <div>
                <label for="">Email <span style="color: red;">*</span></label>
                <input class="form-control" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" type="text" name="email">
            </div>
            <br>
            <div>
                <label for="">Telefone</label>
                <input class="form-control" value="<?php if (isset($_POST['telefone'])) echo $_POST['telefone']; ?>" placeholder="(00) 00000-0000" type="text" name="telefone">
            </div>
            <br>
            <div>
                <label for="">Data de Nascimento</label>
                <input class="form-control" value="<?php if (isset($_POST['data_nasc'])) echo $_POST['data_nasc']; ?>" type="text" name="data_nasc">
            </div>

            <div class="d-grid gap-2">
                <input class="btn btn-success mt-4 " type="submit" value="Criar">
            </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

</html>