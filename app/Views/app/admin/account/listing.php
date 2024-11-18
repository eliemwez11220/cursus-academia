<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="font-weight-bold text-capitalize">Administration - Comptes Agents</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a></li>
                        <li class="breadcrumb-item active">Comptes</li>
                    </ol>
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
                               <h5 class="font-weight-bold text-uppercase">Liste des comptes des agents</h5>
                            </div>

                            <div class="card-tools float-right">

                                <a href="<?= base_url('admin/addForm/account'); ?>"
                                   class="btn btn-info btn-sm text-uppercase"
                                   data-toggle="tooltip" data-placement="bottom"
                                   title="Cliquer pour creer un nouveau compte">
                                    <i class="fa fa-plus"></i> Nouveau compte
                                </a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th>#</th>
                                        <th>Nom Agent</th>
                                        <th>Identifiant</th>
                                        <th>Statut</th>
                                        <th>Groupe</th>
                                        <th>Mot de passe</th>
                                        <th width="1px">Edition</th>
                                        <th width="1px">Détails</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($comptes) && !empty($comptes)):
                                    foreach ($comptes as $key => $value):
                                    $status = (! empty(esc($value['compte_status']))?esc($value['compte_status']):'inactif');
                                    ?>
                                    <tr>
                                        <td><?= $count++; ?></td>
                                        <td class="text-uppercase small">
                                            <?= esc($value['agent_nom']); ?> - <?= esc($value['agent_matricule']); ?>
                                        </td>
                                        <td class="text-uppercase small"><?= esc($value['compte_username']); ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/changeStatus/compte/'.esc($status).'/'.esc($value['compte_uid'])); ?>"
                                               onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                        <span class="badge  <?= (esc($status) =='actif') ? 'badge-info':'badge-danger';?> text-capitalize"
                                                              data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour <?= ($status =='actif')?'desactiver':'activer'; ?> ce compte">
                                                            <?= $status; ?> </span>
                                            </a>
                                        </td>

                                        <td class="text-uppercase small"><?= esc($value['groupe_libelle']); ?></td>

                                        <td width="1px" class="text-center">
                                            <a data-toggle="modal"
                                               data-target="#password_change<?= $count; ?>"
                                               href="<?php // ($v->demande_etat < 3) ? base_url() . 'agent/action_demande/' . $v->demande_etat . '/' . $v->passeport_numero : 'add_form/demande/fin/' . $v->passeport_numero
                                               ?>" class="btn btn-outline-danger btn-xs">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour réinitialiser le mot de passe de ce compte"><i
                                                                    class="fa fa-trash-o"></i>Réinitialiser</span>
                                            </a>
                                        </td>
                                        <td width="1px" class="text-center">
                                            <a href="<?= base_url('admin/editForm/account/'.esc($value['compte_uid'])); ?>"
                                               class="btn btn-xs btn-outline-warning" data-toggle="tooltip"
                                               data-placement="bottom"
                                               title="Cliquer pour modifier cette information">
                                                <i class="fa fa-edit fa-2x"></i>
                                            </a>
                                        </td>
                                        <td width="1px" class="text-center">
                                            <a href="<?= base_url('admin/details/account/'.esc($value['compte_uid'])); ?>"
                                               class="btn btn-xs btn-outline-info" data-toggle="tooltip"
                                               data-placement="bottom"
                                               title="Cliquer pour voir les details">
                                                <i class="fa fa-info-circle fa-2x"></i>
                                            </a>
                                        </td>
                                    </tr><!-- change password modal -->
                                    <div class="modal fade" id="password_change<?= $count; ?>">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header text-center">

                                                    <h4 class="modal-title d-inline-flex">
                                                        <img src="<?= esc($value['compte_avatar']); ?>"
                                                             alt="Avatar" class="img-circle"
                                                             style="border-radius: 100px!important; height: 35px; width: 40px;"/>
                                                        <span class="text-uppercase small">
                                                            <?= esc($value['compte_username']); ?>
                                                        </span>
                                                    </h4>

                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span aria-hidden="true">
                                                                     <i class="fa fa-window-close"></i>
                                                                </span>
                                                    </button>

                                                </div>

                                                <div class="modal-body">
                                                    <h3 class="text-center">Réinitialisation du mot de passe</h3>
                                                    <?php
                                                    $aleatoire_value = "0123456789ABCDEFGHIJKLMNOPQRSTUVWYZabcdefghijklmnopqrstuvwyz*@$#";
                                                    $new_pass_generate = substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(20, 20))), 0, 20);
                                                    //echo $session->getFlashdata('form');
                                                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                                    echo form_open('admin/resetAccountPassword/' .esc($value['compte_uid']), $attributes);
                                                    ?>
                                                    <div class="row">

                                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="asset_password" class="control-label">
                                                                    <span class="text-danger">*</span> Nouveau mot de
                                                                    passe
                                                                    <span class="small">(Il a été généré automatiquement. Vous pouvez le modifier manuellement
                                                                    en cas de besoin avant d'envoyer au correspondant)</span>
                                                                </label>
                                                                <input type="text"
                                                                       class="form-control bg-light text-capitalize"
                                                                       name="asset_password"
                                                                       id="asset_password"
                                                                       value="<?= (!empty($new_pass_generate)) ? $new_pass_generate : set_value('asset_password') ?>"
                                                                       style="border-radius: 10px!important;"
                                                                       required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="form-group">

                                                                <div class="icheck-info d-inline">
                                                                    <input type="checkbox" name="pass_expire"
                                                                           id="pass_expire<?= $count; ?>"
                                                                           checked="checked">
                                                                    <label for="pass_expire<?= $count; ?>">
                                                                        Mot de passe expire à la prémiere
                                                                        connexion
                                                                    </label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit"
                                                                    class="btn btn-danger btn-block text-uppercase"
                                                                    style="border-radius: 100px;">
                                                                Réinitialiser le mot de passe
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <?php echo form_close(); ?>
                                                </div>
                                            </div>
                                        </div><!-- change password users -->
                                        <!-- end update year modal -->
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr class="alert alert-info">
                                                <td colspan="8" class="text-uppercase">
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