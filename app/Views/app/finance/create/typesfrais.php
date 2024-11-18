<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Finance - Nouveau Type Frais</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Type Frais</li>
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
                <!-- left column -->
                <div class="col-md-12">
                    <?php
                    //new code generated automatically
                    $aleatoire_value = "0123456789";
                    $new_code_generate = date('y') . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(5, 20))), 0, 5);

                    //form validation manager
                    $validation = \Config\Services::validation();
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url('finance/saveTypesfrais/create'), $attributes);
                    ?>
                    <!-- /.card-header -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('finance/view/typesfrais'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> Voir la liste
                                </a>
                            </div>
                            <div class="card-tools float-right">
                                <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-check-circle"></i> Enregistrer le type frais
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="code_type_frais" class="control-label">
                                            <span class="text-danger">*</span> Code Type Frais
                                            <span class="small">(Généré automatiquement.Vous pouvez le modifier)</span>
                                        </label>
                                        <input type="text"
                                               class="form-control bg-light text-capitalize"
                                               name="code_type_frais"
                                               id="code_type_frais"
                                               value="<?= (!empty($new_code_generate)) ? $new_code_generate : set_value('code_type_frais') ?>"
                                               style="border-radius: 10px!important;"/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="nature_type_frais"><span class="text-danger">*</span>Catégorie frais </label>
                                        <select id="nature_type_frais" name="nature_type_frais"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info" required>
                                            <option selected="selected" disabled>-- Sélectionnez --
                                            </option>
                                            <option value="minerval">Minerval</option>
                                            <option value="general">Frais Généraux</option>
                                            <option value="divers">Divers</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="libelle_type_frais" class="control-label">
                                            <span class="text-danger">*</span> Libellé Type Frais
                                        </label>
                                        <input type="text" 
                                               class="form-control text-capitalize"
                                               name="libelle_type_frais"
                                               id="libelle_type_frais"
                                               value="<?= set_value('libelle_type_frais') ?>"
                                               style="border-radius: 10px!important;" required/>

                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="montant_type_frais" class="control-label">
                                            <span class="text-danger">*</span> Montant à payer
                                        </label>
                                        <input type="number" min="0" step="0.00"
                                               class="form-control text-capitalize"
                                               name="montant_type_frais"
                                               id="montant_type_frais"
                                               value="<?= set_value('montant_type_frais') ?>"
                                               style="border-radius: 10px!important;" required/>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="devise_type_frais" class="span3"><span class="text-danger">*</span>Devise Monnaie </label>
                                        <select name="devise_type_frais" id="devise_type_frais"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                            <option disabled selected>-- Choisissez une devise --</option>
                                            <option value="USD" <?= set_select('devise_type_frais', 'USD'); ?>>Dollars (USD)</option>
                                            <option value="CDF" <?= set_select('devise_type_frais', 'CDF'); ?>>Francs Congolais(CDF)</option>
                                        </select>
                                    </div>
                                </div>
                                

                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="cycle_type_frais" class="span3"><span class="text-danger">*</span>Cycle des promotions concernees</label>
                                        <select name="cycle_type_frais" id="cycle_type_frais"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                            <option disabled selected>-- Choisissez un cycle --</option>
                                            <?php
                                            if (isset($cycles)):
                                                foreach ($cycles as $cycle) : ?>
                                                    <option value="<?= $cycle['cycle_uid']; ?>" <?= set_select('cycle_type_frais', $cycle['cycle_uid']); ?>
                                                            data-toggle="tooltip" data-placement="right"
                                                            title="tooltip">
                                                        <?= ucfirst($cycle['cycle_libelle']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-lg-6 col-sm-6 col-xs-6" id="inputnewitemshow" style="display: none;">
                                        <label for="nouvelle_nature_type_frais">Nouvelle fréquence paiement</label>
                                        <input type="text" class="form-control text-capitalize"
                                               name="nouvelle_nature_type_frais"
                                               id="nouvelle_nature_type_frais"
                                               value="<?= set_value('nouvelle_nature_type_frais') ?>"
                                               style="border-radius: 10px!important;"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div><!-- .content -->
    </filiere><!-- /#right-panel -->
</div><!-- /#right-panel -->
