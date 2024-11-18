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
                            <h5 class="font-weight-bold text-uppercase">Modification compte : <?= (isset($compte)) ? esc($compte['compte_numero']) : 'Aucun'; ?></h5>
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


                <div class="card-footer">
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-sm-4 col-6">
                            <div class="description-block border-right">
                                        <span class="description-percentage text-warning"><i
                                                    class="fas fa-caret-left"></i> 0%</span>
                                <h5 class="description-header">
                                    <?= (isset($compte)) ? number_format(esc($compte['compte_solde']), 2, ',', ' ') : '...'; ?>
                                    <?= (isset($compte)) ? esc($compte['compte_devise']) : '...'; ?>
                                </h5>
                                <span class="description-text">SOLDE COURANT </span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 col-6">
                            <div class="description-block border-right">
                                        <span class="description-percentage text-success"><i
                                                    class="fas fa-caret-up"></i> %</span>
                                <h5 class="description-header">
                                    <?= (isset($compte)) ? number_format(esc($compte['compte_total_entree']), 2, ',', ' ') : '...'; ?>
                                    <?= (isset($compte)) ? esc($compte['compte_devise']) : '...'; ?>
                                </h5>
                                <span class="description-text">TOTAL ENTREE</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 col-6">
                            <div class="description-block">
                                        <span class="description-percentage text-info"><i
                                                    class="fas fa-caret-down"></i> %</span>
                                <h5 class="description-header">
                                    <?= (isset($compte)) ? number_format(esc($compte['compte_total_sortie']), 2, ',', ' ') : '...'; ?>
                                    <?= (isset($compte)) ? esc($compte['compte_devise']) : '...'; ?>
                                </h5>
                                <span class="description-text">TOTAL SORTIE</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                    </div>
                    <!-- /.row -->
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
                        echo form_open(base_url() . '/finance/saveCompteBancaire/update/'.(isset($compte) ? esc($compte['banque_uid']):''), $attributes);
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('finance/view/banques'); ?>"
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
                                        <th width="20%"> </th>
                                        <th width="80%"> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><label for="numero_compte" class="control-label">
                                            <span class="text-danger">*</span> Numéro Compte
                                            
                                        </label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                                <input type="text"
                                                   class="form-control  text-capitalize"
                                                   name="numero_compte"
                                                   id="numero_compte"
                                               value="<?= (isset($compte)) ? esc($compte['compte_numero']) : set_value('numero_compte') ?>"
                                               style="border-radius: 10px!important;"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="nom_banque" class="control-label">
                                            <span class="text-danger">*</span> Nom Banque
                                        </label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                                <input type="text"
                                                   class="form-control  text-capitalize"
                                                   name="nom_banque"
                                                   id="nom_banque"
                                               value="<?= (isset($compte)) ? esc($compte['banque_nom']) : set_value('nom_banque') ?>"
                                               style="border-radius: 10px!important;"/>
                                            </div>
                                        </td>
                                    </tr>  

                                    <tr>
                                        <td>
                                            <label for="type_compte"><span class="text-danger">*</span>Type de compte </label>
                                        </td>
                                        <td class="text-uppercase">
                                            <?php $type=''; if(isset($compte)){$type=esc($compte['compte_devise']);} ?>
                                            <div class="form-group">
                                                <select name="type_compte" id="type_compte"
                                                        class="form-control select2 select2-info"
                                                        data-dropdown-css-class="select2-info">
                                                    <option disabled>-- Choisissez un type --</option>
                                                    <option <?= ($type=='CDF')?'selected':''; ?> value="CDF"> Francs Congolais (CDF)</option>
                                                    <option <?= ($type=='USD')?'selected':''; ?> value="USD"> Dollars Americains (USD)</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                               
                                    <tr>
                                        <td><label for="commentaire_compte">Observation sur le compte :</label></td>
                                        <td class="text-uppercase">
                                            
                                            <textarea name="commentaire_compte" id="commentaire_compte" cols="30" rows="3"
                                                      class="form-control"><?= (isset($compte)) ? esc($compte['compte_comments']) :set_value('commentaire_compte') ?> </textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>
