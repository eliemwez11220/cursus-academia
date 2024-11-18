<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Modification
                        etudiant: <?= (isset($etudiant) ? esc($etudiant['etudiant_matricule']) . '-' . esc($etudiant['etudiant_nom']) : ''); ?></h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active"></li>
                        Elèves
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
                    <!-- form start -->
                    <?php
                    //matricule generated
                    $aleatoire_value = "0123456789";
                    $new_matricule_student_generate = "EM" . date('Y') . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(4, 20))), 0, 4);

                    //form validation services call
                    $validation = \Config\Services::validation();

                    //form
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open_multipart(base_url() . '/student/updateDossieretudiant/' . (isset($etudiant) ? esc($etudiant['etudiant_uid']) : ''), $attributes);
                    ?>
                    <input type="hidden" name="instoken"
                           value="<?= isset($etudiant) ? esc($etudiant['inscription_uid']) : '' ?>">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="card-tools float-left">
                                    <a href="<?= base_url('student/dossier/inscription'); ?>"
                                       class="btn btn-default btn-sm btn-rounded text-uppercase">
                                        <i class="fa fa-arrow-circle-left fa-lg"></i> voir la liste
                                    </a>

                                    <a href="<?= base_url('student/details/inscription/' . esc($etudiant['etudiant_uid']) . '/' . esc($etudiant['inscription_promotion_uid'])); ?>"
                                       class="btn btn-default btn-sm btn-rounded text-uppercase">
                                        <i class="fa fa-info-circle fa-lg"></i> voir la fiche
                                    </a>
                                </div>
                            </div>
                            <div class="card-tools float-right">
                                <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-sm">
                                    <i class="fa fa-edit fa-lg"></i> <strong>Enregistrer les modifications</strong>
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
                                        <th width="30%"></th>
                                         <th width="20%"></th>
                                        <th width="30%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr class="alert alert-secondary">
                                        <td colspan="4" class="text-uppercase">
                                            <strong>
                                                Infos sur étudiants
                                            </strong>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="matriculeetudiant">
                                                <span class="text-danger">*</span> Matricule étudiant
                                            </label>
                                        </td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                                <input type="text" name="matriculeetudiant" id="matriculeetudiant"
                                                       class="form-control <?= ($validation->hasError('matriculeetudiant')) ? ' is-invalid' : '' ?>"
                                                       placeholder="Matricule"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_matricule']) : set_value('matriculeetudiant') ?>">

                                                <?php if ($validation->hasError('matriculeetudiant')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('matriculeetudiant'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </td>


                                        <td><label for="numeroSernietudiant">
                                                Numéro  ID</label></td>

                                        <td class="text-uppercase">
                                            <div class="form-group">
                                                <input type="text" name="numeroSernietudiant" id="numeroSernietudiant"
                                                       class="form-control <?= ($validation->hasError('numeroSernietudiant')) ? ' is-invalid' : '' ?>"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_numero_serni']) : set_value('numeroSernietudiant'); ?>">

                                                <?php if ($validation->hasError('numeroSernietudiant')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('numeroSernietudiant'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="nometudiant"><span class="text-danger">*</span>Nom étudiant</label>
                                        </td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <input type="text" name="nometudiant" id="nometudiant"
                                                       class="form-control <?= ($validation->hasError('nometudiant')) ? ' is-invalid' : '' ?>"
                                                       placeholder="Nom etudiant"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_nom']) : set_value('nometudiant'); ?>">

                                                <?php if ($validation->hasError('nometudiant')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('nometudiant'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </td>

                                        <td>
                                            <label for="postnometudiant"><span class="text-danger"></span>
                                                Postnom étudiant</label>
                                        </td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                                <input type="text" name="postnometudiant" id="postnometudiant"
                                                       class="form-control <?= ($validation->hasError('postnometudiant')) ? ' is-invalid' : '' ?>"
                                                       placeholder="PostNom etudiant"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_postnom']) : set_value('postnometudiant'); ?>">

                                                <?php if ($validation->hasError('postnometudiant')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('postnometudiant'); ?></span>
                                                <?php } ?>

                                            </div> <!-- prenom etudiant -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="prenometudiant"><span class="text-danger"></span>Prénom
                                                étudiant</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                                <input type="text" name="prenometudiant" id="prenometudiant"
                                                       class="form-control <?= ($validation->hasError('prenometudiant')) ? ' is-invalid' : '' ?>"
                                                       placeholder="PreNom etudiant"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_prenom']) : set_value('prenometudiant'); ?>">

                                                <?php if ($validation->hasError('prenometudiant')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('prenometudiant'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </td>

                                        <td><label><span class="text-danger">*</span>Sexe étudiant : </label></td>
                                        <td class="text-uppercase">
                                            <?php if (isset($etudiant)) {
                                                $sexe = esc($etudiant['etudiant_sexe']);
                                            } ?>
                                            <div class="form-group">

                                                <div class="icheck-success d-inline small">
                                                    <input type="radio"
                                                           name="sexeetudiant" <?= ($sexe == 'masculin') ? 'checked' : ''; ?>
                                                           id="radioSuccess1"
                                                           value="masculin">
                                                    <label for="radioSuccess1">
                                                        Masculin
                                                    </label>
                                                </div>
                                                <div class="icheck-success d-inline small">
                                                    <input type="radio"
                                                           name="sexeetudiant" <?= ($sexe == 'feminin') ? 'checked' : ''; ?>
                                                           id="radioSuccess2" value="feminin">
                                                    <label for="radioSuccess2">
                                                        Feminin
                                                    </label>
                                                </div>
                                                
                                                <?php if ($validation->hasError('sexeetudiant')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('sexeetudiant'); ?></span>
                                                <?php } ?>
                                            </div>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="dateNaissanceetudiant"><span class="text-danger"></span>Date de
                                                naissance:</label></td>
                                        <td class="text-uppercase">

                                            <div class="form-group">

                                                <div class="input-group date" id="date_format_abrege"
                                                     data-target-input="nearest">
                                                    <input type="text"
                                                           class="form-control datetimepicker-input <?= ($validation->hasError('dateNaissanceetudiant')) ? ' is-invalid' : '' ?>"
                                                           id="dateNaissanceetudiant"
                                                           value="<?= isset($etudiant) ? $etudiant['etudiant_date_naissance'] : set_value('dateNaissanceetudiant') ?>"
                                                           data-target="#date_format_abrege" name="dateNaissanceetudiant"/>
                                                    <div class="input-group-append" data-target="#date_format_abrege"
                                                         data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if ($validation->hasError('dateNaissanceetudiant')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('dateNaissanceetudiant'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </td>

                                        <td><label for="lieuNaissanceetudiant"><span class="text-danger"></span>Lieu
                                                de naissance
                                                étudiant</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <input type="text" name="lieuNaissanceetudiant" id="nometudiant"
                                                       class="form-control <?= ($validation->hasError('lieuNaissanceetudiant')) ? ' is-invalid' : '' ?>"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_lieu_naissance']) : set_value('lieuNaissanceetudiant'); ?>">

                                                <?php if ($validation->hasError('lieuNaissanceetudiant')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('lieuNaissanceetudiant'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td><label for="categorieetudiant"><span class="text-danger">*</span>Catégorie
                                                étudiant</label></td>
                                        <td class="text-uppercase">


                                            <div class="form-group">

                                                <select id="categorieetudiant" name="categorieetudiant"
                                                        class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('categorieetudiant')) ? ' is-invalid' : '' ?>"
                                                        data-dropdown-css-class="select2-info" style="width: 100%;">
                                                        <option disabled>-- Sélectionnez une
                                                                    catégorie --
                                                                </option>
                                                    <?php
                                                    
                                                        $cateActuellle = (isset($etudiant))? ($etudiant['etudiant_type_uid']):"";

                                                    $count = 1;
                                                    if (isset($typesetudiants) && !empty($typesetudiants)):
                                                        foreach ($typesetudiants as $key => $value):?>
                                                            <option value="<?= esc($value['typesetudiant_uid']); ?>" 
                                                            <?= ($cateActuellle == esc($value['typesetudiant_uid'])) ? "selected": set_select('categorieetudiant', esc($value['typesetudiant_uid'])); ?>>
                                                                <?= ucfirst(esc($value['typesetudiant_libelle'])); ?>

                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                                <?php if ($validation->hasError('categorieetudiant')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('categorieetudiant'); ?></span>
                                                <?php } ?>
                                            </div>

                                        </td>

                                        <td><label for="statutetudiant"><span class="text-danger">*</span> Statut
                                                étudiant</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                                <select id="statutetudiant" name="statutetudiant"
                                                        class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('statutetudiant')) ? ' is-invalid' : '' ?>"
                                                        data-dropdown-css-class="select2-info" style="width: 100%;">

                                                    <?php

                                                    if (isset($etudiant)):

                                                        if (!empty(esc($etudiant['etudiant_statut']))) { ?>
                                                            <option selected
                                                                    value="<?= esc($etudiant['etudiant_statut']); ?>" <?= set_select('statutetudiant', esc($etudiant['etudiant_statut'])); ?>>
                                                                <?= ucfirst(esc($etudiant['etudiant_statut'])); ?>
                                                            </option>
                                                        <?php } ?>
                                                    <?php else: ?>

                                                        <option selected="selected" disabled>-- Sélectionnez un statut
                                                            --
                                                        </option>
                                                    <?php endif; ?>
                                                    <option value="actif" <?= set_select('statutetudiant', 'actif'); ?>>
                                                        Actif
                                                    </option>
                                                    <option value="inactif" <?= set_select('statutetudiant', 'inactif'); ?>>
                                                        Inactif
                                                    </option>
                                                    <option value="transfert" <?= set_select('statutetudiant', 'transfert'); ?>>
                                                        Transferé
                                                    </option>


                                                </select>
                                                <?php if ($validation->hasError('statutetudiant')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('statutetudiant'); ?></span>
                                                <?php } ?>
                                            </div>

                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <label for="promotionetudiant"><span class="text-danger">*</span>promotion
                                            </label>
                                        </td>
                                        <td class="text-uppercase" colspan="4">


                                            <div class="form-group">

                                                <select class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('promotionetudiant')) ? ' is-invalid' : '' ?>"
                                                        id="promotionetudiant"
                                                        name="promotionetudiant"
                                                        data-dropdown-css-class="select2-info" style="width: 100%;">
                                                    <option selected="selected" disabled>-- Selectionnez une promotion --
                                                    </option>
                                                    <?php
                                                    if (isset($etudiant)) {
                                                        $promotionActuelle = esc($etudiant['inscription_promotion_uid']);
                                                    }
                                                    $count = 1;
                                                    if (isset($promotions) && !empty($promotions)):
                                                        foreach ($promotions as $key => $value):?>
                                                                
                                                            <option value="<?= esc($value['promotion_uid']); ?>" 
                                                            <?= ($promotionActuelle == esc($value['promotion_uid']))? "selected": set_select('promotionetudiant', esc($value['promotion_uid'])); ?>>
                                                                <?= ucfirst(($value['promotion_libelle'])); ?>
                                                                - <?= ucfirst(($value['cycle_libelle'])); ?>
                                                                - <?= ucfirst(($value['option_libelle'])); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                                <?php if ($validation->hasError('promotionetudiant')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('promotionetudiant'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td><label for="phoneetudiant">Numéro Téléphone étudiant :</label>
                                        </td>
                                        <td class="text-uppercase">

                                            <div class="form-group">

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                    class="fas fa-phone"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="phoneetudiant"
                                                           id="phoneetudiant"
                                                           value="<?= isset($etudiant) ? esc($etudiant['etudiant_telephone']) : set_value('phoneetudiant') ?>">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </td>

                                        <td><label for="emailetudiant">Adresse email étudiant :</label>
                                        </td>
                                        <td class="text-uppercase">

                                            <div class="form-group">

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                    class="fas fa-envelope"></i></span>
                                                    </div>
                                                    <input type="email" class="form-control" name="emailetudiant"
                                                           id="emailetudiant"
                                                           value="<?= isset($etudiant) ? esc($etudiant['etudiant_email']) : set_value('emailetudiant') ?>">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </td>

                                        
                                    </tr>
                                    <tr>
                                        
                                        <td><label for="villeetudiant">Ville de résidence :</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <input type="text" name="villeetudiant" id="villeetudiant"
                                                       class="form-control <?= ($validation->hasError('villeetudiant')) ? ' is-invalid' : '' ?>"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_ville']) : set_value('villeetudiant'); ?>">

                                                <?php if ($validation->hasError('villeetudiant')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('villeetudiant'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </td>
                                        <td><label for="provinceetudiant"><span class="text-danger"></span>Province de
                                                résidence :</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <input type="text" name="provinceetudiant" id="provinceetudiant"
                                                       class="form-control <?= ($validation->hasError('provinceetudiant')) ? ' is-invalid' : '' ?>"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_province']) : set_value('provinceetudiant'); ?>">

                                                <?php if ($validation->hasError('provinceetudiant')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('provinceetudiant'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="adresseetudiant">Adresse résidence étudiant :</label></td>
                                        <td class="text-uppercase" colspan="4">
                                            <div class="form-group">

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="adresseetudiant"
                                                           id="adresseetudiant"
                                                           value="<?= isset($etudiant) ? esc($etudiant['etudiant_adresse']) : set_value('adresseetudiant') ?>">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td><label for="groupeSanguinetudiant">Groupe sanguin </label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <input type="text" name="groupeSanguinetudiant" id="groupeSanguinetudiant"
                                                       class="form-control <?= ($validation->hasError('groupeSanguinetudiant')) ? ' is-invalid' : '' ?>"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_groupe_sanguin']) : set_value('groupeSanguinetudiant'); ?>">

                                            </div>
                                        </td>
                                        
                                        <td><label for="ecole_provenance"><span class="text-danger"></span>
                                                Ecole de provenance</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <input type="text" name="ecole_provenance" id="ecole_provenance"
                                                       class="form-control <?= ($validation->hasError('ecole_provenance')) ? ' is-invalid' : '' ?>"
                                                       value="<?= isset($etudiant) ? esc($etudiant['inscription_provenance']) : set_value('ecole_provenance'); ?>">

                                                <?php if ($validation->hasError('ecole_provenance')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('ecole_provenance'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </td>

                                         </tr>
                                         <tr>
                                        <td><label for="observationetudiant">Observation Générale et santé</label></td>
                                        <td class="text-uppercase" colspan="4">
                                            <div class="form-group">
                                        <input type="text" name="observationetudiant" id="observationetudiant"
                                                       class="form-control"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_observation']) : set_value('observationetudiant'); ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <!--
                                    <tr>
                                        <td><label for="caracteristiquesetudiant">Profil (Intellectuel, caractères)</label>
                                        </td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                            <textarea name="caracteristiquesetudiant" id="caracteristiquesetudiant" cols="30"
                                                      rows="3"
                                                      class="form-control"
                                                      autocomplete="off"><?= (isset($etudiant) ? esc($etudiant['etudiant_caracteristiques']) : ''); ?></textarea>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td><label for="poidsetudiant">Poids étudiant en KG</label></td>

                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <input type="text" name="poidsetudiant" id="poidsetudiant"
                                                       class="form-control <?= ($validation->hasError('poidsetudiant')) ? ' is-invalid' : '' ?>"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_poids']) : set_value('poidsetudiant'); ?>">

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="tailleetudiant">Taille étudiant en CM</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <input type="text" name="tailleetudiant" id="tailleetudiant"
                                                       class="form-control <?= ($validation->hasError('tailleetudiant')) ? ' is-invalid' : '' ?>"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_taille']) : set_value('tailleetudiant'); ?>">

                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="applicationetudiant">Application étudiant</label></td>

                                        <td class="text-uppercase">
                                            <div class="form-group">
                                            <textarea name="applicationetudiant" id="applicationetudiant" cols="30" rows="3"
                                                      class="form-control"
                                                      autocomplete="off"><?= (isset($etudiant) ? esc($etudiant['etudiant_application']) : ''); ?></textarea>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td><label for="attitudeetudiant">Attitude étudiant</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                            <textarea name="attitudeetudiant" id="attitudeetudiant" cols="30" rows="3"
                                                      class="form-control"
                                                      autocomplete="off"><?= (isset($etudiant) ? esc($etudiant['etudiant_attitude']) : ''); ?></textarea>
                                            </div>
                                        </td>
                                    </tr>-->
                                    <tr>
                                        <td><label for="photo_etudiant">Photo étudiant:</label></td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                      <i class="fas fa-image"></i>
                                                    </span>
                                                </div>
                                                    <input type="file" name="photo_etudiant" class="form-control"
                                                           id="photo_etudiant"
                                                           value="<?= set_value('photo_etudiant') ?>"/>
                                            </div>
                                            <?php if(isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'photo_etudiant'); ?>
                                            </span>
                                            <?php endif;?>

                                        </td>

                                        <td><label for="fiche_etudiant">Fiche renseignement étudiant en PDF:</label></td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                      <i class="fas fa-download"></i>
                                                    </span>
                                                </div>
                                                    <input type="file" name="fiche_etudiant" class="form-control"
                                                           id="fiche_etudiant"
                                                           value="<?= set_value('fiche_etudiant') ?>"/>
                                            </div>
                                            <?php if(isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'fiche_etudiant'); ?>
                                            </span>
                                            <?php endif;?>

                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-sm">
                                <i class="fa fa-chech-circle fa-lg"></i> <strong>Enregistrer les modifications</strong>
                            </button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <?= form_close(); ?>
                    <!-- /.col (right) -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>
