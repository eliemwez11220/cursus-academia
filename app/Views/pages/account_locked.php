
<!-- Automatic element centering -->
<div class="content-wrapper">
<div class="card mt-5" style="border-radius: 10px!important;">
                            <div class="card-header">
                                <div class="card-title">
                                <span class="float-left">
                                    <a href="<?= base_url(); ?>">
                                    <img src="<?= site_url('global/logo/favicon.png'); ?>" alt="Logo"
                                         style="border-radius:10px; height:50px;"></a>
                                </span>
                                </div>
                                <div class="card-tools">
                                    <div class="float-right">
                                        <h1 class="d-none d-sm-block text-uppercase"><strong>ACCES</strong></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer alert alert-danger mb-0">
                              <?php if (isset($failed)): ?>
                                    <div class="text-center ">
                                        <h3 class="small text-uppercase">
                                            <?= $failed; ?>
                                        </h3>
                                    </div>
                                <?php endif; ?>
                              </div>
                              <a href="<?= base_url(); ?>" class="btn btn-outline-danger btn-block text-uppercase">
                                Aller a la page d'accueil
                              </a>
                           
                            </div> </div>
