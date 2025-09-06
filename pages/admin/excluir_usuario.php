<div class="page-header card">

        <?php
        verify_protected_route(1);

        function verify_exist_user()
        {

                if (isset($_POST['excluir'])) {

                        $id = intval($_GET['id']);
                        include("./database/conexao.php");
                        $sql_code  = "SELECT * FROM usuarios WHERE id = '$id'";
                        $sql_exec = $mysqli->query($sql_code)->fetch_assoc();
                        $user = strtoupper($sql_exec['nome']);


                        if ($sql_exec) {
                                $sql_delete = "DELETE FROM usuarios WHERE id = '$id'";
                                $sql_delete_course = $mysqli->query($sql_delete) or die($mysqli->error);

                                if ($sql_delete_course) {
                                        echo "<span class='alert alert-success col-lg-12' role='alert'> Usuário $user deletado com sucesso! <a href='index.php?p=gerenciar_usuarios&admin=true'> Voltar para a cadastro de usuarios</a> </span>";
                                } else {
                                        echo "ocorreu um erro ao tentar excluir o curso";
                                }
                        }
                }
        }

        verify_exist_user();

        ?>

        <div class="row align-items-end">
                <div class="col-lg-8">
                        <div class="page-header-title">

                                <div class="d-flex justify-content-center align-items-center flex-column">
                                        <h4>Você deseja realmente excluir esse usuário? </h4>
                                        <p> Ao realizar a exclusão será necessário cadastrar o usuário novamente</p>
                                </div>


                        </div>
                        <form class="d-flex gap-3 mt-5" method="POST">
                                <button name="excluir" type="submit" class="btn btn-primary col-lg-4 btn-round"> <i class="ti-close"></i>Excluir usuário </button>
                                <a class="btn btn-danger text-white ml-3 col-lg-4 btn-round" href="index.php?p=gerenciar_usuários&admin=true"> Cancelar </a>
                        </form>
                </div>
        </div>
</div>


</div>
</div>