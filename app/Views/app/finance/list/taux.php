<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Configuration - Finance - Taux</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Taux</li>
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
                                <h5 class="font-weight-bold text-uppercase">Liste &nbsp;  Taux</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a data-toggle="modal" data-target="#nouvel_element"
                                   href="#" class="btn btn-info btn-xs  text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour créer un nouveau cycle">
                                        <i class="fa fa-plus"></i> Nouveau  &nbsp; Taux
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
                                        <th>Monnaie</th>
                                        <th>Valeur</th>
                                        <th>Statut</th>
                                        <th>Creation</th>
                                        <th width="1px">Détails</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($taux) && !empty($taux)):
                                    foreach ($taux as $key => $value):
                                    $status = (! empty(esc($value['taux_statut']))?esc($value['taux_statut']):'inactif');
                                    ?>
                                    <tr>
                                        <td><?= $count++; ?></td>
                                        <td><?= esc($value['taux_monnaie']); ?></td>
                                        <td class="text-uppercase"><?= ($value['taux_value']); ?></td>
                                        <td>
                                            <a href="<?= base_url('finance/changeStatus/taux/'.esc($status).'/'.esc($value['taux_uid'])); ?>"
                                               onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                        <span class="badge  <?= (esc($status) =='actif') ? 'badge-info':'badge-danger';?> text-capitalize">
                                                            <?= $status; ?> </span>
                                            </a>
                                        </td>
                                        <td><?= esc($value['taux_created_at']); ?></td>
                                            <td width="1px" class="text-center">
                                                <a data-toggle="modal"
                                                   data-target="#update_<?= $count; ?>"
                                                   href="#" class="btn btn-xs btn-outline-info">
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

                                                        <h4 class="modal-title d-inline-flex">Détails
                                                           taux <?= esc($value['taux_monnaie']); ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                        <span aria-hidden="true">
                                                                     <i class="fa fa-window-close"></i>
                                                                </span>
                                                        </button>
                                                    </div>
                                                    
                                                    <div class="modal-body">
                                                        <div class="row">

                                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="monnaie_taux" class="control-label">
                                                                        <span class="text-danger">*</span> Monnaie taux
                                                                       
                                                                    </label>
                                                                    <input type="text"
                                                                           class="form-control bg-light text-capitalize"
                                                                           name="monnaie_taux"
                                                                           id="monnaie_taux"
                                                                           value="<?= (!empty(esc($value['taux_monnaie']))) ? esc($value['taux_monnaie']) : old('monnaie_taux') ?>"
                                                                           style="border-radius: 10px!important;"
                                                                           readonly/>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="libelle_cycle" class="control-label">
                                                                        <span class="text-danger">*</span> Valeur Net
                                                                    </label>
                                            <div class="input-group input-group" style="width: 100%!important;">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span>1$ = </span>
                                                </div>
                                            </div>
                                            <input data-toggle="tooltip" data-placement="top"
                                                   title="Montant en Francs Congolais" id="valeur_taux"
                                                   type="number" step="0.00" name="valeur_taux" min="0" max="1000000000"
                                                   class="form-control font-weight-bold"
                                                   value="<?= (!empty(esc($value['taux_value']))) ? esc($value['taux_value']) : old('valeur_taux') ?>" readonly>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span>CDF</span>
                                                </div>
                                            </div>
                                        </div>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
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
                <h4 class="modal-title">Ajout d'un nouveau taux</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open('finance/saveTaux/create/', $attributes);
            ?>
            <div class="modal-body">
                <div class="row">
                    
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="monnaie_taux" class="control-label">
                                <span class="text-danger">*</span> Monnaie ou Libellé taux
                            </label>
                            <select name="monnaie_taux" id="monnaie_taux"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                            <option disabled >-- Choisissez une devise --</option>
                                            <option selected value="USD">Dollars (USD)</option>
                                        </select>
                        </div>
                    </div><div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="valeur_taux" class="control-label">
                                <span class="text-danger">*</span> Valeur Net du taux
                            </label>
                            <div class="input-group input-group" style="width: 100%!important;">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span>1$ = </span>
                                                </div>
                                            </div>
                                            <input data-toggle="tooltip" data-placement="top"
                                                   title="Saisissez le montant en Francs Congolais" id="valeur_taux"
                                                   type="number" step="0.00" name="valeur_taux" min="0" max="1000000000"
                                                   class="form-control font-weight-bold"
                                                   value="<?= old('valeur_taux')?'valeur_taux':'0.00'; ?>" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span>CDF</span>
                                                </div>
                                            </div>
                                        </div>
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
