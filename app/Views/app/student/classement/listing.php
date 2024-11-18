<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Basculement Affectation des étudiants</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">promotionment</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>

    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9 col-sm-9">
                            <div class="tab-content" id="vert-tabs-right-tabContent">
                                <div class="tab-pane fade show active" id="vert-tabs-right-home" role="tabpanel"
                                     aria-labelledby="vert-tabs-right-home-tab">
                                    <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <form role="form" method="get">
                                                    <div class="input-group input-group" style="width: 100%!important;">
                                                        <select id="filtrepromotionetudiants" name="promotion"
                                                                class="form-control select2 select2-info"
                                                                data-dropdown-css-class="select2-info">

                                                            <?php
                                                            if (isset($promotion) && !empty($promotion)): ?>
                                                                <option selected
                                                                        value="<?= esc($promotion['promotion_uid']); ?>" <?= set_select('promotion', esc($promotion['promotion_uid'])); ?>>
                                                                    <?= ucfirst(($promotion['promotion_libelle'])); ?>
                                                                     <?= ucfirst(($promotion['cycle_libelle'])); ?>
                                                                     <?= ucfirst(($promotion['option_libelle'])); ?>
                                                                </option>
                                                            <?php else: ?>
                                                                <option disabled selected>-- Sélectionnez une promotion --
                                                                </option>
                                                            <?php endif; ?>
                                                            <?php
                                                            $count = 1;
                                                            if (isset($promotions) && !empty($promotions)):
                                                                foreach ($promotions as $key => $value):
                                                                    if ($value['annee_affectation'] != session()->get('yearuid')):
                                                                        ?>
                                                                        <option value="<?= esc($value['promotion_uid']); ?>" <?= set_select('promotion', esc($value['promotion_uid'])); ?>>
                                                                            <?= ucfirst(($value['promotion_libelle'])); ?>
                                                                            <?= ucfirst(($value['cycle_libelle'])); ?>
                                                                            <?= ucfirst(($value['option_libelle'])); ?>
                                                                        </option>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-info text-uppercase">
                                                                <i class="fa fa-filter"></i> filtrer
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    <div class="card card-light">
                                        
                                        <?php
                                        //form validation services call
                                        $validation = \Config\Services::validation();
                                        //form
                                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                        echo form_open(base_url() . '/etudiant/affectationetudiantspromotion', $attributes);
                                        ?>

                                         <?php if (isset($etudiants_promotions) && !empty($etudiants_promotions)): ?>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                   
                                                        <div class="text-sm">
                                                            <div class="table-responsive">
                                                                <table id="datatablesWithoutActions"
                                                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                                                    <thead>
                                                                    <tr class="text-uppercase">
                                                                        <th>#</th>
                                                                        <th></th>
                                                                        <th>Elève</th>
                                                                        <th>Ancienne promotion</th>
                                                                        
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php
                                                                    $count = 1;
                                                                    foreach ($etudiants_promotions as $key => $value):
                                                                        if($value['annee_affectation']!= session()->get('yearuid')):?>
                                                                        <tr>
                                                                            <td><?= $count++; ?></td>
                                                                            <td>
                                                                                <input type="checkbox"
                                                                                       name="etudiantIdentifiant[]" checked
                                                                                       value="<?= esc($value['etudiant_uid']); ?>">

                                                                            </td>
                                                                            <td class="text-uppercase"><?= esc($value['etudiant_nom']); ?>
                                                                                - <?= esc($value['etudiant_postnom']); ?>
                                                                                - <?= esc($value['etudiant_prenom']); ?>
                                                                                - <?= esc($value['etudiant_matricule']); ?>
                                                                            </td>
                                                                            <td class="text-uppercase">
                                                                                <input type="text"
                                                                                       name="promotion_uid_ancienne"
                                                                                       value="<?= esc($value['promotion_libelle']); ?>">
                                                                            </td>
                                                                        </tr>

                                                                    <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                   
                                                    <hr>

                                                </div>
                                                <div class="col-sm-12">
                                                    <?php if (isset($promotion) && !empty($promotion)): ?>
                                                        <input type="hidden"
                                                               name="promotion_ancienne"
                                                               value="<?= esc($promotion['promotion_uid']); ?>">
                                                    <?php endif; ?>

                                                    <div class="form-group">
                                                        <label for="promotion_uid_nouvelle"><span
                                                                    class="text-danger">*</span>Nouvelle promotion</label>
                                                        <select class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('promotion_uid_nouvelle')) ? ' is-invalid' : '' ?>"
                                                                id="promotion_uid_nouvelle"
                                                                name="promotion_uid_nouvelle"
                                                                data-dropdown-css-class="select2-info"
                                                                style="width: 100%;">
                                                            <option selected="selected" disabled>-- Sélectionnez une
                                                                promotion --
                                                            </option>
                                                            <?php
                                                            $count = 1;
                                                            if (isset($promotions) && !empty($promotions)):
                                                                foreach ($promotions as $key => $value): ?>
                                                                    <option value="<?= esc($value['promotion_uid']); ?>" <?= set_select('promotion_uid_nouvelle', esc($value['promotion_uid'])); ?>>
                                                                        <?= ucfirst(($value['promotion_libelle'])); ?>
                                                                        - <?= ucfirst(($value['cycle_libelle'])); ?>
                                                                        - <?= ucfirst(($value['option_libelle'])); ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select>
                                                        <?php if ($validation->hasError('promotion_uid_nouvelle')) { ?>
                                                            <span class="invalid-feedback"> <?= $validation->getError('promotion_uid_nouvelle'); ?></span>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <label for="commentaire_affectation">Observation ou
                                                        commentaire sur l'affectation</label>
                                                    <div class="form-group">
                                                            <textarea name="commentaire_affectation"
                                                                      id="commentaire_affectation"
                                                                      cols="30" rows="3"
                                                                      class="form-control"><?= set_value('commentaire_affectation') ?> </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit"
                                                    class="btn btn-info btn-sm  text-uppercase">
                                                <i class="fa fa-check-circle"></i>
                                                Enregistrer l'affectation
                                            </button>
                                        </div>
                                         <?php else: ?>

                                            <?php $request = \Config\Services::request(); 
                                            if ($request->getGet('promotion')): ?>
                                                <div class="text-uppercase small text-center alert alert-secondary">
                                                    <span>
                                                        <strong>
                                                            Aucune donnée trouvée. Il est possible que le bascullement de cette année soit déjà effectué
                                                        </strong>
                                                    </span>
                                                </div>
                                            <?php endif; ?>
                                         <?php endif; ?>
                                        <?= form_close(); ?>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="vert-tabs-right-globale" role="tabpanel"
                                     aria-labelledby="vert-tabs-right-profile-tab">
                                    <!-- /.card-header -->
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="text-uppercase small text-center">
                                                    <strong>
                                                        Basculement global des étudiants
                                                    </strong>
                                                </h3>
                                            </div>
                                        </div>
                                        <?php
                                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                        echo form_open(base_url() . '/etudiant/saveBascullementGlobal', $attributes);
                                        ?>
                                        <div class="card-body">

                                            <div class="table-responsive-sm">
                                                <table id="datatablesExampleAffectation"
                                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                                    <thead>
                                                    <tr class="text-uppercase">
                                                        <th width="1px">#</th>
                                                        <th>Ancienne promotion </th>
                                                        <th>Nouvelle promotion</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php
                                                    if (isset($promotions) && !empty($promotions)):
                                                        $count = 1;
                                                        $countpromotions = count($promotions);
                                                        //for ($i = 1; $i <= $countpromotions; $i++):
                                                        foreach ($promotions as $key => $value): ?>
                                                            <tr>
                                                                <td width="1px"><?= $count++; ?></td>
                                                                <td width="2px" class="text-center">
                                                                    <div class="form-group">
                                                                        <label for="promotion_uid_ancienne_global<?= $count; ?>"></label>
                                                                        <select class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('promotion_uid_ancienne_global')) ? ' is-invalid' : '' ?>"
                                                                                id="promotion_uid_ancienne_global<?= $count; ?>"
                                                                                name="promotion_uid_ancienne_global[]"
                                                                                data-dropdown-css-class="select2-info"
                                                                                style="width: 100%;">
                                                                            <option selected
                                                                                    value="<?= esc($value['promotion_uid']); ?>" <?= set_select('promotion_uid_ancienne_global', esc($value['promotion_uid'])); ?>>
                                                                                <?= ucfirst(($value['promotion_libelle'])); ?>
                                                                                - <?= ucfirst(($value['cycle_libelle'])); ?>
                                                                                - <?= ucfirst(($value['option_libelle'])); ?>
                                                                            </option>
                                                                        </select>
                                                                        <?php if ($validation->hasError('promotion_uid_ancienne_global')) { ?>
                                                                            <span class="invalid-feedback"> <?= $validation->getError('promotion_uid_ancienne_global'); ?></span>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>

                                                                <td width="2px" class="text-center">
                                                                    <div class="form-group">
                                                                        <label for="promotion_uid_nouvelle_global<?= $count; ?>"></label>
                                                                        <select class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('promotion_uid_nouvelle_global')) ? ' is-invalid' : '' ?>"
                                                                                id="promotion_uid_nouvelle_global<?= $count; ?>"
                                                                                name="promotion_uid_nouvelle_global[]"
                                                                                data-dropdown-css-class="select2-info"
                                                                                style="width: 100%;">
                                                                            <option selected="selected" disabled>--
                                                                                Selectionnez une
                                                                                promotion --
                                                                            </option>
                                                                            <?php

                                                                            foreach ($promotions as $key2 => $value2): ?>
                                                                                <option value="<?= esc($value2['promotion_uid']); ?>" <?= set_select('promotion_uid_nouvelle_global', esc($value2['promotion_uid'])); ?>>
                                                                                    <?= ucfirst(($value2['promotion_libelle'])); ?>
                                                                                    - <?= ucfirst(($value2['cycle_libelle'])); ?>
                                                                                    - <?= ucfirst(($value2['option_libelle'])); ?>
                                                                                </option>
                                                                            <?php endforeach; ?>

                                                                        </select>
                                                                        <?php if ($validation->hasError('promotion_uid_nouvelle_global')) { ?>
                                                                            <span class="invalid-feedback"> <?= $validation->getError('promotion_uid_nouvelle_global'); ?></span>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="card-footer">
                                            <button type="submit"
                                                    class="btn btn-info btn-sm text-uppercase">
                                                <i class="fa fa-check-circle"></i>
                                                Enregistrer le bascullement global
                                            </button>
                                        </div>
                                        <?= form_close(); ?>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                        <div class="col-3 col-sm-3">
                            <div class="nav flex-column nav-tabs nav-tabs-right h-100" id="vert-tabs-right-tab"
                                 role="tablist" aria-orientation="vertical">
                                <a class="btn btn-xs btn-outline-info nav-link active" id="vert-tabs-right-home-tab"
                                   data-toggle="pill"
                                   href="#vert-tabs-right-home" role="tab" aria-controls="vert-tabs-right-home"
                                   aria-selected="true"><span class="text-uppercase">Basculement par promotion</span></a>
                                <!-- 
                                <a class="btn btn-xs btn-outline-info nav-link" id="vert-tabs-right-globale-tab"
                                   data-toggle="pill"
                                   href="#vert-tabs-right-globale" role="tab" aria-controls="vert-tabs-right-globale"
                                   aria-selected="false"><span class="text-uppercase">Basculement globale</span></a>
                            -->
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h1 class="text-uppercase small">Dernières affectations
                                    effectuées</h1>
                            </div>
                            <div class="card-tools float-right">

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase small">
                                        <th>#</th>
                                        <th>Matricule</th>
                                        <th>Nom Elève</th>
                                        <th>Sexe</th>
                                        <th>promotion</th>
                                        <th>Edition</th>
                                        <th>Détails</th>
                                    </tr>
                                    </thead>
                                   <tbody class="small">
                                    <?php
                                    $count = 1;
                                    if (isset($etudiants) && !empty($etudiants)):
                                        foreach ($etudiants as $key => $value):
                                            $status = (!empty(esc($value['etudiant_statut'])) ? esc($value['etudiant_statut']) : 'inactif');
                                            ?>
                                            <tr class="small">
                                                <td><?= $count++; ?></td>

                                                <td class="text-uppercase"><?= esc($value['etudiant_matricule']); ?></td>
                                                <td class="text-uppercase"><?= esc($value['etudiant_nom']); ?>
                                                    - <?= esc($value['etudiant_postnom']); ?>
                                                    - <?= esc($value['etudiant_prenom']); ?></td>
                                                <td class="text-uppercase"><?= esc($value['etudiant_sexe']); ?></td>
                                                <td class="text-uppercase"><?= esc($value['promotion_libelle']); ?></td>
                                                <td width="2px" class="text-center">
                                                    <a href="<?= base_url('etudiant/editForm/inscription/' . esc($value['etudiant_uid'])); ?>"
                                                       class="btn btn-xs btn-outline-warning" data-toggle="tooltip"
                                                       data-placement="bottom"
                                                       title="Cliquer pour modifier cette information">
                                                        <i class="fa fa-edit fa-2x"></i>
                                                    </a>
                                                </td>
                                                <td width="2px" class="text-center">
                                                    <a href="<?= base_url('etudiant/details/inscription/' . esc($value['etudiant_uid']) . '/' . esc($value['inscription_promotion_uid'])); ?>"
                                                       class="btn btn-xs btn-outline-info" data-toggle="tooltip"
                                                       data-placement="bottom"
                                                       title="Cliquer pour voir les details">
                                                        <i class="fa fa-info-circle fa-2x"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr class="alert alert-warning small">
                                            <td colspan="9" class="text-uppercase">
                                                <strong>Aucun étudiant n'a été affecté</strong>
                                            </td>
                                        </tr>
                                    <?php endif; ?>

                                    </tbody>
                                    <tfoot>
                                    <tr class="alert alert-secondary">
                                        <td colspan="9" class="text-uppercase">
                                            <strong>Année Scolaire
                                                <span class="float-right">
                                            <?= session()->get('yearlibelle'); ?>
                                            </span></strong>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
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