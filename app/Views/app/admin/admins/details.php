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
                            <h5 class="font-weight-bold">Administration - Détails Compte </h5>
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
                                        <img src="<?= (isset($account) ? esc($account['admin_avatar']) : '')?>"
                                             alt="<?= (isset($account) ? esc($account['admin_pseudo']) : '')?>" class="img-circle"
                                             style="border-radius: 100px!important; width: 70px!important; height: 65px!important;"/>
                                        <span class="text-uppercase d-inline">
                                            <?= (isset($account)) ? esc($account['admin_fullname']) : 'Aucun Libelle'; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="card-tools float-right">
                                <a href="<?= base_url('admin/view/admins'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> voir la liste
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
                                        <th width="30%"></th>
                                        <th width="70%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>Nom d'utilisateur</td>
                                        <td class="text-uppercase">
                                            <?= (isset($account)) ? esc($account['admin_pseudo']) : 'Aucun Libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td class="text-lowercase">
                                            <?= (isset($account)) ? esc($account['admin_email']) : 'Aucun Libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Profile attaché</td>
                                        <td class="text-uppercase">
                                            <?= (isset($account)) ? esc($account['admin_profile']) : 'Aucun Libelle'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Question secrète 1</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['admin_question1']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Question secrète 2</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['admin_question2']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Question secrète 3</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['admin_question3']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Réponse Question secrète 1</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['admin_reponse1']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Réponse Question secrète 2</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['admin_reponse2']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Réponse Question secrète 3</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['admin_reponse3']) : 'Aucun statut'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Question secrète 3</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['admin_question3']) : 'Aucun statut'; ?></td>
                                    </tr>
                                   
                                    <tr>
                                        <td>Statut Activation</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['admin_statut']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Dernière connexion</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['admin_lastlogin_at']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Dernière Déconnexion</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['admin_lastlogout_at']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Statut session active</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['admin_session']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nombre session ouverte</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['admin_session_nbr']) : 'Aucun statut'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Dernier changement mot de passe</td>
                                        <td class="text-capitalize"><?= (isset($account)) ? esc($account['admin_lastchange_pass']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    

                                    <tr>
                                        <td>Créé le</td>
                                        <td><?= (isset($account)) ? esc($account['admin_created_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour le</td>
                                        <td><?= (isset($account)) ? esc($account['admin_updated_at']) : 'Aucune date'; ?></td>
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
             <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="font-weight-bold text-uppercase">Liste de ses Ecoles</h5>
                            </div>
                            
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase small">
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Nom Ecole</th>
                                        <th>RESEAUX</th>
                                        <th>RESPONSABLE</th>
                                        <th width="1px">Abonnement</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($ecoles) && !empty($ecoles)):
                                        foreach ($ecoles as $key => $value):
                                            $status = (! empty(esc($value['ecole_statut']))?esc($value['ecole_statut']):'inactif');
                                            ?>
                                            <tr class="small">
                                                <td><?= $count++; ?></td>
                                                <td>
                                                    <a href="<?= base_url('admin/exploreSchool/'.esc($value['ecole_uid'])); ?>" class="btn btn-xs btn-outline-info" target="_blank">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour se connecter sur cette école">
                                                <?= esc($value['ecole_code']); ?></span>
                                                </a>
                                                    </td>
                                                <td class="text-uppercase"><?= ($value['ecole_libelle']); ?>
                                                </td>
                                                
                                                <td class="text-uppercase"><?= ($value['coordination_libelle']); ?></td>

                                                <td class="text-uppercase"><?= ($value['ecole_gestionnaire']); ?></td>
                                                <td class="text-uppercase"><?= ($value['ecole_created_at']); ?></td>
                                            
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr class="alert alert-info">
                                        <td colspan="7" class="text-uppercase">
                                            <strong>Aucune donnée</strong>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
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
