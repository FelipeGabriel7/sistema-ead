<?php

verify_protected_route(0);

function list_all_purchase_course()
{
        include("./database/conexao.php");

        if (!isset($_SESSION['user'])) {
                session_start();
        }

        $id_usuario = $_SESSION['user'];
        $sql_code = "SELECT * FROM cursos WHERE id IN (SELECT id_curso FROM relatorio WHERE id_usuario = '$id_usuario')";
        $sql_exec = $mysqli->query($sql_code) or die($mysqli->error);
        $all_courses = [];
        $num_courses = $sql_exec->num_rows;


        if ($sql_exec->num_rows > 0) {
                while ($row = $sql_exec->fetch_assoc()) {
                        array_push($all_courses, $row);
                }
        }

        return [
                "data" => $all_courses,
                "num_courses" => $num_courses
        ];
}

$courses = list_all_purchase_course();



?>
<div class="page-header card">
        <div class="row align-items-end">
                <div class="col-lg-8">
                        <div class="page-header-title">
                                <i class="ti-control-play bg-c-green"></i>
                                <div class="d-inline">
                                        <h4> Meus Cursos </h4>
                                        <span> Estes são os cursos que você possui, clique no botão assistir ou continuar para prosseguir </span>
                                </div>
                        </div>
                </div>
                <div class="col-lg-4">
                        <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                                <a href="index.php">
                                                        <i class="ti-home text-secondary"></i>
                                                </a>
                                        </li>
                                        <li class="breadcrumb-item"> Meus Cursos </li>
                                </ul>
                        </div>
                </div>



        </div>


</div>
<div class="page-body">
        <div class="d-flex">
                <div class="d-flex gap-2">

                        <?php foreach ($courses['data'] as $item): ?>
                                <div class="card ml-4 mr-4">
                                        <img class="img-fluid mb-4" src="<?= $item['imagem_curso']; ?>" alt="">

                                        <div class="card-header">
                                                <h5> <?= $item['titulo'] ?></h5>
                                        </div>
                                        <div class="card-body">
                                                <p class="mt-10"> <?= $item['descricao'] ?> </p>

                                                <a href="index.php?p=conteudo_curso&id=<?= $item['id'] ?>" class="btn btn-primary form-control col-sm-12"> Assistir </a>

                                        </div>

                                </div>
                        <?php endforeach; ?>



                </div>
        </div>
</div>

</div>
</div>