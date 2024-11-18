<?php
    $validation = \Config\Services::validation();
    $session = \Config\Services::session();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <filiere class="content mt-5">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-default mt-5">
              <div class="card-header">
                <h3 class="card-title text-uppercase font-weight-bold">Fonctionnalités</h3>
				<div class="card-tools">
								<h3 class="small text-uppercase font-weight-bold">Eduschool</h3>
                            </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="position-relative p-3 bg-gray" style="height: 180px">
                      <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-primary">
                          SMS & EMAIL
                        </div>
                      </div>
                      La communication vous permet <br />
					  de rester en contact avec tous les parents. Grâce à la messagerie électronique
					  personnalisée pour une réunion ou un communiqué.
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="position-relative p-3 bg-gray" style="height: 180px">
                      <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-info">
                          Inscription
                        </div>
                      </div>
                      Gérer les dossiers des étudiants. <br />
					  Dès son inscription, jusqu'à fin de ses études.
					  La réinscription, le transfert et les fiches de parents sont tenues 
					  à ce niveau.
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="position-relative p-3 bg-gray" style="height: 180px">
                      <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-secondary">
                          Suivi scolaire
                        </div>
                      </div>
					  Ce module couvre la Scolarité, <br />
					  le parcours scolaire complet retraçant l'historique.
					  Vous avez également la possibilité de généreux de bulletins
					  des cotes des étudiants.
                    </div>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-sm-4">
                    <div class="position-relative p-3 bg-gray" style="height: 180px">
                      <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-success">
                          finance
                        </div>
                      </div>
					  Ce module vous permet de <br /> gérer les entrées et sorties de la caisse <br />
                      Controler les différents mouvements de la caisse tels que les paiments de frais,
les dépenses engagées par l'école pour ses besoins et les autres recettes.	Gérer différents types de frais.				  
					 
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="position-relative p-3 bg-gray" style="height: 180px">
                      <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-warning">
                          enseignement
                        </div>
                      </div>
                      Ce module s'étale sur les cours. <br /> Gérer les différentes matières <br />
					  pour toutes les promotions. Vous avez la possibilité d'effectuer des affectations
					  de branches aux enseignants et dans différentes promotions ainsi que la cotation des étudiants
					  après évaluation.
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="position-relative p-3 bg-gray" style="height: 180px">
                      <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-danger">
                          Personnel
                        </div>
                      </div>
					  Gérer les ressources humaines. <br /> Ce module vous permet de gérer tous les agents, <br />
                      leur fonction et grade ainsi que les différents secteurs d'activités dans lesquels ils sont 
					  affectés. Trouvez chaque dossier agent pour des besoins informels
                    </div>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-sm-4">
                    <div class="position-relative p-3 bg-gray" style="height: 180px">
                      <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-success">
                          Evaluation
                        </div>
                      </div>
					  <p>
						Ce module vous permet <br />d'effectuer des évaluations de chaque agent pour de raisons de performance,
						de ponctualité par exemple, etc. Chaque inspecteur peut évaluer chaque enseignant selon les 
						critères qui seront définis.
					  </p>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="position-relative p-3 bg-gray" style="height: 180px">
                      <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-warning small">
                          <small>Fonctionnement</small>
                        </div>
                      </div>
					  <p>
						Le fonctionnement, vous permet <br />de gérer les différents cycles, différentes filieres et options, 
						les promotions, les branches, les types de frais, les catégories d'étudiants ainsi que les modes d'enseignement.
					  </p>
                    </div>
                  </div>
                  <div class="col-sm-4">
                   <div class="position-relative p-3 bg-gray" style="height: 180px">
                      <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-danger">
                          Rapports
                        </div>
                      </div>
					  <p>
						Générer différents rapports <br />
						pour toutes les opérations comme les listes des étudiants, les fiches de scolarité, les réçus de paiements
						les journaux de caisses, les palmarès, les registres. Tous les documents administratif ou comptable.
					  </p>
                    </div>
                  </div>
                </div>
				<div class="row mt-4">
				<div class="col-sm-4">
                    <div class="position-relative p-3 bg-gray" style="height: 180px">
                      <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-primary">
                          Statistiques
                        </div>
                      </div>
                      Elaborer des statistiques <br />
					  basés sur des effectifs des étudiants, le nombre des promotions et options, les différentes branches,
						les fréquentations regulière des étudiants et la participation aux activités de l'école. La nature et 
le mode de paiement ainsi les difficultés liées à l'exécution de certaines tâches.						
					  
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="position-relative p-3 bg-gray" style="height: 180px">
                      <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-info">
                          Etudes en ligne
                        </div>
                      </div>
                      Accès à la plateforme par les étudiants <br />
					  pour une étude en ligne grace aux notes de cours que chaque enseignant devra 
					  mettre à la disposition des étudiants par promotion suivant le programme établi. Les matières 
					  peuvent être de vidéos, des audios ou des documents que les concernés peuvent téléchargé.
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="position-relative p-3 bg-gray" style="height: 180px">
                      <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-secondary">
                          Administration
                        </div>
                      </div>
					  Gérer des accès à l'application, <br />
					  en définissant les règles de base en attribuant les privilèges à chaque profil
					  pour utliser l'application. Chaque compte utilisateur et surveiller de près.
                    </div>
                  </div>
				  </div>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->