<?php

verify_protected_route(0);

function get_all_courses()
{
        include("./database/conexao.php");

        if (!$_SESSION['user']) {
                session_start();
        }

        $id_usuario = $_SESSION['user'];
        $sql_code = "SELECT * FROM cursos WHERE id NOT IN (SELECT id_curso FROM relatorio WHERE id_usuario = '$id_usuario')";
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

$courses = get_all_courses();



function update_purchase_courses()

{
        include("./database/conexao.php");
        if (!isset($_SESSION)) {
                session_start();
        }

        if (isset($_POST['adquirir_curso'])) {
                $user = $_SESSION['user'];
                $id_curso = $_POST['adquirir_curso'];

                $sql_consulte_credits = "SELECT creditos FROM usuarios WHERE id = '$user'";
                $sql_exec = $mysqli->query($sql_consulte_credits) or die($mysqli->error);
                $sql_exec = $sql_exec->fetch_assoc();
                $creditos = $sql_exec['creditos'];

                $sql_consulte_course = "SELECT preco FROM cursos WHERE id = '$id_curso'";
                $sql_exec = $mysqli->query($sql_consulte_course) or die($mysqli->error);
                $sql_exec = $sql_exec->fetch_assoc();
                $preco = $sql_exec['preco'];

                if ($creditos >= $preco) {
                        $sql_relatory = "INSERT INTO relatorio (id_usuario, id_curso) VALUES ('$user', '$id_curso')";
                        $sql_exec = $mysqli->query($sql_relatory) or die($mysqli->error);
                        $success = "Curso adquirido com sucesso, <p> Ir para a página de cursos <a href='index.php?p=meus_cursos'> Clique aqui </a></p>";

                        $update_creditos = $creditos - $preco;
                        $sql_update_creditos = "UPDATE usuarios SET creditos = '$update_creditos' WHERE id = '$user'";
                        $sql_exec = $mysqli->query($sql_update_creditos) or die($mysqli->error);


                        if ($sql_exec) {
                                return [
                                        "success" => $success
                                ];
                        }


                        $mysqli->close();
                } else {
                        $erro = "Você não possui créditos suficientes para adquirir este curso";
                        return [
                                "erro" => $erro
                        ];
                }
        }
}

$purchase = update_purchase_courses();



?>
<div class="page-header card">
        <div class="row align-items-end">
                <div class="col-lg-8">
                        <div class="page-header-title">
                                <i class="ti-control-play bg-c-pink"></i>
                                <div class="d-inline">
                                        <h4> Loja de Cursos </h4>
                                        <span>Adquira nossos cursos com os seus creditos</span>
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
                                        <li class="breadcrumb-item"> Loja de cursos </li>
                                </ul>
                        </div>
                </div>


        </div>


</div>

<?php if (isset($purchase['erro'])): ?>
        <div class="alert bg-danger text-white card" role="alert">
                <span class="text-center text-white mt-2 mb-2 p-2"> <?= $purchase['erro']; ?></span>
        </div>
<?php endif; ?>
<?php if (isset($purchase['success'])): ?>
        <div class="alert bg-success text-white card" role="alert">
                <span class="text-center text-white mt-2 mb-2 p-2"> <?= $purchase['success']; ?></span>
        </div>

<?php endif; ?>


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
                                                <form action="" method="POST">
                                                        <button type="submit" name="adquirir_curso" value="<?= $item['id'] ?>" class="btn btn-outline-success form-control col-sm-12"> Adquirir por <?= format_money($item['preco']) ?> </button>
                                                </form>

                                        </div>

                                </div>
                        <?php endforeach; ?>



                </div>
        </div>
</div>

</div>
</div>