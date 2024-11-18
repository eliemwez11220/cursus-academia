<!--
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 21-Apr-21
 * Time: 4:58 PM
 */-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="d-inline-flex">
                                <img style="width:50px; height:50px; border-radius:100px"
                                     src="<?= (isset($ecole)) ? esc($ecole['ecole_logo']) : ''; ?>" alt="Logo">
                                <h5 class="font-weight-bold text-uppercase mt-3"> <?= (isset($ecole) ? ($ecole['ecole_libelle']) : 'Information Ecole'); ?></h5>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Ecole</li>
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
                                    <a href="<?= base_url('ecole/view/ecoles'); ?>"
                                       class="btn btn-default btn-rounded text-uppercase btn-xs">
                                        <i class="fa fa-arrow-circle-left"></i> voir la liste
                                    </a>
                                </div>
                            </div>

                            <div class="card-tools float-right">
                                <a href="<?= base_url('ecole/editForm/ecole/' . (isset($ecole) ? esc($ecole['ecole_uid']) : '')); ?>"
                                   class="btn btn-warning btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-edit"></i> Apporter des modifications
                                </a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesWithoutActions"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>

                                    <tr>
                                        <th width="20%"> </th>
                                        <th width="80%"> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Code Référence</td>
                                        <td><?= (isset($ecole)) ? esc($ecole['ecole_code']) : 'Aucun Code'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nom Ecole</td>
                                        <td class="text-uppercase"><?= (isset($ecole)) ? ($ecole['ecole_libelle']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Type Ecole</td>
                                        <td class="text-uppercase"><?= (isset($ecole)) ? ($ecole['typesecole_libelle']) : 'Aucun libelle'; ?></td>
                                    </tr>


                                    <tr>
                                        <td>Type Enseignement</td>
                                        <td class="text-uppercase"><?= (isset($ecole)) ? ($ecole['typesens_libelle']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Statut visibilité</td>
                                        <td class="text-uppercase"><?= (isset($ecole)) ? ($ecole['ecole_statut']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Gestionnaire</td>
                                        <td class="text-uppercase"><?= (isset($ecole)) ? ($ecole['ecole_gestionnaire']) : '...'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Coordination</td>
                                        <td class="text-uppercase"><?= (isset($ecole)) ? ($ecole['ecole_coordination']) : '... '; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Devise de l'école</td>
                                        <td class="text-uppercase"><?= (isset($ecole)) ? ($ecole['ecole_devise']) : '... '; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Email</td>
                                        <td class="text-uppercase"><?= (isset($ecole)) ? esc($ecole['ecole_email']) : '... '; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Téléphone</td>
                                        <td class="text-uppercase"><?= (isset($ecole)) ? esc($ecole['ecole_telephone']) : ' '; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Ville</td>
                                        <td class="text-uppercase"><?= (isset($ecole)) ? ($ecole['ecole_ville']) : ' '; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Province</td>
                                        <td class="text-uppercase"><?= (isset($ecole)) ? ($ecole['ecole_province']) : '... '; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Adresse Physique</td>
                                        <td class="text-capitalize"><?= (isset($ecole)) ? ($ecole['ecole_adresse']) : '... '; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Site web</td>
                                        <td class="text-lowecase">
                                            <a href="<?= (isset($ecole)) ? esc($ecole['ecole_siteweb']) : '#'; ?>">
                                                <?= (isset($ecole)) ? esc($ecole['ecole_siteweb']) : '...'; ?></a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Créee le</td>
                                        <td><?= (isset($ecole)) ? esc($ecole['ecole_created_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Créee par</td>
                                        <td><?= (isset($ecole)) ? esc($ecole['ecole_created_by']) : 'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour le</td>
                                        <td><?= (isset($ecole)) ? esc($ecole['ecole_updated_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td><?= (isset($ecole)) ? esc($ecole['ecole_updated_by']) : 'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimée le</td>
                                        <td><?= (isset($ecole)) ? esc($ecole['ecole_deleted_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimée par</td>
                                        <td><?= (isset($ecole)) ? esc($ecole['ecole_deleted_by']) : 'Aucun agent'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Commentaire ou Observation</td>
                                        <td><?= (isset($ecole)) ? ($ecole['ecole_comment']) : 'Aucun agent'; ?></td>
                                    </tr>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>
                                                <img style="width:300px; height:300px; border-radius:100px"
                                                        src="<?= (isset($ecole)) ? ($ecole['ecole_logo']) : ''; ?>" alt="Logo <?= (isset($ecole)) ? ($ecole['ecole_libelle']) : 'Ecole'; ?>">
                                            </td>
                                        </tr>
                                    </tfoot>
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
