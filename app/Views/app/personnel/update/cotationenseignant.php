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
                            <h5 class="font-weight-bold">Personnel - Modification Evaluation Enseignant</h5>
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

                    //tabe uid reference
                    $table_reference = isset($cotation) ? esc($cotation['cotation_uid']) : '';

                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url() . '/agent/saveEvaluationEnseignant/update/'.$table_reference, $attributes);
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('agent/view/cotationenseignants'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> voir la liste</a>
                            </div>
                            <div class="card-tools float-right">
                                <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-check-circle"></i> Enregistrer les modifications
                                </button>
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
                                            $old_agent = isset($cotation) ? esc($cotation['cotation_agent_uid']) : '';
                                            $count = 1;
                                            if (isset($agents) && !empty($agents)):
                                                foreach ($agents as $key => $value):
                                                    if ($old_agent == esc($value['agent_uid'])) { ?>
                                                        <option selected
                                                                value="<?= esc($old_agent); ?>" <?= set_select('agent_cotation', esc($old_agent)); ?>>
                                                            <?= ucfirst(esc($value['agent_nom'])); ?>
                                                            -<?= ucfirst(esc($value['agent_postnom'])); ?>-
                                                            <?= ucfirst(esc($value['agent_prenom'])); ?> -
                                                            <?= ucfirst(esc($value['agent_matricule'])); ?>
                                                        </option>
                                                    <?php } ?>
                                                    <option value="<?= esc($value['agent_uid']); ?>" <?= set_select('agent_cotation', esc($value['agent_uid'])); ?>>
                                                        <?= ucfirst(esc($value['agent_nom'])); ?>-<?= ucfirst(esc($value['agent_postnom'])); ?>-
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
                                            $oldPeriode = isset($cotation) ? esc($cotation['cotation_periode_uid']):'';
                                            $count = 1;
                                            if (isset($periodes) && !empty($periodes)):
                                                foreach ($periodes as $key => $value):
                                                    if ($oldPeriode == esc($value['periode_uid'])) { ?>
                                                        <option selected
                                                                value="<?= esc($oldPeriode); ?>" <?= set_select('periode_cotation', esc($oldPeriode)); ?>>
                                                            <?= ucfirst(esc($value['periode_libelle'])); ?>
                                                        </option>
                                                    <?php } ?>
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
                                 <div class="row"> </div>
                                 <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="critere_cotation" class="control-label">
                                            <span class="text-danger">*</span> Critère d'évaluation
                                        </label>
                                        <select id="critere_cotation" name="critere_cotation"
                                                class="form-control select2 select2-info <?php if($validation->hasError( 'critere_cotation')){echo 'is-invalid';} ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez un critère --</option>
                                            <?php
                                            $oldCritere  = isset($cotation) ? esc($cotation['cotation_critere_uid']):'';
                                            $count = 1;
                                            if (isset($criteres) && !empty($criteres)):
                                                foreach ($criteres as $key => $value):
                                                    if ($oldCritere == esc($value['critere_uid'])) { ?>
                                                    <option selected
                                                            value="<?= esc($oldCritere); ?>" <?= set_select('critere_cotation', esc($oldCritere)); ?>>
                                                        <?= ucfirst(esc($value['critere_libelle'])); ?>
                                                    </option>
                                                    <?php } ?>
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
                                        <label for="cotes_max" class="control-label">
                                            <span class="text-danger"></span> Maximum Cotation
                                        </label>
                                        <input type="number" min="0" step="0.00"
                                               class="form-control <?php if($validation->hasError( 'cotes_max')){echo 'is-invalid';} ?>"
                                               name="cotes_max" id="cotes_max"
                                               value="<?= isset($cotation) ? esc($cotation['critere_cotes_max']):set_value('cotes_max') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if(isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'cotes_max'); ?>
                                            </span>
                                        <?php endif;?>
                                    </div>
                                </div><div class="col-lg-2 col-sm-2 col-xs-12">
                                    <div class="form-group">
                                        <label for="cotes_directeur" class="control-label">
                                            <span class="text-danger"></span> Cotes Directeur
                                        </label>
                                        <input type="number" min="0" step="0.00"
                                               class="form-control <?php if($validation->hasError( 'cotes_directeur')){echo 'is-invalid';} ?>"
                                               name="cotes_directeur" id="cotes_directeur"
                                               value="<?= isset($cotation) ? esc($cotation['cotation_cote_directeur']):set_value('cotes_directeur') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if(isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'cotes_directeur'); ?>
                                            </span>
                                        <?php endif;?>
                                    </div>
                                </div>
                                
                                <div class="col-lg-2 col-sm-2 col-xs-12">
                                    <div class="form-group">
                                        <label for="cotes_coordination" class="control-label">
                                            <span class="text-danger"></span> Cotes Coordination
                                        </label>
                                        <input type="number" min="0" step="0.00"
                                               class="form-control <?php if($validation->hasError( 'cotes_coordination')){echo 'is-invalid';} ?>"
                                               name="cotes_coordination" id="cotes_coordination"
                                               value="<?= isset($cotation) ? esc($cotation['cotation_cote_insp_coordination']):set_value('cotes_coordination') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if(isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'cotes_coordination'); ?>
                                            </span>
                                        <?php endif;?>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="compose-textarea"> <span class="text-danger"></span> Observation  Evaluation </label>
                                        <textarea  name="description_cotation" class="form-control" rows="10" style="height: 100px!important;"
                                                  placeholder="Decrivez l'evaluation ici..."><?= isset($cotation) ? esc($cotation['cotation_description']):set_value('description_cotation');?></textarea>
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

            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="card bg-secondary">
                        <div class="card-header">
                            <h5 class="card-title">
                                Autres évaluation du même agent
                            </h5>
                        </div>
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
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $agentCriteres = isset($cotation) ? esc($cotation['cotation_agent_uid']) : '';

                                            $critereSelected = isset($cotation) ? esc($cotation['cotation_uid']) : '';
                                                if (isset($cotations_agents) && !empty($cotations_agents)):
                                                    foreach ($cotations_agents as $key => $value):
                                                        if ($agentCriteres == $value['cotation_agent_uid']):
                                                            $moyenne = (esc($value['cotation_cote_directeur']) + esc($value['cotation_cote_insp_coordination']))/2;
                                                        ?>
                                                <tr class="small <?= ($critereSelected == esc($value['cotation_uid']))?'alert alert-info':'' ?>">
                                                        <td class="text-center"><?= $count++; ?></td>
                                                        <td><?= esc($value['critere_libelle']); ?></td>
                                                        <td><?= esc($value['periode_libelle']); ?></td>

                                                        <td class="text-center"><?= esc($value['critere_cotes_max']); ?></td>
                                                       <td class="text-center"><?= esc($value['cotation_cote_directeur']); ?></td>
                                                        <td class="text-center"><?= esc($value['cotation_cote_insp_coordination']); ?></td>
                                                        <td class="text-center"><?=  number_format($moyenne, 2, ',', ' ') ; ?></td>
                                                        <td width="1px" class="text-center">
                                                    <a href="<?= base_url('agent/editForm/cotationenseignant/' . esc($value['cotation_uid'])); ?>"
                                                       class="btn btn-xs btn-outline-warning">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour modifier cette information"><i class="fa fa-edit fa-2x"></i></span>
                                                    </a>
                                                </td>
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
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>

