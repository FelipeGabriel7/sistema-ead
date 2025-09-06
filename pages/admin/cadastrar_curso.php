<?php
verify_protected_route(1);

function create_course()
{
        if (isset($_POST['enviar'])) {
                include("./database/conexao.php");
                include("./utils/enviarArquivo.php");

                $erro = [];
                $sucess = "";

                $title = $mysqli->real_escape_string($_POST['titulo']);
                $preco = $mysqli->real_escape_string(floatval($_POST['preco-curso']));
                $desc = $mysqli->real_escape_string($_POST['descricao']);
                $img = $_FILES['imagem'];
                $desc_smart = $mysqli->real_escape_string($_POST['descricao-curta']);


                if (empty($title)) $erro[] = "Preencha um titulo para o curso";
                if (empty($preco)) $erro[] = "Informe um preço válido para o curso";
                if (empty($desc)) $erro[] = "Informe uma descrição do curso";
                if (empty($img) || !isset($img) || $img['size'] === 0) $erro[] = "Selecione uma imagem válida";

                if (count($erro) > 0) {
                        return [
                                "erro" => $erro
                        ];
                } else {


                        $upload = enviarArquivo($_FILES['imagem']['error'], $_FILES['imagem']['size'], $_FILES['imagem']['name'], $_FILES['imagem']['tmp_name']);


                        if ($upload !== false) {

                                $sql_query = "INSERT INTO cursos (titulo, descricao, conteudo, data_cadastro, preco, imagem_curso) 
                                VALUES (
                                '$title', 
                                '$desc_smart', 
                                '$desc', 
                                NOW(), 
                                '$preco', 
                                '$upload'
                                )";

                                $sql_exec = $mysqli->query($sql_query);

                                if ($sql_exec) {
                                        $sucess = "Curso adicionado com sucesso! <a class='color_primary' href='index.php?p=gerenciar_cursos&admin=true'> Retornar a página de cursos </a>";
                                        return [
                                                "status" => 201,
                                                "success" => $sucess
                                        ];
                                } else {
                                        $erro[] = "Falha ao inserir registro no banco de dados" . $mysqli->error;
                                }
                        } else {
                                $erro[] = "Falha ao enviar a imagem, tente novamente mais tarde";
                        }
                }
        }
}

$course_create = create_course();


?>

<div class="page-header card">
        <div class="row align-items-end">
                <div class="col-lg-8">
                        <div class="page-header-title">
                                <i class="ti-bag bg-c-pink"></i>
                                <div class="d-inline">
                                        <h4>Cadastre seu curso</h4>
                                        <span>Preencha as informações e clique em salvar para cadastrar o curso</span>
                                </div>
                        </div>
                </div>
        </div>
</div>
<?php if (isset($course_create['erro'])): ?>
        <div class="alert alert-danger" role="alert">
                <?php foreach ($course_create['erro'] as $error) {
                        echo "$error." . " " . " <br/>";
                } ?>
        </div>
<?php endif; ?>
<?php if (isset($course_create['success'])): ?>
        <div class="alert alert-success" role="alert"> <?= $course_create['success'] ?></div>
<?php endif; ?>
<div class="page-body">
        <div class="card">
                <form class="p-4" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                                <div class="form-group col-md-6">
                                        <label for="inputEmail4">Titulo</label>
                                        <input type="text" class="form-control" id="titulo" placeholder="Informe o titulo do curso" name="titulo">
                                </div>
                                <div class="form-group col-md-6">
                                        <label for="inputEmail4"> Descrição Curta</label>
                                        <input type="text" class="form-control" id="titulo" placeholder="Descrição Curta" name="descricao-curta">
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="inputAddress"> Imagem </label>
                                <input type="file" class="form-control" id="imagem" placeholder="Selecione uma imagem" name="imagem">
                        </div>
                        <div class="form-group">
                                <label for="inputAddress2">Preço </label>
                                <input type="number" class="form-control" id="preco" placeholder="R$ 00,00" name="preco-curso">
                        </div>
                        <div class="form-group">
                                <label for="inputCity">Descrição </label>
                                <textarea type="textarea" cols="40" rows="5" class="form-control" id="inputCity" placeholder="informe a descrição" name="descricao"></textarea>
                        </div>


                        <button type="submit" class="btn btn-round btn-primary" name="enviar"> <i class="ti-save"></i>Cadastrar curso</button>

                        <a type="button" class="float-right btn btn-round btn-danger float-right text-white" href="index.php?p=gerenciar_cursos&admin=true"> <i class="ti-arrow-left"></i> Cancelar</a>
                </form>
        </div>

</div>
</div>


</div>
</div>