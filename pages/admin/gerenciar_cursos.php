   <!-- Page-header start -->
   <?php

        include('./utils/functions.php');
        verify_protected_route(1);



        function list_all_courses()
        {
                include('./database/conexao.php');

                $sql_query = $mysqli->real_escape_string("SELECT * FROM cursos");
                $query_exec = $mysqli->query($sql_query) or die($mysqli->error);

                $all_courses = [];
                $num_courses = $query_exec->num_rows;

                if ($query_exec->num_rows > 0) {
                        while ($row = $query_exec->fetch_assoc()) {
                                array_push($all_courses, $row);
                        }
                }

                if (!empty($all_courses)) {
                        return [
                                "message" => "Dados buscados com sucesso",
                                "data" => $all_courses,
                                "num_courses" => $num_courses
                        ];
                } else {
                        return [
                                "message" => "Você não possui cursos cadastrados",
                                "num_courses" => 0
                        ];
                }
        }

        $result = list_all_courses();

        ?>
   <div class="page-header card">
           <div class="row align-items-center ">
                   <div class="col-lg-10">
                           <div class="page-header-title">
                                   <i class="ti-bag bg-c-pink"></i>
                                   <div class="d-inline">
                                           <h4>Gerenciar Cursos</h4>
                                           <span>Administre os cursos cadastrados no sistema</span>
                                   </div>
                           </div>
                   </div>
                   <div class="col-lg-2">
                           <a href="index.php?p=cadastrar_curso&admin=true" class="d-flex gap-2 btn btn-danger rounded-1 justify-content-center align-items-center btn-round"> <i class="ti-plus"></i>Adicionar novo curso</a>
                   </div>
           </div>

   </div>
   <!-- Basic table card start -->
   <div class="card">
           <div class="card-header">
                   <h4 class="text-secondary">Cursos cadastrados</h4>
                   <span>Visualize todos os cursos adicionados no sistema</span>
                   <div class="card-header-right">
                           <ul class="list-unstyled card-option">
                                   <li><i class="icofont icofont-simple-left "></i></li>
                                   <li><i class="icofont icofont-maximize full-card"></i></li>
                                   <li><i class="icofont icofont-minus minimize-card"></i></li>
                                   <li><i class="icofont icofont-refresh reload-card"></i></li>
                                   <li><i class="icofont icofont-error close-card"></i></li>
                           </ul>
                   </div>
           </div>

           <?php if ($result['num_courses'] == 0) { ?>
                   <span class="text-center text-secondary mt-2 mb-2 p-5"> Você não possui nenhum curso cadastrado, <a class="text-primary" href="index.php?p=cadastrar_curso&admin=true"> Clique aqui para adicionar um novo curso </a></span>
           <?php } else { ?>
                   <div class="card-block table-border-style">
                           <div class="table-responsive">

                                   <table class="table">
                                           <thead>
                                                   <tr>
                                                           <th>ID </th>
                                                           <th> Imagem </th>
                                                           <th>Titulo do Curso</th>
                                                           <th>Data do cadastro</th>
                                                           <th>Valor do Curso</th>
                                                           <th> Gerenciar </th>
                                                   </tr>
                                           </thead>
                                           <tbody>

                                                   <?php foreach ($result['data'] as $item): ?>
                                                           <tr>
                                                                   <th> <?= $item['id'] ?> </th>
                                                                   <td> <img src="<?= $item['imagem_curso'] ?>" alt="" height="50"> </td>
                                                                   <td> <?= $item['titulo'] ?></td>
                                                                   <td> <?= format_date($item['data_cadastro']); ?></td>
                                                                   <td> <?= format_money($item['preco']); ?></td>
                                                                   <td>
                                                                           <span><a href="index.php?p=editar_curso&admin=true&id=<?= $item['id'] ?>" class="text-success"> Editar </a></span>
                                                                           <span class="text-secondary"> | </span>
                                                                           <span><a href="index.php?p=excluir_curso&admin=true&id=<?= $item['id'] ?>" class="text-danger"> Excluir </a></span>
                                                                   </td>
                                                           </tr>

                                                   <?php endforeach; ?>

                                                   </tr>
                                           </tbody>
                                   </table>
                           </div>
                   </div>
           <?php } ?>

   </div>

   </div>
   </div>