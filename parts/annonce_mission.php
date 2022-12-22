<div class="row">
    <div class="col-lg-4">
        <div class="text-center">
            <h2 class="text-danger" style="font-size: 4em; font-weight: bold;">
                <?= count_annonces($_SESSION["id"]) ?>
            </h2>
            <span>Annonce</span><br>
            <a href="annonces_list.php" class="btn btn-danger btn-sm">
                <small>Publiée(s)</small>
            </a>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="text-center">
            <h2 class="text-primary" style="font-size: 4em; font-weight: bold;">
                <?= count_missions_on_way($_SESSION["id"]) ?>
            </h2>
            <span>Mission</span><br>
            <a href="mission_on_way.php" class="btn btn-primary btn-sm">
                <small>En cours</small>
            </a>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="text-center">
            <h2 class="text-success" style="font-size: 4em; font-weight: bold;">
                <?= count_missions_finished($_SESSION["id"]) ?>
            </h2>
            <span>Mission</span><br>
            <a href="mission_finished.php" class="btn btn-success btn-sm">
                <small>Terminée</small>
            </a>
        </div>
    </div>
</div>