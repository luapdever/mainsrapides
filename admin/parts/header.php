<?php

if(empty($pageTitle)) {
    $pageTitle = "Breeding - Page";
}

?>

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><?php echo $pageTitle; ?></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
            <li class="breadcrumb-item active"><?php echo $pageTitle; ?></li>
        </ol>
    </div>
</div>