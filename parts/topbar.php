<!-- start .top-menu-area -->
<div id="topbar" class="top-menu-area ">
    <!-- start .container -->
    <div class="container-fluid pl-5 pr-5">
        <!-- start .row -->
        <div class="row">
            <!-- start .col-md-3 -->
            <div class="col-lg-4 col-md-4 col-6 v_middle">
                <div class="logo">
                    <a href="index.php">
                        <img src="assets/img/logo.jpeg" alt="logo image" class="img-fluid" width="300">
                    </a>
                    <a href="missions.php" class="ml-5 text-dark hide-down">
                        <span>
                            <i class="fa fa-search"></i> Consulter les missions
                        </span>
                    </a>
                </div>
            </div>
            <!-- end /.col-md-3 -->

            <!-- start .col-md-5 -->
            <div class="col-lg-7 offset-lg-1 col-md-7 col-6 v_middle">
                <!-- start .author-area -->
                <div class="author-area">

                    <?php if(!isset($_SESSION["email"])): ?>
                    <div class="author-area not_logged_in">
                        <div class="author__notification_area">
                            <ul>
                                <li>
                                    <a href="inscription.php" class="icon_wrap text-dark">
                                        <span>S'inscrire</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="connexion.php" class="icon_wrap text-dark">
                                        <span>Se connecter</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="pull-right join">
                            <a href="inscription.php" class="btn btn--xs">Proposer mes services</a>
                        </div>
                    </div>

                    <?php else: ?>
                    <div class="author__notification_area">
                        <ul>
                            <li class="has_dropdown">
                                <div class="icon_wrap">
                                    <span class="lnr lnr-alarm"></span>
                                    <span id="count_notif">
                                        
                                    </span>
                                </div>

                                <div class="dropdowns notification--dropdown">

                                    <div class="dropdown_module_header">
                                        <h4>Mes Notifications</h4>
                                    </div>

                                    <div class="notifications_module" id="notifications_list">
                                        
                                    </div>
                                </div>
                            </li>
                            <li class="has_dropdown">
                                <div class="icon_wrap">
                                    <span class="lnr lnr-envelope"></span>
                                    <span id="count_msg">

                                    </span>
                                </div>

                                <div class="dropdowns messaging--dropdown">
                                    <div class="dropdown_module_header">
                                        <h4>Mes Messages</h4>
                                        <a href="messages.php">Tout voir</a>
                                    </div>

                                    <div class="messages" id="messages_list">
                                        
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--start .author__notification_area -->

                    <!--start .author-author__info-->
                    <div class="author-author__info inline has_dropdown">
                        <div class="author__avatar">
                            <?php if(!is_null($_SESSION["photo"])): ?>
                                <img src=".<?= $_SESSION["photo"] ?>" alt="user avatar" class="img-responsive img-thumbnail" width="60" />
                            <?php else: ?>
                                <img src="images/usr_avatar.png" alt="user avatar">
                            <?php endif; ?>

                        </div>
                        <div class="autor__info">
                            <p class="name">
                                <? echo $_SESSION['prenom'] . ' ' . $_SESSION['nom'] ?>
                            </p>
                            <p class="ammount text-capitalize">
                                <?= get_role($_SESSION["role"])["label"] ?>
                            </p>
                        </div>

                        <div class="dropdowns dropdown--author">
                            <ul>
                                <li>
                                    <a href="profile.php">
                                        <span class="lnr lnr-user"></span>Profile</a>
                                </li>
                                <li>
                                    <a href="tableau-de-bord.php">
                                        <span class="lnr lnr-home"></span> Tableau de bord</a>
                                </li>
                                <li>
                                    <a href="profile-info.php">
                                        <span class="lnr lnr-cog"></span> Mes informations</a>
                                </li>
                                <li>
                                    <a href="profile-adress">
                                        <span class="lnr lnr-cart"></span>Mes coordonnées</a>
                                </li>
                                <li>
                                    <a href="messages.php">
                                        <span class="lnr lnr-heart"></span> Ma messagerie</a>
                                </li>
                                <li>
                                    <a href="parainages.php">
                                        <span class="lnr lnr-dice"></span>Mes parainages</a>
                                </li>
                                <li>
                                    <a href="deconnexion.php">
                                        <span class="lnr lnr-exit"></span>Deconnexion</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--end /.author-author__info-->
                </div>
                <!-- end .author-area -->

                <!-- author area restructured for mobile -->
                <div class="mobile_content ">
                    <span class="lnr lnr-user menu_icon"></span>

                    <!-- offcanvas menu -->
                    <div class="offcanvas-menu closed">
                        <span class="lnr lnr-cross close_menu"></span>
                        <div class="author-author__info">
                            <div class="author__avatar v_middle">
                                <img src="images/usr_avatar.png" alt="user avatar">
                            </div>
                            <div class="autor__info v_middle">
                                <p class="name">
                                    Jhon Doe
                                </p>
                                <p class="ammount">$20.45</p>
                            </div>
                        </div>
                        <!--end /.author-author__info-->

                        <div class="author__notification_area">
                            <ul>
                                <li>
                                    <a href="notification.html">
                                        <div class="icon_wrap">
                                            <span class="lnr lnr-alarm"></span>
                                            <span class="notification_count noti">25</span>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="messages.php">
                                        <div class="icon_wrap">
                                            <span class="lnr lnr-envelope"></span>
                                            <span class="notification_count msg">6</span>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="cart.html">
                                        <div class="icon_wrap">
                                            <span class="lnr lnr-cart"></span>
                                            <span class="notification_count purch">2</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!--start .author__notification_area -->

                        <div class="dropdowns dropdown--author">
                            <ul>
                                <li>
                                    <a href="author.html">
                                        <span class="lnr lnr-user"></span>Profile</a>
                                </li>
                                <li>
                                    <a href="dashboard.html">
                                        <span class="lnr lnr-home"></span> Dashboard</a>
                                </li>
                                <li>
                                    <a href="dashboard-setting.html">
                                        <span class="lnr lnr-cog"></span> Setting</a>
                                </li>
                                <li>
                                    <a href="cart.html">
                                        <span class="lnr lnr-cart"></span>Purchases</a>
                                </li>
                                <li>
                                    <a href="favourites.html">
                                        <span class="lnr lnr-heart"></span> Favourite</a>
                                </li>
                                <li>
                                    <a href="dashboard-add-credit.html">
                                        <span class="lnr lnr-dice"></span>Add Credits</a>
                                </li>
                                <li>
                                    <a href="dashboard-statement.html">
                                        <span class="lnr lnr-chart-bars"></span>Sale Statement</a>
                                </li>
                                <li>
                                    <a href="dashboard-upload.html">
                                        <span class="lnr lnr-upload"></span>Upload Item</a>
                                </li>
                                <li>
                                    <a href="dashboard-manage-item.html">
                                        <span class="lnr lnr-book"></span>Manage Item</a>
                                </li>
                                <li>
                                    <a href="dashboard-withdrawal.html">
                                        <span class="lnr lnr-briefcase"></span>Withdrawals</a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="lnr lnr-exit"></span>Logout</a>
                                </li>
                            </ul>
                        </div>
                        <?php endif; ?>
                        
                    </div>
                </div>
                <!-- end /.mobile_content -->
            </div>
            <!-- end /.col-md-5 -->
        </div>
        <!-- end /.row -->
    </div>
    <!-- end /.container -->
</div>
<div class="topbar-space"></div>

<style>
    #topbar {
        position: fixed;
        top: 0px;
        width: 100%;
        z-index: 10000;
    }
</style>
