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
                            <h5 class="font-weight-bold text-uppercase">Détails TYPE Frais
                                : <?= (isset($typesfrais)) ? esc($typesfrais['typesfrai_libelle']) : 'Aucun libelle'; ?></h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Types Frais</li>
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
                    //form validation manager
                    $validation = \Config\Services::validation();
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url() . '/finance/saveTypesfrais/update/' . (isset($typesfrais) ? esc($typesfrais['typesfrai_uid']) : ''), $attributes);
                    ?>
                    <!-- /.card-header -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('finance/view/typesfrais'); ?>"
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
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th width="20%"></th>
                                        <th width="80%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><label for="code_type_frais" class="control-label">
                                                <span class="text-danger">*</span> Code type frais

                                            </label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control  text-capitalize"
                                                       name="code_type_frais"
                                                       id="code_type_frais"
                                                       value="<?= (isset($typesfrais)) ? esc($typesfrais['typesfrai_code']) : set_value('code_type_frais') ?>"
                                                       style="border-radius: 10px!important;"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="libelle_type_frais" class="control-label">
                                                <span class="text-danger">*</span> Libellé type frais
                                            </label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                            <input type="text" 
                                                       class="form-control"
                                                       name="libelle_type_frais"
                                                       id="libelle_type_frais"
                                                       value="<?= (isset($typesfrais)) ? (esc($typesfrais['typesfrai_libelle'])) : set_value('libelle_type_frais') ?>"
                                                       style="border-radius: 10px!important;"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="montant_type_frais" class="control-label">
                                                <span class="text-danger">*</span> Montant à payer en
                                                <?= (isset($typesfrais)) ? (esc($typesfrais['typesfrai_devise'])) : '' ?>
                                            </label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                                <input type="number" min="0" step="0.00"
                                                       class="form-control text-capitalize"
                                                       name="montant_type_frais"
                                                       id="montant_type_frais"
                                                       value="<?= (isset($typesfrais)) ? (esc($typesfrais['typesfrai_montant'])) : set_value('montant_type_frais') ?>"
                                                       style="border-radius: 10px!important;"/>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="devise_type_frais" class="span3"><span
                                                        class="text-danger">*</span>Devise Monnaie </label></td>
                                        <td class="text-uppercase">

                                            <div class="form-group">
                                                <select name="devise_type_frais" id="devise_type_frais"
                                                        class="form-control select2 select2-info"
                                                        data-dropdown-css-class="select2-info">
                                                    <option disabled>-- Choisissez une devise --</option>
                                                    <option <?= ($typesfrais['typesfrai_devise'] == 'USD') ? 'selected' : ''; ?> value="USD">
                                                        Dollars (USD)
                                                    </option>
                                                    <option <?= ($typesfrais['typesfrai_devise'] == 'CDF') ? 'selected' : ''; ?> value="CDF">
                                                        Francs Congolais(CDF)
                                                    </option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="cycle_type_frais" class="span3"><span
                                                        class="text-danger">*</span>Cycle des promotions</label>
                                        </td>
                                        <td class="text-uppercase">

                                            <div class="form-group">

                                                <select name="cycle_type_frais" id="cycle_type_frais"
                                                        class="form-control select2 select2-info"
                                                        data-dropdown-css-class="select2-info">
                                                    <option disabled>-- Choisissez un cycle --</option>
                                                    <?php
                                                    $cycleOld = (isset($typesfrais)) ? esc($typesfrais['typesfrai_cycle_uid']) : '';
                                                    if (isset($cycles)):
                                                        foreach ($cycles as $cycle) :
                                                            if ($cycleOld == esc($cycle['cycle_uid'])) { ?>
                                                                <option selected value="<?= $cycleOld; ?>" <?= set_select('cycle_type_frais', $cycleOld); ?>
                                                                        data-toggle="tooltip" data-placement="right"
                                                                        title="tooltip">
                                                                    <?= $cycle['cycle_libelle'] ?>
                                                                </option>

                                                            <?php } ?>
                                                            <option value="<?= $cycle['cycle_uid']; ?>" <?= set_select('cycle_type_frais', $cycle['cycle_uid']); ?>
                                                                    data-toggle="tooltip" data-placement="right"
                                                                    title="tooltip">
                                                                <?= $cycle['cycle_libelle'] ?>
                                                                - <?= $cycle['cycle_code'] ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="nature_type_frais" class="span3">Catégorie frais </label>
                                        </td>
                                        <td class="text-uppercase">

                                            <?php $nature = (isset($typesfrais)) ? esc($typesfrais['typesfrai_nature']) : 'Aucun'; ?>

                                            <div class="form-group">

                                                <select id="nature_type_frais" name="nature_type_frais"
                                                        class="form-control select2 select2-info"
                                                        data-dropdown-css-class="select2-info">
                                                    <option disabled>-- Selectionnez --
                                                    </option>
                                                    <option value="minerval" <?= ($nature == 'minerval') ? 'selected' : ''; ?> >
                                                        Minerval
                                                    </option>
                                                    <option value="general" <?= ($nature == 'general') ? 'selected' : ''; ?>>
                                                        Frais généraux
                                                    </option>
                                                    <option value="divers" <?= ($nature == 'divers') ? 'selected' : ''; ?>>
                                                        Divers
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group" id="inputnewitemshow" style="display: none;">
                                                <label for="nouvelle_nature_type_frais"> Nouvelle fréquence
                                                    paiement</label>
                                                <input type="text" class="form-control text-capitalize"
                                                       name="nouvelle_nature_type_frais"
                                                       id="nouvelle_nature_type_frais"
                                                       value="<?= set_value('nouvelle_nature_type_frais') ?>"
                                                       style="border-radius: 10px!important;"/>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td><label for="datedebut_typesfrais" class="span3">Date début paiement </label>
                                        </td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <div class="input-group date" id="date_debut_annee"
                                                     data-target-input="nearest">
                                                    <input type="text"
                                                           class="form-control datetimepicker-input <?= ($validation->hasError('datedebut_typesfrais')) ? ' is-invalid' : '' ?>"
                                                           id="datedebut_typesfrais"
                                                           value="<?= isset($typesfrais) ? esc($typesfrais['typesfrai_date_debut']) : set_value('datedebut_typesfrais') ?>"
                                                           data-target="#date_debut_annee" name="datedebut_typesfrais"/>
                                                    <div class="input-group-append" data-target="#date_debut_annee"
                                                         data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if ($validation->hasError('datedebut_typesfrais')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('datedebut_typesfrais'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="datefin_typesfrais" class="span3">Date fin paiement </label>
                                        </td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <div class="input-group date" id="date_fin_annee"
                                                     data-target-input="nearest">
                                                    <input type="text"
                                                           class="form-control datetimepicker-input <?= ($validation->hasError('datefin_typesfrais')) ? ' is-invalid' : '' ?>"
                                                           id="datefin_typesfrais"
                                                           value="<?= isset($typesfrais) ? esc($typesfrais['typesfrai_date_fin']) : set_value('datefin_typesfrais') ?>"
                                                           data-target="#date_fin_annee" name="datefin_typesfrais"/>
                                                    <div class="input-group-append" data-target="#date_fin_annee"
                                                         data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if ($validation->hasError('datefin_typesfrais')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('datefin_typesfrais'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="commentaire_frais">Observation ou commentaire:</label></td>
                                        <td class="text-uppercase">
                        
                                            <textarea name="commentaire_frais" id="commentaire_frais" cols="30" rows="3"
                                                      class="form-control"
                                                      autocomplete="off"><?= (isset($typesfrais) ? esc($typesfrais['typesfrai_comments']) : set_value('commentaire_frais')); ?></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer float-right">
                            <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-sm">
                                <i class="fa fa-check-circle"></i> Enregistrer les modifications
                            </button>
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>
