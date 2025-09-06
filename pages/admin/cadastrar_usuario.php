<?php
verify_protected_route(1);


function create_user()
{
        if (isset($_POST['criar_usuario'])) {
                include("./database/conexao.php");

                $erro = [];
                $sucess = "";

                $name = $mysqli->real_escape_string($_POST['nome']);
                $email = $mysqli->real_escape_string($_POST['email']);
                $password = $mysqli->real_escape_string($_POST['senha']);
                $credits = $mysqli->real_escape_string($_POST['creditos']);
                $users = $mysqli->real_escape_string($_POST['opcoes']) ?? null;
                $email_validate = filter_var($email, FILTER_VALIDATE_EMAIL);

                if (empty($credits)) {
                        $credits = 0;
                }

                if (empty($email_validate) || !$email_validate) $erro[] = "Informe um e-mail válido para o usuário!";
                if (empty($name)) $erro[] = "Informe um nome para o usuário";
                if (empty($password) || strlen($password) < 8 || $password === '') $erro[] = "A senha deve possuir no minimo 8 caracteres";
                if (!isset($users) || $users === "" || $users === null) $erro[] = "Informe um tipo de usuário válido";


                if (count($erro) > 0) {
                        return [
                                "erro" => $erro
                        ];
                } else {
                        $password_hash = password_hash($password, PASSWORD_BCRYPT);

                        if (!empty($password_hash)) {


                                $sql_query = "INSERT INTO usuarios (nome, email, senha, data_cadastro, creditos, isAdmin) VALUES (
                                '$name',
                                '$email',
                                '$password_hash',
                                NOW(),
                                '$credits',
                                '$users'
                                )";

                                $sql_exec = $mysqli->query($sql_query);

                                if ($sql_exec) {
                                        $sucess = "Usuário cadastro com sucesso! <a class='color_primary' href='index.php?p=gerenciar_usuario&admin=true'> Retornar ao cadastro de usuários </a>";
                                        return [
                                                "status" => 201,
                                                "success" => $sucess
                                        ];
                                } else {
                                        $erro[] = "Falha ao inserir registro no banco de dados" . $mysqli->error;
                                }
                        }
                }
        }
}

$user_create = create_user();


?>

<div class="page-header card">
        <div class="row align-items-end">
                <div class="col-lg-8">
                        <div class="page-header-title">
                                <i class="ti-user bg-c-green"></i>
                                <div class="d-inline">
                                        <h4>Cadastre seu usuário</h4>
                                        <span>Preencha as informações e clique em salvar para cadastrar o usuário</span>
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
                                        <input type="text" class="form-control" id="titulo" placeholder="Informe o nome do usuário" name="nome">
                                </div>
                                <div class="form-group col-md-12">
                                        <label for="inputEmail4"> E-mail </label>
                                        <input type="email" class="form-control" id="titulo" placeholder="Informe um e-mail" name="email">
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="inputAddress"> Senha </label>
                                <input type="password" class="form-control" id="senha" placeholder="informe uma senha" name="senha">
                        </div>
                        <div class="form-group">
                                <label for="inputAddress2"> creditos </label>
                                <input type="number" class="form-control" id="creditos" placeholder="R$ 00,00" name="creditos">
                        </div>
                        <div class="form-group">
                                <label for="opcoes"> Tipo de Usuário</label>
                                <select class="form-control" name="opcoes" id="opcoes" aria-label="Selecione uma opção">
                                        <option selected value="">Selecione uma opção</option>
                                        <option value="1">Administrador</option>
                                        <option value="0">Usuário Padrão</option>
                                </select>

                        </div>



                        <button type="submit" class="btn btn-round btn-primary mt-2" name="criar_usuario"> <i class="ti-save"></i>Cadastrar Usuário</button>

                        <a type="button" class="float-right mt-2 btn btn-round btn-danger float-right text-white" href="index.php?p=gerenciar_usuarios&admin=true"> <i class="ti-arrow-left"></i> Cancelar</a>
                </form>
        </div>

</div>
</div>


</div>
</div>