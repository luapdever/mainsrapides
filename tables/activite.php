<?php
//categorie.php

include('../database_connection.php');
include('../AddLogInclude.php');
//include('header.php');


if(!isset($_SESSION['type']))
{
	header('location:../connexion.php');
}

if($_SESSION['type'] == '4')
{
	header("location:../tableau-de-bord.php");
} else
{
    // Log
// 	switch ($_SESSION['type']) {
	
// 		case 1:
// 			addlog("Con-20", "Consultation de la liste des catégories", $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Administrateur");
// 			break;
// 		case 2:
// 			addlog("Con-20", "Consultation de la liste des catégories", $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Contrôleur");
// 			break;
// 		case 3:
// 			addlog("Con-20", "Consultation de la liste des catégories", $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Enregistreur");
// 			break;
// 		case 4:
// 			addlog("Con-20", "Consultation de la liste des catégories", $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Recenseur");
// 			break;
// 	}
 }



?>


<!doctype html>
<html lang="fr">


<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/tables/datatables.net.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Mar 2017 21:34:01 GMT -->
<head>
    <meta charset="utf-8" />
    <!--<link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png" />-->
	
    <link rel="icon" type="image/png" href="../../assets/img/favicon_awale.png" />
	
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Awale - Liste des activités</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Canonical SEO -->
    <link rel="canonical" href="//www.creative-tim.com/product/material-dashboard-pro" />
    <!--  Social tags      -->
    <meta name="keywords" content="material dashboard, bootstrap material admin, bootstrap material dashboard, material design admin, material design, creative tim, html dashboard, html css dashboard, web dashboard, freebie, free bootstrap dashboard, css3 dashboard, bootstrap admin, bootstrap dashboard, frontend, responsive bootstrap dashboard, premiu material design admin">
    <meta name="description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design.">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Material Dashboard PRO by Creative Tim | Premium Bootstrap Admin Template">
    <meta itemprop="description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design.">
    <meta itemprop="image" content="../../../../s3.amazonaws.com/creativetim_bucket/products/51/opt_mdp_thumbnail.jpg">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@creativetim">
    <meta name="twitter:title" content="Material Dashboard PRO by Creative Tim | Premium Bootstrap Admin Template">
    <meta name="twitter:description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design.">
    <meta name="twitter:creator" content="@creativetim">
    <meta name="twitter:image" content="../../../../s3.amazonaws.com/creativetim_bucket/products/51/opt_mdp_thumbnail.jpg">
    <!-- Open Graph data -->
    <meta property="fb:app_id" content="655968634437471">
    <meta property="og:title" content="Material Dashboard PRO by Creative Tim | Premium Bootstrap Admin Template" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="http://www.creative-tim.com/product/material-dashboard-pro" />
    <meta property="og:image" content="../../../../s3.amazonaws.com/creativetim_bucket/products/51/opt_mdp_thumbnail.jpg" />
    <meta property="og:description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design." />
    <meta property="og:site_name" content="Creative Tim" />
    <!-- Bootstrap core CSS     -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
	
    <!--  Material Dashboard CSS    -->
    <link href="../../assets/css/material-dashboard.css?<?php echo filemtime('../../assets/css/material-dashboard.css'); ?>" rel="stylesheet" />
	
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../../assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="../../assets/css/font-awesome.css" rel="stylesheet" />
    <link href="../../assets/css/google-roboto-300-700.css" rel="stylesheet" />
	
	<style>
	
		.form-control-jp-jp {
            width:100%;
            height: 40px;
            padding: 8px 6px 6px 10px;
            border: 1px solid #ddd;
            font-size: 14px !important;
            line-height: 1.42857143;
            color: #3e3f3a;
            background-color: #fff;
            border-radius: 4px;

            transition: border-color ease-in-out .30s,box-shadow ease-in-out .30s;
            transition-property: border-color, box-shadow;
            transition-duration: 0.30s, 0.30s;
            transition-timing-function: ease-in-out, ease-in-out;
            transition-delay: 0s, 0s;

        }
		
		input[type=text]:focus, textarea:focus, select:focus {
        box-shadow: 0 0 5px rgba(81, 203, 238, 1);
        border: 1px solid rgba(81, 203, 238, 1);
        }
		
		input[type="text"]:disabled {
		  background: #eee;
		}

        .form-control-textarea-jp {
        width: 100%;
        height: 90px;
        padding: 8px 6px 6px 10px;
        border: 1px solid #ddd;
        font-size: 14px !important;
        line-height: 1.42857143;
        color: #3e3f3a;
        background-color: #fff;
        border-radius: 4px;

        transition: border-color ease-in-out .30s, box-shadow ease-in-out .30s;
        transition-property: border-color, box-shadow;
        transition-duration: 0.30s, 0.30s;
        transition-timing-function: ease-in-out, ease-in-out;
        transition-delay: 0s, 0s;

        }
	
	</style>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-active-color="rose" data-background-color="black" data-image="../../assets/img/sidebar-1.jpg">
            <!--
        Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
        Tip 2: you can also add an image using data-image tag
        Tip 3: you can change the color of the sidebar with data-background-color="white | black"
    -->
            <div class="logo">
                <a href="#" class="simple-text" style="margin-right: 10px;">
                    <img src="../../assets/img/logo-awale100.png" alt="Awale" />
                </a>
            </div>
            <div class="logo logo-mini">
                <a href="#" class="simple-text" style="margin-right: 10px;">
                    <img src="../../assets/img/logo-awale100-A.png" alt="Awale" />
                </a>
            </div>
            <div class="sidebar-wrapper">
                <div class="user">
					<!--
                    <div class="photo">
                        <img src="../assets/img/faces/avatar.jpg" />
                    </div>
					-->
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                            <div><big><?php echo $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]; ?></big></div>
							    
							<?php switch ($_SESSION["type"])
									{
									case 1: echo "<div><small>Administrateur</small></div>";
									break;
									
									case 2: echo "<div><small>Contrôleur</small></div>";
									break;
									
									case 3: echo "<div><small>Enregistreur</small></div>";
									break;
									
									case 4: echo "<div><small>Contrôleur</small></div>";
									break;
									}
							?>
                            <b class="caret"></b>
                        </a>
                        <div class="collapse" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a href="../pages/profil.php">Modifier mon profil</a>
                                </li>
                                <li>
                                    <a href="../pages/deconnexion.php">Déconnexion</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
				
				<!-- Menu vertical ============================================================================================================================= -->
                <?php include('menu_maintenance.php'); ?>
				
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                            <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                            <i class="material-icons visible-on-sidebar-mini">view_list</i>
                        </button>
                    </div>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"> Les activités journalière de la maintenance enregistrées dans le système </a>
                    </div>
					
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="orange">
                                    <i class="material-icons">Activité</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title" style="font-weight: 400">Liste des activités de la maintenance</h4>
                                    <div class="toolbar">
                                                
																
															
                                    </div>

                                    <div class="material-datatables" style="margin-top: 20px;">
										
										<form method="post" action="../export/exporter-cat-microsoft.php">
										
											<div class="col-md-8" style="padding-left: 0 !important; margin-bottom: 15px;">
											
												<!-- == Administrateur, Contrôleur ========================================================================================== -->
												<?php
												if($_SESSION['type'] == '1' || $_SESSION['type'] == '2')
												{
												?>

												<a href="../export/exporter-cat-pdf.php"><button type="button" name="export_pdf" id="export_pdf" class="btn btn-primary" style="margin-right: 15px;">Exporter en PDF</button></a>
												<button type="submit" name="export_word" id="export_word" class="btn btn-primary" style="margin-right: 15px;">Exporter en Word</button>
												<button type="submit" name="export_excel" id="export_excel" class="btn btn-primary" style="margin-right: 15px;">Exporter en Excel</button>
												
												<?php
												}
												?>
											</div>
											
											<div class="col-md-4" style="padding-right: 0 !important">
												<!-- == Administrateur, Contrôleur ========================================================================================== -->
												<?php
												if($_SESSION['type'] == '1' || $_SESSION['type'] == '2')
												{
												?>
												<button type="button" name="add" id="add_button" class="btn btn-warning" style="float:right;">Ajouter une activité</button>
												<?php
												}
												?>
											</div>
										
										</form>
									
                                        <table id="activite_data" class="table table-striped table-bordered" cellspacing="0" width="100%" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th style="background-color: #ddd !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">N°</th>
													<th style="background-color: #ddd !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">Activités principales</th>
                                                    <th style="background-color: #ddd !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">Statut</th>
													
													<!-- == Administrateur, Controleur ========================================================================================== -->
													<?php
													if($_SESSION['type'] == '1' || $_SESSION['type'] == '2')
													{
													?>
													<th style="background-color: #ddd !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">Actions</th>
													<?php
													}
													?>		
                                                    <!--<th class="disabled-sorting text-right">Actions</th>-->
                                                </tr>
                                            </thead>
											
                                        </table>
                                    </div>
                                </div>
                                <!-- end content-->
                            </div>
                            <!--  end card  -->
                        </div>
                        <!-- end col-md-12 -->
                    </div>
                    <!-- end row -->
                </div>
            </div>
			
			
        </div>
    </div>
	
	
	<div id="activiteModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="activite_form">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" style="color: #ff9800; font-weight: 400;"><i class="fa fa-plus"></i> Ajouter une activité</h4>
    				</div>
    				<div class="modal-body">
						<div class="form-group">
							<label>Nom de l'activité *</label>
							<input type="text" name="intitule_activite" id="intitule_activite"  class="form-control-jp-jp" required />
						</div>
                        <div class="form-group">
							<label>Description de l'activité *</label>
							<input type="text" name="desc_activite" id="desc_activite"   class="form-control-textarea-jp" required />
						</div>
						
						
    				</div>
    				<div class="modal-footer">
    					<input type="hidden" name="id_activite" id="id_activite"/>
    					<input type="hidden" name="btn_action" id="btn_action"/>
    					<input type="submit" name="action" id="action" class="btn btn-info" value="Enregistrer" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
    <div id="activitedetailsModal" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="activite_form">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" style="color: #ff9800; font-weight: 400;"><i class="fa fa-info-circle"></i> Détails sur l'activité de maintenance</h4>
					</div>
					<div class="modal-body">
						<div id="activite_details"></div>
					</div>
					<div class="modal-footer">
						
						<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
