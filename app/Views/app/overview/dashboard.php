<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mb-2">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        Tableau de bord
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Vue d'ensemble</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </filiere>
    <!-- Main content -->

    <filiere class="content">
        <div class="container-fluid">
            <?php if (session()->get('profile') == 'sysadmin' && (session()->get('schooluid') =='')): ?>
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1">
                            <i class="fas fa-network-wired"></i>
                        </span>
                            <div class="info-box-content"><span
                                        class="info-box-text text-uppercase">Réseaux Ecoles</span>
                                <span class="info-box-number font-weight-bold">
                                <?= (isset($nb_reseaux) ? $nb_reseaux : ''); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1">
                            <i class="fas fa-building"></i>
                        </span>
                            <div class="info-box-content"><span class="info-box-text text-uppercase">Ecoles</span>
                                <span class="info-box-number font-weight-bold">
                                <?= (isset($nb_ecoles) ? $nb_ecoles : ''); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1">
                            <i class="fas fa-calendar-day"></i>
                        </span>
                            <div class="info-box-content"><span class="info-box-text text-uppercase">Années</span>
                                <span class="info-box-number font-weight-bold">
                                <?= (isset($nb_annees) ? $nb_annees : ''); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1">
                            <i class="fas fa-users-cog"></i>
                        </span>
                            <div class="info-box-content"><span class="info-box-text text-uppercase">Utilisateurs</span>
                                <span class="info-box-number font-weight-bold">
                                <?= (isset($nb_users) ? $nb_users : ''); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1">
                            <i class="fas fa-users"></i>
                        </span>
                            <div class="info-box-content"><span class="info-box-text text-uppercase">Elèves</span>
                                <span class="info-box-number font-weight-bold">
                                <?= (isset($nb_etudiants) ? $nb_etudiants : ''); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1">
                            <i class="fas fa-info-circle"></i>
                        </span>
                            <div class="info-box-content"><span class="info-box-text text-uppercase">promotions</span>
                                <span class="info-box-number font-weight-bold">
                                <?= (isset($nb_promotions) ? $nb_promotions : ''); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1">
                            <i class="fas fa-book-open"></i>
                        </span>
                            <div class="info-box-content"><span class="info-box-text text-uppercase">Options</span>
                                <span class="info-box-number font-weight-bold">
                                <?= (isset($nb_options) ? $nb_options : ''); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1">
                            <i class="fas fa-user-circle"></i>
                        </span>
                            <div class="info-box-content"><span class="info-box-text text-uppercase">Abonnés</span>
                                <span class="info-box-number font-weight-bold">
                                <?= (isset($nb_clients) ? $nb_clients : ''); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- ./col -->
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            <?php else: ?>
                <?php if (session()->get('profile') == 'client' && (session()->get('schooluid') == '')): ?>
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <!-- ./col -->
                        <div class="col-lg-6 col-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1">
                                    <i class="fas fa-building"></i>
                                </span>
                                <div class="info-box-content"><span
                                            class="info-box-text text-uppercase">Total Ecoles</span>
                                    <span class="info-box-number font-weight-bold">
                                        <?= (isset($nb_schools) ? $nb_schools : ''); ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <!-- Widget: user widget style 1 -->
                            <div class="card card-widget widget-user">
                                <!-- Add the bg color to the header using any of the bg-* promotions -->
                                <div class="widget-user-header bg-info">
                                    <h3 class="widget-user-username text-uppercase"><?= session()->fullname; ?></h3>
                                    <h5 class="widget-user-desc text-uppercase"><?= session()->role; ?> </h5>
                                </div>
                                <div class="widget-user-image">
                                    <img class="img-circle elevation-4"
                                         src="<?= (session()->get('avatar') != '') ? session()->get('avatar') : site_url('global/img/avatar.png'); ?>"
                                         alt="Avatar" style="height: 100px; width: 100px">
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-6 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header text-capitalize"><?= session()->username; ?></h5>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-6">
                                            <div class="description-block">
                                                <h5 class="description-header text-lowercase"><?= session()->email; ?></h5>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                        <!-- /.col -->
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                <?php else: ?>
                    <!-- Info boxes -->
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1">
                            <i class="fas fa-users"></i>
                        </span>
                                <div class="info-box-content"><span class="info-box-text text-uppercase">Elèves</span>
                                    <span class="info-box-number font-weight-bold">
                                <?= (isset($nb_etudiants) ? $nb_etudiants : ''); ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1">
                            <i class="fas fa-thumbs-up"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text text-uppercase">Parents</span>
                                    <span class="info-box-number font-weight-bold">
                                <?= (isset($nb_parents) ? $nb_parents : ''); ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1">
                            <i class="fas fa-thumbs-up"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text text-uppercase">promotions</span>
                                    <span class="info-box-number font-weight-bold">
                                <?= (isset($nb_promotions) ? $nb_promotions : ''); ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text text-uppercase">Agents</span>
                                    <span class="info-box-number font-weight-bold">
                                <?= (isset($nb_agents) ? $nb_agents : ''); ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title text-uppercase">Statistiques paiements et mouvements
                                        caisses </h5>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <!--

                                            <div class="btn-group">
                                            <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                                <i class="fas fa-wrench small text-muted">Rapport</i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                                <a class="dropdown-divider"></a>
                                                <a href="#" class="dropdown-item">Journalier</a>
                                                <a href="#" class="dropdown-item">Heddomadaire</a>
                                                <a class="dropdown-divider"></a>
                                                <a href="#" class="dropdown-item">Mensuel</a>
                                                <a href="#" class="dropdown-item">Annuel</a>
                                            </div>
                                        </div>

                                        -->
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <p class="text-center text-uppercase">
                                                <strong>Finance - Exercice <?= session()->yearlibelle; ?></strong>
                                            </p>
                                            <div class="body chart">
                                                <canvas id="myChart"></canvas>
                                            </div>

                                            <!--<div class="chart">
                                                 Sales Chart Canvas
                                                <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                                            </div>-->
                                            <!-- /.chart-responsive -->
                                        </div>
                                        <div class="col-md-3">
                                            <p class="text-center text-uppercase">
                                                <strong>Finance - CAISSE </strong>
                                            </p>
                                            <!-- Info Boxes Style 2 -->
                                            <div class="info-box mb-3 bg-info mt-5">
                                                <span class="info-box-icon"><i class="fas fa-comment"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-uppercase">Solde caisses</span>
                                                    <span class="info-box-number"> <?= (isset($caisse_solde)) ? number_format(esc($caisse_solde), 2, ',', ' ') : '0.00'; ?>
                                                        <small>CDF</small></span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>

                                            <!-- /.info-box --><!-- /.info-box -->
                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="far fa-comment"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-uppercase">TOTAL ENTREE</span>
                                                    <span class="info-box-number">
                             <?= (isset($caisse_entree)) ? number_format(esc($caisse_entree), 2, ',', ' ') : '0.00'; ?>
                                                        <small>CDF</small>
                                </span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div> <!-- /.info-box --><!-- /.info-box -->
                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="far fa-comment"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-uppercase">TOTAL SORTIE</span>
                                                    <span class="info-box-number">
                                 <?= (isset($caisse_sortie)) ? number_format(esc($caisse_sortie), 2, ',', ' ') : '0.00'; ?>
                                                        <small>CDF</small>
                                </span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>

                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- ./card-body -->
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-6 col-6">
                                            <div class="description-block border-right text-center">
                                                <h5 class="description-header">
                                                    <?= (isset($cost_total_payment)) ? number_format(esc($cost_total_payment), 2, ',', ' ') : '0.00'; ?>
                                                    CDF
                                                </h5>
                                                <span class="description-text small font-weight-bold">TOTAL RECETTES</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>


                                        <div class="col-sm-6 col-6">
                                            <div class="description-block text-center">
                                                <h5 class="description-header"><?= (isset($cost_total_depenses)) ? number_format(esc($cost_total_depenses), 2, ',', ' ') : '0.00'; ?></h5>
                                                <span class="description-text">DEPENSES CDF</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->


                <div class="row">
                    <div class="col-md-6">
                        <!-- Widget: user widget style 2 -->
                        <div class="card card-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* promotions -->
                            <div class="widget-user-header bg-info">
                                <div class="widget-user-image">
                                    <img class="img-circle elevation-4"
                                         src="<?= (session()->get('schoollogo') != '') ? session()->get('schoollogo') : site_url('global/logo/favicon.png'); ?>"
                                         alt="Logo">
                                </div>
                                <!-- /.widget-user-image -->
                                <h3 class="widget-user-username text-uppercase small font-weight-bold">
                                    <span class="small"><?= session()->schoolname; ?></span>
                                </h3>
                                <h5 class="widget-user-desc text-uppercase small font-weight-bold">Gestionnaire
                                    : <?= session()->schoolmgr; ?></h5>
                            </div>
                            <div class="card-footer p-0">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Code ID <span
                                                    class="float-right badge bg-primary text-capitalize"><?= session()->schoolcode; ?></span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Téléphone <span
                                                    class="float-right badge bg-primary text-capitalize"><?= session()->schoolphone; ?></span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Email <span
                                                    class="float-right badge bg-primary text-lowercase"><?= session()->schoolemail; ?></span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Adresse <span
                                                    class="float-right badge bg-primary text-capitalize"><?= session()->schooladdress; ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <!-- Widget: user widget style 1 -->
                        <div class="card card-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* promotions -->
                            <div class="widget-user-header bg-info">
                                <h3 class="widget-user-username text-uppercase"><?= session()->fullname; ?></h3>
                                <h5 class="widget-user-desc text-uppercase"><?= session()->role; ?> </h5>
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle elevation-4"
                                     src="<?= (session()->get('avatar') != '') ? session()->get('avatar') : site_url('global/img/avatar.png'); ?>"
                                     alt="Avatar" style="height: 100px; width: 100px">
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-6 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header text-capitalize"><?= session()->matricule; ?></h5>
                                            <span class="description-text">MATRICULE</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-6">
                                        <div class="description-block">
                                            <h5 class="description-header text-lowercase"><?= session()->email; ?></h5>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                    <!-- /.col -->
                </div>
                <?php endif; ?>
            <?php endif; ?>
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </filiere>
</div>