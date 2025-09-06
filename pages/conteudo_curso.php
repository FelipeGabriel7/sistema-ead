<?php

verify_protected_route(0);

function search_course_info()
{
        include("./database/conexao.php");
        if (!isset($_SESSION)) {
                session_start();
        }

        $id_curso = $_GET['id'];
        $id_user = $_SESSION['user'];
        $sql_code = "SELECT * FROM cursos WHERE id = '$id_curso' AND id IN (SELECT id_curso FROM relatorio WHERE id_usuario = '$id_user')";
        $sql_exec = $mysqli->query($sql_code) or die($mysqli->error);
        $course_item = $sql_exec->fetch_assoc();
        return $course_item;
}

$course_item_view = search_course_info();


?>
<div class="page-header card">
        <div class="row align-items-end">
                <div class="col-lg-8">
                        <div class="page-header-title">
                                <i class="ti-control-play bg-c-blue"></i>
                                <div class="d-inline">
                                        <h4>Assista o contéudo do seu curso <?= $course_item_view['titulo']; ?></h4>
                                        <span>Assista seu curso adquirido</span>
                                </div>
                        </div>


                </div>

        </div>

</div>
<div class="card">
        <h5 class="mt-2 p-4"> Contéudo do curso</h5>
        <div class="p-5 m-2 bg-light border-1">
                <?= $course_item_view['conteudo'] ?>
        </div>
</div>