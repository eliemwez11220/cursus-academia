<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mb-2">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Pointages Agents</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                        <li class="breadcrumb-item active">Pointages</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-light">
                        <div class="card-header">
                            <h3 class="card-title">Pointages des Agents pour la frequentation journalière</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- form start -->
                            <form role="form" id="presenceetudiantsForm" method="post" action="#">
                                <div class="form-group">
                                    <label for="promotionPresence">Services ou Departements</label>
                                    <div class="input-group input-group" style="width: 100%!important;">
                                        <select id="promotionPresence" name="promotionPresence"
                                                class="form-control select2 select2-success"
                                                data-dropdown-css-class="select2-success">
                                            <option selected="selected" disabled>-- Sélectionnez un service ou departement --</option>
                                            <option>Security</option>
                                            <option>Menagers</option>
                                            <option>Enseignements</option>
                                            <option>Direction Primaire</option>
                                            <option>Direction Sécondaire</option>
                                            <option>Ressources Humaines</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-outline-success text-uppercase">
                                                Afficher Agents
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->

    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="" method="post" role="form">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <div class="card-title">
                                    <h5>
                                        <strong>
                                            Service : Security |
                                            Date du Jour
                                            : <?= utf8_decode(strftime("%A, %d-%m-%Y", strtotime(date('d-m-Y')))) ?>
                                        </strong>
                                    </h5>
                                </div>
                                <div class="card-tools float-right">
                                    <button type="submit" class="btn btn-success text-uppercase btn-sm">
                                        Enregistrer le pointage
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed">
                                    <thead>
                                    <tr>
                                        <th>Identite Agent</th>
                                        <th>Présence Période</th>
                                        <th>Heure Arrivée</th>
                                        <th>Heure Sortie</th>
                                        <th>Absence/Observation</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $heureDebut = utf8_decode(strftime("%H:%M", strtotime(date('07:00'))));
                                    $heureSortie = utf8_decode(strftime("%H:%M", strtotime(date('17:00'))));
                                    $heureMinActuelle = utf8_decode(strftime("%H:%M", strtotime(date('H:i'))));
                                    $heureActuelleSysteme = utf8_decode(strftime("%H", strtotime(date('H'))));
                                    $heureArriveeMax = utf8_decode(strftime("%H", strtotime(date('07'))));
                                    $heureSortieInf = utf8_decode(strftime("%H", strtotime(date('17'))));
                                    ?>
                                    <tr>
                                        <td>202104991 - <span class="text-capitalize">Elie Mwez rubuz</span></td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess1"
                                                      <?= ($heureActuelleSysteme == '07'
                                                           OR $heureActuelleSysteme == '08' OR $heureActuelleSysteme == '09'
                                                           OR $heureActuelleSysteme == '10')?'checked':'disabled' ; ?>>
                                                <label for="checkboxSuccess1">
                                                    Matin <?= $heureDebut; ?>-08:00
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess2"
                                                    <?= ($heureActuelleSysteme == '04' OR $heureActuelleSysteme == '07'
                                                        OR $heureActuelleSysteme == '05' OR $heureActuelleSysteme == '17')?'checked':'disabled' ; ?>>
                                                <label for="checkboxSuccess2">
                                                    Soir <?= $heureSortie; ?>-17:00
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerMatin"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerMatin"
                                                       value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerMatin"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                            <div class="input-group date" id="timepickerSoir"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerSoir" value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerSoir"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div><div class="form-group">
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <select class="form-control select2" id="browser" style="width: 100%;">
                                                    <option disabled="disabled" selected="selected">-- Justification
                                                        --
                                                    </option>
                                                    <option>Maladie</option>
                                                    <option>Renvoie</option>
                                                    <option>Circonstance</option>
                                                    <option>Absence Justifiée</option>
                                                    <option>Absence Non Justifiée</option>
                                                    <option>Non Justifiée Prolongée</option>
                                                    <option>Retard Justifié</option>
                                                    <option>Retard Non Justifié</option>
                                                </select>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>202104991 - <span class="text-capitalize">Elie Mwez rubuz</span></td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess1"
                                                       checked="checked">
                                                <label for="checkboxSuccess1">
                                                    Matin <?= $heureDebut; ?>
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess2"
                                                       checked="checked">
                                                <label for="checkboxSuccess2">
                                                    Soir <?= $heureSortie; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerMatin"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerMatin"
                                                       value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerMatin"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerSoir"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerSoir" value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerSoir"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <select class="form-control select2" id="browser" style="width: 100%;">
                                                    <option disabled="disabled" selected="selected">-- Justification
                                                        --
                                                    </option>
                                                    <option>Maladie</option>
                                                    <option>Renvoie</option>
                                                    <option>Circonstance</option>
                                                    <option>Absence Justifiée</option>
                                                    <option>Absence Non Justifiée</option>
                                                    <option>Non Justifiee Prolongée</option>
                                                    <option>Retard Justifié</option>
                                                    <option>Retard Non Justifié</option>
                                                </select>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>202104991 - <span class="text-capitalize">Elie Mwez rubuz</span></td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess1"
                                                       checked="checked">
                                                <label for="checkboxSuccess1">
                                                    Matin <?= $heureDebut; ?>
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess2"
                                                       checked="checked">
                                                <label for="checkboxSuccess2">
                                                    Soir <?= $heureSortie; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerMatin"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerMatin"
                                                       value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerMatin"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerSoir"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerSoir" value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerSoir"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <select class="form-control select2" id="browser" style="width: 100%;">
                                                    <option disabled="disabled" selected="selected">-- Justification
                                                        --
                                                    </option>
                                                    <option>Maladie</option>
                                                    <option>Renvoie</option>
                                                    <option>Circonstance</option>
                                                    <option>Absence Justifiée</option>
                                                    <option>Absence Non Justifiée</option>
                                                    <option>Non Justifiée Prolongée</option>
                                                    <option>Retard Justifié</option>
                                                    <option>Retard Non Justifié</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>202104991 - <span class="text-capitalize">Elie Mwez rubuz</span></td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess1"
                                                       checked="checked">
                                                <label for="checkboxSuccess1">
                                                    Matin <?= $heureDebut; ?>
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess2"
                                                       checked="checked">
                                                <label for="checkboxSuccess2">
                                                    Soir <?= $heureSortie; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerMatin"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerMatin"
                                                       value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerMatin"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerSoir"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerSoir" value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerSoir"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <select class="form-control select2" id="browser" style="width: 100%;">
                                                    <option disabled="disabled" selected="selected">-- Justification
                                                        --
                                                    </option>
                                                    <option>Maladie</option>
                                                    <option>Renvoie</option>
                                                    <option>Circonstance</option>
                                                    <option>Absence Justifiée</option>
                                                    <option>Absence Non Justifiée</option>
                                                    <option>Non Justifiee Prolongée</option>
                                                    <option>Retard Justifié</option>
                                                    <option>Retard Non Justifié</option>
                                                </select>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>202104991 - <span class="text-capitalize">Elie Mwez rubuz</span></td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess1"
                                                       checked="checked">
                                                <label for="checkboxSuccess1">
                                                    Matin <?= $heureDebut; ?>
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess2"
                                                       checked="checked">
                                                <label for="checkboxSuccess2">
                                                    Soir <?= $heureSortie; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerMatin"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerMatin"
                                                       value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerMatin"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerSoir"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerSoir" value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerSoir"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <select class="form-control select2" id="browser" style="width: 100%;">
                                                    <option disabled="disabled" selected="selected">-- Justification
                                                        --
                                                    </option>
                                                    <option>Maladie</option>
                                                    <option>Renvoie</option>
                                                    <option>Circonstance</option>
                                                    <option>Absence Justifiée</option>
                                                    <option>Absence Non Justifiée</option>
                                                    <option>Non Justifiee Prolongée</option>
                                                    <option>Retard Justifié</option>
                                                    <option>Retard Non Justifié</option>
                                                </select>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>202104991 - <span class="text-capitalize">Elie Mwez rubuz</span></td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess1"
                                                       checked="checked">
                                                <label for="checkboxSuccess1">
                                                    Matin <?= $heureDebut; ?>
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess2"
                                                       checked="checked">
                                                <label for="checkboxSuccess2">
                                                    Soir <?= $heureSortie; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerMatin"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerMatin"
                                                       value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerMatin"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerSoir"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerSoir" value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerSoir"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <select class="form-control select2" id="browser" style="width: 100%;">
                                                    <option disabled="disabled" selected="selected">-- Justification
                                                        --
                                                    </option>
                                                    <option>Maladie</option>
                                                    <option>Renvoie</option>
                                                    <option>Circonstance</option>
                                                    <option>Absence Justifiée</option>
                                                    <option>Absence Non Justifiée</option>
                                                    <option>Non Justifiee Prolongée</option>
                                                    <option>Retard Justifié</option>
                                                    <option>Retard Non Justifié</option>
                                                </select>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>202104991 - <span class="text-capitalize">Elie Mwez rubuz</span></td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess1"
                                                       checked="checked">
                                                <label for="checkboxSuccess1">
                                                    Matin <?= $heureDebut; ?>
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess2"
                                                       checked="checked">
                                                <label for="checkboxSuccess2">
                                                    Soir <?= $heureSortie; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerMatin"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerMatin"
                                                       value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerMatin"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerSoir"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerSoir" value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerSoir"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <select class="form-control select2" id="browser" style="width: 100%;">
                                                    <option disabled="disabled" selected="selected">-- Justification
                                                        --
                                                    </option>
                                                    <option>Maladie</option>
                                                    <option>Renvoie</option>
                                                    <option>Circonstance</option>
                                                    <option>Absence Justifiée</option>
                                                    <option>Absence Non Justifiée</option>
                                                    <option>Non Justifiée Prolongée</option>
                                                    <option>Retard Justifié</option>
                                                    <option>Retard Non Justifié</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>202104991 - <span class="text-capitalize">Elie Mwez rubuz</span></td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess1"
                                                       checked="checked">
                                                <label for="checkboxSuccess1">
                                                    Matin <?= $heureDebut; ?>
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess2"
                                                       checked="checked">
                                                <label for="checkboxSuccess2">
                                                    Soir <?= $heureSortie; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerMatin"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerMatin"
                                                       value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerMatin"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerSoir"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerSoir" value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerSoir"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <select class="form-control select2" id="browser" style="width: 100%;">
                                                    <option disabled="disabled" selected="selected">-- Justification
                                                        --
                                                    </option>
                                                    <option>Maladie</option>
                                                    <option>Renvoie</option>
                                                    <option>Circonstance</option>
                                                    <option>Absence Justifiée</option>
                                                    <option>Absence Non Justifiée</option>
                                                    <option>Non Justifiée Prolongée</option>
                                                    <option>Retard Justifié</option>
                                                    <option>Retard Non Justifié</option>
                                                </select>
                                            </div>
                                        </td>

                                    </tr> <tr>
                                        <td>202104991 - <span class="text-capitalize">Elie Mwez rubuz</span></td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess1"
                                                       checked="checked">
                                                <label for="checkboxSuccess1">
                                                    Matin <?= $heureDebut; ?>
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess2"
                                                       checked="checked">
                                                <label for="checkboxSuccess2">
                                                    Soir <?= $heureSortie; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerMatin"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerMatin"
                                                       value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerMatin"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerSoir"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerSoir" value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerSoir"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <select class="form-control select2" id="browser" style="width: 100%;">
                                                    <option disabled="disabled" selected="selected">-- Justification
                                                        --
                                                    </option>
                                                    <option>Maladie</option>
                                                    <option>Renvoie</option>
                                                    <option>Circonstance</option>
                                                    <option>Absence Justifiée</option>
                                                    <option>Absence Non Justifiée</option>
                                                    <option>Non Justifiée Prolongée</option>
                                                    <option>Retard Justifié</option>
                                                    <option>Retard Non Justifié</option>
                                                </select>
                                            </div>
                                        </td>
                                        <!--
                                         <td>
                                            <div class="form-group">

                                                <div class="icheck-success d-inline">
                                                    <input type="radio" name="r3"  id="radioSuccess2">
                                                    <label for="radioSuccess2">
                                                        Matin
                                                    </label>
                                                </div>
                                                <div class="icheck-success d-inline">
                                                    <input type="radio" name="r3" id="radioSuccess1"
                                                           checked="checked">
                                                    <label for="radioSuccess1">
                                                        Soir
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                         -->


                                    </tr>
                                    <tr>
                                        <td>202104991 - <span class="text-capitalize">Elie Mwez rubuz</span></td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess1"
                                                       checked="checked">
                                                <label for="checkboxSuccess1">
                                                    Matin <?= $heureDebut; ?>
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess2"
                                                       checked="checked">
                                                <label for="checkboxSuccess2">
                                                    Soir <?= $heureSortie; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerMatin"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerMatin"
                                                       value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerMatin"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerSoir"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerSoir" value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerSoir"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <select class="form-control select2" id="browser" style="width: 100%;">
                                                    <option disabled="disabled" selected="selected">-- Justification
                                                        --
                                                    </option>
                                                    <option>Maladie</option>
                                                    <option>Renvoie</option>
                                                    <option>Circonstance</option>
                                                    <option>Absence Justifiée</option>
                                                    <option>Absence Non Justifiée</option>
                                                    <option>Non Justifiée Prolongée</option>
                                                    <option>Retard Justifié</option>
                                                    <option>Retard Non Justifié</option>
                                                </select>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>202104991 - <span class="text-capitalize">Elie Mwez rubuz</span></td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess1"
                                                       checked="checked">
                                                <label for="checkboxSuccess1">
                                                    Matin <?= $heureDebut; ?>
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess2"
                                                       checked="checked">
                                                <label for="checkboxSuccess2">
                                                    Soir <?= $heureSortie; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerMatin"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerMatin"
                                                       value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerMatin"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerSoir"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerSoir" value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerSoir"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <select class="form-control select2" id="browser" style="width: 100%;">
                                                    <option disabled="disabled" selected="selected">-- Justification
                                                        --
                                                    </option>
                                                    <option>Maladie</option>
                                                    <option>Renvoie</option>
                                                    <option>Circonstance</option>
                                                    <option>Absence Justifiée</option>
                                                    <option>Absence Non Justifiée</option>
                                                    <option>Non Justifiée Prolongée</option>
                                                    <option>Retard Justifié</option>
                                                    <option>Retard Non Justifié</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>202104991 - <span class="text-capitalize">Elie Mwez rubuz</span></td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess1"
                                                       checked="checked">
                                                <label for="checkboxSuccess1">
                                                    Matin <?= $heureDebut; ?>
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess2"
                                                       checked="checked">
                                                <label for="checkboxSuccess2">
                                                    Soir <?= $heureSortie; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerMatin"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerMatin"
                                                       value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerMatin"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerSoir"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerSoir" value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerSoir"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <select class="form-control select2" id="browser" style="width: 100%;">
                                                    <option disabled="disabled" selected="selected">-- Justification
                                                        --
                                                    </option>
                                                    <option>Maladie</option>
                                                    <option>Renvoie</option>
                                                    <option>Circonstance</option>
                                                    <option>Absence Justifiée</option>
                                                    <option>Absence Non Justifiée</option>
                                                    <option>Non Justifiée Prolongée</option>
                                                    <option>Retard Justifié</option>
                                                    <option>Retard Non Justifié</option>
                                                </select>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>202104991 - <span class="text-capitalize">Elie Mwez rubuz</span></td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess1"
                                                       checked="checked">
                                                <label for="checkboxSuccess1">
                                                    Matin <?= $heureDebut; ?>
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess2"
                                                       checked="checked">
                                                <label for="checkboxSuccess2">
                                                    Soir <?= $heureSortie; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerMatin"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerMatin"
                                                       value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerMatin"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerSoir"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerSoir" value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerSoir"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <select class="form-control select2" id="browser" style="width: 100%;">
                                                    <option disabled="disabled" selected="selected">-- Justification
                                                        --
                                                    </option>
                                                    <option>Maladie</option>
                                                    <option>Renvoie</option>
                                                    <option>Circonstance</option>
                                                    <option>Absence Justifiée</option>
                                                    <option>Absence Non Justifiée</option>
                                                    <option>Non Justifiée Prolongée</option>
                                                    <option>Retard Justifié</option>
                                                    <option>Retard Non Justifié</option>
                                                </select>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>202104991 - <span class="text-capitalize">Elie Mwez rubuz</span></td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess1"
                                                       checked="checked">
                                                <label for="checkboxSuccess1">
                                                    Matin <?= $heureDebut; ?>
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess2"
                                                       checked="checked">
                                                <label for="checkboxSuccess2">
                                                    Soir <?= $heureSortie; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerMatin"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerMatin"
                                                       value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerMatin"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerSoir"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerSoir" value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerSoir"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <select class="form-control select2" id="browser" style="width: 100%;">
                                                    <option disabled="disabled" selected="selected">-- Justification
                                                        --
                                                    </option>
                                                    <option>Maladie</option>
                                                    <option>Renvoie</option>
                                                    <option>Circonstance</option>
                                                    <option>Absence Justifiée</option>
                                                    <option>Absence Non Justifiée</option>
                                                    <option>Non Justifiée Prolongée</option>
                                                    <option>Retard Justifié</option>
                                                    <option>Retard Non Justifié</option>
                                                </select>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>202104991 - <span class="text-capitalize">Elie Mwez rubuz</span></td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess1"
                                                       checked="checked">
                                                <label for="checkboxSuccess1">
                                                    Matin <?= $heureDebut; ?>
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess2"
                                                       checked="checked">
                                                <label for="checkboxSuccess2">
                                                    Soir <?= $heureSortie; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerMatin"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerMatin"
                                                       value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerMatin"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerSoir"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerSoir" value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerSoir"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <select class="form-control select2" id="browser" style="width: 100%;">
                                                    <option disabled="disabled" selected="selected">-- Justification
                                                        --
                                                    </option>
                                                    <option>Maladie</option>
                                                    <option>Renvoie</option>
                                                    <option>Circonstance</option>
                                                    <option>Absence Justifiée</option>
                                                    <option>Absence Non Justifiée</option>
                                                    <option>Non Justifiée Prolongée</option>
                                                    <option>Retard Justifié</option>
                                                    <option>Retard Non Justifié</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>202104991 - <span class="text-capitalize">Elie Mwez rubuz</span></td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess1"
                                                       checked="checked">
                                                <label for="checkboxSuccess1">
                                                    Matin <?= $heureDebut; ?>
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="presencePeriode" id="checkboxSuccess2"
                                                       checked="checked">
                                                <label for="checkboxSuccess2">
                                                    Soir <?= $heureSortie; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerMatin"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerMatin"
                                                       value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerMatin"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date" id="timepickerSoir"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       data-target="#timepickerSoir" value="<?= $heureMinActuelle; ?>"/>
                                                <div class="input-group-append" data-target="#timepickerSoir"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <select class="form-control select2" id="browser" style="width: 100%;">
                                                    <option disabled="disabled" selected="selected">-- Justification
                                                        --
                                                    </option>
                                                    <option>Maladie</option>
                                                    <option>Renvoie</option>
                                                    <option>Circonstance</option>
                                                    <option>Absence Justifiée</option>
                                                    <option>Absence Non Justifiée</option>
                                                    <option>Non Justifiée Prolongée</option>
                                                    <option>Retard Justifié</option>
                                                    <option>Retard Non Justifié</option>
                                                </select>
                                            </div>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </form>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </filiere>
</div>
