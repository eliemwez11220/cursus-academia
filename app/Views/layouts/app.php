<?php

if (session()->get('status') == 'lockscreen') {
    return redirect()->to(base_url('profile/lockscreen'));
}


$uri = service('uri');
$totalSegments = $uri->getTotalSegments();
$urlParam1 = ($totalSegments >= 0) ? $uri->getSegment(1) : '';
$urlParam2 = ($totalSegments >= 1) ? $uri->getSegment(2) : '';
$urlParam3 = ($totalSegments >= 3) ? $uri->getSegment(3) : '';
$urlParams = $uri->getSegments();
$urlCurrent = (uri_string());

$request = \Config\Services::request();
$session = \Config\Services::session();

$theme = esc($request->getGet('theme') != '') ? esc($request->getGet('theme')) : $session->get('theme');
$urlThemeAdded = base_url() . '/' . (uri_string());

$navbar = '';
$sidebar = '';

switch ($theme) {
    case 'black':
        $navbar = 'navbar-dark';
        $sidebar = 'sidebar-dark-light';
        break;
    case 'success':
        $navbar = 'navbar-dark navbar-success';
        $sidebar = 'sidebar-light-green';
        break;
    case 'orange':
        $navbar = 'navbar-dark navbar-warning';
        $sidebar = 'sidebar-dark-warning';
        break;
    case 'blue':
        $navbar = 'navbar-dark navbar-primary';
        $sidebar = 'sidebar-dark-primary';
        break;
    case 'light':
        $navbar = 'navbar-white navbar-light';
        $sidebar = 'sidebar-light-gray';
        break;
    default:
        $navbar = 'navbar-dark navbar-primary';
        $sidebar = 'sidebar-dark-primary';
}
$dataTheme = array(
    'navbar' => $navbar,
    'sidebar' => $sidebar,
    'theme' => $theme,
);
$session->set($dataTheme);


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- FOR XSS ATTACKS -->
    <meta charset="utf-8">
    <?= csrf_meta() ?>
    <!-- Locale -->
    <!-- To the Future  Meta Tags -->
    <meta http-equiv="Content-Language" content="fr">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if($urlParam1 == "rapport"):?>
        <title>Rapport</title>
    <?php else: ?>
        <title> <?= (isset($title)) ? $title : ' Tableau de bord '; ?> - ISS PALMARES</title>
    <?php endif; ?>
    <link rel="icon" type="image/png" href="<?= base_url('global/img/esp.webp'); ?>"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('global/plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('global/plugins/daterangepicker/daterangepicker.css'); ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('global/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
          href="<?= base_url('global/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
    <!-- Select2 for select items options-->
    <link rel="stylesheet" href="<?= base_url('global/plugins/select2/css/select2.min.css'); ?>">
    <link rel="stylesheet"
          href="<?= base_url('global/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('global/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
    <!-- summernote for editor -->
    <link rel="stylesheet" href="<?= base_url('global/plugins/summernote/summernote-bs4.css'); ?>">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('global/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">
    <!-- DataTables  -->
    <link rel="stylesheet" href="<?= base_url('global/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet"
          href="<?= base_url('global/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('global/dist/css/adminlte.min.css'); ?>">

    <style type="text/css" media="print">

        .printoff {
            display: none !important;
        }
        @media screen {
  div.footer-options {
    display: none;
  }
}
@media print { 
        
    @page {
        max-height: 100% !important;
                max-width: 100% !important;
                margin-top: 30px !important;
                margin-bottom: 30px !important;
                margin-left: 0 !important;
                margin-right: 0 !important;
                padding: 0 !important;
                
                <?php if($urlParam3 == "minerval"):?>
                    
                    zoom: 130% !important;
                <?php else:?>
                    zoom: 110% !important;
                size: A4 portrait;
                <?php endif; ?>
            }
  div.footer-options {
    position: fixed;
    bottom: 0;
    bottom: 0;
  }

            body {
                page-break-before: always!important;
                width: 100% !important;
                height: 100% !important;
                padding-bottom: 10 !important;
                max-height: 100% !important;
                max-width: 100% !important;
            }
         
            table {
                display: block !important;
                zoom: 110% !important;
                font-size: 15px!important;
            }
        }

    </style>
    <script type="text/javascript">
        setTimeout(function () {
            $('#hiddensuccessmsg').hide();
            $('#hiddenerrorsmsg').hide();
        }, 15000);
    </script>
</head>
<body style="font-family: Roboto, Segoe UI, sans-serif!important;"
      class="hold-transition <?= (($urlParam1 == 'finance' && $urlParam3 == 'paiement')) ? 'sidebar-collapse' : 'sidebar-mini' ?> layout-fixed">

<!-- Site wrapper -->
<div class="wrapper">

    <!-- Navbar navbar-white navbar-light elevation-4-->
    <nav class="main-header navbar navbar-expand fixed-top <?= $session->get('navbar'); ?>">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            
        
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"
                data-toggle="tooltip" data-placement="bottom"
                                   title="Paramètres du provil">
                    <i class="fa fa-cogs fa-lg"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('secure/disconnect'); ?>" class="nav-link btn btn-danger"

                   onclick="return confirm ('Voulez-vous vraiment quitter cette application ?');"
                   
                   data-toggle="tooltip" data-placement="bottom"
                                   title="Fermer l'application">
                    <i class="fa fa-power-off fa-lg"></i>
                </a>
            </li>
        </ul>
    </nav>
    <div class="collapse" id="search-input-box">
        <div class="container">
            <form id="formSearchAdvanced" method="post" action="<?= base_url('overview/search'); ?>">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <div class="d-inline">
                            <div class="input-group">
                                <input class="form-control form-control-lg" type="search" name="query"
                                       placeholder="Saisissez le nom ou le numéro matricule de l'étudiant"
                                       aria-label="Search" autofocus
                                       style="border-top-left-radius: 100px!important; border-bottom-left-radius: 100px!important;">
                                <div class="input-group-append">
                                    <button class="btn btn-default btn-lg" type="submit"
                                            style="border-top-right-radius: 100px!important; border-bottom-right-radius: 100px!important;">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="mb-5 mt-5">
        <h1></h1>
    </div>
    <?php
    $session = \Config\Services::session();
    if (isset($session->failed)) : ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <div id="hiddenerrorsmsg" class="alert alert-danger text-center text-uppercase">
                        <span class="fa fa-windows-close"> </span>
                        <?= $session->getFlashdata('failed');
                        $session->remove('failed'); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if (isset($session->success)) : ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <div id="hiddensuccessmsg" class="alert alert-success text-center text-uppercase">
                        <span class="fa fa-check-circle"> </span> <?= $session->getFlashdata('success');
                        $session->remove('success'); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if (isset($session->info)) : ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <div id="hiddensuccessmsg" class="alert alert-warning text-center text-uppercase">
                        <span class="fa fa-exclamation-triangle"> </span> <?= $session->getFlashdata('info');
                        $session->remove('info'); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
   <!-- Main Sidebar Container -dark-primary nav-flat fixed-sidebar nav-child-indent nav-compact nav-flat  nav-legacy-->
   <aside class="main-sidebar sidebar-mini text-sm  fixed-sidebar nav-child-indent nav-compact  sidebar-no-expand <?= $session->get('sidebar') ?>">
          <div class="brand-link mb-2 text-center bg-light">
            <!-- text brand-->
            <div class="brand-text font-weight-bold dropdown mt-1">
                <h5 class="font-weight-bold text-uppercase text-dark">
                    <?= $session->groupe; ?>
                </h5>
                <h5 class="font-weight-bold text-uppercase text-dark">
                    <?= $session->yearlibelle; ?>
                </h5>
            </div> 
        </div>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                                <a href="<?= base_url('overview'); ?>"
                                   class="nav-link <?= ($urlCurrent == 'overview') ? 'active' : '' ?>">

                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Accueil
                                    </p>
                                </a>
                            </li>

                    <?php if($session->groupe == "secretaire" OR $session->role == "secretaire" OR $session->usertype == "sysadmin"): ?>
                    <?php endif; ?>
                    <li class="nav-item has-treeview hidden <?= ($urlParam1 == 'student' or $urlParam2 == 'dossier') ? 'menu-open' : '' ?>">
                        <a href="#"
                           class="nav-link <?= ($urlParam1 == 'student' or $urlParam2 == 'dossier') ? 'active' : '' ?>">
                            <i class="nav-icon fa fa-folder-open"></i>
                            <p>
                                Gestion étudiants
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <!-- ($urlParam2 == 'dossier' OR $urlParam2 == 'details' OR $urlParam2 == 'details') &&   -->
                                <a href="<?= base_url('student/addForm/inscription'); ?>"
                                   class="nav-link <?= ($urlParam2 == 'addform' && $urlParam3 == 'inscription') ? 'active' : '' ?>">
                                    <i class="fas fa-circle nav-icon"></i>
                                    <p>Identification</p>
                                    
                                </a>
                            </li>
                            <li class="nav-item">
                                <!-- ($urlParam2 == 'dossier' OR $urlParam2 == 'details' OR $urlParam2 == 'details') &&   -->
                                <a href="<?= base_url('student/dossier/inscription'); ?>"
                                   class="nav-link <?= ($urlParam1 == 'student' && $urlParam1 == 'inscription') ? 'active' : '' ?>">
                                    <i class="fas fa-circle nav-icon"></i>
                                    <p>Dossiers Etudiants</p>
                                    
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="<?= base_url('student/cursus/parcours'); ?>"
                                   class="nav-link <?= ($urlCurrent == 'student/cursus/parcours') ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-circle"></i>
                                    <p>
                                        Cursus Académiques
                                    </p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?= ($urlParam1 == 'ecole') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= ($urlParam1 == 'ecole') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Configuration
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('ecole/view/promotions'); ?>"
                                   class="nav-link <?= ($urlCurrent == 'ecole/view/promotions') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Promotions</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('ecole/view/cycles'); ?>"
                                   class="nav-link <?= ($urlCurrent == 'ecole/view/cycles') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Cycles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('ecole/view/filieres'); ?>"
                                   class="nav-link <?= ($urlCurrent == 'ecole/view/filieres') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Options / Filières</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('ecole/view/annees'); ?>"
                                   class="nav-link <?= ($urlCurrent == 'ecole/view/annees') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Années</p>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="<?= base_url('ecole/view/periodes'); ?>"
                                   class="nav-link <?= ($urlCurrent == 'ecole/view/periodes') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Périodes</p>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="<?= base_url('ecole/view/typesstudents'); ?>"
                                   class="nav-link <?= ($urlCurrent == 'ecole/view/typesstudents') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Categories Etudiants </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?= ($urlParam1 == 'cours') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= ($urlParam1 == 'cours') ? 'active' : '' ?>">
                            <i class="nav-icon fa fa-calendar-day"></i>
                            <p>
                                Enseignement
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                           <?php if($session->groupe == "enseignants" OR $session->role == "enseignant"): ?>
 
                            <li class="nav-item">
                                <a href="<?= base_url('cours/view/cotes'); ?>"
                                   class="nav-link <?= ($urlCurrent == 'cours/view/cotes') ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-circle"></i>
                                    <p class="text-capitalize">
                                        Cotations
                                    </p>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a href="<?= base_url('cours/view/matieres'); ?>"
                                   class="nav-link <?= ($urlCurrent == 'cours/view/matieres') ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-circle"></i>
                                    <p>Cours </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('ecole/view/branches'); ?>"
                                   class="nav-link <?= ($urlCurrent == 'ecole/view/branches') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Branches </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <?= ($urlParam1 == 'admin') ? 'menu-open' : '' ?>">
                        <a href="#"
                           class="nav-link <?= ($urlParam2 == 'group' or $urlParam2 == 'account') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>
                                Administration
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('agent/view/fonctions'); ?>"
                                   class="nav-link <?= ($urlCurrent == 'agent/view/fonctions') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Fonctions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('agent/view/grades'); ?>"
                                   class="nav-link <?= ($urlCurrent == 'agent/view/grades') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Grades</p>
                                </a>
                            </li>
                           <li class="nav-item">
                                <a href="<?= base_url('agent/view/secteurs'); ?>"
                                   class="nav-link <?= ($urlCurrent == 'agent/view/secteurs') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Services</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('agent/view/personnels'); ?>"
                                   class="nav-link <?= ($urlCurrent == 'agent/view/personnels') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Personnels</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/view/group'); ?>"
                                   class="nav-link <?= ($urlCurrent == 'admin/view/group') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Rôles Utilisateurs</p> <!-- Types Profiles -->
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/view/account'); ?>"
                                   class="nav-link <?= ($urlCurrent == 'admin/view/account') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Utilisateurs</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview <!!?= ($urlParam1 == 'rapport' && $urlParam2 == 'finances') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-print"></i>
                            <p>
                                Documents
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('office/students'); ?>"
                                   class="nav-link <?= ($urlCurrent == 'office/students') ? 'active' : '' ?>">
                                    <i class="fas fa-circle nav-icon"></i>
                                    <p>Palmares</p>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="<?= base_url('office/deliberation'); ?>"
                                   class="nav-link <?= ($urlCurrent == 'office/deliberation') ? 'active' : '' ?>">
                                    <i class="fas fa-circle nav-icon"></i>
                                    <p>Archives Resultats</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('office/grille'); ?>"
                                   class="nav-link <?= ($urlCurrent == 'office/grille') ? 'active' : '' ?>">
                                    <i class="fas fa-circle nav-icon"></i>
                                    <p>Grilles Déliberation</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <!-- Main content 
    <div class="page-number"></div>-->
    <?php
    if (isset($_view) && $_view)
        echo view($_view);
    ?>
     <div class="container footer-options">
           
            <?php  if($urlParam1 == "rapport"):?>
                <div class="float-right mt-5 mr-3">
                <span class="font-weight-bold small"> <?= date("d/m/Y H:i:s"); ?> </span>
            </div>
                <?php endif; ?>
        <!-- Control Sidebar
        <div class="float-right mr-5">
            <span class="font-weight-bold counter-pages" id="num-page"></span>
            <span>/</span>
            <span class="font-weight-bold counter-pages" id="total-pages"></span>
        </div>-->
    </div>

    <footer class="main-footer small printoff">
        
        <span class="d-none d-sm-block"> Tous droits réservés </span>
        <strong>&copy;
            <script>
                document.write(new Date().getFullYear());
            </script> ESP DELIBERATION
        </strong>
        </div>
    </footer>
    <!-- Control Sidebar-->
    <!-- Control sidebar content goes here -->
    <aside class="control-sidebar card mt-5">
        <div class="text-center mt-5">
            <img src="<?= ($session->get('avatar') != '') ? $session->get('avatar') : site_url('global/img/avatar.png'); ?>"
                 alt="Avatar" class="img-circle text-center"
                 style="border-radius: 100px!important; width: 50px!important; height:50px!important;"/>
            <h3 class="text-uppercase small">
                <?= $session->get('fullname') ?> - <?= $session->get('role') ?>
            </h3>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12">
                <?php if ($session->profile == 'sysadmin' or $session->profile == 'client') : ?>
                    <?php if ($session->schooluid != '') : ?>
                        <a class="btn btn-xs btn-info text-uppercase" href="<?= base_url('ecole/fiche'); ?>">Gerer Fiche
                            Ecole</a>
                    <?php endif; ?>
                    <a class="btn btn-xs btn-info text-uppercase" href="<?= base_url('admin/profile'); ?>">Gerer mon
                        Profile</a>
                <?php endif; ?>
            </div>
            <div class="col-12 col-sm-12">
                <div class="card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            <?php if ($session->profile != 'sysadmin') : ?>
                                <li class="nav-item">
                                    <a class="nav-link active text-info" id="custom-tabs-two-home-tab"
                                       data-toggle="pill" href="#custom-tabs-two-home" role="tab"
                                       aria-controls="custom-tabs-two-home" aria-selected="true">Paramètres</a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link text-info" id="custom-tabs-two-profile-tab" data-toggle="pill"
                                   href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile"
                                   aria-selected="false">Thèmes</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-two-tabContent">
                            <div class="tab-pane <?= ($session->profile != 'sysadmin') ? 'fade show active' : '' ?>"
                                 id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                <a href="<?= base_url('profile/page/manage'); ?>" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <i class="fa fa-user fa-2x img-circle"></i>
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title text-dark">
                                                Mon profil
                                            </h3>
                                            <p class="text-sm text-muted">Gérer votre profil </p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="<?= base_url('profile/page/password'); ?>" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <i class="fa fa-lock fa-2x img-circle"></i>
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title text-dark">
                                                Changer mot de passe
                                            </h3>
                                            <p class="text-sm text-muted">Gérer votre mot de passe. </p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="<?= base_url('profile/page/picture'); ?>" class="dropdown-item btn btn-link">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <i class="fa fa-image fa-2x img-circle"></i>
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title text-dark">
                                                Changer Avatar
                                            </h3>
                                            <p class="text-sm text-muted">Gérer votre photo de profil </p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>

                                <a href="<?= base_url('profile/page/preferences'); ?>" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <i class="fa fa-cog fa-2x img-circle"></i>
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title text-dark">
                                                Paramètres
                                            </h3>
                                            <p class="text-sm text-muted">Gérer vos preferences profil </p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>

                                <div class="dropdown-divider"></div>
                                <a href="<?= base_url('profile/lockscreen'); ?>" class="dropdown-item mb-5"
                                   onclick="return confirm ('Voulez-vous vraiment mettre en veille cette application ?');">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <i class="fa fa-clock fa-2x img-circle"></i>
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title text-dark">
                                                Mettre en veille
                                            </h3>
                                            <p class="text-sm text-muted">Mise en veille prolongée </p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                            </div>
                            <div class="tab-pane fade <?= ($session->profile == 'sysadmin') ? 'fade show active' : '' ?>"
                                 id="custom-tabs-two-profile" role="tabpanel"
                                 aria-labelledby="custom-tabs-two-profile-tab">


                                <a href="<?= $urlThemeAdded . '?theme=success'; ?>"
                                   class="dropdown-item btn btn-success">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <i class="fa fa-circle fa-2x text-success img-circle"></i>
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title text-dark">
                                                Theme Vert
                                            </h3>
                                            <p class="text-sm text-muted">Changer l'arriere-plan en vert</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="<?= $urlThemeAdded . '?theme=orange'; ?>"
                                   class="dropdown-item btn btn-warning">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <i class="fa fa-circle fa-2x text-warning img-circle"></i>
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title text-dark">
                                                Theme Orange
                                            </h3>
                                            <p class="text-sm text-muted">Changer l'arriere-plan en orange</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>

                                <div class="dropdown-divider"></div>
                                <a href="<?= $urlThemeAdded . '?theme=black'; ?>" class="dropdown-item btn btn-dark">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <i class="fa fa-circle fa-2x text-dark img-circle"></i>
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title text-dark">
                                                Theme Noir
                                            </h3>
                                            <p class="text-sm text-muted">Changer l'arriere-plan en noir</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>

                                <div class="dropdown-divider"></div>
                                <a href="<?= $urlThemeAdded . '?theme=light'; ?>" class="dropdown-item btn btn-light">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <i class="fa fa-circle fa-2x text-secondary img-circle"></i>
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title text-dark">
                                                Theme Blanc
                                            </h3>
                                            <p class="text-sm text-muted">Changer l'arriere-plan en blanc</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="<?= $urlThemeAdded . '?theme=blue'; ?>" class="dropdown-item btn btn-primary">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <i class="fa fa-circle fa-2x text-primary img-circle"></i>
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title text-dark">
                                                Theme Bleu
                                            </h3>
                                            <p class="text-sm text-muted">Changer l'arriere-plan en bleu</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                            </div>

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- Modal Help Users -->
<div class="modal fade" id="help_users_support_center">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Assistance technique</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url() . '/support/helpUser/', $attributes);
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="code_annee_scolaire" class="control-label">
                                <span class="text-danger">*</span> Titre Objet
                            </label>
                            <input type="text" class="form-control bg-light text-capitalize" name="title_help"
                                   id="code_annee_scolaire" value="<?= set_value('code_annee') ?>"
                                   style="border-radius: 10px!important;" required/>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="code_annee_scolaire" class="control-label">
                                <span class="text-danger">*</span> Message
                            </label>
                            <textarea name="message_help" class="form-control" rows="5"
                                      placeholder="Decrivez votre problème ici..."><?= set_value('message_help') ?></textarea>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-info btn-sm text-uppercase">Envoyer</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer</button>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
         

<!-- /.modal -->      
<!-- jQuery -->
<script src="<?= base_url('global/plugins/jquery/jquery.js'); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('global/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>" defer></script>
<?php if ($urlParam1 == 'overview') : ?>
    <!-- ChartJS -->
    <script src="<?= base_url('global/plugins/chart.js/Chart.min.js'); ?>"></script>
    <!-- Sparkline -->
    <script src="<?= base_url('global/plugins/sparklines/sparkline.js'); ?>" defer></script>
<?php endif; ?>
<!-- Select2 -->
<script src="<?= base_url('global/plugins/select2/js/select2.full.min.js'); ?>" defer></script>
<?php if ($urlParam2 == 'editForm' OR $urlParam2 == 'dossier' OR strtolower($urlParam2) == 'addform' OR $urlParam2 == 'compose' or $urlParam3 == "create" or $urlParam1 == "rapport" or $urlParam2 == "changeSchoolYear") : ?>
    <!-- InputMask -->
    <script src="<?= base_url('global/plugins/moment/moment.min.js'); ?>" defer></script>
    <script src="<?= base_url('global/plugins/inputmask/min/jquery.inputmask.bundle.min.js'); ?>" defer></script>
    <!-- daterangepicker -->
    <script src="<?= base_url('global/plugins/daterangepicker/daterangepicker.js'); ?>" defer></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url('global/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"
            defer></script>
    <!-- Summernote -->
    <script src="<?= base_url('global/plugins/summernote/summernote-bs4.min.js'); ?>" defer></script>
    <script>
        //datetimepicker manage
        $(function () {
            //Add text editor
            $('#compose-textarea').summernote();
            $('#composemessage').summernote();
            //Initialize Select2 Elements
            $('.select2').select2();
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
            //Money Euro
            $('[data-mask]').inputmask();

            //Date range picker
            $('#reservation').daterangepicker();
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            });
            //Date range picker
            $('#date_format_abrege').datetimepicker({
                format: 'YYYY/MM/DD'
            }); //Date range picker
            $('#date_debut_annee').datetimepicker({
                format: 'YYYY/MM/DD'
            });
            //Date range picker
            $('#date_fin_annee').datetimepicker({
                format: 'YYYY/MM/DD'
            });
            //Timepicker
            $('#timepickerMatin').datetimepicker({
                format: 'LT'
            });
            //Timepicker
            $('#timepickerSoir').datetimepicker({
                format: 'LT'
            });
            $("input[data-bootstrap-switch]").each(function () {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });
        });
    </script>
