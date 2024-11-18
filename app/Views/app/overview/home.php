<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mb-2 mt-5">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> Tableau de bord</h1>
                </div><!-- /.col -->
                
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </filiere>
    <!-- Main content -->

    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
                    <div class="row">
                      <div class="col-12 col-sm-6 col-lg-6">
                       <div class="row">
                        <div class="col-12 col-sm-12 col-lg-12">
                            <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1">
                            <i class="fas fa-users"></i>
                        </span>
                                <div class="info-box-content"><span class="info-box-text text-uppercase">Etudiants</span>
                                    <span class="info-box-number font-weight-bold">
                                <?= (isset($nb_etudiants) ? $nb_etudiants : ''); ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        

                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>

                        <div class="col-12 col-sm-12 col-lg-12">
                            <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1">
                            <i class="fas fa-thumbs-up"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text text-uppercase">Promotions</span>
                                    <span class="info-box-number font-weight-bold">
                                <?= (isset($nb_promotions) ? $nb_promotions : ''); ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-12 col-lg-12">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text text-uppercase">Agents</span>
                                    <span class="info-box-number font-weight-bold">
                                <?= (isset($nb_agents) ? $nb_agents : ''); ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        </div> </div>
          <div class="col-md-6">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* promotions -->
              <div class="widget-user-header bg-primary">
                <h3 class="widget-user-username text-uppercase"><?= session()->fullname; ?></h3>
                <h5 class="widget-user-desc text-uppercase"><?= session()->role; ?> </h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-4" src="<?= (session()->get('avatar') != '') ? session()->get('avatar') : site_url('global/img/avatar.png'); ?>" alt="Logo">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header text-capitalize"><?= session()->matricule; ?></h5>
                      <span class="description-text">MATRICULE</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header text-lowercase"><?= session()->email; ?></h5>
                      <span class="description-text">EMAIL</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
          <!-- /.col -->
        </div>
        </div><!--/. container-fluid -->
    </filiere>
</div>