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
                            <h5 class="font-weight-bold text-uppercase">Détails Caisse : <?= (isset($caisse)) ? esc($caisse['caisse_libelle']) : 'Aucun libelle'; ?></h5>
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
                 <div class="card-footer">
                            <div class="row">
                              
                                <!-- /.col -->
                                <div class="col-sm-4 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-warning"><i
                                                    class="fas fa-caret-left"></i> 0%</span>
                                        <h5 class="description-header"> CDF <?= (isset($caisse)) ? number_format(esc($caisse['caisse_solde']),2,',', ' ') : '...'; ?></h5>
                                        <span class="description-text">TOTAL SOLDE</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-success"><i
                                                    class="fas fa-caret-up"></i> 20%</span>
                                        <h5 class="description-header">  CDF <?= (isset($caisse)) ? number_format(esc($caisse['caisse_total_entree']),2,',', ' ') : '...'; ?></h5>
                                        <span class="description-text">TOTAL ENTREE</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 col-6">
                                    <div class="description-block">
                                        <span class="description-percentage text-info"><i
                                                    class="fas fa-caret-down"></i> 18%</span>
                                        <h5 class="description-header"> CDF <?= (isset($caisse)) ? number_format(esc($caisse['caisse_total_sortie']),2,',', ' ') : '...'; ?></h5>
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
                        echo form_open(base_url() . '/finance/saveCaisse/update/'.(isset($caisse) ? esc($caisse['caisse_uid']):''), $attributes);
                    ?>
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
                                        <td><label for="code_caisse" class="control-label">
                                            <span class="text-danger">*</span> Code Caisse
                                            
                                        </label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                                <input type="text"
                                                   class="form-control  text-capitalize"
                                                   name="code_caisse"
                                                   id="code_caisse"
                                               value="<?= (isset($caisse)) ? esc($caisse['caisse_code']) : set_value('code_caisse') ?>"
                                               style="border-radius: 10px!important;"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="libelle_caisse" class="control-label">
                                            <span class="text-danger">*</span> Libellé Caisse
                                            
                                        </label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                                <input type="text"
                                                   class="form-control  text-capitalize"
                                                   name="libelle_caisse"
                                                   id="libelle_caisse"
                                               value="<?= (isset($caisse)) ? esc($caisse['caisse_libelle']) : set_value('libelle_caisse') ?>"
                                               style="border-radius: 10px!important;"/>
                                            </div>
                                        </td>
                                    </tr>  

                                    <tr>
                                        <td>
                                            <label for="type_caisse" class="span3"><span class="text-danger">*</span>Type de caisse </label>
                                        </td>
                                        <td class="text-uppercase">
                                            <?php if(isset($caisse)){$type=esc($caisse['caisse_type']);} ?>
                                            <div class="form-group">
                                                <select name="type_caisse" id="type_caisse"
                                                        class="form-control select2 select2-info"
                                                        data-dropdown-css-class="select2-info">
                                                    <option disabled>-- Choisissez un type --</option>
                                                    <option <?= ($type=='mixte')?'selected':''; ?> value="mixte"> Mixte(entrees & sorties)</option>
                                                    <option <?= ($type=='entree')?'selected':''; ?> value="entree"> Entrees seulement</option>
                                                    <option <?= ($type=='sortie')?'selected':''; ?> value="sortie"> Sorties seulement</option>
                                                    <option <?= ($type=='principal')?'selected':''; ?> value="principal"> Principal</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td><label for="localisation_caisse">Localisation ou adresse caisse</label></td>
                                        <td class="text-uppercase">
                                        <input type="text" class="form-control text-capitalize"
                                               name="localisation_caisse"
                                               id="localisation_caisse"
                                               value="<?= (isset($caisse)) ? esc($caisse['caisse_localisation']):set_value('localisation_caisse') ?>"
                                               style="border-radius: 10px!important;"/>
                                        </td>
                                    </tr>
                               
                                    <tr>
                                        <td><label for="observation_caisse">Observation sur la caisse:</label></td>
                                        <td class="text-uppercase">
                                            
                                            <textarea name="observation_caisse"
                                                                      id="observation_caisse"
                                                                      cols="30" rows="3"
                                                                      class="form-control"><?= (isset($caisse)) ? esc($caisse['caisse_observation']) :set_value('observation_caisse') ?> </textarea>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td><label for="commentaire_caisse">Commentaire :</label></td>
                                        <td class="text-uppercase">
                                             <textarea name="commentaire_caisse"
                                                                      id="commentaire_caisse"
                                                                      cols="30" rows="3"
                                                                      class="form-control"><?= (isset($caisse)) ? esc($caisse['caisse_comment']) :set_value('commentaire_caisse') ?> </textarea>
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
