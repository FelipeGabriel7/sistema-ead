   <!-- Page-header start -->
   <?php

        include('./utils/functions.php');
        verify_protected_route(1);
        function report_view_list()
        {
                include('./database/conexao.php');
                $items = [];

                $sql_code = "SELECT 
                R.*,
                U.nome AS nome_user,
                U.email AS email,
                C.titulo AS nome_curso
                FROM relatorio R
                INNER JOIN cursos C ON R.id_curso = C.ID
                INNER JOIN usuarios U ON R.id_usuario = U.id";

                $sql_exec = $mysqli->query($sql_code) or die($mysqli->error);
                $num_relatorios = $sql_exec->num_rows;

                if ($num_relatorios > 0) {
                        while ($item = $sql_exec->fetch_assoc()) {
                                array_push($items, $item);
                        }
                }
                return [
                        "num_items" => $num_relatorios,
                        "data" => $items
                ];
        }

        $items = report_view_list();
        ?>
   <div class="page-header card">
           <div class="row align-items-center ">
                   <div class="col-lg-10">
                           <div class="page-header-title">
                                   <i class="ti-panel bg-c-green"></i>
                                   <div class="d-inline">
                                           <h4>Relatórios </h4>
                                           <span>Visualize as entradas e saida do sistema</span>
                                   </div>
                           </div>
                   </div>

           </div>

   </div>
   <!-- Basic table card start -->
   <div class="card">
           <div class="card-header">
                   <h4 class="text-secondary"> Movimentações </h4>
                   <span>Visualize todas as entradas/saidas do sistema </span>
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

           <?php if ($items['num_items'] == 0) { ?>
                   <span class="text-center text-secondary mt-2 mb-2 p-5"> Você não possui nenhum curso cadastrado, <a class="text-primary" href="index.php?p=cadastrar_usuario&admin=true"> Clique aqui para adicionar um novo curso </a></span>
           <?php } else { ?>
                   <div class="card-block table-border-style">
                           <div class="table-responsive">

                                   <table class="table">
                                           <thead>
                                                   <tr>
                                                           <th>ID </th>
                                                           <th> Usuário </th>
                                                           <th> E-mail usuário</th>
                                                           <th> Curso </th>
                                                           <th> Data da compra</th>
                                                           <th> Valor </th>
                                                   </tr>
                                           </thead>
                                           <tbody>

                                                   <?php foreach ($items['data'] as $item): ?>
                                                           <tr>
                                                                   <th> <?= $item['id'] ?> </th>
                                                                   <td> <?= $item['nome_user'] ?></td>
                                                                   <td> <?= $item['email'] ?></td>
                                                                   <td> <?= $item['nome_curso'] ?></td>
                                                                   <td> <?= format_date($item['data_compra']); ?></td>
                                                                   <td> <?= format_money($item['valor']); ?></td>
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