<?php endif; ?>
<?php if ($urlParam2 == 'view' or $urlParam2 == 'dossier' or $urlParam2 == 'cursus' or $urlParam2 == 'search' or $urlParam1 == 'rapport') : ?>
    <!-- DataTables --> <!-- DataTables -->
    <script src="<?= base_url('global/plugins/datatables/jquery.dataTables.js'); ?>"></script>
    <script src="<?= base_url('global/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>" defer></script>
    <script src="<?= base_url('global/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"
            defer></script>
    <script src="<?= base_url('global/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"
            defer></script>
    <script type="text/javascript">
        //datatables function
        $(function () {
            $('#datatablesExample2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
        //table without min actions
        $(function () {
            $('#datatablesWithoutActions').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": false,
                "autoWidth": true,
                "responsive": false,
            });
        }); //table for reprting status actions
        $(function () {
            $('#datatablesReportingActions').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": true,
                "responsive": false,
            });
        });
    </script>
<?php endif; ?>
<!-- Scroll to top -->
<script src="<?= base_url('global/'); ?>dist/js/scrolltotop.js" defer></script>
<!-- AdminLTE App -->
<script src="<?= base_url('global/dist/js/adminlte.min.js'); ?>" defer></script>

<?php if ($urlParam2 == 'addform' && $urlParam3 == 'matiere') : ?>
   
