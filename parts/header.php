<!-- start .mainmenu_area -->
<div class="mainmenu">

    <?php if(isset($_SESSION["id"])): ?>
    <div class="container">
        <!-- start .row-->
        <div class="row">
            <!-- start .col-md-12 -->
            <div class="col-md-12">
                <div class="navbar-header">
                    <!-- start mainmenu__search -->
                    <div class="mainmenu__search">
                        <form action="#">
                            <div class="searc-wrap">
                                <input type="text" placeholder="Search product">
                                <button type="submit" class="search-wrap__btn">
                                    <span class="lnr lnr-magnifier"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- start mainmenu__search -->
                </div>

                <nav class="navbar navbar-expand-md navbar-light mainmenu__menu">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li>
                                <a href="index.php">Accueil</a>
                            </li>
                            <li>
                                <a href="missions.php">Consulter les missions</a>
                            </li>
                            <?php if(count_annonces($_SESSION["id"]) > 0): ?>
                            <li>
                                <a href="annonces_list.php">Mes annonces 
                                    <span class="btn btn--sm btn-primary"><?= count_annonces($_SESSION["id"]) ?></span>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </nav>
            </div>
            <!-- end /.col-md-12 -->
        </div>
        <!-- end /.row-->
    </div>
    <?php else: ?>
    <div class="container-fluid p-4 text-center hide-down">
        <!-- start .row-->
        <div class="row">
            <div class="col">
                <a href="/categorie/" class="text-dark">
                    <h6 style="font-size: 12px">Jardin et extérieur</h6>
                </a>
            </div>            
            <div class="col">
                <a href="/categorie/" class="text-dark">
                    <h6 style="font-size: 12px">Petits travaux</h6>
                </a>
            </div>            
            <div class="col">
                <a href="/categorie/" class="text-dark">
                    <h6 style="font-size: 12px">Electricité et éclairage</h6>
                </a>
            </div>            
            <div class="col">
                <a href="/categorie/" class="text-dark">
                    <h6 style="font-size: 12px">Maison connectée & confort</h6>
                </a>
            </div>            
            <div class="col">
                <a href="/categorie/" class="text-dark">
                    <h6 style="font-size: 12px">Plomberie, cuisine et salle de bain</h6>
                </a>
            </div>            
            <div class="col">
                <a href="/categorie/" class="text-dark">
                    <h6 style="font-size: 12px">Peinture, sol et mur</h6>
                </a>
            </div>            
            <div class="col">
                <a href="/categorie/" class="text-dark">
                    <h6 style="font-size: 12px">Services généraux</h6>
                </a>
            </div>            
        </div>
        <!-- end /.row-->
    </div>
    <?php endif; ?>
</div>
<!-- end /.mainmenu-->