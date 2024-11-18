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
                            <h5 class="font-weight-bold text-uppercase">Détails Transfert 
                                <span class="text-primary">
                                    <?= (isset($transfert)) ? esc($transfert['transfert_code']) : 'Aucun libelle'; ?>
                                </span>
                            </h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Parents</li>
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
                                <a href="<?= base_url('etudiant/dossier/transfert'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> Voir la liste
                                </a>
                            </div>
                            <div class="card-tools float-right">
                                <a href="<?= base_url('etudiant/editForm/transfert/'.(isset($transfert) ? esc($transfert['transfert_uid']):'')); ?>"
                                   class="btn btn-warning btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-edit"></i> mettre a jour infos
                                </a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesWithoutActions"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th width="20%"></th>
                                        <th width="80%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Code référence transfert</td>
                                        <td class="text-uppercase"><?= (isset($transfert)) ? esc($transfert['transfert_code']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Statut transfert</td>
                                        <td class="text-uppercase"><?= (isset($transfert)) ? esc($transfert['transfert_statut']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td> Elève transféré </td>
                                        <td class="text-uppercase">  
                                            <?= (isset($transfert)) ? esc($transfert['etudiant_nom']) : 'Aucun libelle'; ?>
                                        -<?= (isset($transfert)) ? esc($transfert['etudiant_prenom']) : 'Aucun libelle'; ?>
                                        -<?= (isset($transfert)) ? esc($transfert['etudiant_postnom']) : 'Aucun libelle'; ?> - 
                                            <?= (isset($transfert)) ? esc($transfert['etudiant_matricule']) : 'Aucun libelle'; ?>
                                        </td>
                                    </tr>
                                  <tr>
                                        <td> Nouvelle école </td>
                                        <td class="text-uppercase">  
                                            <?= (isset($transfert)) ? esc($transfert['ecole_libelle']) : 'Aucun libelle'; ?> - 
                                            <?= (isset($transfert)) ? esc($transfert['ecole_code']) : 'Aucun libelle'; ?>
                                        </td>
                                    </tr>
                                  

                                    <tr>
                                        <td> Motif transfert </td>
                                        <td>  <?= (isset($transfert)) ? esc($transfert['transfert_motif']) : 'Aucun libelle'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Crée le</td>
                                        <td class="text-uppercase"><?= (isset($transfert)) ? esc($transfert['transfert_created_at']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Crée par</td>
                                        <td class="text-uppercase"><?= (isset($transfert)) ? esc($transfert['transfert_created_by']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour le</td>
                                        <td class="text-uppercase"><?= (isset($transfert)) ? esc($transfert['transfert_updated_at']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td class="text-uppercase"><?= (isset($transfert)) ? esc($transfert['transfert_updated_by']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimé le</td>
                                        <td class="text-uppercase"><?= (isset($transfert)) ? esc($transfert['transfert_deleted_at']) : 'Aucun libelle'; ?></td>
                                    </tr><tr>
                                        <td>Supprimé par</td>
                                        <td class="text-uppercase"><?= (isset($transfert)) ? esc($transfert['transfert_deleted_by']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label for="commentaire_annee">Observation sur le transfert:</label></td>
                                        <td class="text-uppercase"><?= (isset($transfert)) ? esc($transfert['transfert_comment']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>