<script type="text/javascript">
    let ponderation = null;
    $('#volume_horaire').keyup(function () {
        let credit = $('#credit_horaire').val();
        let volume = $(this).val();
        if (volume !== '' && credit !== '') {
            ponderation = volume / credit;
            $('#ponderation').val(ponderation);
        }
    });
    $('#credit_horaire').keyup(function () {
        let  volume= $('#volume_horaire').val();
        let  credit = $(this).val();
        if (volume !== '' && credit !== '') {
            ponderation = volume / credit;
            $('#ponderation').val(ponderation);
        }
    });
</script>
<?php endif; ?>
<!-- GET student DETAILS-->
<script type="text/javascript">
    <?php header('Content-type: application/json'); ?>
    $('#etudiant_uid').on('change', function () {
        student_data_uid = $(this).val();
        if (student_data_uid !== '') {
            let urlBase = "<?= base_url('ajaxController/students/') ?>/" + student_data_uid;
            $.ajax({
                url: urlBase,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    //$("input[name='crsf_test_name']").val(result['crsf']);
                    //console.log(data);
                    //$('#matricule_student').val(data.student_matricule);
                    $('#promotion_student').val(data.promotion_libelle);
                    location.reload();
                }
            });
        }
    });
</script>
<!-- GET TYPEFRAIS DETAILS-->
<script type="text/javascript">
    <?php header('Content-type: application/json'); ?>
    $('#typefrais_uid_payment').on('change', function () {
        let frais_type_uid = $(this).val();
        //console.log(frais_type_uid);
        if (frais_type_uid !== '') {
            let urlBase = "<?= base_url('ajaxController/frais/') ?>/" + frais_type_uid;
            $.ajax({
                url: urlBase,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    if (data.typesfrai_devise === 'USD') {
                        let montant_usd_converti = data.typesfrai_montant * $('#taux_journalier').val();
                        $('#montant_frais').val(montant_usd_converti.toFixed(2));
                    } else {
                        $('#montant_frais').val(data.typesfrai_montant);
                    }
                }
            });
        }
    });
