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
                            <h5 class="font-weight-bold">Administration - Détails Compte Agent </h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Comptes</li>
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
                                    <div class="brand-image">
                                        <img src="<?= (isset($account) ? esc($account['compte_avatar']) : '')?>"
                                             alt="<?= (isset($account) ? esc($account['compte_username']) : '')?>" class="img-circle"
                                             style="border-radius: 100px!important; width: 70px!important; height: 65px!important;"/>
                                        <span class="text-uppercase d-inline">
                                            <?= (isset($account)) ? esc($account['agent_matricule']) : 'Aucun Libelle'; ?>
                                            -
                                            <?= (isset($account)) ? esc($account['agent_nom']) : 'Aucun Libelle'; ?>
                                            <?= (isset($account)) ? esc($account['agent_postnom']) : 'Aucun Libelle'; ?>
                                            <?= (isset($account)) ? esc($account['agent_prenom']) : 'Aucun Libelle'; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="card-tools float-right">
                                <a href="<?= base_url('admin/view/account'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> voir la liste
                                </a> |
                                <a href="<?= base_url('admin/editForm/account/' . (isset($account) ? esc($account['compte_uid']) : '')); ?>"
                                   class="btn btn-warning btn-rounded text-uppercase btn-xs">
                                    <span data-toggle="tooltip"
                                          data-placement="bottom"
                                          title="Cliquer pour modifier ce compte">
                                        <i class="fa fa-edit"></i>
                                    </span>
                                     Mettre à jour
                                </a>
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
                                        <td>Nom d'utilisateur</td>
                                        <td class="text-uppercase">
                                            <?= (isset($account)) ? esc($account['compte_username']) : 'Aucun Libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td class="text-uppercase">
                                            <?= (isset($account)) ? esc($account['compte_email']) : 'Aucun Libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Groupe attaché</td>
                                        <td class="text-uppercase">
                                            <?= (isset($account)) ? esc($account['groupe_libelle']) : 'Aucun Libelle'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Question secrète 1</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['compte_question1']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Question secrète 2</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['compte_question2']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Question secrète 3</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['compte_question3']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Réponse Question secrète 1</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['compte_reponse1']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Réponse Question secrète 2</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['compte_reponse2']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Réponse Question secrète 3</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['compte_reponse3']) : 'Aucun statut'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Question secrète 3</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['compte_question3']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Activation compte</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['compte_activated_at']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Statut visibilité</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['compte_status']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Dernière connexion</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['compte_lastlogin_at']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Dernière Deconnexion</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['compte_lastlogout_at']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Statut session active</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['compte_session']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nombre session ouverte</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['compte_session_nbr']) : 'Aucun statut'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Dernier changement mot de passe</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['compte_changepass_at']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Derniere reinitialisation mot de passe</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['compte_resetpass_at']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Derniere reinitialisation mot de passe par</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['compte_resetpass_by']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nombre de reinitialisation du mot de passe par</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['compte_resetpass_nbr']) : 'Aucun statut'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Crée le</td>
                                        <td><?= (isset($account)) ? esc($account['compte_created_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Créeepar</td>
                                        <td><?= (isset($account)) ? esc($account['compte_created_by']) : 'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour le</td>
                                        <td><?= (isset($account)) ? esc($account['compte_updated_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td><?= (isset($account)) ? esc($account['compte_updated_by']) : 'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimé le</td>
                                        <td><?= (isset($account)) ? esc($account['compte_deleted_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimé par</td>
                                        <td><?= (isset($account)) ? esc($account['compte_deleted_by']) : 'Aucun agent'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Commentaire ou Observation</td>
                                        <td><?= (isset($account)) ? esc($account['compte_observation']) : 'Aucun commentaire'; ?></td>
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
