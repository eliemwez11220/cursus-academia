<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Finance - Nouvelle caisse</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Caisses</li>
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
                    $new_code_generate = "CCF" . date('y') . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(5, 20))), 0, 5);

                    //form validation manager
                    $validation = \Config\Services::validation();
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url() . '/finance/saveCaisse/create', $attributes);
                    ?>
                    <!-- /.card-header -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('finance/view/caisses'); ?>"
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
                                        <label for="code_caisse" class="control-label">
                                            <span class="text-danger">*</span> Code caisse
                                            <span class="small">(Ce code a été généré automatiquement.Vous pouvez le modifier)</span>
                                        </label>
                                        <input type="text"
                                               class="form-control <?= ($validation->hasError('code_caisse')) ? ' is-invalid' : '' ?>"
                                               name="code_caisse"
                                               id="code_caisse"
                                               value="<?= (!empty($new_code_generate)) ? $new_code_generate : set_value('code_caisse') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if ($validation->hasError('code_caisse')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('code_caisse'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                

                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="type_caisse" class="span3"><span class="text-danger">*</span>Type de caisse </label>
                                        <select name="type_caisse" id="type_caisse"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                            <option disabled selected>-- Choisissez un type --</option>
                                            <option value="mixte"> Mixte(entrees & sorties)</option>
                                            <option value="entree"> Entrées seulement</option>
                                            <option value="sortie"> Sorties seulement</option>
                                            <option value="principal"> Principal</option>
                                        </select>
                                    </div>
                                </div>
                              

                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="libelle_caisse" class="control-label">
                                            <span class="text-danger">*</span> Libellé Caisse
                                        </label>
                                        <input type="text"
                                               class="form-control text-capitalize"
                                               name="libelle_caisse"
                                               id="libelle_caisse"
                                               value="<?= set_value('libelle_caisse') ?>"
                                               style="border-radius: 10px!important;" />
                                         <?php if ($validation->hasError('libelle_caisse')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('libelle_caisse'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                           
                                <div class="col-lg-12 col-sm-12 col-xs-12" >
                                        <label for="localisation_caisse">Localisation ou adresse caisse</label>
                                        <input type="text" class="form-control text-capitalize"
                                               name="localisation_caisse"
                                               id="localisation_caisse"
                                               value="<?= set_value('localisation_caisse') ?>"
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