<!--   Core JS Files   -->
<script src="../../assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="../../assets/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="../../assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../assets/js/material.min.js" type="text/javascript"></script>
<script src="../../assets/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="../../assets/js/jquery.validate.min.js"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="../../assets/js/moment.min.js"></script>
<!--  Charts Plugin -->
<script src="../../assets/js/chartist.min.js"></script>
<!--  Plugin for the Wizard -->
<script src="../../assets/js/jquery.bootstrap-wizard.js"></script>
<!--  Notifications Plugin    -->
<script src="../../assets/js/bootstrap-notify.js"></script>
<!--   Sharrre Library    -->
<script src="../../assets/js/jquery.sharrre.js"></script>
<!-- DateTimePicker Plugin -->
<script src="../../assets/js/bootstrap-datetimepicker.js"></script>
<!-- Vector Map plugin -->
<script src="../../assets/js/jquery-jvectormap.js"></script>
<!-- Sliders Plugin -->
<script src="../../assets/js/nouislider.min.js"></script>
<!--  Google Maps Plugin    -->
<!--<script src="https://maps.googleapis.com/maps/api/js"></script>-->
<!-- Select Plugin -->
<script src="../../assets/js/jquery.select-bootstrap.js"></script>
<!--  DataTables.net Plugin    -->
<script src="../../assets/js/jquery.datatables.js?<?php echo filemtime('../../assets/js/jquery.datatables.js'); ?>"></script>
<!-- Sweet Alert 2 plugin -->
<script src="../../assets/js/sweetalert2.js"></script>
<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="../../assets/js/jasny-bootstrap.min.js"></script>
<!--  Full Calendar Plugin    -->
<script src="../../assets/js/fullcalendar.min.js"></script>
<!-- TagsInput Plugin -->
<script src="../../assets/js/jquery.tagsinput.js"></script>
<!-- Material Dashboard javascript methods -->
<script src="../../assets/js/material-dashboard.js"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="../../assets/js/demo.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	$('#add_button').click(function(){
		$('#activiteModal').modal('show');
		$('#activite_form')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Ajouter une activité de maintenance");
		$('#action').val('Enregistrer');
		$('#btn_action').val('Enregistrer');
	});

	$(document).on('submit','#activite_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"activite_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				
				swal({
					title: "Effectué !",
					text: data,
					buttonsStyling: false,
					confirmButtonClass: "btn btn-success",
					type: "success"
				});
				
				$('#activite_form')[0].reset();
				$('#activiteModal').modal('hide');
				//$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				activitedataTable.ajax.reload();
			}
		})
	});
	

    $(document).on('click', '.update', function(){
		var id_activite = $(this).attr("id");
		var btn_action = 'fetch_single';
		$.ajax({
			url:"activite_action.php",
			method:"POST",
			data:{id_activite:id_activite, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{
				$('#activiteModal').modal('show');		
				$('#intitule_activite').val(data.intitule_activite);
                $('#desc_activite').val(data.desc_activite);
				$('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Modifier une activité de maintenance");
				$('#id_activite').val(id_activite);		
				$('#action').val('Modifier');
				$('#btn_action').val("Modifier");
				
			}
		})
	});
	
	
	var activitedataTable = $('#activite_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"activite_fetch.php",
			type:"POST"
		},
		
		"columnDefs":[
			{
				"targets":[3],
				"orderable":false,
			},
		],
		
		
		//"bSort" : false,
		
		"pageLength": 10
	});
	


    // details
    $(document).on('click', '.view', function(){
        var id_activite = $(this).attr("id");
        var btn_action = 'activite_details';
        $.ajax({
            url:"activite_action.php",
            method:"POST",
            data:{id_activite:id_activite, btn_action:btn_action},
            success:function(data){
                $('#activitedetailsModal').modal('show');
                $('#activite_details').html(data);
            }
        })
    });

    //desactivation et activation
	$(document).on('click', '.delete', function(){
		var id_activite = $(this).attr('id');
		var status = $(this).data("status");
		var btn_action = 'delete';
		
		swal({					
			title: 'Changement du statut !',
			text: "Souhaitez-vous changer le statut de l'activité de la maintenance ?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonClass: 'btn btn-success',
			cancelButtonClass: 'btn btn-danger',
			confirmButtonText: 'Oui, je le veux',
			cancelButtonText: 'Annuler',
			buttonsStyling: false
			
		}).then(function() {	// Lorsque l'utilisateur clique sur Oui pour valider le changement !
		
			$.ajax({
				url:"activite_action.php",
				method:"POST",
				data:{id_activite:id_activite, status:status, btn_action:btn_action},
				success:function(data)
				{				
					swal({
						title: 'Effectué !',
						text: data,
						type: 'success',
						confirmButtonClass: "btn btn-success",
						buttonsStyling: false
					});				
					activitedataTable.ajax.reload();
				}
			});		
		});
		
		
	});

	
});

</script>


<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/tables/datatables.net.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Mar 2017 21:34:01 GMT -->
</html>