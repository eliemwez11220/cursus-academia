<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Administration - Autorisations & permissions</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Privilèges</li>
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
                                <h5 class="font-weight-bold text-uppercase">Liste &nbsp; des Privilèges</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a data-toggle="modal" data-target="#nouvel_element"
                                   href="#" class="btn btn-info btn-xs  text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour créer un nouveau groupe">
                                        <i class="fa fa-plus"></i> Nouveau  &nbsp; Privilèges
                                    </span>
                                </a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th>#</th>
                                        <th>Groupe Autorise</th>
                                        <th>Objet Acces</th>
                                        <th colspan="4">Droits</th>
                                        <th width="1px"></th>
                                        <th width="1px"></th>
                                        <th width="1px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($privileges) && !empty($privileges)):
                                        foreach ($privileges as $key => $value):
                                            $status = (!empty(esc($value['privilege_status'])) ? esc($value['privilege_status']) : 'inactif');
                                            ?>
                                            <tr>
                                                <td><?= $count++; ?></td>
                                                <td class="text-uppercase small"><?= esc($value['groupe_libelle']); ?></td>
                                                <td class="text-uppercase small">
                                                    <?php //esc($value['acces_libelle']).' - '; ?> 
                                                    <?php
                                                    $objet = esc($value['acces_objet']);
                                                    switch ($objet):
                                                        case "dossiers": echo 'Dossiers etudiants';
                                                            break;case "cotes": echo 'Cotes & Epreuves';
                                                        break;case "branches": echo 'Branches & Matières';
                                                        break;case "personnels": echo 'Personnel';
                                                        break;case "finances": echo 'Finances';
                                                        break;case "configurations": echo 'Configuration';
                                                        break;case "administrations": echo 'Administration';
                                                        break;case "rapports": echo 'Rapports';
                                                        break;case "publications": echo 'Publication';
                                                        break;case "etudes": echo 'Etudes en ligne';
                                                        break;
                                                        default: echo "Acces a tous les modules";
                                                            break;
                                                            ?>
                                                        <?php endswitch;?>
                                                </td>
                                                <td><?= (esc($value['privilege_lecture']) == 'allow')?"Lecture":"-"; ?>|</td> 
                                                <td><?= (esc($value['privilege_ecriture']) == 'allow')?"Ecriture":"-"; ?> |</td>
                                                <td><?= (esc($value['privilege_execute']) == 'allow')?"Execute":"-"; ?>|</td> 
                                                <td class="small"><?= (esc($value['privilege_tout']) == 'allow')?"Tous les privileges":"-"; ?></td>

                                                <td>
                                                    <a href="<?= base_url('admin/changeStatus/privilege/'.esc($status).'/'.esc($value['privilege_uid'])); ?>"
                                                       onclick="return confirm('Voulez-vous vraiment bloquer son acces?');">
                                                        <span class="badge  <?= (esc($status) =='actif') ? 'badge-success':'badge-danger';?> text-capitalize" data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour bloquer l'acces">
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
                                                </td>
                                                <td width="1px" class="text-center">
                                                    <a href="<?= base_url('admin/details/privileges/' . esc($value['privilege_uid'])); ?>"
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

                                                            <h4 class="modal-title d-inline-flex text-uppercase font-weight-bold">
                                                                Modification privilège</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                        <span aria-hidden="true">
                                                                     <i class="fa fa-window-close"></i>
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <?php
                                                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                                        echo form_open('admin/savePrivilege/update/' . esc($value['privilege_uid']), $attributes);
                                                        ?>
                                                        <div class="modal-body">
                                                            <div class="row">

                                                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="groupe" class="control-label">
                                                                            <span class="text-danger">*</span> Groupe Autorisation
                                                                        </label>
                                                                        <select id="groupe" name="groupe"
                                                                                class="form-control select2 select2-info"
                                                                                data-dropdown-css-class="select2-info">
                                                                            <option disabled >-- Sélectionnez un groupe --</option>
                                                                            <?php

                                                                            if (isset($groupes) && !empty($groupes)):
                                                                                foreach ($groupes as $key2 => $value2):
                                                                                    if(esc($value['privilege_groupe_uid']) == esc($value2['groupe_uid'])):?>
                                                                                        <option selected value="<?= $value2['groupe_uid']; ?>"><?= $value2['groupe_libelle']; ?></option>
                                                                                    <?php endif; ?>
                                                                                    <option value="<?= $value2['groupe_uid']; ?>"><?= $value2['groupe_libelle']; ?></option>
                                                                                <?php endforeach; ?>
                                                                            <?php endif; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="objet_acces" class="control-label">
                                                                            <span class="text-danger">*</span> Objet Module Acces
                                                                        </label>
                                                                        <select id="objet_acces" name="objet_acces"
                                                                                class="form-control select2 select2-info"
                                                                                data-dropdown-css-class="select2-info">
                                                                            <option disabled selected>-- Sélectionnez un Module --</option>
                                                                            <?php

                                                                            if (isset($acces) && !empty($acces)):
                                                                                foreach ($acces as $keyA => $valueAc):
                                                                                    if(esc($value['privilege_acces_uid']) == esc($valueAc['acces_uid'])):?>
                                                                                        <option selected value="<?= $value['acces_uid']; ?>"><?= $valueAc['acces_libelle']; ?></option>
                                                                                    <?php endif; ?>
                                                                                    <option value="<?= $valueAc['acces_uid']; ?>"><?= $valueAc['acces_libelle']; ?></option>
                                                                                <?php endforeach; ?>
                                                                            <?php endif; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                    <h5 class="font-weight-bold"><span class="text-danger">*</span> Droits d'accès</h5>

                                                                    <div class="form-group">
                                                                        <div class="icheck-info d-inline">
                                                                            <input type="checkbox" name="lecture"
                                                                                   id="lecture<?= $count; ?>" <?= (esc($value['privilege_lecture']) == 'allow')? 'checked':''?>>
                                                                            <label for="lecture<?= $count; ?>">
                                                                                Lecture
                                                                            </label>
                                                                        </div>

                                                                        <div class="icheck-info d-inline">
                                                                            <input type="checkbox" name="ecriture"
                                                                                   id="ecriture<?= $count; ?>" <?= (esc($value['privilege_ecriture']) == 'allow')? 'checked':''?>>
                                                                            <label for="ecriture<?= $count; ?>">
                                                                                Ecriture
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-info d-inline">
                                                                            <input type="checkbox" name="execute"
                                                                                   id="execute<?= $count; ?>" <?= (esc($value['privilege_execute']) == 'allow')? 'checked':''?>>
                                                                            <label for="execute<?= $count; ?>">
                                                                                Exécution
                                                                            </label>
                                                                        </div>
                                                                        <div class="icheck-info d-inline">
                                                                            <input type="checkbox" name="full"
                                                                                   id="full<?= $count; ?>" <?= (esc($value['privilege_tout']) == 'allow')? 'checked':''?>>
                                                                            <label for="full<?= $count; ?>">
                                                                                Tous les privilèges
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="observation" class="control-label">
                                                                            <span class="text-danger"></span> Commentaire ou observation
                                                                        </label>
                                                                        <textarea name="observation" class="form-control text-capitalize"
                                                                                  id="observation" cols="30"
                                                                                  rows="5"><?= isset($value)? esc($value['privilege_observation']):old('observation') ?></textarea>
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
                <h4 class="modal-title font-weight-bold text-uppercase">Ajout d'un nouveau privilège</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open('admin/savePrivilege/create/', $attributes);
            ?>
            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="groupe" class="control-label">
                                <span class="text-danger">*</span> Groupe Autorisation
                            </label>
                            <select id="groupe" name="groupe"
                                    class="form-control select2 select2-info"
                                    data-dropdown-css-class="select2-info">
                                <option disabled selected>-- Sélectionnez un groupe --</option>
                                <?php
                                $countaccess = 1;
                                if (isset($groupes) && !empty($groupes)):
                                foreach ($groupes as $key => $value):?>
                                    <option value="<?= $value['groupe_uid']; ?>"><?= $value['groupe_libelle']; ?></option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="objet_acces" class="control-label">
                                <span class="text-danger">*</span> Objet Module Acces
                            </label>
                            <select id="objet_acces" name="objet_acces"
                                    class="form-control select2 select2-info"
                                    data-dropdown-css-class="select2-info">
                                <option disabled selected>-- Sélectionnez un Module --</option>
                                <?php
                                $countaccess = 1;
                                if (isset($acces) && !empty($acces)):
                                foreach ($acces as $key => $value):?>
                                    <option value="<?= $value['acces_uid']; ?>"><?= $value['acces_libelle']; ?></option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <h5 class="font-weight-bold"><span class="text-danger">*</span> Droits d'acces</h5>
                        <div class="form-group">
                            <div class="icheck-info d-inline">
                                <input type="checkbox" name="lecture"
                                       id="lecture">
                                <label for="lecture">
                                    Lecture
                                </label>
                            </div>

                            <div class="icheck-info d-inline">
                                <input type="checkbox" name="ecriture"
                                       id="ecriture">
                                <label for="ecriture">
                                    Ecriture
                                </label>
                            </div>
                            <div class="icheck-info d-inline">
                                <input type="checkbox" name="execute"
                                       id="execute" >
                                <label for="execute">
                                   Execution
                                </label>
                            </div>
                            <div class="icheck-info d-inline">
                                <input type="checkbox" name="full"
                                       id="full" checked="checked">
                                <label for="full">
                                    Tous les privilèges
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="observation" class="control-label">
                                <span class="text-danger"></span> Commentaire ou observation
                            </label>
                            <textarea name="observation" class="form-control text-capitalize"
                                      id="observation" cols="30"
                                      rows="5"><?= old('observation') ?></textarea>
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
