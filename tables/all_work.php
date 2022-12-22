<?php 

include('../AddLogInclude.php');

include('../database_connection.php');
include("../scripts_php/fonctions_sql.php");

$output = '';

$tablist = '';
$tabcontent = '';

$categories = all_categorie($connect);

$i = 0;
foreach ($categories as $key => $categorie) {
    $tablist .= '
        <li>
            <a href="#category' . $categorie["id"] . '" class="'. ($i===0 ? 'active' : '') . '" aria-controls="category' . $categorie["id"] . '" role="tab" data-toggle="tab" aria-expanded="true" aria-selected="true">
                ' . $categorie["label"] . '
            </a>
        </li>
    ';

    $tabcontent .= '

        <div role="tabpanel" class="fade tab-pane product-tab '. ($i===0 ? 'active show' : '') . '" id="category' . $categorie["id"] . '">
            <div class="tab-content-wrapper">
                <div class="row">
    ';

    foreach ($categorie["subcategories"] as $key1 => $subcategorie) {
        $tabcontent .= '
                    <div class="col-lg-3">
                        <div class="product product--card product--card3">
                            <div class="product__thumbnail" id="c_works_of_' . $subcategorie["id"] . '" class="dropdown-toggle btn btn--bordered btn-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="./' . $subcategorie["photo"] . '" alt="Product Image">
                                <div class="prod_btn">
                                    <a href="#" class="transparent btn--sm btn--round">
                                        <span class="lnr lnr-arrow-down"></span>
                                    </a>
                                </div>
                                <!-- end /.prod_btn -->
                            </div>
                            <div class="product-desc">
                                <h3>' . $subcategorie["label"] . '</h3>
                            </div>
                            <div class="category-works">
                                <ul class="custom_dropdown dropdown-menu" aria-labelledby="c_works_of_' . $subcategorie["id"] . '">
        ';
        $i++;

        foreach ($subcategorie["travaux"] as $key2 => $work) {
            $tabcontent .= '
                                    <li>
                                        <a href="annonce_add.php?work_id=' . $work["id"] . '">' . $work["label"] . '</a>
                                    </li>
            ';
        }

        $tabcontent .= '
                                </ul>
                            </div>
                        </div>
                    </div>
        ';
    }
    $tabcontent .= '
                </div>
            </div>
        </div>
    ';
}

$output .= '

<div class="tab tab1">
    <div class="item-navigation">
        <ul class="nav nav-tabs" role="tablist">
            ' . $tablist . '
        </ul>
    </div>

    <div class="tab-content">
        ' . $tabcontent . '
    </div>
</div>

';


echo json_encode($output);

?>

