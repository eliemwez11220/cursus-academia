<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Inscription des étudiants</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard'); ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Inscription</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>

    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php
                    //matricule generated
                    $aleatoire_value = "0123456789";
                    $new_matricule_student_generate = "CSR" . date('y') . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(3, 20))), 0, 3);

                    //form validation services call
                    $validation = \Config\Services::validation();

                    //form
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url('student/saveIncription/create'), $attributes);
                    ?>
                    <div class="card card-light">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="card-tools float-left">
                                    <a href="<?= base_url('student/dossier/inscription'); ?>"
                                       class="btn btn-default btn-sm btn-rounded text-uppercase">
                                        <i class="fa fa-arrow-circle-left"></i> voir la liste
                                    </a>
                                </div>
                            </div>
                            <div class="card-tools float-right">
                                <button type="submit" class="btn btn-info btn-sm btn-rounded text-uppercase">
                                    <i class="fa fa-check-circle fa-lg"></i> Incrire étudiant
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- left column -->
                                <div class="col-sm-4">
                                    <!-- Matricule etudiant (!empty($new_matricule_student_generate)) ? $new_matricule_student_generate : -->
                                    <div class="form-group">
                                        <label for="matriculeetudiant"><span class="text-danger">*</span> Matricule
                                            </label>
                                        <input type="text" name="matriculeetudiant" id="matriculeetudiant"
                                               class="form-control <?= ($validation->hasError('matriculeetudiant')) ? ' is-invalid' : '' ?>"
                                               placeholder="Matricule" autocomplete="off"
                                               value="<?= (set_value('matriculeetudiant')) ? set_value('matriculeetudiant') : $new_matricule_student_generate ?>">
                                        <?php if ($validation->hasError('matriculeetudiant')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('matriculeetudiant'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div><!-- left column -->
                                <div class="col-sm-4">
                                    <!-- Nom etudiant -->
                                    <div class="form-group">
                                        <label for="nom_etudiant"><span class="text-danger">*</span>Nom </label>
                                        <input type="text" name="nometudiant" id="nom_etudiant" autocomplete="off"
                                               class="form-control <?= ($validation->hasError('nometudiant')) ? ' is-invalid' : '' ?>"
                                               placeholder="Nom " value="<?= set_value('nometudiant'); ?>" autofocus>

                                        <?php if ($validation->hasError('nometudiant')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('nometudiant'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <!-- PostNom etudiant -->
                                    <div class="form-group">
                                        <label for="postnometudiant"><span class="text-danger"></span>Postnom
                                            </label>

                                        <input type="text" name="postnometudiant" id="postnometudiant" autocomplete="off"
                                               class="form-control <?= ($validation->hasError('postnometudiant')) ? ' is-invalid' : '' ?>"
                                               placeholder="Post-nom" value="<?= set_value('postnometudiant'); ?>">

                                        <?php if ($validation->hasError('postnometudiant')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('postnometudiant'); ?></span>
                                        <?php } ?>

                                    </div> <!-- prenom etudiant -->
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="prenom_etudiant"><span class="text-danger"></span>Prénom
                                            </label>
                                        <input type="text" name="prenometudiant" id="prenom_etudiant" autocomplete="off"
                                               class="form-control <?= ($validation->hasError('prenometudiant')) ? ' is-invalid' : '' ?>"
                                               placeholder="Prénom" value="<?= set_value('prenometudiant'); ?>">
                                        <?php if ($validation->hasError('prenometudiant')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('prenometudiant'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <!-- radio -->
                                    <div class="form-group">
                                        <label form="sexeetudiant"><span class="text-danger">*</span>Sexe : </label>

                                        <select id="sexeetudiant" name="sexeetudiant" title="sexe"
                                                class="form-control text-capitalize <?= ($validation->hasError('sexeetudiant')) ? ' is-invalid' : '' ?>"
                                                style="width: 100%;">
                                            <option selected="selected" disabled>-- Sélectionnez le sexe --
                                            </option>
                                            <option value="masculin" <?= set_select('sexeetudiant', 'masculin'); ?>>
                                                Masculin
                                            </option>
                                            <option value="feminin" <?= set_select('sexeetudiant', 'feminin'); ?>> Feminin
                                            </option>
                                        </select>
                                        <?php if ($validation->hasError('sexeetudiant')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('sexeetudiant'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="categorieetudiant"><span class="text-danger">*</span>Catégorie
                                            </label>
                                        <select id="categorieetudiant" name="categorieetudiant"
                                                class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('categorieetudiant')) ? ' is-invalid' : '' ?>"
                                                data-dropdown-css-class="select2-info" style="width: 100%;">
                                            <option selected="selected" disabled>-- Sélectionnez une catégorie --
                                            </option>
                                            <?php
                                            $count = 1;
                                            if (isset($typesetudiants) && !empty($typesetudiants)):
                                                foreach ($typesetudiants as $key => $value): ?>
                                                    <option value="<?= esc($value['typesetudiant_uid']); ?>" <?= set_select('categorieetudiant', esc($value['typesetudiant_uid'])); ?>>
                                                        <?= ucfirst(($value['typesetudiant_libelle'])); ?>

                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('categorieetudiant')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('categorieetudiant'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="promotionetudiant"><span class="text-danger">*</span>
                                    Promotion choisie </label>
                                        <select class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('promotionetudiant')) ? ' is-invalid' : '' ?>"
                                                id="promotionetudiant"
                                                name="promotionetudiant"
                                                data-dropdown-css-class="select2-info" style="width: 100%;">
                                            <option selected="selected" disabled>-- Sélectionnez une promotion --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($promotions) && !empty($promotions)):
                                                foreach ($promotions as $key => $value): ?>
                                                    <option value="<?= esc($value['promotion_uid']); ?>" <?= set_select('promotionetudiant', esc($value['promotion_uid'])); ?>>
                                                        <?= ucfirst(($value['promotion_libelle'])); ?>
                                                        - <?= ucfirst(($value['cycle_libelle'])); ?> <?= ucfirst(($value['option_libelle'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('promotionetudiant')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('promotionetudiant'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="lieuNaissanceetudiant"><span class="text-danger"></span>Lieu Naissance
                                            </label>
                                        <input type="text" name="lieuNaissanceetudiant" id="lieuNaissanceetudiant"
                                               autocomplete="off"
                                               class="form-control <?= ($validation->hasError('lieuNaissanceetudiant')) ? ' is-invalid' : '' ?>"
                                               value="<?= set_value('lieuNaissanceetudiant'); ?>">
                                        <?php if ($validation->hasError('lieuNaissanceetudiant')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('lieuNaissanceetudiant'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="dateNaissanceetudiant"><span class="text-danger"></span>Date
                                            naissance:</label>
                                        <div class="input-group date" id="date_format_abrege"
                                             data-target-input="nearest">
                                            <input type="date"
                                                   class="form-control datetimepicker-input <?= ($validation->hasError('dateNaissanceetudiant')) ? ' is-invalid' : '' ?>"
                                                   id="dateNaissanceetudiant"
                                                   value="<?= set_value('dateNaissanceetudiant') ?>"
                                                   name="dateNaissanceetudiant"/>
                                        </div>
                                        <?php if ($validation->hasError('dateNaissanceetudiant')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('dateNaissanceetudiant'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success btn-rounded text-uppercase">
                                <i class="fas fa-check-circle fa-lg"></i> Inscrire étudiant
                            </button>
                            <a href="<?= base_url('etudiant/addForm/inscription'); ?>"
                               class="btn btn-danger btn-rounded text-uppercase">
                                <i class="fas fa-window-close fa-lg"></i> Annuler
                            </a>
                        </div>
                    </div>
                    <?= form_close(); ?>
                    <!-- /.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.container-fluid -->
    </filiere>
</div><!-- /.container-fluid -->

