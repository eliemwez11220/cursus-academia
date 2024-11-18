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
                            <h5 class="font-weight-bold">Modification Ecole <?= (isset($ecole)) ? ($ecole['ecole_libelle']) :'' ?></h5>
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
                    <?php
                    $validation = \Config\Services::validation();
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open_multipart(base_url() . '/ecole/saveEcole/update/'.(isset($ecole) ? esc($ecole['ecole_uid']): ''), $attributes);
                    ?>

                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                 <?php if(empty(session()->schooluid)) :?>
                                    <a href="<?= base_url('ecole/view/ecoles'); ?>"
                                       class="btn btn-default btn-rounded text-uppercase btn-xs">
                                        <i class="fa fa-arrow-circle-left"></i> voir la liste
                                    </a>
                                <?php else: ?>
                                    <a href="<?= base_url('ecole/fiche'); ?>"
                                       class="btn btn-default btn-rounded text-uppercase btn-xs">
                                        <i class="fa fa-arrow-circle-left"></i> voir la fiche
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="card-tools float-right">
                                <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-check-circle"></i> Enregistrer les modifications
                                </button>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesWithoutActions"
                                       class="table table-sm  table-hover table-head-fixed">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th width="20%"></th>
                                        <th width="80%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><label for="code_ecole">Code Ecole</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="code_ecole"
                                                   id="code_ecole"
                                                   value="<?= (isset($ecole)) ? ($ecole['ecole_code']): set_value('code_ecole') ?>"
                                                   style="border-radius: 10px!important;"
                                                   required/>
                                            <?php if(isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'code_ecole'); ?>
                                            </span>
                                            <?php endif;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="libelle_ecole">Nom Ecole</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="libelle_ecole"
                                                   id="libelle_ecole"
                                                   value="<?= (isset($ecole)) ? ($ecole['ecole_libelle']) :set_value('libelle_ecole') ?>"
                                                   style="border-radius: 10px!important;"
                                                   required/>
                                            <?php if(isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'libelle_ecole'); ?>
                                            </span>
                                            <?php endif;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="gestionnaire_ecole">Gestionnaire Ecole</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="gestionnaire_ecole"
                                                   id="gestionnaire_ecole"
                                                   value="<?= (isset($ecole)) ? ($ecole['ecole_gestionnaire']) :set_value('gestionnaire_ecole') ?>"
                                                   style="border-radius: 10px!important;"
                                                   />

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="coordination_ecole" class="control-label">
                                                <span class="text-danger">*</span> Coordination
                                            </label>
                                        </td>
                                        <td>
                                                <div class="form-group">

                                                    <select id="coordination_ecole" name="coordination_ecole"
                                                            class="form-control select2 select2-info text-capitalize <?php if ($validation->hasError('coordination_ecole')) {
                                                                echo 'is-invalid';
                                                            } ?>"
                                                            data-dropdown-css-class="select2-info" required>
                                                        <option disabled>-- Sélectionnez une coordination--</option>
                                                        <?php
                                                        $count = 1;
                                                        if (isset($coordinations) && !empty($coordinations)):
                                                            foreach ($coordinations as $key => $value):
                                                                if (esc($value['coordination_uid']) == esc($ecole['ecole_coordination'])): ?>
                                                                    <option selected value="<?= esc($ecole['ecole_coordination']); ?>" <?= set_select('coordination_ecole', ($ecole['ecole_coordination'])); ?>>
                                                                        <?= ucfirst(($value['coordination_libelle'])); ?></option>
                                                                <?php endif; ?>
                                                                <option value="<?= esc($value['coordination_uid']); ?>" <?= set_select('coordination_ecole', ($value['coordination_uid'])); ?>>
                                                                    <?= ucfirst(($value['coordination_libelle'])); ?></option>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <option>Aucune coordination</option>
                                                        <?php endif; ?>
                                                    </select>
                                                    <?php if (isset($validation)): ?>
                                                        <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'coordination_ecole'); ?>
                                            </span>
                                                    <?php endif; ?>
                                                </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="typeens_sid_ecole" class="control-label">
                                                <span class="text-danger">*</span> Type Enseignement
                                            </label>
                                        </td>
                                        <td>
                                            <select id="typeens_sid_ecole" name="typeens_sid"
                                                    class="form-control select2 select2-info text-capitalize <?php if($validation->hasError( 'typeens_sid')){echo 'is-invalid';} ?>"
                                                    data-dropdown-css-class="select2-info" required>
                                                <option disabled>-- Sélectionnez type enseignement--</option>
                                                <?php
                                                $count = 1;
                                                if (isset($typesens) && !empty($typesens)):
                                                    foreach ($typesens as $key => $value):
                                                        if (esc($value['typesens_uid']) == esc($ecole['typesens_uid'])): ?>
                                                            <option selected value="<?= esc($ecole['typesens_uid']); ?>" <?= set_select('typeens_sid', esc($ecole['typesens_uid'])); ?>>
                                                                <?= ucfirst(($value['typesens_libelle'])); ?></option>
                                                        <?php endif; ?>
                                                            <option value="<?= esc($value['typesens_uid']); ?>" <?= set_select('typeens_sid', esc($value['typesens_uid'])); ?>>
                                                            <?= ucfirst(($value['typesens_libelle'])); ?>-<?= esc($value['typesens_code']); ?></option>

                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <option>Aucun</option>
                                                <?php endif; ?>
                                            </select>
                                            <?php if(isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'typeens_sid'); ?>
                                            </span>
                                            <?php endif;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="typeecole_sid" class="control-label">
                                                <span class="text-danger">*</span> Type Ecole
                                            </label>
                                        </td>
                                        <td>
                                            <select id="typeecole_sid" name="typeecole_sid"
                                                    class="form-control select2 select2-info text-capitalize <?php if($validation->hasError( 'typeecole_sid')){echo 'is-invalid';} ?>"
                                                    data-dropdown-css-class="select2-info" required>
                                                <option  disabled>-- Sélectionnez type ecole--</option>
                                                <?php
                                                $count = 1;
                                                if (isset($typesecoles) && !empty($typesecoles)):
                                                    foreach ($typesecoles as $key => $value):
                                                        if (esc($value['typesecole_uid']) == esc($ecole['typesecole_uid'])): ?>
                                                            <option selected value="<?= esc($ecole['typesecole_uid']); ?>" <?= set_select('typecole_sid', esc($ecole['typesecole_uid'])); ?>>
                                                                <?= ucfirst(($value['typesecole_libelle'])); ?></option>
                                                        <?php endif; ?>
                                                            <option value="<?= esc($value['typesecole_uid']); ?>" <?= set_select('typecole_sid', esc($value['typesecole_uid'])); ?>>
                                                                <?= ucfirst(($value['typesecole_libelle'])); ?> - <?= esc($value['typesecole_code']); ?></option>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <option>Aucun</option>
                                                <?php endif; ?>
                                            </select>
                                            <?php if(isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'typecole_sid'); ?>
                                            </span>
                                            <?php endif;?>
                                        </td>
                                    </tr>



                                    <tr>

                                        <td><label for="devise_ecole">Devise de l'école</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="devise_ecole"
                                                   id="devise_ecole"
                                                   value="<?= (isset($ecole)) ? ($ecole['ecole_devise']) :set_value('devise_ecole') ?>"
                                                   style="border-radius: 10px!important;"
                                                   />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="email_ecole">Email de l'école</label></td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                </div>
                                            <input type="text"
                                                   class="form-control bg-light text-lowercase"
                                                   name="email_ecole"
                                                   id="email_ecole"
                                                   value="<?= (isset($ecole)) ? ($ecole['ecole_email']) :set_value('email_ecole') ?>"
                                                   />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="telephone_ecole">Numero Téléphone école</label></td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="telephone_ecole" id="telephone_ecole"
                                                       data-inputmask='"mask": "+243999999999"'
                                                       data-mask placeholder="Ex: 858533285"
                                                       value="<?= (isset($ecole)) ? ($ecole['ecole_telephone']) :set_value('telephone_ecole') ?>" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="ville_ecole">Ville école</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="ville_ecole"
                                                   id="ville_ecole"
                                                   value="<?= (isset($ecole)) ? ($ecole['ecole_ville']) :set_value('ville_ecole') ?>"
                                                   style="border-radius: 10px!important;"
                                                   />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="province_ecole">Province école</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="province_ecole"
                                                   id="province_ecole"
                                                   value="<?= (isset($ecole)) ? ($ecole['ecole_province']) :set_value('province_ecole') ?>"
                                                   style="border-radius: 10px!important;"
                                                   />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="siteweb_ecole">Site web école</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-lowercase"
                                                   name="siteweb_ecole"
                                                   id="siteweb_ecole" placeholder="Ex:https://www.trecaad.com"
                                                   value="<?= (isset($ecole)) ? esc($ecole['ecole_siteweb']) :set_value('siteweb_ecole') ?>"
                                                   style="border-radius: 10px!important;"
                                                   />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="logo_ecole">Logo Ecole:</label></td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                      <i class="fas fa-image"></i>
                                                    </span>
                                                </div>
                                                    <input type="file" name="logo_ecole" class="form-control"
                                                           id="logo_ecole"
                                                           value="<?= set_value('logo_ecole') ?>"/>
                                            </div>
                                            <?php if(isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'logo_ecole'); ?>
                                            </span>
                                            <?php endif;?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="adresse_ecole">Adresse Physique:</label></td>
                                        <td>
                                            <textarea name="adresse_ecole" class="form-control"
                                                      id="adresse_ecole" cols="30" rows="5"><?= (isset($ecole)) ? ($ecole['ecole_adresse']) :set_value('adresse_ecole') ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="commentaire_ecole">Observation ou commentaire:</label></td>
                                        <td>
                                            <textarea name="commentaire_ecole" class="form-control"
                                                      id="commentaire_ecole" cols="30" rows="5"><?= (isset($ecole)) ? ($ecole['ecole_comment']) :set_value('commentaire_ecole') ?></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-check-circle"></i> Enregistrer les modifications
                                </button>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <?= form_close(); ?>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>
