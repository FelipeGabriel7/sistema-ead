<?php

function verify_exist_user()
{
    include("./database/conexao.php");
    include("./utils/session_user.php");
    include("./utils/sendEmail.php");
    include("./utils/generateRandomPassword.php");

    if (isset($_POST['reset_password'])) {
        $random_password = generateRandomString(8);

        $email_reset_password = $mysqli->real_escape_string($_POST['email_reset_password']);
        $erro = "";


        if (empty($email_reset_password)) $erro = "Informe um e-mail válido para recuperar a senha, caso exista o e-mail será enviado uma senha para a recuperação de senha";

        if (isset($erro) && $erro !== "") {
            return [
                "erro" => $erro
            ];
        }

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email_reset_password'";
        $sql_exec = $mysqli->query($sql_code) or die($mysqli->error);
        $user = $sql_exec->fetch_assoc();

        if ($user['id']) {
            $id_user = $user['id'];
            $random_password_hash = password_hash($random_password, PASSWORD_BCRYPT);
            $query = "UPDATE usuarios SET senha = '$random_password_hash' WHERE id = '$id_user'";
            $sql_exec = $mysqli->query($query) or die($mysqli->error);
            $name_user = $user['nome'];


            send_to_email($email_reset_password, "Sua nova senha para acesso a plataforma EAD", "
            <h1> Olá $name_user, está é será suas nova senha para acesso a plataforma  </h1>
            <span> Sua senha: $random_password </span>
            <div>
                <p> Recomendamos que após acessar a plataforma, acesse o perfil e altere sua senha. </p>
                <a href='http://localhost:3000/login.php'> Acessar a plataforma </a>
            </div>
        ");

            $msg = "O e-mail com a nova senha de acesso foi enviado!";

            return [
                "msg" => $msg
            ];
        }
    }
}

$recovery_password = verify_exist_user();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Sistemas EAD </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="CodedThemes">
    <meta name="keywords" content=" Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="CodedThemes">
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>

    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <form class="md-float-material" action="" method="POST">

                            <div class="auth-box">
                                <div class="d-flex justify-content-center align-items-center flex-column">
                                    <div class="text-center align-items-center">
                                        <img src="assets/images/auth/logo_system_sem_fundo.png" style="width: 200px; height: 200px;" alt="logo.png">
                                    </div>
                                    <?php if (isset($recovery_password['erro'])): ?>
                                        <div class="alert text-start alert-danger" role="alert">
                                            <?= $recovery_password['erro'] ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (isset($recovery_password['msg'])): ?>
                                        <div class="alert text-start alert-success" role="alert">
                                            <?= $recovery_password['msg'] ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-12">
                                        <h3 class="text-left txt-primary"> Recuperar senha </h3>
                                        <p class="text-secondary text-left"> Informe seu e-mail para redefinir sua senha, será enviado uma nova senha para acesso ao sistema</p>
                                    </div>
                                </div>
                                <hr />
                                <div class="input-group">
                                    <input type="email" name="email_reset_password" class="form-control" placeholder="Informe seu e-mail para recuperar sua senha">
                                    <span class="md-line"></span>
                                </div>
                                <div class="d-flex justify-content-end pointer">
                                    <a href="login.php" class="text-right f-w-600  text-primary pointer"> Voltar </a>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" name="reset_password" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20"> Recuperar senha </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>

    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="assets/js/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="assets/js/modernizr/css-scrollbars.js"></script>
    <script type="text/javascript" src="assets/js/common-pages.js"></script>
</body>

</html>