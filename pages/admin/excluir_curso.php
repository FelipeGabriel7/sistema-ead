<div class="page-header card">

        <?php
        verify_protected_route(1);

        function verify_exist_course()
        {

                if (isset($_POST['excluir'])) {

                        $id = intval($_GET['id']);
                        include("./database/conexao.php");
                        $sql_code  = "SELECT * FROM cursos WHERE id = '$id'";
                        $sql_exec = $mysqli->query($sql_code)->fetch_assoc();


                        if ($sql_exec) {
                                $sql_delete = "DELETE FROM cursos WHERE id = '$id'";
                                $sql_delete_course = $mysqli->query($sql_delete) or die($mysqli->error);

                                if ($sql_delete_course) {
                                        echo "<span class='alert alert-success col-lg-12' role='alert'> Curso deletado com sucesso! <a href='index.php?p=gerenciar_cursos&admin=true'> Voltar para a página de cursos</a> </span>";
                                } else {
                                        echo "ocorreu um erro ao tentar excluir o curso";
                                }
                        }
                }
        }

        verify_exist_course();

        ?>

        <div class="row align-items-end">
                <div class="col-lg-8">
                        <div class="page-header-title">

                                <div class="d-flex justify-content-center align-items-center flex-column">
                                        <h4>Você deseja realmente excluir esse curso? </h4>

                                </div>


                        </div>
                        <form class="d-flex gap-3 mt-5" method="POST">
                                <button name="excluir" type="submit" class="btn btn-primary col-lg-4 btn-round"> <i class="ti-close"></i>Excluir Curso </button>
                                <a class="btn btn-danger text-white ml-3 col-lg-4 btn-round" href="index.php?p=gerenciar_cursos&admin=true"> Cancelar </a>
                        </form>
                </div>
        </div>
</div>


</div>
</div>