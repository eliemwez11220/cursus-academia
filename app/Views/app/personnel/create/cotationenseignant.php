<!--
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 25-Apr-21
 * Time: 12:47 PM
 */-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Personnel - Nouvelle Evaluation Enseignant</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Cotation Enseignant</li>
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
                    $validation = \Config\Services::validation();
                    //new code generated automatically
                    $aleatoire_value = "0123456789";
                    $new_code_generate = "CPR" . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(5, 20))), 0, 5);
                    //form attributes
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url() . '/agent/saveEvaluationEnseignant/create/', $attributes);
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('agent/view/cotationenseignants'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> voir la liste</a>
                            </div>
                            <div class="card-tools float-right">
                                
                                <a href="<?= base_url('agent/view/cotationenseignants'); ?>"
                                   class="btn btn-info btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-check-circle"></i> valider l'évaluation</a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                 
                                    <div class="form-group">
                                        <label for="agent_cotation" class="control-label">
                                            <span class="text-danger">*</span> Enseignant à évaluer
                                        </label>
                                        <select id="agent_cotation" name="agent_cotation"
                                                class="form-control select2 select2-info <?php if($validation->hasError( 'agent_cotation')){echo 'is-invalid';} ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez un agent --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($agents) && !empty($agents)):
                                                foreach ($agents as $key => $value): 
                                                    if (session()->enseignantdecotation == $value['agent_uid']) {?>
                                                        # <option selected value="<?= esc($value['agent_uid']); ?>" <?= set_select('agent_cotation', esc($value['agent_uid'])); ?>>
                                                        <?= ucfirst(esc($value['agent_nom'])); ?>
                                                        <?= ucfirst(esc($value['agent_postnom'])); ?>
                                                        <?= ucfirst(esc($value['agent_prenom'])); ?> -
                                                        <?= ucfirst(esc($value['agent_matricule'])); ?>
                                                    </option>
                                                    <?php } ?>
                                                    <option value="<?= esc($value['agent_uid']); ?>" <?= set_select('agent_cotation', esc($value['agent_uid'])); ?>>
                                                        <?= ucfirst(esc($value['agent_nom'])); ?>
                                                        <?= ucfirst(esc($value['agent_postnom'])); ?>
                                                        <?= ucfirst(esc($value['agent_prenom'])); ?> -
                                                        <?= ucfirst(esc($value['agent_matricule'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if(isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'agent_cotation'); ?>
                                            </span>
                                        <?php endif;?>
                                    </div>
                                </div>
                                 <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="periode_cotation" class="control-label">
                                            <span class="text-danger">*</span> Période d'évaluation
                                        </label>
                                        <select id="periode_cotation" name="periode_cotation"
                                                class="form-control select2 select2-info <?php if($validation->hasError( 'periode_cotation')){echo 'is-invalid';} ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez une période --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($periodes) && !empty($periodes)):
                                                foreach ($periodes as $key => $value): ?>
                                                    <option value="<?= esc($value['periode_uid']); ?>" <?= set_select('periode_cotation', esc($value['periode_uid'])); ?>>
                                                        <?= ucfirst(esc($value['periode_libelle'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if(isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'periode_cotation'); ?>
                                            </span>
                                        <?php endif;?>
                                    </div>
                                </div>
                                </div>
                                 <div class="row">
                                     <div class="col-lg-4 col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="critere_cotation" class="control-label">
                                                <span class="text-danger">*</span> Critère d'évaluation
                                            </label>
                                            <select id="critere_cotation" name="critere_cotation"
                                                    class="form-control select2 select2-info <?php if($validation->hasError( 'critere_cotation')){echo 'is-invalid';} ?>"
                                                    data-dropdown-css-class="select2-info">
                                                <option selected="selected" disabled>-- Sélectionnez un critère --</option>
                                                <?php
                                                $count = 1;
                                                if (isset($criteres) && !empty($criteres)):
                                                    foreach ($criteres as $key => $value): ?>
                                                        <option value="<?= esc($value['critere_uid']); ?>" <?= set_select('critere_cotation', esc($value['critere_uid'])); ?>>
                                                            <?= ucfirst(esc($value['critere_libelle'])); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <?php if(isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                    <?= display_validation_error($validation, 'critere_cotation'); ?>
                                                </span>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                   <div class="col-lg-2 col-sm-2 col-xs-12">
                                        <div class="form-group">
                                            <label for="max_cotation" class="control-label">
                                                <span class="text-danger"></span> Max Cotation
                                            </label>
                                            <input type="text" class="form-control"
                                                       name="max_cotation" id="max_cotation"
                                                       value="<?= set_value('max_cotation') ?>" readonly/>
                                        </div>
                                    </div>
                                   <div class="col-lg-2 col-sm-2 col-xs-12">
                                        <div class="form-group">
                                            <label for="cotes_directeur" class="control-label">
                                                <span class="text-danger"></span> Cote Directeur
                                            </label>
                                            <input type="number" min="0" step="0.00"
                                                   class="form-control <?php if($validation->hasError('cotes_directeur')){echo 'is-invalid';} ?>"
                                         name="cotes_directeur" id="cotes_directeur"
                                                   value="<?= set_value('cotes_directeur') ?>"
                                                   />
                                            <?php if(isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                    <?= display_validation_error($validation, 'cotes_directeur'); ?>
                                                </span>
                                            <?php endif;?>
                                        </div>
                                    </div>

                                   <div class="col-lg-4 col-sm-4 col-xs-12">
                                       <label for="cotes_coordination" class="control-label">Cote Coordination </label>
                                          <div class="input-group"> 
                                            <input type="number" min="0" step="0.00"
                                                   class="form-control"
                                                   name="cotes_coordination" id="cotes_coordination"
                                                   value="<?= set_value('cotes_coordination') ?>" />
                                            <div class="input-group-append"> 
                                                   <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-xs">
                                                    <i class="fa fa-check-circle"></i> Ajouter
                                                </button>
                                            </div> 
                                        </div> 
                                   </div>
                                </div>
                               
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                               
                                    <div class="card bg-secondary">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <table class="table table-sm table-bordered" id="table_achats">
                                            <thead>
                                                <tr class="text-uppercase small">
                                                    <th>#</th>
                                                    <th>CRITERES</th>
                                                    <th>PERIODE</th>
                                                    <th class="text-center">MAXIMUM</th>
                                                    <th class="text-center">DIRECTEUR</th>
                                                    <th class="text-center">INSPECTEUR</th>
                                                    <th class="text-center">MOYENNE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                if (isset($cotations) && !empty($cotations)):
                                                    foreach ($cotations as $key => $value):
                                                        if (session()->enseignantdecotation == $value['cotation_agent_uid']):
                                                            $moyenne = (esc($value['cotation_cote_directeur']) + esc($value['cotation_cote_insp_coordination']))/2;
                                                        ?>
                                                        <tr class="small">
                                                        <td class="text-center"><?= $count++; ?></td>
                                                        <td><?= esc($value['critere_libelle']); ?></td>
                                                        <td><?= esc($value['periode_libelle']); ?></td>

                                                        <td class="text-center"><?= esc($value['critere_cotes_max']); ?></td>
                                                       <td class="text-center"><?= esc($value['cotation_cote_directeur']); ?></td>
                                                        <td class="text-center"><?= esc($value['cotation_cote_insp_coordination']); ?></td>
                                                        <td class="text-center"><?=  number_format($moyenne, 2, ',', ' ') ; ?></td>
                                                        
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                    <tr class="small alert alert-warning">
                                                        <td colspan="7" class="text-uppercase">
                                                            <strong>Aucune cotation</strong>
                                                        </td>
                                                     </tr>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                        </div>

                                    </div>
                                </div>
                                </div>
                                </div>
                        
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <?php echo form_close(); ?>
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

