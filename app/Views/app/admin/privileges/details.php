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
                            <h5 class="font-weight-bold">Administration - Détails Privilèges </h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Privilèges</li>
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
                                    <a href="<?= base_url('admin/view/privileges'); ?>"
                                       class="btn btn-default btn-rounded text-uppercase btn-xs">
                                        <i class="fa fa-arrow-circle-left"></i> voir la liste
                                    </a>
                                </div>
                            </div>

                            <div class="card-tools float-right">
                                <h5 class="text-info text-uppercase font-weight-bold">
                                    <?= (isset($privilege)) ? esc($privilege['acces_libelle']) : 'Aucun Libelle'; ?>
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
                                        <td>Libellé où module Acces</td>
                                        <td class="text-uppercase">
                                            <?= (isset($privilege)) ? esc($privilege['acces_libelle']) : 'Aucun Libelle'; ?> |
                                            <?php
                                            $objet = (isset($privilege)) ? esc($privilege['acces_objet']) : 'Aucun Libelle';
                                            switch ($objet):
                                                case "dossiers":
                                                    echo 'Dossiers Elèves';
                                                    break;
                                                case "cotes":
                                                    echo 'Cotes & Epreuves';
                                                    break;
                                                case "branches":
                                                    echo 'Branches & Matières';
                                                    break;
                                                case "personnels":
                                                    echo 'Personnel';
                                                    break;
                                                case "finances":
                                                    echo 'Finances';
                                                    break;
                                                case "configurations":
                                                    echo 'Configuration';
                                                    break;
                                                case "administrations":
                                                    echo 'Administration';
                                                    break;
                                                case "rapports":
                                                    echo 'Rapports';
                                                    break;
                                                case "publications":
                                                    echo 'Publication';
                                                    break;
                                                case "etudes":
                                                    echo 'Etudes en ligne';
                                                    break;
                                                default:
                                                    echo "Acces à tous les modules";
                                                    break;
                                                    ?>
                                                <?php endswitch; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Groupe Autorisé</td>
                                        <td class="text-uppercase">
                                            <?= (isset($privilege)) ? esc($privilege['groupe_libelle']) : 'Aucun Libelle'; ?>
                                        </td>
                                    </tr>

                                    <tr class="alert alert-secondary">
                                        <td colspan="5"><b>Droits accordés</b></td>
                                    </tr>

                                    <tr>
                                        <td>Tous les privilèges</td>
                                        <td class="text-uppercase"><?= (isset($privilege)) ? esc($privilege['privilege_tout']) : 'Aucun statut'; ?></td>
                                    </tr><tr>
                                        <td>Lecture</td>
                                        <td class="text-uppercase"><?= (isset($privilege)) ? esc($privilege['privilege_lecture']) : 'Aucun statut'; ?></td>
                                    </tr><tr>
                                        <td>Ecriture</td>
                                        <td class="text-uppercase"><?= (isset($privilege)) ? esc($privilege['privilege_lecture']) : 'Aucun statut'; ?></td>
                                    </tr><tr>
                                        <td>Exécution</td>
                                        <td class="text-uppercase"><?= (isset($privilege)) ? esc($privilege['privilege_execute']) : 'Aucun statut'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Statut visibilité</td>
                                        <td class="text-uppercase"><?= (isset($privilege)) ? esc($privilege['privilege_status']) : 'Aucun statut'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Créée le</td>
                                        <td><?= (isset($privilege)) ? esc($privilege['privilege_created_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Créée par</td>
                                        <td><?= (isset($privilege)) ? esc($privilege['privilege_created_by']) : 'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour le</td>
                                        <td><?= (isset($privilege)) ? esc($privilege['privilege_updated_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td><?= (isset($privilege)) ? esc($privilege['privilege_updated_by']) : 'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimée le</td>
                                        <td><?= (isset($privilege)) ? esc($privilege['privilege_deleted_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimée par</td>
                                        <td><?= (isset($privilege)) ? esc($privilege['privilege_deleted_by']) : 'Aucun agent'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Commentaire ou Observation</td>
                                        <td><?= (isset($privilege)) ? esc($privilege['privilege_observation']) : 'Aucun commentaire'; ?></td>
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
