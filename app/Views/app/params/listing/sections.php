<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Gestion des Filières & Options</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"> 
                                    <a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Configuration</li>
                                <li class="breadcrumb-item active">Filières & Options</li>
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
                                <h5 class="font-weight-bold text-uppercase">Filières & Options</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a data-toggle="modal" data-target="#nouvel_element"
                                   href="#" class="btn btn-info btn-xs text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour créer une nouvelle filiere">
                                        <i class="fa fa-plus"></i> Nouvelle  Option
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
                                        <th>Code</th>
                                        <th>Filière</th>
                                        <th>Option</th>
                                        <th>Etat</th>
                                        <th width="1px"> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($filieres) && !empty($filieres)):
                                        foreach ($filieres as $key => $value):
                                            $status = (!empty(esc($value['filiere_statut'])) ? esc($value['filiere_statut']) : 'inactif');
                                            ?>
                                            <tr>
                                                <td><?= $count++; ?></td>
                                                <td><?= esc($value['filiere_code']); ?></td>
                                                <td class="text-uppercase"><?= ($value['filiere_libelle']); ?></td>
                                                <td class="text-uppercase"><?= ($value['option_libelle']); ?></td>
                                                <td>
                                                    <a href="<?= base_url('ecole/changeStatus/filiere/' . esc($status) . '/' . esc($value['filiere_uid'])); ?>"
                                                       onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                        <span class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                            <?= $status; ?> </span>
                                                    </a>
                                                </td>

                                                <td width="1px" class="text-center">
                                                    <a data-toggle="modal"
                                                       data-target="#update_<?= $count; ?>"
                                                       href="#" class="btn btn-xs btn-outline-warning">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour modifier cette information">
                                                <i class="fa fa-edit fa-2x"></i></span>
                                                    </a>
                                                
                                                    <a href="<?= base_url('ecole/details/filieres/' . esc($value['filiere_uid'])); ?>"
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
                                                                filiere <?= esc($value['filiere_libelle']); ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                        <span aria-hidden="true">
                                                                     <i class="fa fa-window-close"></i>
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <?php
                                                        $validation = \Config\Services::validation();
                                                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                                        echo form_open('ecole/savefiliere/update/' . esc($value['filiere_uid']), $attributes);
                                                        ?>
                                                        <div class="modal-body">
                                                            <div class="row">

                                                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="code_filiere" class="control-label">
                                                                            <span class="text-danger">*</span> Code
                                                                            
                                                                           
                                                                        </label>
                                                                        <input type="text"
                                                                               class="form-control bg-light text-capitalize"
                                                                               name="code_filiere"
                                                                               id="code_filiere"
                                                                               value="<?= (!empty(esc($value['filiere_code']))) ? esc($value['filiere_code']) : set_value('code_filiere') ?>"
                                                                               style="border-radius: 10px!important;"
                                                                               required/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-sm-12 col-xs-12">

                                                                    <div class="form-group">
                                                                        <label for="filiere_sid" class="control-label">
                                                                            <span class="text-danger">*</span> 
                                                                            Désignation de la catégorie
                                                                        </label>
                                                                        <input type="text"
                                                                               class="form-control text-capitalize"
                                                                               name="filiere_sid"
                                                                               id="filiere_sid"
                                                                               value="<?= (!empty(($value['filiere_libelle']))) ? ($value['filiere_libelle']) : old('filiere_sid') ?>"
                                                                               style="border-radius: 10px!important;"/>
                                                                    </div>

                                                                </div>
                                                                <div class="col-lg-12 col-sm-12 col-xs-12">

                                                                    <div class="form-group">
                                                                        <label for="libelle_option"
                                                                               class="control-label">
                                                                            <span class="text-danger"></span> Nom ou
                                                                            Libellé Option
                                                                        </label>
                                                                        <input type="text"
                                                                               class="form-control text-capitalize"
                                                                               name="libelle_option"
                                                                               id="libelle_option"
                                                                               value="<?= (!empty(($value['option_libelle']))) ? ($value['option_libelle']) : set_value('libelle_option') ?>"
                                                                               style="border-radius: 10px!important;"
                                                                               />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="submit"
                                                                    class="btn btn-info btn-sm text-uppercase">
                                                                Enregistrer les modifications
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                    data-dismiss="modal">Fermer
                                                            </button>
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
                                                <strong>Aucune filiere n'est enregistrée/strong>
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
                <h4 class="modal-title">Ajout d'une nouvelle filiere et option</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            //new code generated automatically
            $aleatoire_value = "0123456789";
            $new_code_generate = "CYC" . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(5, 20))), 0, 5);
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open('ecole/savefiliere/create/', $attributes);
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="code_filiere" class="control-label">
                                <span class="text-danger">*</span> Code filiere
                                <span class="small">
                                    (Ce code a été généré automatiquement.
                                    Vous pouvez modifier manuellement en cas de besoin avant d'enregistrer)
                                </span>
                            </label>
                            <input type="text"
                                   class="form-control bg-light text-capitalize"
                                   name="code_filiere"
                                   id="code_filiere"
                                   value="<?= (!empty($new_code_generate)) ? $new_code_generate : old('code_filiere') ?>"
                                   style="border-radius: 10px!important;"
                                   required/>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="filiere_sid" class="control-label">
                                <span class="text-danger">*</span> filiere
                            </label>
                            <select id="filiere_sid" name="filiere_sid"
                                    class="form-control select2 select2-info"
                                    data-dropdown-css-class="select2-info" required>
                                <option selected="selected" disabled>-- Sélectionnez filiere--
                                </option>
                                
                                <?php
                                $count = 1;
                                if (isset($filieres) && !empty($filieres)): ?>
                                    <option value="new">Nouvelle filiere</option>
                                     <?php
                                     foreach ($filieres as $key => $value): ?>
                                        <option value="<?= ($value['filiere_libelle']); ?>" <?= set_select('filiere_sid', ($value['filiere_libelle'])); ?>>
                                            <?= ucfirst(($value['filiere_libelle'])); ?></option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                   <option value="new">Créer une filiere</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div id="inputnewitemshow" style="display:none;">
                            <div class="form-group">
                                <label for="libelle_filiere" class="control-label">
                                    <span class="text-danger">*</span> Libelle nouvelle filiere
                                </label>
                                <input type="text"
                                       class="form-control text-capitalize"
                                       name="libelle_filiere"
                                       id="libelle_filiere" 
                                       value="<?= old('libelle_filiere') ?>"
                                       style="border-radius: 10px!important;"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12">

                        <div class="form-group">
                            <label for="libelle_option" class="control-label">
                                <span class="text-danger"></span> Nom ou Libellé Option
                            </label>
                            <input type="text"
                                   class="form-control text-capitalize"
                                   name="libelle_option"
                                   id="libelle_option"
                                   value="<?= old('libelle_option') ?>"
                                   style="border-radius: 10px!important;"
                                   />
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
