<?php

if (!isset($_SESSION)) {
        session_start();
}

$id_user = intval($_SESSION['user']);


?>

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
<!-- Pre-loader end -->
<div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

                <nav class="navbar header-navbar pcoded-header">
                        <div class="navbar-wrapper">

                                <div class="navbar-logo">
                                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                                                <i class="ti-menu"></i>
                                        </a>
                                        <a class="mobile-search morphsearch-search" href="#">
                                                <i class="ti-search"></i>
                                        </a>
                                        <a href="index.php">
                                                <img src="./assets/images/logo_ead.png" width="100px" />
                                        </a>
                                        <a class="mobile-options">
                                                <i class="ti-more"></i>
                                        </a>
                                </div>

                                <div class="navbar-container container-fluid">
                                        <ul class="nav-left">
                                                <li>
                                                        <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                                                </li>

                                                <li>
                                                        <a href="#!" onclick="javascript:toggleFullScreen()">
                                                                <i class="ti-fullscreen"></i>
                                                        </a>
                                                </li>
                                        </ul>

                                        <ul class="nav-right">
                                                <?php if ($_SESSION['userAdmin'] == 0): ?>
                                                        <li class="header-notification">
                                                                <a href="#!">
                                                                        <i class="ti-money"></i>
                                                                        <span class="badge bg-c-pink text-center"></span>
                                                                </a>

                                                                <ul class="show-notification d-flex flex-column gap-1 justify-content-center align-items-start p-4">
                                                                        <p class=""> <b> Seus créditos: </b> <span> <?= format_money(get_name_user('creditos')); ?></span></p>
                                                                </ul>

                                                        </li>
                                                <?php endif; ?>
                                                <li class="user-profile header-notification">
                                                        <a href="#!">

                                                                <span> <?= get_name_user('nome'); ?></span>
                                                                <i class="ti-angle-down"></i>
                                                        </a>
                                                        <ul class="show-notification profile-notification">

                                                                <li>
                                                                        <a href="index.php?p=perfil&id=<?= $id_user ?>">
                                                                                <i class="ti-user"></i> Perfil
                                                                        </a>
                                                                </li>

                                                                <li>
                                                                        <a href="logout.php">
                                                                                <i class="ti-layout-sidebar-left"></i> Logout
                                                                        </a>
                                                                </li>
                                                        </ul>
                                                </li>
                                        </ul>

                                </div>
                        </div>
                </nav>

                <div class="pcoded-main-container">
                        <div class="pcoded-wrapper">
                                <nav class="pcoded-navbar">
                                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                                        <div class="pcoded-inner-navbar main-menu">
                                                <div class="">



                                                        <?php if ($_SESSION['userAdmin'] == 0 || !isset($_SESSION['userAdmin'])): ?>
                                                                <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Menu</div>
                                                                <ul class="pcoded-item pcoded-left-item">
                                                                        <li class="">
                                                                                <a href="index.php">
                                                                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                                                                        <span class="pcoded-mtext" data-i18n="nav.dash.main"> Página Inicial </span>
                                                                                        <span class="pcoded-mcaret"></span>
                                                                                </a>
                                                                        </li>
                                                                        <li class="">
                                                                                <a href="index.php?p=loja_cursos">
                                                                                        <span class="pcoded-micon"><i class="ti-bag"></i></span>
                                                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main"> Loja de Cursos</span>
                                                                                        <span class="pcoded-mcaret"></span>
                                                                                </a>
                                                                        </li>
                                                                        <li class="">
                                                                                <a href="index.php?p=meus_cursos">
                                                                                        <span class="pcoded-micon"><i class="ti-control-play"></i></span>
                                                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main"> Meus Cursos</span>
                                                                                        <span class="pcoded-mcaret"></span>
                                                                                </a>
                                                                        </li>
                                                                        <li class="">
                                                                                <a href="logout.php">
                                                                                        <span class="pcoded-micon"><i class="ti-arrow-left"></i></span>
                                                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main"> Sair </span>
                                                                                        <span class="pcoded-mcaret"></span>
                                                                                </a>
                                                                        </li>

                                                                </ul>
                                                        <?php endif; ?>
                                                        <?php if (isset($_SESSION['userAdmin']) && $_SESSION['userAdmin'] == 1): ?>
                                                                <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation"> Menu (Administrador) </div>
                                                                <ul class="pcoded-item pcoded-left-item">
                                                                        <li class="">
                                                                                <a href="index.php">
                                                                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                                                                        <span class="pcoded-mtext" data-i18n="nav.dash.main"> Página Inicial </span>
                                                                                        <span class="pcoded-mcaret"></span>
                                                                                </a>
                                                                        </li>
                                                                        <li class="">
                                                                                <a href="index.php?p=gerenciar_cursos&admin=true">
                                                                                        <span class="pcoded-micon"><i class="ti-bag"></i></span>
                                                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main"> Gerenciar cursos</span>
                                                                                        <span class="pcoded-mcaret"></span>
                                                                                </a>
                                                                        </li>
                                                                        <li class="">
                                                                                <a href="index.php?p=gerenciar_usuarios&admin=true">
                                                                                        <span class="pcoded-micon"><i class="ti-user"></i></span>
                                                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main"> Gerenciar usuários </span>
                                                                                        <span class="pcoded-mcaret"></span>
                                                                                </a>
                                                                        </li>
                                                                        <li class="">
                                                                                <a href="index.php?p=relatorio&admin=true">
                                                                                        <span class="pcoded-micon"><i class="ti-receipt"></i></span>
                                                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main"> Relatórios </span>
                                                                                        <span class="pcoded-mcaret"></span>
                                                                                </a>
                                                                        </li>

                                                                        <li class="">
                                                                                <a href="logout.php">
                                                                                        <span class="pcoded-micon"><i class="ti-arrow-left"></i></span>
                                                                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main"> Sair </span>
                                                                                        <span class="pcoded-mcaret"></span>
                                                                                </a>
                                                                        </li>

                                                                </ul>
                                                        <?php endif; ?>
                                </nav>