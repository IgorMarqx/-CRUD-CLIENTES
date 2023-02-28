<?php
// verificando o botão se confirmar executar esse IF
if (isset($_POST['confirmar'])) {

    include('./conexao.php');
    // passando o id pela URL via GET e transformando em int
    $id = intval($_GET['id']);
    // fazendo o delete pelo banco de dados via ID
    $sql = "DELETE FROM clientes WHERE id = '$id'";
    $query = $db->query($sql) or die($db->error);

    if ($query) { ?>
        <script>
            window.location.href = './clientes.php'
        </script>
<?php
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/cadastro.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <title>Deletar Cliente</title>
</head>

<body>
    <div class="container">
        <div class="position">
            <h1>Tem certeza que deseja deletar esse cliente?</h1>

            <form action="" method="post">
                <div class="btns">
                    <a class="btn btn-success" href="./clientes.php">Não</a>
                    <button class="btn btn-danger" name="confirmar" value="1" type="submit">Sim</button>
                </div>
            </form>
        </div>
    </div>


</body>

</html>