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
                            <h5 class="font-weight-bold">Modification fiche parent</h5>
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
                    echo form_open(base_url() . '/etudiant/saveParent/update/' . (isset($parent) ? esc($parent['parent_uid']) : ''), $attributes);
                    ?>

                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('etudiant/dossier/parent'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> voir la liste
                                </a>
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
                                        <th width="15%"></th>
                                        <th width="35%"></th>
                                        <th width="15%"></th>
                                        <th width="35%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><label for="nom_pere"><span class="text-danger">*</span>Nom du père</label>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="nom_pere" id="nom_pere"
                                                       class="form-control <?= ($validation->hasError('nom_pere')) ? ' is-invalid' : '' ?>"
                                                       value="<?= (isset($parent)) ? esc($parent['parent_nom_pere']) : set_value('nom_pere'); ?>">
                                                <?php if ($validation->hasError('nom_pere')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('nom_pere'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </td>

                                        <td><label for="profession_pere"><span class="text-danger"></span>Profession
                                                du père</label></td>
                                        <td>
                                            <div class="form-group">

                                                <input type="text" name="profession_pere" id="profession_pere"
                                                       class="form-control <?= ($validation->hasError('profession_pere')) ? ' is-invalid' : '' ?>"
                                                       value="<?= (isset($parent)) ? esc($parent['parent_profession_pere']) : set_value('profession_pere'); ?>">
                                                <?php if ($validation->hasError('profession_pere')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('profession_pere'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td><label for="phone_pere">Téléphone du père</label></td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="phone_pere"
                                                       id="phone_pere"
                                                       data-inputmask='"mask": "+243999999999"'
                                                       data-mask placeholder="Ex: 858533285"
                                                       value="<?= (isset($parent)) ? substr(esc($parent['parent_phone_pere']), 4) : set_value('telephone_tuteur') ?>"/>
                                            </div>
                                        </td>

                                        <td><label for="nom_mere"><span class="text-danger">*</span>Nom de la
                                                mère</label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="nom_mere" id="nom_mere"
                                                       class="form-control <?= ($validation->hasError('nom_mere')) ? ' is-invalid' : '' ?>"
                                                       value="<?= (isset($parent)) ? esc($parent['parent_nom_mere']) : set_value('nom_mere'); ?>">
                                                <?php if ($validation->hasError('nom_mere')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('nom_mere'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="profession_mere"><span class="text-danger"></span>Profession de
                                                la mère</label></td>
                                        <td>
                                            <div class="form-group">

                                                <input type="text" name="profession_mere" id="profession_mere"
                                                       class="form-control <?= ($validation->hasError('profession_mere')) ? ' is-invalid' : '' ?>"
                                                       value="<?= (isset($parent)) ? esc($parent['parent_profession_mere']) : set_value('profession_mere'); ?>">
                                                <?php if ($validation->hasError('profession_mere')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('profession_mere'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </td>

                                        <td><label for="phone_mere">Téléphone mère</label></td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="phone_mere"
                                                       id="phone_mere"
                                                       data-inputmask='"mask": "+243999999999"'
                                                       data-mask placeholder="Ex: 858533285"
                                                       value="<?= (isset($parent)) ? substr(esc($parent['parent_phone_mere']), 4) : set_value('phone_mere') ?>"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="nom_tuteur"><span class="text-danger">*</span>Nom du
                                                tuteur</label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="nom_tuteur" id="nom_tuteur"
                                                       class="form-control <?= ($validation->hasError('nom_tuteur')) ? ' is-invalid' : '' ?>"
                                                       value="<?= (isset($parent)) ? esc($parent['parent_nom_tuteur']) : set_value('nom_tuteur'); ?>">
                                                <?php if ($validation->hasError('nom_tuteur')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('nom_tuteur'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </td>

                                        <td><label for="profession_tuteur"><span class="text-danger"></span>Profession
                                                du tuteur</label></td>
                                        <td>
                                            <div class="form-group">

                                                <input type="text" name="profession_tuteur" id="profession_tuteur"
                                                       class="form-control <?= ($validation->hasError('profession_tuteur')) ? ' is-invalid' : '' ?>"
                                                       value="<?= (isset($parent)) ? esc($parent['parent_profession_tuteur']) : set_value('profession_tuteur'); ?>">
                                                <?php if ($validation->hasError('profession_tuteur')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('profession_tuteur'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td><label for="telephone_tuteur">Téléphone du tuteur</label></td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="telephone_tuteur"
                                                       id="telephone_tuteur"
                                                       data-inputmask='"mask": "+243999999999"'
                                                       data-mask placeholder="Ex: 858533285"
                                                       value="<?= (isset($parent)) ? substr(esc($parent['parent_phone_tuteur']), 4) : set_value('telephone_tuteur') ?>"/>
                                            </div>
                                        </td>
                                        <td>
                                            <label for="tuteur_lien"><span class="text-danger"></span>
                                                Lien tuteur - étudiant :</label>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="tuteur_lien"
                                                       name="tuteur_lien"
                                                       value="<?= (isset($parent)) ? esc($parent['parent_lien_tuteur']) : set_value('tuteur_lien') ?>"/>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                    <td> <label class="phone_sms"><span class="text-danger">*</span>Numéro  SMS
                                            :</label></td>
                                            <td>
                                                <?php $sms = (isset($parent)) ? esc($parent['parent_phone_sms']) : ""; ?>
                                                <div class="input-group">
                                                    <div class="icheck-success d-inline mr-3">
                                                        <input type="radio"
                                                               name="phone_sms" <?= (!empty($sms) && ($sms== "pere")) ? "checked" : ""; ?>
                                                               id="pere"
                                                               value="pere">
                                                        <label for="pere">
                                                            Père
                                                        </label>
                                                    </div>
                                                    <div class="icheck-success d-inline mr-3 ml-3">
                                                        <input type="radio"
                                                               name="phone_sms"
                                                               id="mere" value="mere" <?= (!empty($sms) && ($sms== "mere")) ? "checked" : ""; ?>>
                                                        <label for="mere">
                                                            Mère
                                                        </label>
                                                    </div>
                                                    <div class="icheck-success d-inline">
                                                        <input type="radio"
                                                               name="phone_sms"
                                                               id="tuteur" value="tuteur" <?= (!empty($sms) && ($sms== "tuteur")) ? "checked" : ""; ?>>
                                                        <label for="tuteur">
                                                            Tuteur
                                                        </label>
                                                    </div>
                                                </div>
                                                <!-- /.input group -->
                                            </td>

                                        <td><label for="email_tuteur">Email Parent</label></td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="text"
                                                       class="form-control bg-light text-lowercase"
                                                       name="email_tuteur"
                                                       id="email_tuteur"
                                                       value="<?= (isset($parent)) ? esc($parent['parent_email']) : set_value('email_tuteur') ?>"
                                                />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td><label for="phone_second_pere">Deuxième Téléphone du père</label></td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="phone_second_pere"
                                                       id="phone_second_pere"
                                                       data-inputmask='"mask": "+243999999999"'
                                                       data-mask placeholder="Ex: 858533285"
                                                       value="<?= (isset($parent)) ? substr(esc($parent['parent_phone_pere2']), 4) : set_value('phone_second_pere') ?>"/>
                                            </div>
                                        </td>

                                        <td><label for="phone_second_mere">Deuxième Téléphone de la mère</label></td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="phone_second_mere"
                                                       id="phone_second_mere"
                                                       data-inputmask='"mask": "+243999999999"'
                                                       data-mask placeholder="Ex: 858533285"
                                                       value="<?= (isset($parent)) ? substr(esc($parent['parent_phone_mere2']), 4) : set_value('phone_second_mere') ?>"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="phone_second_tuteur">Deuxième Téléphone du tuteur</label></td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="phone_second_tuteur"
                                                       id="phone_second_tuteur"
                                                       data-inputmask='"mask": "+243999999999"'
                                                       data-mask placeholder="Ex: 858533285"
                                                       value="<?= (isset($parent)) ? substr(esc($parent['parent_phone_tuteur2']), 4) : set_value('phone_second_tuteur') ?>"/>
                                            </div>
                                        </td>
                                        <td>
                                            <label for="nom_autre_personne"><span class="text-danger"></span>
                                                Autre personne à contacter :</label>
                                        </td>
                                        <td>

                                            <div class="form-group">

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="fas fa-user"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="nom_autre_personne"
                                                           name="nom_autre_personne"
                                                           value="<?= (isset($parent)) ? esc($parent['parent_autre_personnee']) : set_value('nom_autre_personne') ?>"/>
                                                </div>
                                            </div>

                                        </td>

                                    </tr>
                                    <tr>
                                        <td><label for="adresse_parent">Adresse Tuteur:</label></td>
                                        <td>
                                            <textarea name="adresse_parent" class="form-control"
                                                      id="adresse_parent" cols="30"
                                                      rows="3"><?= (isset($parent)) ? esc($parent['parent_adresse']) : set_value('adresse_parent') ?></textarea>
                                        </td>

                                        <td><label for="commentaire_parent">Observation:</label></td>
                                        <td>
                                            <textarea name="commentaire_parent" class="form-control"
                                                      id="commentaire_parent" cols="30"
                                                      rows="3"><?= (isset($parent)) ? esc($parent['parent_comment']) : set_value('commentaire_parent') ?></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-lg">
                                <i class="fa fa-check-circle"></i> Enregistrer les modifications
                            </button>
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
