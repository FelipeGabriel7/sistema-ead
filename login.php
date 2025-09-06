<?php
function verify_user_exist()
{
    include("./database/conexao.php");
    include("./utils/session_user.php");

    if (isset($_POST['Acessar'])) {

        $erro = [];
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        if (empty($email)) {
            $erro[] = "Informe um e-mail válido para realizar o login.";
        }
        if (empty($senha) || strlen($senha) < 8 || $senha === "") {
            $erro[] = "Senha inválida, a senha deve possuir 8 caracteres";
        }

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email'";
        $sql_exec = $mysqli->query($sql_code) or die($mysqli->error);
        $user = $sql_exec->fetch_assoc();

        if ($user) {
            $verify_password = password_verify($senha, $user['senha']);

            if ($verify_password) {
                create_sessions_user($user);
                return;
            } else {
                $erro[]  = "A senha informada é inválida, tente novamente";
            }
        }

        if (count($erro) > 0) {
            return [
                "erro" => $erro
            ];
        }
    }
}

$user_login = verify_user_exist();

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
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
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
                                    <?php if (isset($user_login['erro'])): ?>
                                        <div class="alert text-start alert-danger" role="alert">
                                            <?php foreach ($user_login['erro'] as $error) {
                                                echo "$error." . " " . " <br/>";
                                            } ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-12">
                                        <h3 class="text-left txt-primary">Entrar </h3>
                                    </div>
                                </div>
                                <hr />
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control" placeholder="Informe seu e-mail">
                                    <span class="md-line"></span>
                                </div>
                                <div class="input-group">
                                    <input type="password" name="senha" class="form-control" placeholder="Informe sua senha">
                                    <span class="md-line"></span>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div>
                                        <a href="esqueceu_senha.php" class="text-right f-w-600  text-secondary pointer"> Esqueceu sua senha? </a>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" name="Acessar" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20"> Acessar </button>
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