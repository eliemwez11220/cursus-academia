<!--
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 21-Apr-21
 * Time: 10:20 AM
 */
 -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold text-uppercase">Détails Maxima Matière</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Maxima Matière</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>

    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="float-left">
                                    <a href="<?= base_url('cours/view/maximas'); ?>"
                                       class="btn btn-default btn-rounded text-uppercase btn-xs">
                                        <i class="fa fa-arrow-circle-left"></i> Voir la liste
                                    </a>
                                </div>
                            </div>

                            <div class="card-tools float-right">
                                <h5 class="text-info text-uppercase font-weight-bold">
                                    maxima <?= (isset($maxima)) ? esc($maxima['maxima_libelle']) : 'Aucun'; ?>
                                </h5>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesWithoutActions"
                                       class="table table-sm table-bordered table-hover table-head-fixed">
                                    <thead>

                                    <tr class="text-uppercase">
                                        <th width="20%"></th>
                                        <th width="80%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Libellé Maxima</td>
                                        <td>
                                            <?= (isset($maxima)) ? esc($maxima['maxima_libelle']) : ''; ?>
                                        </td>
                                    </tr>
                                  

                                    <tr>
                                        <td>Statut visibilité</td>
                                        <td class="text-uppercase">
                                            <?= (isset($maxima)) ? esc($maxima['maxima_statut']) : 'Aucun statut'; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Maxima Période</td>
                                        <td class="text-uppercase">
                                            <?= (isset($maxima)) ? esc($maxima['maxima_max_periode']) : 'Aucun'; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Maxima Examen</td>
                                        <td class="text-uppercase">
                                            <?= (isset($maxima)) ? esc($maxima['maxima_max_examen']) : 'Aucun'; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Créée le</td>
                                        <td><?= (isset($maxima)) ? esc($maxima['maxima_created_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Créée par</td>
                                        <td><?= (isset($maxima)) ? esc($maxima['maxima_created_by']) : 'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour le</td>
                                        <td><?= (isset($maxima)) ? esc($maxima['maxima_updated_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td><?= (isset($maxima)) ? esc($maxima['maxima_updated_by']) : 'Aucun agent'; ?></td>
                                    </tr>
                                  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>
