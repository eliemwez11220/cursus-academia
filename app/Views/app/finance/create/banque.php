<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Finance - Nouveau compte bancaire</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Comptes bancaires</li>
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
                    //form validation manager
                    $validation = \Config\Services::validation();
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url() . '/finance/saveCompteBancaire/create', $attributes);
                    ?>
                    <!-- /.card-header -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('finance/view/banques'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> Voir la liste
                                </a>
                            </div>
                            <div class="card-tools float-right">
                                <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-check-circle"></i> Enregistrer la caisse
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="numero_compte" class="control-label">
                                            <span class="text-danger">*</span> Numéro Compte Bancaire
                                        </label>
                                        <input type="text"
                                               class="form-control <?= ($validation->hasError('numero_compte')) ? ' is-invalid' : '' ?>"
                                               name="numero_compte"
                                               id="numero_compte"
                                               value="<?= set_value('numero_compte') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if ($validation->hasError('numero_compte')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('numero_compte'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>


                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="type_compte" class="span3"><span class="text-danger">*</span>Type de
                                            compte </label>
                                        <select name="type_compte" id="type_compte"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                            <option disabled selected>-- Choisissez un type --</option>
                                            <option value="USD"> Dollars Americains(USD)</option>
                                            <option value="CDF"> Francs Congolais(CDF)</option>
                                            <option value="NEW"> Autres </option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="nom_banque" class="control-label">
                                            <span class="text-danger">*</span> Nom Banque
                                        </label>
                                        <input type="text"
                                               class="form-control text-capitalize"
                                               name="nom_banque"
                                               id="nom_banque"
                                               value="<?= set_value('nom_banque') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if ($validation->hasError('nom_banque')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('nom_banque'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="montant_compte" class="control-label">
                                            <span class="text-danger">*</span> Montant de départ
                                        </label>
                                        <input type="text"
                                               class="form-control text-capitalize"
                                               name="montant_compte"
                                               id="montant_compte"
                                               value="<?= set_value('montant_compte') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if ($validation->hasError('montant_compte')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('montant_compte'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <label for="commentaire_compte">Observation ou commentaire sur le compte</label>
                                    <input type="text" class="form-control text-capitalize"
                                           name="commentaire_compte"
                                           id="commentaire_compte"
                                           value="<?= set_value('commentaire_compte') ?>"
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
