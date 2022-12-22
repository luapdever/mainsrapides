<?php

include('../db.php');
include("../functions.php");
include('../scripts_php/fonctions_list.php');

if(!connected()) {
    header("location: ../connexion.php");
    exit();
}

if($_SESSION['type_compte'] != "super_admin") {
    header("location: tb.php");
}

$title = "Tableau de Bord";
$pageTitle = "Tableau de Bord - Super_Admin";


$dataStatistic = data_statistic($connect);

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('../parts/head.php'); ?>
</head>

<body class="fix-header fix-sidebar card-no-border">

    
    <?php include('../parts/loader.php'); ?>


    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <?php include('../parts/navbar.php'); ?>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        
        <?php include('../parts/sidebar-left.php'); ?>

        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                
                <?php include('../parts/header.php'); ?>

                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="card-group">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3>Activités</h3>
                                    <?php
                                        $activite = count_row($connect, "activite");
                                    ?>
                                    <h5><?php echo $activite['total']; ?></h5>
                                    <p><strong><?php echo $activite['total7']; ?></strong> - cette semaine</p>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $activite['total7']*100/$activite['total']; ?>%; height: 6px;" aria-valuenow="<?php echo $activite['total7']; ?>"
                                     aria-valuemin="0" aria-valuemax="<?php echo $activite['total']; ?>"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3>Equipements</h3>
                                    <?php
                                        $equipement = count_row($connect, "equipement");
                                    ?>
                                    <h5><?php echo $equipement['total']; ?></h5>
                                    <p><strong><?php echo $equipement['total7']; ?></strong> - cette semaine</p>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $equipement['total7']*100/$equipement['total']; ?>%; height: 6px;" aria-valuenow="<?php echo $equipement['total7']; ?>"
                                     aria-valuemin="0" aria-valuemax="<?php echo $equipement['total']; ?>"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3>Cultures</h3>
                                    <?php
                                        $culture = count_row($connect, "culture");
                                    ?>
                                    <h5><?php echo $culture['total']; ?></h5>
                                    <p><strong><?php echo $culture['total7']; ?></strong> - cette semaine</p>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $culture['total7']*100/$culture['total']; ?>%; height: 6px;" aria-valuenow="<?php echo $culture['total7']; ?>"
                                     aria-valuemin="0" aria-valuemax="<?php echo $culture['total']; ?>"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3>Terrain</h3>
                                    <?php
                                        $terrain = count_row($connect, "terrain");
                                    ?>
                                    <h5><?php echo $terrain['total']; ?></h5>
                                    <p><strong><?php echo $terrain['total7']; ?></strong> - cette semaine</p>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $terrain['total7']*100/$terrain['total']; ?>%; height: 6px;" aria-valuenow="<?php echo $terrain['total7']; ?>"
                                     aria-valuemin="0" aria-valuemax="<?php echo $terrain['total']; ?>"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-group">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3>Intrant</h3>
                                    <?php
                                        $intrant = count_row($connect, "intrant");
                                    ?>
                                    <h5><?php echo $intrant['total']; ?></h5>
                                    <p><strong><?php echo $intrant['total7']; ?></strong> - cette semaine</p>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $intrant['total7']*100/$intrant['total']; ?>%; height: 6px;" aria-valuenow="<?php echo $intrant['total7']; ?>"
                                     aria-valuemin="0" aria-valuemax="<?php echo $intrant['total']; ?>"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3>Pesticides</h3>
                                    <?php
                                        $pesticide = count_row($connect, "pesticide");
                                    ?>
                                    <h5><?php echo $pesticide['total']; ?></h5>
                                    <p><strong><?php echo $pesticide['total7']; ?></strong> - cette semaine</p>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $pesticide['total7']*100/$pesticide['total']; ?>%; height: 6px;" aria-valuenow="<?php echo $pesticide['total7']; ?>"
                                     aria-valuemin="0" aria-valuemax="<?php echo $pesticide['total']; ?>"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3>Personnel</h3>
                                    <?php
                                        $personnel = count_row($connect, "personnel");
                                    ?>
                                    <h5><?php echo $personnel['total']; ?></h5>
                                    <p><strong><?php echo $personnel['total7']; ?></strong> - cette semaine</p>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $personnel['total7']*100/$personnel['total']; ?>%; height: 6px;" aria-valuenow="<?php echo $personnel['total7']; ?>"
                                     aria-valuemin="0" aria-valuemax="<?php echo $personnel['total']; ?>"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="white p-5 r-5">
                                <div class="card-title">
                                    <h5> Statistiques des activités </h5>
                                    <em>Cliquer sur une légende pour voir ou cacher ses statistiques</em>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-12" style="height: 350px">
                                        <canvas data-chart="line" 
                                            data-dataset="<?php echo $dataStatistic; ?>" 
                                            data-labels="['Aujourd\'hui', 'Jour -1', 'Jour -2', 'Jour -3', 'Jour -4', 'Jour -5']" 
                                            data-dataset-options="[
                                                            {   label:'Semence',
                                                                fill: true,
                                                                backgroundColor: 'rgba(50,141,255,.2)',
                                                                borderColor: '#328dff',
                                                                pointBorderColor: '#328dff',
                                                                pointBackgroundColor: '#fff',
                                                                pointBorderWidth: 2,
                                                                borderWidth: 1,
                                                                borderJoinStyle: 'miter',
                                                                pointHoverBackgroundColor: '#328dff',
                                                                pointHoverBorderColor: '#328dff',
                                                                pointHoverBorderWidth: 1,
                                                                pointRadius: 3,
                                                                
                                                            },
                                                            {  
                                                                label:'Plantation',
                                                                fill: false,
                                                                borderDash: [5, 5],
                                                                backgroundColor: 'rgba(0,0,255,1)',
                                                                borderColor: '#0000ff',
                                                                pointBorderColor: '#0000ff',
                                                                pointBackgroundColor: '#0000ff',
                                                                pointBorderWidth: 2,
                                                
                                                                borderWidth: 1,
                                                                borderJoinStyle: 'miter',
                                                                pointHoverBackgroundColor: '#0000ff',
                                                                pointHoverBorderColor: '#fff',
                                                                pointHoverBorderWidth: 1,
                                                                pointRadius: 3,
                                                                
                                                            },
                                                            {  
                                                                label:'Desherbage',
                                                                fill: false,
                                                                borderDash: [5, 5],
                                                                backgroundColor: 'rgba(0,255,255,1)',
                                                                borderColor: '#00ffff',
                                                                pointBorderColor: '#00ffff',
                                                                pointBackgroundColor: '#00ffff',
                                                                pointBorderWidth: 2,
                                                
                                                                borderWidth: 1,
                                                                borderJoinStyle: 'miter',
                                                                pointHoverBackgroundColor: '#00ffff',
                                                                pointHoverBorderColor: '#fff',
                                                                pointHoverBorderWidth: 1,
                                                                pointRadius: 3,
                                                                
                                                            },
                                                            {  
                                                                label:'Fertilisation',
                                                                fill: false,
                                                                borderDash: [5, 5],
                                                                backgroundColor: 'rgba(255,0,0,1)',
                                                                borderColor: '#ff0000',
                                                                pointBorderColor: '#ff0000',
                                                                pointBackgroundColor: '#ff0000',
                                                                pointBorderWidth: 2,
                                                
                                                                borderWidth: 1,
                                                                borderJoinStyle: 'miter',
                                                                pointHoverBackgroundColor: '#ff0000',
                                                                pointHoverBorderColor: '#fff',
                                                                pointHoverBorderWidth: 1,
                                                                pointRadius: 3,
                                                                
                                                            }
                                                            ]"
                                            data-options="{
                                                                    maintainAspectRatio: false,
                                                                    legend: {
                                                                        display: true
                                                                    },
                                                        
                                                                    scales: {
                                                                        xAxes: [{
                                                                            display: true,
                                                                            gridLines: {
                                                                                zeroLineColor: '#eee',
                                                                                color: '#eee',
                                                                            
                                                                                borderDash: [5, 5],
                                                                            }
                                                                        }],
                                                                        yAxes: [{
                                                                            display: true,
                                                                            gridLines: {
                                                                                zeroLineColor: '#eee',
                                                                                color: '#eee',
                                                                                borderDash: [5, 5],
                                                                            }
                                                                        }]
                                                        
                                                                    },
                                                                    elements: {
                                                                        line: {
                                                                        
                                                                            tension: 0.4,
                                                                            borderWidth: 1
                                                                        },
                                                                        point: {
                                                                            radius: 2,
                                                                            hitRadius: 10,
                                                                            hoverRadius: 6,
                                                                            borderWidth: 4
                                                                        }
                                                                    }
                                                                }">
                                        </canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
  
    <script src="../assets/js/app.js"></script>

    <?php include('../parts/include_js.php'); ?>

</body>

</html>