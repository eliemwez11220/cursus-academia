<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <div class="printoff">
                                <form role="form" id="annee_scolaire_filter" method="get">
                                    <div class="input-group input-group" style="width: 100%!important;">
                                        
                                        <div class="input-group-append">
                                            
                                            <select id="anneeScolaire" name="yr"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                            <option disabled>-- Année Scolaire --</option>
                                            <?php
                                            $selectedYear = isset($anneeChoosed)?$anneeChoosed:session()->yearlibelle;
                                            $count = 1;
                                            if (isset($annees) && !empty($annees)):
                                                foreach ($annees as $key => $value): 
                                                    if ($selectedYear == $value['annee_libelle']) { ?>
                                                        <option selected value="<?= esc($value['annee_uid']); ?>" <?= set_select('yr', esc($value['annee_uid'])); ?>>
                                                            <?= ucfirst(esc($value['annee_libelle'])); ?>
                                                        </option>
                                                    <?php } ?>

                                                    <option value="<?= esc($value['annee_uid']); ?>" <?= set_select('yr', esc($value['annee_uid'])); ?>>
                                                        <?= ucfirst(esc($value['annee_libelle'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                         </div>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default text-uppercase">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Rapports</li>
                        <li class="breadcrumb-item active">Registres</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>
    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
             <div class="card">
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-6 invoice-col border-right"> 
                            <address>
                                <span class="text-uppercase">
                                    <b>
                                                
                                       <?= session()->get('schoolname'); ?> | 
                                        <?= isset($ecole) ? esc($ecole['ecole_code']) : ''; ?>
                                    </b>
                                </span>
                                <br>
                                <span class="text-capitalize">
                                    <?= isset($ecole) ? esc($ecole['ecole_ville']) . ' , ' . esc($ecole['ecole_province']) : ''; ?>
                                </span>
                                <br>
                                <span class="text-capitalize">
                                    <?= isset($ecole) ? esc($ecole['ecole_adresse']) : ''; ?>
                                </span>
                                <br>
                                <p>
                                      Téléphone: <?= isset($ecole) ? esc($ecole['ecole_telephone']) : ''; ?><br>
                                        Email: <?= isset($ecole) ? esc($ecole['ecole_email']) : ''; ?>
                                </p> 
                            </address>
                        </div> <div class="col-sm-6 invoice-col"> 
                            <address>
                                <span class="text-uppercase">
                                    <b>
                                              Année scolaire  :  
                                       <?= isset($anneeChoosed)?$anneeChoosed:session()->get('yearlibelle'); ?>
                                    </b>
                                </span>
                                <br>
                                <span class="text-uppercase">
                                    <b>
                                        CYCLES :
                                    </b>
                                </span>
                                <br>
                                <?php
                                    if (isset($cycles) && !empty($cycles)):
                                        foreach ($cycles as $key => $value):?>
                                          
                                                <b class="text-uppercase pt-0">
                                                    <?= ($value['cycle_libelle']); ?> - </b>
                                            
                                        <?php endforeach;?>
                                <?php endif;?> 
                                <br>
                                 <span class="text-uppercase">
                                    <b>
                                        EFFECTIF etudiants :
                                        <?= isset($nb_etudiants)?$nb_etudiants:0; ?>
                                    </b>
                                </span>
                               
                            </address>
                        </div> 
                    </div> 
                </div> 
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="text-uppercase font-weight-bold">
                                    Statistiques annuels des étudiants par options et promotions
                                </h5>
                            </div>

                            <div class="card-tools float-right">

                                <a href="" onclick="print()" class="btn btn-success btn-sm text-uppercase">
                                    <i class="fa fa-print"></i> Imprimer
                                </a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatablesExample2"
                                   class="table table-sm  table-bordered table-hover table-head-fixed">
                                <thead>

                                <tr class="text-uppercase">
                                    <th>Options/promotions</th>
                                    <th>Garcons</th>
                                    <th>Filles</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="4" class="text-uppercase"><strong>Maternelle <span class="float-right">[3 promotions]</span></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1ere Mat.</td>
                                    <td>75</td>
                                    <td>25</td>
                                    <td>100</td>
                                </tr>
                                <tr>
                                    <td>2eme Mat.</td>
                                    <td>35</td>
                                    <td>25</td>
                                    <td>60</td>
                                </tr>
                                <tr>
                                    <td>3eme Mat.</td>
                                    <td>35</td>
                                    <td>25</td>
                                    <td>60</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-uppercase"><strong>Primaire <span class="float-right">[6 promotions]</span></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1ère Prim.</td>
                                    <td>75</td>
                                    <td>25</td>
                                    <td>100</td>
                                </tr>
                                <tr>
                                    <td>2ème Prim.</td>
                                    <td>35</td>
                                    <td>25</td>
                                    <td>60</td>
                                </tr>
                                <tr>
                                    <td>3ème Prim.</td>
                                    <td>35</td>
                                    <td>25</td>
                                    <td>60</td>
                                </tr>
                                <tr>
                                    <td>4ème Prim.</td>
                                    <td>75</td>
                                    <td>25</td>
                                    <td>100</td>
                                </tr>
                                <tr>
                                    <td>5ème Prim.</td>
                                    <td>35</td>
                                    <td>25</td>
                                    <td>60</td>
                                </tr>
                                <tr>
                                    <td>6ème Prim.</td>
                                    <td>35</td>
                                    <td>25</td>
                                    <td>60</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-uppercase"><strong>Secondaire Général <span
                                                    class="float-right">[2 promotions]</span></strong></td>
                                </tr>
                                <tr>
                                    <td>8ème EB</td>
                                    <td>550</td>
                                    <td>850</td>
                                    <td>1400</td>
                                </tr>
                                <tr>
                                    <td>7ème EB</td>
                                    <td>250</td>
                                    <td>450</td>
                                    <td>700</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-uppercase"><strong>Options Générales <span
                                                    class="float-right">[4 options]</span></strong></td>
                                </tr>
                                <tr>
                                    <td>Peda</td>
                                    <td>550</td>
                                    <td>850</td>
                                    <td>1400</td>
                                </tr>
                                <tr>
                                    <td>Littéraire</td>
                                    <td>250</td>
                                    <td>450</td>
                                    <td>700</td>
                                </tr>
                                <tr>
                                    <td>Scientifique Math-physique</td>
                                    <td>250</td>
                                    <td>350</td>
                                    <td>600</td>
                                </tr>
                                <tr>
                                    <td>Scientifique Biochimie</td>
                                    <td>250</td>
                                    <td>350</td>
                                    <td>600</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-uppercase"><strong>Options Techniques <span
                                                    class="float-right">[7 options]</span></strong></td>
                                </tr>
                                <tr>
                                    <td>COM.GEN</td>
                                    <td>150</td>
                                    <td>250</td>
                                    <td>400</td>
                                </tr>
                                <tr>
                                    <td>MEC.GEN</td>
                                    <td>75</td>
                                    <td>125</td>
                                    <td>200</td>
                                </tr>
                                <tr>
                                    <td>MEC.AUTO</td>
                                    <td>75</td>
                                    <td>120</td>
                                    <td>195</td>
                                </tr>
                                <tr>
                                    <td>ELECTRICITE</td>
                                    <td>75</td>
                                    <td>120</td>
                                    <td>1400</td>
                                </tr>
                                <tr>
                                    <td>ELECTRONIQUE</td>
                                    <td>75</td>
                                    <td>120</td>
                                    <td>1400</td>
                                </tr>
                                <tr>
                                    <td>AGRICULTURE</td>
                                    <td>75</td>
                                    <td>120</td>
                                    <td>1400</td>
                                </tr>
                                <tr>
                                    <td>COUPE ET COUTURE
                                    </td>
                                    <td>75</td>
                                    <td>120</td>
                                    <td>1400</td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </filiere>
</div>