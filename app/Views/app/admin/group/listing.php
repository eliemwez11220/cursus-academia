<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Administration - Groupes Utilisateurs</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Groupes</li>
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
                                <h5 class="font-weight-bold text-uppercase">Liste &nbsp;  Groupes</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a data-toggle="modal" data-target="#nouvel_element"
                                   href="#" class="btn btn-info btn-xs  text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour créer un nouveau groupe">
                                        <i class="fa fa-plus"></i> Nouveau  &nbsp; Groupe
                                    </span>
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
                                        <th>Nom Groupe</th>
                                        <th>Statut</th>
                                        <th>Création</th>
                                        <th width="1px">Edition</th>
                                        <th width="1px">Détails</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($groupes) && !empty($groupes)):
                                        foreach ($groupes as $key => $value):
                                            $status = (! empty(esc($value['groupe_status']))?esc($value['groupe_status']):'inactif');
                                            ?>
                                            <tr>
                                                <td><?= $count++; ?></td>
                                                <td class="text-uppercase"><?= esc($value['groupe_libelle']); ?></td>
                                                <td>
                                                    <a href="<?= base_url('admin/changeStatus/groupe/'.esc($status).'/'.esc($value['groupe_uid'])); ?>"
                                                       onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                        <span class="badge  <?= (esc($status) =='actif') ? 'badge-info':'badge-danger';?> text-capitalize">
                                                            <?= $status; ?> </span>
                                                    </a>
                                                </td>
                                                <td><?= esc($value['groupe_created_at']); ?></td>
                                                <td width="1px" class="text-center">
                                                    <a data-toggle="modal"
                                                       data-target="#update_<?= $count; ?>"
                                                       href="#" class="btn btn-xs btn-outline-warning">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour modifier cette information">
                                                <i class="fa fa-edit fa-2x"></i></span>
                                                    </a>
                                                </td>
                                                <td width="1px" class="text-center">
                                                    <a href="<?= base_url('admin/details/group/'.esc($value['groupe_uid'])); ?>" class="btn btn-xs btn-outline-info">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour voir les details">
                                                <i class="fa fa-info-circle fa-2x"></i></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <!-- update year modal -->
                                            <div class="modal fade" id="update_<?= $count; ?>">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">

                                                            <h4 class="modal-title d-inline-flex text-uppercase font-weight-bold">Modification
                                                                Groupe <?= esc($value['groupe_libelle']); ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                        <span aria-hidden="true">
                                                                     <i class="fa fa-window-close"></i>
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <?php
                                                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                                        echo form_open('admin/saveGroupe/update/'.esc($value['groupe_uid']), $attributes);
                                                        ?>
                                                        <div class="modal-body">
                                                            <div class="row">

                                                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="libelle_groupe" class="control-label">
                                                                            <span class="text-danger">*</span> Nom ou Libellé du groupe
                                                                        </label>
                                                                        <input type="text"
                                                                               class="form-control text-capitalize"
                                                                               name="libelle_groupe"
                                                                               id="libelle_groupe"
                                                                               value="<?= (!empty(esc($value['groupe_libelle']))) ? esc($value['groupe_libelle']) :old('libelle_groupe') ?>"
                                                                               style="border-radius: 10px!important;"
                                                                               required/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="observation_groupe" class="control-label">
                                                                            <span class="text-danger"></span> observation sur le groupe
                                                                        </label>
                                                                        <textarea name="observation_groupe"  class="form-control text-capitalize" id="observation_groupe" cols="30" rows="5"><?= (!empty(esc($value['groupe_observation']))) ? esc($value['groupe_observation']) :old('observation_groupe') ?></textarea>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="submit" class="btn btn-info btn-sm text-uppercase">Enregistrer les modifications</button>
                                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer</button>
                                                        </div>
                                                        <?php echo form_close(); ?>
                                                    </div>
                                                </div>
                                            </div>
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
<!-- Creation nouvelle annee scolaire -->
<div class="modal fade" id="nouvel_element">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold text-uppercase">Ajout d'un nouveau groupe</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open('admin/saveGroupe/create/', $attributes);
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="libelle_groupe" class="control-label">
                                <span class="text-danger">*</span> Nom ou Libellé du groupe
                            </label>
                            <input type="text"
                                   class="form-control text-capitalize"
                                   name="libelle_groupe"
                                   id="libelle_groupe"
                                   value="<?= old('libelle_groupe') ?>"
                                   style="border-radius: 10px!important;"
                                   required/>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="observation_groupe" class="control-label">
                                <span class="text-danger"></span> observation sur le groupe
                            </label>
                            <textarea name="observation_groupe"  class="form-control text-capitalize" id="observation_groupe" cols="30" rows="5"><?= old('observation_groupe') ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-info btn-sm text-uppercase">Enregistrer</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer</button>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
