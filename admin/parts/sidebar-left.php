        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile" style="background: url(../assets/images/background/user-info.jpg) no-repeat;">
                    <!-- User profile image -->
                    <div class="p-t-20 p-l-10 p-b-30">
                        <img class="avatar" src="..<?php echo htmlspecialchars($_SESSION['photo']); ?>"  alt="user" />
                    </div>
                    <!-- User profile text-->
                    <div class="profile-text"> <a href="../user/user-profile.php" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?php echo htmlspecialchars($_SESSION['prenom'] . ' ' . $_SESSION['nom']); ?></a>
                        <div class="dropdown-menu animated flipInY">
                            <a href="../user/user-profile.php" class="dropdown-item"><i class="ti-user"></i> Mon profil</a>
                            <div class="dropdown-divider"></div> <a href="../deconnexion.php" class="dropdown-item"><i class="fa fa-power-off"></i> Deconnexion</a>
                        </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">MENU</li>
                        <li>
                            <a class="waves-effect waves-dark" href="../tb/tb.php" aria-expanded="false">
                                <i class="mdi mdi-gauge"></i>
                                <span class="hide-menu">Tableau de Bord </span>
                            </a>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="../categorie/categorie.php" aria-expanded="false">
                                <i class="mdi mdi-arrange-send-backward"></i>
                                <span class="hide-menu">Catégorie</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="../categorie/categorie.php">Toutes les catégories</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="../subcategorie/subcategorie.php" aria-expanded="false">
                                <i class="mdi mdi-arrange-send-backward"></i>
                                <span class="hide-menu">Sous-catégorie</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="../subcategorie/subcategorie.php">Toutes les sous-catégories</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="../travail/travail.php" aria-expanded="false">
                                <i class="mdi mdi-arrange-send-backward"></i>
                                <span class="hide-menu">Travaux</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="../travail/travail.php">Tous les travaux</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="../annonce/annonce.php" aria-expanded="false">
                                <i class="mdi mdi-arrange-send-backward"></i>
                                <span class="hide-menu">Annonces</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="../annonce/annonce.php">Toutes les annonces</a></li>
                                <!-- <li><a href="../annonce/annonce-add.php">Ajouter</a></li> -->
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="../paiement/paiement.php" aria-expanded="false">
                                <i class="mdi mdi-arrange-send-backward"></i>
                                <span class="hide-menu">Paiements</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="../paiement/paiement.php">Tous les paiements</a></li>
                                <!-- <li><a href="../paiement/paiement-add.php">Ajouter</a></li> -->
                            </ul>
                        </li>
                        <?php if($_SESSION['role'] > 2): ?>
                            <li>
                                <a class="has-arrow waves-effect waves-dark" href="../user/user.php" aria-expanded="false">
                                    <i class="mdi mdi-arrange-send-backward"></i>
                                    <span class="hide-menu">Utilisateurs</span>
                                </a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="../user/user.php">Tous les utilisateurs</a></li>
                                    <li><a href="../user/user-add.php">Ajouter</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <!-- item-->
                <a href="../deconnexion.php" class="link" data-toggle="tooltip" title="Deconnexion"><i class="mdi mdi-power"></i></a>
            </div>
            <!-- End Bottom points-->
        </aside>