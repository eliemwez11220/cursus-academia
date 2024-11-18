<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Finance  - Prétudiantment</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Prétudiantments</li>
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
                    $new_code_generate = "MVT" . date('y') . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(5, 20))), 0, 5);

                    //form validation manager
                    $validation = \Config\Services::validation();
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url('finance/saveMouvement/create'), $attributes);
                    ?>
                    <!-- /.card-header -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('finance/view/depenses'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> Voir la liste de prétudiantments
                                </a>
                            </div>
                            <div class="card-tools float-right">
                                <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-check-circle"></i> Enregistrer
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                    <div class="d-none">
                                        <label for="code_mvt" class="control-label">
                                            <span class="text-danger">*</span> Code référence
                                            <span class="small">(Ce code a été généré automatiquement)</span>
                                        </label>
                                        </div>
                                        <input type="hidden"
                                               class="form-control <?= ($validation->hasError('code_mvt')) ? ' is-invalid' : '' ?>"
                                               name="code_mvt"
                                               id="code_mvt"
                                               value="<?= (!empty($new_code_generate)) ? $new_code_generate : set_value('code_mvt') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if ($validation->hasError('code_caisse')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('code_mvt'); ?></span>
                                        <?php } ?>
                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="libelle_mvt" class="control-label">
                                            <span class="text-danger">*</span> Libellé  prétudiantment
                                        </label>
                                        <input type="text"
                                               class="form-control"
                                               name="libelle_mvt"
                                               id="libelle_mvt"
                                               value="<?= old('libelle_mvt') ?>"
                                               style="border-radius: 10px!important;" autofocus/>
                                         <?php if ($validation->hasError('libelle_mvt')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('libelle_mvt'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="caisse_uid_mvt" class="span3"> <span class="text-danger">*</span> Caisse </label>
                                        <select name="caisse_uid_mvt" id="caisse_uid_mvt"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                            <option disabled >Choisissez une caisse</option>
                                            <?php
                                            if (isset($caisses)):
                                                foreach ($caisses as $key => $value) : ?>
                                                    <option selected value="<?= esc($value['caisse_uid']); ?>" <?= set_select('caisse_uid_mvt', esc($value['caisse_uid'])); ?>>
                                                      <?= ucfirst($value['caisse_libelle']); ?> 
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                             
                                    <div class="form-group">
                                        <input name="type_mvt" id="type_mvt"
                                                type="hidden" value="depense" />
                                        
                                        <input name="nature_mvt" id="nature_mvt"
                                                type="hidden" value="journaliere" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="montant_mvt_cdf"><span class="text-danger"></span>Sortie Francs</label>
                                        <div class="input-group input-group" style="width: 100%!important;">
                                            <input data-toggle="tooltip" data-placement="top"
                                                   title="En chiffre SVP!"
                                                   type="number" step="0.00" name="montant_mvt_cdf" min="0" max="1000000000"
                                                   class="form-control font-weight-bold" id="montant_mvt_cdf"
                                                   value="<?= old('montant_mvt_cdf'); ?>">
                                            <div class="input-group-append">
                                            <span class="input-group-text">CDF</span>
                                                <!-- <select name="devise_mvt" id="devise_mvt"
                                                        class="form-control select2 select2-info"
                                                        data-dropdown-css-class="select2-info">
                                                    <option selected disabled>--Devise--</option>
                                                    <option value="USD" <!?= set_select('devise_mvt', 'USD'); ?>>USD</option>
                                                    <option value="CDF" <!?= set_select('devise_mvt', 'CDF'); ?>>CDF</option>
                                                </select> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="montant_mvt_usd"><span class="text-danger"></span>Sortie Dollars</label>
                                        <div class="input-group input-group" style="width: 100%!important;">
                                            <input data-toggle="tooltip" data-placement="top"
                                                   title="En chiffre SVP!"
                                                   type="number" step="0.00" name="montant_mvt_usd" min="0" max="1000000000"
                                                   class="form-control font-weight-bold" id="montant_mvt_usd"
                                                   value="<?= old('montant_mvt_usd'); ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text">USD</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-sm-12 col-xs-12" >
                                        <label for="motif_mvt">Motif ou Observation</label>
                                    <textarea name="motif_mvt" id="motif_mvt" cols="30" rows="3" class="form-control"><?= old('motif_mvt');?></textarea>
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