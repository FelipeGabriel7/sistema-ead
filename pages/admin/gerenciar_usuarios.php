   <!-- Page-header start -->
   <?php


        include('./utils/functions.php');
        verify_protected_route(1);

        function list_all_users()
        {
                include('./database/conexao.php');

                $sql_query = $mysqli->real_escape_string("SELECT * FROM usuarios");
                $query_exec = $mysqli->query($sql_query) or die($mysqli->error);

                $all_users = [];
                $num_users = $query_exec->num_rows;

                if ($query_exec->num_rows > 0) {
                        while ($row = $query_exec->fetch_assoc()) {
                                array_push($all_users, $row);
                        }
                }

                if (!empty($all_users)) {
                        return [
                                "message" => "Dados buscados com sucesso",
                                "data" => $all_users,
                                "num_users" => $num_users
                        ];
                } else {
                        return [
                                "message" => "Você não possui cursos cadastrados",
                                "num_users" => 0
                        ];
                }
        }

        $result = list_all_users();

        ?>
   <div class="page-header card">
           <div class="row align-items-center ">
                   <div class="col-lg-10">
                           <div class="page-header-title">
                                   <i class="ti-user bg-c-green"></i>
                                   <div class="d-inline">
                                           <h4>Gerenciar Usuários</h4>
                                           <span>Administre os usuários cadastrados no sistema</span>
                                   </div>
                           </div>
                   </div>
                   <div class="col-lg-2">
                           <a href="index.php?p=cadastrar_usuario&admin=true" class="d-flex gap-2 btn btn-success rounded-1 justify-content-center align-items-center btn-round"> <i class="ti-plus"></i> Cadastrar novo usuário</a>
                   </div>
           </div>

   </div>
   <!-- Basic table card start -->
   <div class="card">
           <div class="card-header">
                   <h4 class="text-secondary"> Usuários Cadastrados </h4>
                   <span>Visualize todos os usuários cadastrados no sistema</span>
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

           <?php if ($result['num_users'] == 0) { ?>
                   <span class="text-center text-secondary mt-2 mb-2 p-5"> Você não possui nenhum curso cadastrado, <a class="text-primary" href="index.php?p=cadastrar_usuario&admin=true"> Clique aqui para adicionar um novo curso </a></span>
           <?php } else { ?>
                   <div class="card-block table-border-style">
                           <div class="table-responsive">

                                   <table class="table">
                                           <thead>
                                                   <tr>
                                                           <th>ID </th>
                                                           <th> Usuário </th>
                                                           <th> Nme do Usuário </th>
                                                           <th>Data do cadastro</th>
                                                           <th> Créditos </th>
                                                           <th> Administrador? </th>
                                                           <th> Gerenciar </th>
                                                   </tr>
                                           </thead>
                                           <tbody>

                                                   <?php foreach ($result['data'] as $item): ?>
                                                           <tr>
                                                                   <th> <?= $item['id'] ?> </th>
                                                                   <td class="d-flex p-2">
                                                                           <h3 class="bg-success p-2" style="border-radius: 12px"> <i class="ti-user"></i></h3>
                                                                   </td>
                                                                   <td> <?= $item['nome'] ?></td>
                                                                   <td> <?= format_date($item['data_cadastro']); ?></td>
                                                                   <td> <?= format_money($item['creditos']); ?></td>
                                                                   <?php if ($item['isAdmin']) { ?>
                                                                           <td> Administrador </td>
                                                                   <?php } else { ?>
                                                                           <td> Usuário Padrão </td>
                                                                   <?php } ?>
                                                                   <td>
                                                                           <span><a href="index.php?p=editar_usuario&admin=true&id=<?= $item['id'] ?>" class="text-success"> Editar </a></span>
                                                                           <span class="text-secondary"> | </span>
                                                                           <span><a href="index.php?p=excluir_usuario&admin=true&id=<?= $item['id'] ?>" class="text-danger"> Excluir </a></span>
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