</script>

<script>
    //Manage tooltip in page
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>

<script>
    jQuery(document).ready(function () {
        $('#type_frais_sid').on('change', function () {
            $select_frais = $(this).val();
            if ($select_frais === 'minerval')
                $('#div_minerval').slideDown();
            else
                $('#div_minerval').slideUp();

        });
        //enable add new element in  option
        $('select').on('change', function () {
            $select_new = $(this).val();
            if ($select_new === 'new')
                $('#inputnewitemshow').slideDown();
            else
                $('#inputnewitemshow').slideUp();
        });
        $('form').attr('autocomplete', 'off');
        $('input').addClass('printoff bg-light'); // add class to all input to change background
        $('label').addClass('printoff'); //add promotion to all label do not print
    });
</script>

<!--  -->
<?php if (isset($minerval) && isset($generaux) && isset($recettes) && isset($depenses)) : ?>
    <script defer>
        //statistiques de traitement de demandes de visas par mois
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"],
                //Passeports recus
                datasets: [{
                    label: '# MINERVAL',
                    data: [<?= $minerval[0]; ?>, <?= $minerval[1]; ?>, <?= $minerval[2]; ?>, <?= $minerval[3]; ?>,
                        <?= $minerval[4]; ?>, <?= $minerval[5]; ?>, <?= $minerval[6]; ?>, <?= $minerval[7]; ?>,
                        <?= $minerval[8]; ?>, <?= $minerval[9]; ?>, <?= $minerval[10]; ?>, <?= $minerval[11]; ?>
                    ],
                    backgroundColor: [
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                    ],
                    borderColor: [
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                    ],
                    borderWidth: 1
                },
                    {
                        label: '# FRAIS GENERAUX',
                        data: [<?= $generaux[0]; ?>, <?= $generaux[1]; ?>, <?= $generaux[2]; ?>, <?= $generaux[3]; ?>,
                            <?= $generaux[4]; ?>, <?= $generaux[5]; ?>, <?= $generaux[6]; ?>, <?= $generaux[7]; ?>,
                            <?= $generaux[8]; ?>, <?= $generaux[9]; ?>, <?= $generaux[10]; ?>, <?= $generaux[11]; ?>
                        ],
                        backgroundColor: [
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)'
                        ],
                        borderColor: [
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)',
                            'rgba(253, 180, 92)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '# AUTRES RECETTES',
                        data: [<?= $recettes[0]; ?>, <?= $recettes[1]; ?>, <?= $recettes[2]; ?>, <?= $recettes[3]; ?>,
                            <?= $recettes[4]; ?>, <?= $recettes[5]; ?>, <?= $recettes[6]; ?>, <?= $recettes[7]; ?>,
                            <?= $recettes[8]; ?>, <?= $recettes[9]; ?>, <?= $recettes[10]; ?>, <?= $recettes[11]; ?>
                        ],
                        backgroundColor: [
                            'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                            'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                            'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                            'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                            'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                            'rgba(0, 200, 81)', 'rgba(0, 200, 81)',
                        ],
                        borderColor: [
                            'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                            'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                            'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                            'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                            'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                            'rgba(0, 200, 81)', 'rgba(0, 200, 81)',
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '# DEPENSES',
                        data: [<?= $depenses[0]; ?>, <?= $depenses[1]; ?>, <?= $depenses[2]; ?>, <?= $depenses[3]; ?>,
                            <?= $depenses[4]; ?>, <?= $depenses[5]; ?>, <?= $depenses[6]; ?>, <?= $depenses[7]; ?>,
                            <?= $depenses[8]; ?>, <?= $depenses[9]; ?>, <?= $depenses[10]; ?>, <?= $depenses[11]; ?>
                        ],
                        backgroundColor: [
                            'rgb(255, 90, 94)',
                            'rgb(255, 90, 94)',
                            'rgba(255, 90, 94)',
                            'rgba(255, 90, 94)',
                            'rgba(255, 90, 94)',
                            'rgba(255, 90, 94)',

                            'rgb(255, 90, 94)',
                            'rgb(255, 90, 94)',
                            'rgba(255, 90, 94)',
                            'rgba(255, 90, 94)',
                            'rgba(255, 90, 94)',
                            'rgba(255, 90, 94)'
                        ],
                        borderColor: [
                            'rgb(255, 90, 94)',
                            'rgb(255, 90, 94)',
                            'rgba(255, 90, 94)',
                            'rgba(255, 90, 94)',
                            'rgba(255, 90, 94)',
                            'rgba(255, 90, 94)',

                            'rgb(255, 90, 94)',
                            'rgb(255, 90, 94)',
                            'rgba(255, 90, 94)',
                            'rgba(255, 90, 94)',
                            'rgba(255, 90, 94)',
                            'rgba(255, 90, 94)'
                        ],
                        borderWidth: 1
                    },
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
<?php endif; ?>
</body>
</html>