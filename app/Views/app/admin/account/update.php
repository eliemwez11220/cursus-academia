<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Administration - Nouveau compte</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard'); ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Création compte agent</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>

    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <?php
            if (isset($agent) && !empty($agent)): ?>
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <?php
                        //form validation services call
                        $validation = \Config\Services::validation();

                        //form
                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                        echo form_open_multipart(base_url() . '/admin/saveCompteAgent/update/' . esc($agent['compte_uid']), $attributes);
                        ?>
                        <div class="card card-light">
                            <div class="card-header">
                                <div class="card-title">
                                    <div class="card-tools float-left">
                                        <a href="<?= base_url('admin/view/account'); ?>"
                                           class="btn btn-default btn-sm btn-rounded text-uppercase">
                                            <i class="fa fa-arrow-circle-left"></i> voir la liste
                                        </a>
                                    </div>
                                </div>

                                <div class="card-tools float-right">

                                    <button type="submit" class="btn btn-info btn-sm btn-rounded text-uppercase">
                                        <i class="fa fa-check-circle fa-lg"></i> Enregistrer les modifications
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- left column -->
                                    <div class="col-sm-4">
                                        <!-- Matricule etudiant -->
                                        <div class="form-group">
                                            <label for="matricule"><span class="text-danger">*</span> Matricule
                                                agent (en lecture)</label>
                                            <input type="text" name="matricule" id="matricule"
                                                   class="form-control <?= ($validation->hasError('matricule')) ? ' is-invalid' : '' ?>"
                                                   placeholder="Matricule Agent" readonly
                                                   value="<?= (!empty(esc($agent['agent_matricule']))) ? esc($agent['agent_matricule']) : set_value('matricule') ?>">
                                        </div>
                                    </div><!-- left column -->
                                    <div class="col-sm-4">
                                        <?php $fullname = esc($agent['agent_nom']) . '-' . esc($agent['agent_postnom']) . '-' . esc($agent['agent_prenom']); ?>
                                        <!-- Nom etudiant -->
                                        <div class="form-group">
                                            <label for="nom"><span class="text-danger">*</span>Nom Complet Agent (en
                                                lecture)</label>

                                            <input type="text" name="fullname" id="fullname"
                                                   class="form-control text-capitalize <?= ($validation->hasError('fullname')) ? ' is-invalid' : '' ?>"
                                                   placeholder="Nom Agent" readonly
                                                   value="<?= !empty($fullname) ? $fullname : set_value('fullname'); ?>">
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="email"><span class="text-danger"></span>Adresse Mail :</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="email"
                                                       class="form-control <?= ($validation->hasError('email')) ? ' is-invalid' : '' ?>"
                                                       name="email" id="email"
                                                       value="<?= (!empty(esc($agent['agent_email']))) ? esc($agent['agent_email']) : set_value('email') ?>">
                                            </div>
                                            <?php if ($validation->hasError('email')) { ?>
                                                <span class="invalid-feedback"> <?= $validation->getError('email'); ?></span>
                                            <?php } ?>
                                            <!-- /.input group -->
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="username"><span class="text-danger">*</span>Identifiant ou
                                                pseudo de connexion :</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <input type="text"
                                                       class="form-control <?= ($validation->hasError('username')) ? ' is-invalid' : '' ?>"
                                                       name="username" id="username"
                                                       value="<?= (!empty(esc($agent['compte_username']))) ? esc($agent['compte_username']) : set_value('username') ?>">
                                            </div>
                                            <?php if ($validation->hasError('username')) { ?>
                                                <span class="invalid-feedback"> <?= $validation->getError('username'); ?></span>
                                            <?php } ?>
                                            <!-- /.input group -->
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="groupe" class="control-label">
                                                <span class="text-danger">*</span> Groupe
                                            </label>
                                            <select id="groupe" name="groupe"
                                                    class="form-control select2 select2-info <?php if ($validation->hasError('groupe')) {
                                                        echo 'is-invalid';
                                                    } ?>"
                                                    data-dropdown-css-class="select2-info">
                                                <option disabled>-- Sélectionnez un groupe --</option>
                                                <?php
                                                $groupe = (!empty(esc($agent['compte_groupe_uid']))) ? esc($agent['compte_groupe_uid']) : '';
                                                if (isset($groupes) && !empty($groupes)):
                                                    foreach ($groupes as $key => $value):
                                                        if ($groupe == esc($value['groupe_uid'])): ?>
                                                            <option selected="selected"
                                                                    value="<?= esc($value['groupe_uid']); ?>" <?= set_select('groupe', esc($value['groupe_uid'])); ?>>
                                                                <?= ucfirst(esc($value['groupe_libelle'])); ?>
                                                            </option>
                                                        <?php endif; ?>
                                                        <option value="<?= esc($value['groupe_uid']); ?>" <?= set_select('groupe', esc($value['groupe_uid'])); ?>>
                                                            <?= ucfirst(esc($value['groupe_libelle'])); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <option>Aucune donnée</option>
                                                <?php endif; ?>
                                            </select>
                                            <?php if (isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'groupe'); ?>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="avatar_compte" class="control-label">
                                                <span class="text-danger"></span> Photo Profil Agent
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                      <i class="fa fa-download"></i>
                                                    </span>
                                                </div>
                                                <input type="file" name="avatar_compte" class="form-control"
                                                       id="avatar_compte"
                                                       value="<?= set_value('avatar_compte') ?>"/>

                                                <input type="hidden" name="file_old_value" class="form-control"
                                                       id="file_old_value"
                                                       value="<?= (!empty(esc($agent['compte_avatar']))) ? esc($agent['compte_avatar']) :old('file_old_value') ?>"/>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="question1" class="control-label">
                                                <span class="text-danger"></span> Question secrète 1
                                            </label>
                                            <select id="question1" name="question1"
                                                    class="form-control select2 select2-info"
                                                    data-dropdown-css-class="select2-info">
                                                <option disabled>-- Sélectionnez une question --</option>

                                                <option value="nom_fille_ainee" <?= (esc($agent['compte_question1']) == 'nom_fille_ainee') ? 'selected' :''?>>Quel est le nom de votre fille ainee?
                                                </option>
                                                <option value="marque_voiture" <?= (esc($agent['compte_question1']) == 'marque_telephone') ? 'selected' :''?>>Quelle marque de voiture
                                                    preferez-vous?
                                                </option>
                                                <option value="province_origine" <?= (esc($agent['compte_question1']) == 'province_origine') ? 'selected' :''?>>Quelle est votre province d'origine?
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="reponse1" class="control-label">
                                                <span class="text-danger"></span> Réponse de la question secrète 1
                                            </label>

                                            <input type="text" name="reponse1" class="form-control"
                                                   id="reponse1"
                                                   value="<?= (!empty(esc($agent['compte_reponse1']))) ? esc($agent['compte_reponse1']) :old('reponse1') ?>"/>

                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="question2" class="control-label">
                                                <span class="text-danger"></span> Question secrète 2
                                            </label>
                                            <select id="question2" name="question2"
                                                    class="form-control select2 select2-info"
                                                    data-dropdown-css-class="select2-info">
                                                <option disabled>-- Sélectionnez une question --</option>
                                                <option value="date_engagement" <?= (esc($agent['compte_question2']) == 'date_engagement') ? 'selected' :''?>>Quelle est la date a laquelle vous etiez engagé
                                                </option>
                                                <option value="animal_domestique" <?= (esc($agent['compte_question2']) == 'animal_domestique') ? 'selected' :''?>>Quel est votre animal domestique préférez-vous?
                                                </option>
                                                <option value="oiseau" <?= (esc($agent['compte_question2']) == 'oiseau') ? 'selected' :''?>>Quel oiseau préférez-vous?
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="reponse2" class="control-label">
                                                <span class="text-danger"></span> Réponse de la question secrète 2
                                            </label>

                                            <input type="text" name="reponse2" class="form-control"
                                                   id="reponse2"
                                                   value="<?= (!empty(esc($agent['compte_reponse2']))) ? esc($agent['compte_reponse2']) :old('reponse2') ?>"/>

                                        </div>
                                    </div> <div class="col-lg-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="question3" class="control-label">
                                                <span class="text-danger"></span> Question secrète 3
                                            </label>
                                            <select id="question3" name="question3"
                                                    class="form-control select2 select2-info"
                                                    data-dropdown-css-class="select2-info">
                                                <option disabled >-- Selectionnez une question --</option>
                                                <option value="date_engagement" <?= (esc($agent['compte_question3']) == 'date_engagement') ? 'selected' :''?>>Quelle est la date a laquelle vous etiez engagé
                                                </option>
                                                <option value="animal_domestique" <?= (esc($agent['compte_question3']) == 'animal_domestique') ? 'selected' :''?>>Quel est votre animal domestique préférez-vous?
                                                </option>
                                                <option value="oiseau" <?= (esc($agent['compte_question3']) == 'oiseau') ? 'selected' :''?>>Quel oiseau préférez-vous?
                                                </option>
                                                <option value="nom_fille_ainee" <?= (esc($agent['compte_question3']) == 'nom_fille_ainee') ? 'selected' :''?>>Quel est le nom de votre fille ainée?
                                                </option>
                                                <option value="marque_voiture" <?= (esc($agent['compte_question3']) == 'marque_voiture') ? 'selected' :''?>>Quelle marque de voiture
                                                    préférez-vous?
                                                </option>
                                                <option value="province_origine" <?= (esc($agent['compte_question3']) == 'province_origine') ? 'selected' :''?>>Quelle est votre province d'origine?
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="reponse3" class="control-label">
                                                <span class="text-danger"></span> Réponse de la question secrète 3
                                            </label>

                                            <input type="text" name="reponse3" class="form-control"
                                                   id="reponse3"
                                                   value="<?= (!empty(esc($agent['compte_reponse3']))) ? esc($agent['compte_reponse3']) :old('reponse3') ?>"/>

                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="observation" class="control-label">
                                                <span class="text-danger"></span> Observation ou commentaire
                                            </label>
                                            <textarea name="observation" class="form-control" id="observation" cols="30" rows="3"><?= (!empty(esc($agent['compte_observation']))) ? esc($agent['compte_observation']) :old('observation') ?></textarea>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <?= form_close(); ?>
                        <!-- /.col (right) -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            <?php endif; ?>
        </div><!-- /.container-fluid -->
    </filiere>
</div><!-- /.container-fluid -->

