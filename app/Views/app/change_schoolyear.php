<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold small">Changement années scolaires</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview'); ?>">Accueil</a></li>
                        <li class="breadcrumb-item active">Annees</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>
    <?php
    $validation = \Config\Services::validation();
    $session = \Config\Services::session();
    $segment = \Config\Services::uri();
    ?>
    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="card">
         
            <?php
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url() . '/overview/changeSchoolYear/', $attributes);
            ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="libelle_annee_scolaire_save" class="control-label">
                                <span class="text-danger">*</span> Année Scolaire
                            </label>
                            <div class="input-group input-group" style="width: 100%!important;">
                                        <select id="anneeScolaire" name="year"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                            <option disabled>-- Annee Scolaire --</option>
                                            <option selected="selected" value=" <?= session()->get('yearuid'); ?>"><?= session()->get('yearlibelle'); ?></option>
                                            <?php
                                            $count = 1;
                                            if (isset($annees) && !empty($annees)):
                                                foreach ($annees as $key => $value): ?>
                                                    <option value="<?= esc($value['annee_uid']); ?>" <?= set_select('year', esc($value['annee_uid'])); ?>>
                                                        <?= ucfirst(esc($value['annee_libelle'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-info text-uppercase">
                                                Consulter l'annee
                                            </button>
                                        </div>
                                    </div>
                        </div>
                    </div>
                    
                </div>
            </div>
           
            <?php echo form_close(); ?>
        </div>
        </div><!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>
<!-- ./wrapper -->