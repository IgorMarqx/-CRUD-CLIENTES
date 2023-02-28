<?php
include('./conexao.php');

// fazendo consulta no banco de dados, e listando todos os usuarios
$sql_clients = "SELECT * FROM clientes";
$query_clients = $db->query($sql_clients) or die($db->error);
// contando o numero de linhas do banco de dados
$num_clients =  mysqli_num_rows($query_clients);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/clientes.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Lista de clientes</title>
</head>

<body>
    <div class="container">
        <div class="title">
            <h1>Lista de Clientes</h1>
            <h2>Clientes cadastrados</h2>
        </div>

        <div class="position-button mt-2 mb-2">
            <a class="btn btn-success" href="cadastrar_cliente.php">Cadastrar novo cliente</a>
        </div>

        <div class="table">
            <table cellpadding="20">
                <thead>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Nascimento</th>
                    <th>Data de cadastro</th>
                    <th>Ações</th>
                </thead>
                <tbody>
                    <?php
                    // verificando se existe algum cliente cadastrado
                    if ($num_clients == 0) { ?>
                        <tr>
                            <td colspan="7">Nenhum cliente foi cadastrado</td>
                        </tr>
                        <?php } else {
                        // looping para listar todos os usuarios cadastrados
                        while ($cliente = $query_clients->fetch_assoc()) {

                            $telefone = "Não informado";
                            if (!empty($cliente['telefone'])) {
                                formatar_telefone($cliente['telefone']);
                            }

                            // formatando data de nascimento do cliente
                            $nascimento = "Não Informado";
                            if (!empty($cliente['data_nasc'])) {
                                $nascimento = formatar_data($cliente['data_nasc']);
                            }

                            // formatando data e hora de cadastro
                            $data_cadastro = date("d/m/Y H:i", strtotime($cliente['data_cadastro']));
                        ?>
                            <tr>
                                <td><?php echo $cliente['id'] ?></td>
                                <td><?php echo $cliente['nome'] ?></td>
                                <td><?php echo $cliente['email'] ?></td>
                                <td><?php echo $telefone ?></td>
                                <td><?php echo $nascimento ?></td>
                                <td><?php echo $data_cadastro ?></td>
                                <td>
                                    <a class="icon" href="editar_cliente.php?id=<?php echo $cliente['id'] ?>"><i class="fa-sharp fa-solid fa-pencil"></i></a>
                                    <a class="icon" href="deletar_cliente.php?id=<?php echo $cliente['id'] ?>"><i class="fa-solid fa-xmark"></i></a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

</html>