<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold small">Profile - Gerer Photo profile</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview'); ?>">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('profile/manage'); ?>">Profile</a></li>
                        <li class="breadcrumb-item active">Picture</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>
    <?php
    $validation = \Config\Services::validation();
    $session = \Config\Services::session();
    ?>
<!-- ##### Breadcumb Area Start ##### -->
<!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
          <div class="col-md-6">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* promotions -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username text-uppercase"><?= session()->fullname; ?></h3>
                <h5 class="widget-user-desc text-uppercase"><?= session()->role; ?> </h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-4" src="<?= (session()->get('avatar') != '') ? session()->get('avatar') : site_url('global/img/avatar.png'); ?>" alt="Avatar" style="height: 100px; width: 100px">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header text-uppercase small"><?= session()->matricule; ?></h5>
                      <span class="description-text small">Matricule</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header text-lowercase small"> <?= session()->username; ?>
                      </h5>
                       <span class="description-text small">Pseudo</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="p-0">
                <ul class="nav flex-column">
                  
                   <li class="nav-item">
                    <a href="#" class="nav-link">
                      Telephone <span class="float-right font-weight-bold text-capitalize"><?= session()->phone; ?></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Email <span class="float-right font-weight-bold text-lowercase"><?= session()->email; ?></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Adresse 
                      <span class="float-right font-weight-bold text-capitalize">
                        <?= session()->adresse; ?>
                        </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Ecole 
                      <span class="float-right font-weight-bold text-capitalize small">
                        <?= session()->schoolname; ?> - <?= session()->schoolcode; ?>
                    </span>
                    </a>
                  </li> 
                </ul>
              </div>
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
          <!-- /.col -->

                <div class="col-lg-6 col-sm-6">
                    <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h5 class="text-primary text-center text-uppercase font-weight-bold">
                                        <i class="fa fa-info-circle"></i>
                                        Mise a jour de la photo de profile
                                    </h5>
                                 </div>
                            </div>
                            <div class="card-body">
                                
                             <?php
                                $attibustes = array('role' => 'form', 'autocomplete' => 'off');
                                echo form_open_multipart(site_url('profile/changePicture'), $attibustes);
                                ?>
                                <div class="input-group mb-3">
                                    <input type="file" name="photo_avatar" class="form-control-lg form-control <?= $validation->hasError('photo_avatar') ? ' is-invalid' : '' ?>" placeholder="Ancien mot de passe">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-image"></span>
                                        </div>
                                    </div>
                                    
                                     <?php if (isset($validation)) {
                                        if ($validation->hasError('photo_avatar')) { ?>
                                             <span class="invalid-feedback">
                                              <?= isset($validation) ? $validation->getError('photo_avatar') : ''; ?></span>
                                        <?php }} ?>
                                      
                                    
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-block btn-info btn-lg text-uppercase">
                                        CHANGER PHOTO
                                    </button>
                                </div>
                                <?= form_close(); ?>
                            </div>
                    </div>
                </div>


            </div>
        </div>
</filiere>
</div>