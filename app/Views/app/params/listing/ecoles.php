<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Configuration - Ecoles</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Ecoles</li>
                            </ol>
                        </div>
                    </div> </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>

    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <?php if (!empty(session()->clienttoken) && session()->profile =='client'):?>
            <div class="float-right">
                                <a  href="<?= base_url('ecole/addForm/ecole'); ?>" class="btn btn-info btn-xs  text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour créer une nouvelle ecole">
                                        <i class="fa fa-plus"></i> Nouvelle Ecole
                                    </span>
                                </a>
                            </div>
            <div class="row">

             <?php
             if (isset($ecoles) && !empty($ecoles)):
                foreach ($ecoles as $key => $value):
                    if ($value['ecole_client_uid'] == session()->clienttoken):
                    ?>
                       <div class="col-md-4">
                        <!-- Widget: user widget style 1 -->
                        <div class="card card-widget widget-user">
                          <!-- Add the bg color to the header using any of the bg-* promotions -->
                          <div class="widget-user-header bg-info">
                            <h5 class="widget-user-username text-uppercase small"><?= ($value['ecole_libelle']); ?></h5>
                            <h6 class="widget-user-desc text-uppercase"><?= esc($value['ecole_code']); ?> </h6>
                          </div>
                          <div class="widget-user-image">
                            <img class="img-circle elevation-4" src="<?= (session()->get('schoollogo') != '') ? session()->get('schoollogo') : site_url('global/logo/favicon.png'); ?>" alt="Avatar" style="height: 100px; width: 100px">
                          </div>
                          <div class="card-footer">
                            <div class="row">
                              <div class="col-sm-6 border-right">
                                <div class="description-block">
                                  <h5 class="description-header text-capitalize"><?= ($value['coordination_libelle']); ?></h5>
                                  <span class="description-text">Réseaux</span>
                                </div>
                                <!-- /.description-block -->
                              </div>
                              <!-- /.col -->
                              <div class="col-sm-6">
                                <div class="description-block">
                                  <h5 class="description-header text-uppercase"><?= ($value['typesecole_libelle']); ?></h5>
                                  <span class="description-text">Type Ecole</span>
                                </div>
                                <!-- /.description-block -->
                              </div>
                              <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <div  class="text-center">
                                <a href="<?= base_url('client/explorer/ecole/'.esc($value['ecole_uid'])); ?>" class="btn btn-xs btn-danger" target="_blank">
                                    <span data-toggle="tooltip" data-placement="top" title="Cliquer pour voir les details">
                                                            EXPLORER</span>
                                                            </a>
                                                 
                            </div>
                          </div>
                        </div>
                        <!-- /.widget-user -->
                      </div>  
                    <?php endif;?>
                <?php endforeach;?>
                <?php endif;?>
            </div>
        <?php else:?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="font-weight-bold text-uppercase">Liste &nbsp;  Ecoles</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a  href="<?= base_url('ecole/addForm/ecole'); ?>" class="btn btn-info btn-xs  text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour créer une nouvelle ecole">
                                        <i class="fa fa-plus"></i> Nouvelle Ecole
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
                                    <tr class="text-uppercase small">
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Nom Ecole</th>
                                        <th>Statut</th>
                                        <th>Coordination</th>
                                        <th>RESPONSABLE</th>
                                        <th width="1px">Edition</th>
                                        <th width="1px">Détails</th>
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
                                                <td class="text-uppercase">
                                                    <a href="<?= base_url('ecole/changeStatus/ecole/'.esc($status).'/'.esc($value['ecole_uid'])); ?>"
                                                       onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                        <span class="badge  <?= (esc($status) =='actif') ? 'badge-info':'badge-danger';?> text-capitalize">
                                                            <?= $status; ?> </span>
                                                    </a>
                                                </td>
                                                <td class="text-uppercase"><?= ($value['coordination_libelle']); ?></td>

                                                <td class="text-uppercase"><?= ($value['ecole_gestionnaire']); ?></td>
                                            <td width="1px" class="text-center">
                                                <a href="<?= base_url('ecole/editForm/ecole/'.esc($value['ecole_uid'])); ?>" class="btn btn-xs btn-outline-warning">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour modifier cette information">
                                                <i class="fa fa-edit fa-2x"></i></span>
                                                </a>
                                            </td>
                                            <td width="1px" class="text-center">
                                                <a href="<?= base_url('ecole/details/ecoles/'.esc($value['ecole_uid'])); ?>" class="btn btn-xs btn-outline-info">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour voir les details">
                                                <i class="fa fa-info-circle fa-2x"></i></span>
                                                </a>
                                            </td>
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
            <?php endif;?>
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>
<!-- Creation nouvelle annee scolaire -->
<div class="modal fade" id="nouvel_element">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Création d'une nouvelle école</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            //new code generated automatically
            $aleatoire_value = "0123456789";
            $new_code_generate = "CEC" . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(5, 20))), 0, 5);
            //form attributes
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url().'/ecole/saveSchool/create/', $attributes);
            ?>
            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="code_ecole" class="control-label">
                                <span class="text-danger">*</span> Code Ecole
                                <span class="small">
                                    (Ce code a été généré automatiquement.
                                    Vous pouvez modifier manuellement en cas de besoin avant d'enregistrer)
                                </span>
                            </label>
                            <input type="text"
                                   class="form-control bg-light text-capitalize"
                                   name="code_ecole"
                                   id="code_ecole"
                                   value="<?= (!empty($new_code_generate)) ? $new_code_generate : set_value('code_ecole') ?>"
                                   style="border-radius: 10px!important;"
                                   required/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="libelle_ecole" class="control-label">
                                <span class="text-danger">*</span> Nom Ecole
                            </label>
                            <input type="text"
                                   class="form-control bg-light text-capitalize"
                                   name="libelle_ecole"
                                   id="libelle_ecole"
                                   value="<?= set_value('libelle_ecole') ?>"
                                   style="border-radius: 10px!important;"
                                   required/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="gestionnaire_ecole" class="control-label">
                                <span class="text-danger">*</span> Nom Gestionnaire
                            </label>
                            <input type="text"
                                   class="form-control bg-light text-capitalize"
                                   name="gestionnaire_ecole"
                                   id="gestionnaire_ecole"
                                   value="<?= set_value('gestionnaire_ecole') ?>"
                                   style="border-radius: 10px!important;"
                                   required/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="typeens_sid_ecole" class="control-label">
                                <span class="text-danger">*</span> Type Enseignement
                            </label>
                            <select id="typeens_sid_ecole" name="typeens_sid_ecole"
                                    class="form-control select2 select2-info"
                                    data-dropdown-css-class="select2-info">
                                <option selected="selected" disabled>-- Sélectionnez type enseignement--</option>
                                <option>Enseignement de base</option>
                                <option>Médical</option>
                            </select>
                        </div>
                    </div>        <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="typeecole_sid" class="control-label">
                                <span class="text-danger">*</span> Type Ecole
                            </label>
                            <select id="typeecole_sid" name="typeecole_sid"
                                    class="form-control select2 select2-info"
                                    data-dropdown-css-class="select2-info">
                                <option selected="selected" disabled>-- Sélectionnez type ecole--</option>
                                <option>Mixte</option>
                                <option>Filles</option>
                                <option>Garcons</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-info btn-sm text-uppercase">Enregistrer l'école</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer</button>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
