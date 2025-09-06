<?php

verify_protected_route(0);

function search_user()
{
        include("./database/conexao.php");

        if (isset($_GET['id'])) {
                $id_user = intval($_GET['id']);

                $sql_query = "SELECT * FROM usuarios WHERE id = '$id_user'";
                $sql_exec = $mysqli->query($sql_query) or die($mysqli->error);
                $user = $sql_exec->fetch_assoc();
                return $user;
        }
}

function update_user()
{
        if (isset($_POST['criar_usuario'])) {
                include("./database/conexao.php");

                $erro = [];
                $sucess = "";
                $user = search_user();
                $user_id = $user['id'];

                $name = $mysqli->real_escape_string($_POST['nome']);
                $email = $mysqli->real_escape_string($_POST['email']);
                $password = $mysqli->real_escape_string($_POST['senha']);

                $password_confirme = $mysqli->real_escape_string($_POST['senha_confirme']);

                $email_validate = filter_var($email, FILTER_VALIDATE_EMAIL);

                if (empty($credits)) {
                        $credits = 0;
                }

                if (empty($email_validate) || !$email_validate) $erro[] = "Informe um e-mail válido para o usuário!";
                if (empty($name)) $erro[] = "Informe um nome para o usuário";
                if (empty($password) || strlen($password) < 8 || $password === '') $erro[] = "A senha deve possuir no minimo 8 caracteres";
                if (empty($password_confirme) || strlen($password_confirme) < 8 || $password_confirme === '') $erro[] = "A senha deve possuir no minimo 8 caracteres";

                // senhas diferentes
                if ($password !== $password_confirme) $erro[] = "As senhas precisam ser iguais, verifique e tente novamente.";


                if (count($erro) > 0) {
                        return [
                                "erro" => $erro
                        ];
                } else {
                        $password_hash = password_hash($password, PASSWORD_BCRYPT);
                        $sql_query = "";

                        if (empty($password) || $password === "") {
                                $sql_query = "UPDATE usuarios 
                                SET
                                nome = '$name', email = '$email', data_cadastro = NOW()
                                WHERE id = '$user_id'
                                ";
                        } else {

                                $sql_query = "UPDATE usuarios 
                                SET
                                nome = '$name', email = '$email', senha = '$password_hash', data_cadastro = NOW()
                                WHERE id = '$user_id'
                                ";
                        }
                        $sql_exec = $mysqli->query($sql_query);

                        if ($sql_exec) {
                                $sucess = "Usuário editado com sucesso! <a class='color_primary' href='index.php'> Retornar a página inicial </a>";
                                return [
                                        "status" => 201,
                                        "success" => $sucess
                                ];
                        } else {
                                $erro[] = "Falha ao editar registro no banco de dados" . $mysqli->error;
                        }
                }
        }
}


$user_create = update_user();
$user_search = search_user();


?>

<div class="page-header card">
        <div class="row align-items-end">
                <div class="col-lg-8">
                        <div class="page-header-title">
                                <i class="ti-user bg-c-green"></i>
                                <div class="d-inline">
                                        <h4>Edite o usuário <?= $user_search['nome'] ?></h4>
                                        <span>Edite as informaçõs que deseja e clique em salvar para alterar o usuário</span>
                                </div>
                        </div>
                </div>
        </div>
</div>
<?php if (isset($user_create['erro'])): ?>
        <div class="alert alert-danger" role="alert">
                <?php foreach ($user_create['erro'] as $error) {
                        echo "$error." . " " . " <br/>";
                } ?>
        </div>
<?php endif; ?>
<?php if (isset($user_create['success'])): ?>
        <div class="alert alert-success" role="alert"> <?= $user_create['success'] ?></div>
<?php endif; ?>
<div class="page-body">
        <div class="card">
                <form class="p-4" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                                <div class="form-group col-md-12">
                                        <label for="inputEmail4">Nome do Usuário</label>
                                        <input type="text" class="form-control" id="titulo" placeholder="Informe nome do usuário" name="nome" value="<?= $user_search['nome'] ?>">
                                </div>
                                <div class="form-group col-md-12">
                                        <label for="inputEmail4"> E-mail </label>
                                        <input type="email" class="form-control" id="titulo" placeholder="Informe o e-mail" name="email" value="<?= $user_search['email'] ?>">
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="inputAddress"> Senha </label>
                                <input type="password" class="form-control" id="senha" placeholder="informe a nova senha" name="senha">
                        </div>
                        <div class="form-group">
                                <label for="inputAddress"> Confirme a senha </label>
                                <input type="password" class="form-control" id="senha" placeholder="Confirme sua senha" name="senha_confirme">
                        </div>


                        <button type="submit" class="btn btn-round btn-primary mt-2" name="criar_usuario"> <i class="ti-save"></i> Salvar </button>

                        <a type="button" class="float-right mt-2 btn btn-round btn-danger float-right text-white" href="index.php"> <i class="ti-arrow-left"></i> Cancelar</a>
                </form>
        </div>

</div>
</div>


</div>
</div>