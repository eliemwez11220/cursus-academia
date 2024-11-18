<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Cours - Maximas Matières</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Maximas</li>
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
                                <h5 class="text-uppercase font-weight-bold"> Liste des Maximas</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a data-toggle="modal" data-target="#nouvel_element"
                                   href="#" class="btn btn-info btn-xs  text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour créer un nouveau cycle">
                                        <i class="fa fa-plus"></i> Nouveau  &nbsp; Maxima
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
                                        <th width="1px"># </th>
                                         <th width="1px">Libellé </th>
                                        <th width="1px">Max Pér.</th>
                                        <th width="1px">Max Exam.</th>

                                        <th width="1px">Statut </th>
                                        <th width="1px">Cycle </th>
                                      
                                        <th width="1px">Edition</th>
                                        <th width="1px">Détails</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($maximas) && !empty($maximas)):
                                        foreach ($maximas as $key => $value): 
                                             $status = (!empty(esc($value['maxima_statut'])) ? esc($value['maxima_statut']) : 'inactif');
                                         ?>
                                            <tr class="small">
                                                <td><?= $count++; ?></td>
                                                 <td class="text-uppercase"><?= esc($value['maxima_libelle']); ?></td>
                                             
                                                <td width="1px" class="text-uppercase text-center"><?= esc($value['maxima_max_periode']); ?></td>
                                                <td width="1px" class="text-uppercase text-center"><?= esc($value['maxima_max_examen']); ?></td>

                                                <td>
                                                    <a href="<?= base_url('cours/changeStatus/maxima/' . esc($status) . '/' . esc($value['maxima_uid'])); ?>"
                                                       onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                        <span class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                            <?= $status; ?> </span>
                                                    </a>
                                                </td>
                                                    <td class="text-uppercase"><?= ($value['cycle_libelle']); ?></td>
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
                                                    <a href="<?= base_url('cours/details/maxima/' . esc($value['maxima_uid'])); ?>"
                                                       class="btn btn-xs btn-outline-info">
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

                                                        <h4 class="modal-title d-inline-flex">Modification
                                                           Maxima <?= esc($value['maxima_libelle']); ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                        <span aria-hidden="true">
                                                                     <i class="fa fa-window-close"></i>
                                                                </span>
                                                        </button>
                                                    </div>
                                                    <?php
                                                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                                    echo form_open('cours/saveMaxima/update/'.esc($value['maxima_uid']), $attributes);
                                                    ?>
                                                    <div class="modal-body">
                                                        <div class="row">

                                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="maxima_libelle" class="control-label">
                                            <span class="text-danger">*</span> Libellé Groupe Maxima
                                        </label>
                                        <input type="text" 
                                               class="form-control" name="maxima_libelle" id="maxima_libelle"
                                                    value="<?= (!empty(esc($value['maxima_libelle']))) ? esc($value['maxima_libelle']) : set_value('maxima_libelle') ?>"
                                               />
                                     
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="max_periode" class="control-label">
                                            <span class="text-danger">*</span> Maxima Période
                                        </label>
                                        <input type="number" min="0" step="0.00"
                                               class="form-control"
                                               name="max_periode" id="max_periode"
                                                    value="<?= (!empty(esc($value['maxima_max_periode']))) ? esc($value['maxima_max_periode']) : set_value('max_periode') ?>"
                                        />
                                        
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="max_examen" class="control-label">
                                            <span class="text-danger">*</span> Maxima Examen
                                        </label>
                                        <input type="number" min="0" step="0.00"
                                               class="form-control"
                                               name="max_examen" id="max_examen"
                                                     value="<?= (!empty(esc($value['maxima_max_examen']))) ? esc($value['maxima_max_examen']) : set_value('max_examen') ?>"
                                              />
                                        
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="cycle_sid_promotion" class="control-label">
                                            <span class="text-danger">*</span> Cycle
                                        </label>
                                        <select id="cycle_sid_promotion" name="cycle_sid_promotion"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez un cycle --</option>
                                            <?php
                                                    $oldCycle = esc($value['maxima_cycle_uid']);
                                            $count = 1;
                                            if (isset($cycles) && !empty($cycles)):
                                                foreach ($cycles as $key => $value): 
                                                    if ($oldCycle == esc($value['cycle_uid'])):
                                                    ?>
                                                    <option selected value="<?= esc($value['cycle_uid']); ?>" <?= set_select('cycle_sid_promotion', esc($value['cycle_uid'])); ?>>
                                                        <?= ucfirst(($value['cycle_libelle'])); ?></option>
                                                        <?php endif; ?>
                                                    <option value="<?= esc($value['cycle_uid']); ?>" <?= set_select('cycle_sid_promotion', esc($value['cycle_uid'])); ?>>
                                                        <?= ucfirst(($value['cycle_libelle'])); ?></option>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <option>Aucun cycle</option>
                                            <?php endif; ?>
                                        </select>
                                        
                                    </div>
                                </div>                  </div>
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
                <h4 class="modal-title">Ajout d'un nouveau type de maxima</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $validation = \Config\Services::validation();
                    //form attributes
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url() . '/cours/saveMaxima/create/', $attributes);
            ?>
            <div class="modal-body">
                 <div class="row">
                                
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="maxima_libelle" class="control-label">
                                            <span class="text-danger">*</span> Libellé Groupe Maxima
                                        </label>
                                        <input type="text" 
                                               class="form-control <?php if ($validation->hasError('maxima_libelle')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="maxima_libelle" id="maxima_libelle"
                                               value="<?= set_value('maxima_libelle') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'maxima_libelle'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                              <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="max_periode" class="control-label">
                                            <span class="text-danger">*</span> Maxima Période
                                        </label>
                                        <input type="number" min="0" step="0.00"
                                               class="form-control <?php if ($validation->hasError('max_periode')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="max_periode" id="max_periode"
                                               value="<?= set_value('max_periode') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'max_periode'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="max_examen" class="control-label">
                                            <span class="text-danger">*</span> Maxima Examen
                                        </label>
                                        <input type="number" min="0" step="0.00"
                                               class="form-control <?php if ($validation->hasError('max_examen')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="max_examen" id="max_examen"
                                               value="<?= set_value('max_examen') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'max_examen'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                 <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="cycle_sid_promotion" class="control-label">
                                            <span class="text-danger">*</span> Cycle
                                        </label>
                                        <select id="cycle_sid_promotion" name="cycle_sid_promotion"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez un cycle --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($cycles) && !empty($cycles)):
                                                foreach ($cycles as $key => $value): ?>
                                                    <option value="<?= esc($value['cycle_uid']); ?>" <?= set_select('cycle_sid_promotion', esc($value['cycle_uid'])); ?>>
                                                        <?= ucfirst(($value['cycle_libelle'])); ?></option>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <option>Aucun cycle</option>
                                            <?php endif; ?>
                                        </select>
                                        <?php if(isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'cycle_sid_promotion'); ?>
                                            </span>
                                        <?php endif;?>
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