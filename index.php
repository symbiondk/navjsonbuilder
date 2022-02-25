<?php
require_once 'functions.php';

function renderMenuItem($row)
{
    $HTML_output = '';
    $id = $row['id'];
    $label = $row['label'];
    $url = $row['url'];
    $icon = (empty($row['icon'])) ? '' : $row['icon'];

    $HTML_output .= '<li class="dd-item dd3-item" data-id="' . $id . '" data-label="' . $label . '" data-url="' . $url . '" data-icon="' . $icon . '">' .
        '<div class="dd-handle dd3-handle" > Drag</div>' .
        '<div class="dd3-content"><span>' . $label . '</span>' .
        '<div class="item-edit">Edit</div>' .
        '</div>' .
        '<div class="item-settings d-none">' .
        '<p><label for="">Navigation Label<br><input type="text" name="navigation_label" value="' . $label . '"></label></p>' .
        '<p><label for="">Navigation Url<br><input type="text" name="navigation_url" value="' . $url . '"></label></p>' .
        '<p><label for="">Icon<br><input type="text" name="navigation_icon" value="' . $icon . '"></label></p>' .
        '<p><a class="item-delete" href="javascript:;">Remove</a> |' .
        '<a class="item-close" href="javascript:;">Close</a></p>' .
        '</div>';

         if(!empty($row['children'])){
            $HTML_output .= '<ol class="dd-list">';
                foreach ($row['children'] as $key => $row_child) {
                    $HTML_output .= renderMenuItem($row_child);
                }
            $HTML_output .= '</ol>';
         }

        $HTML_output .= '</li>';


    return $HTML_output;
}

function menuTree() {
    $items = '';

    $items .= '<ol class="dd-list">';
    $result = getNav();
    foreach ($result as $row) {
        $items .= renderMenuItem($row);
    }
    $items .= '</ol>';

    return $items;
}

?>

<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Nav builder (beta)</title>
    <link rel="stylesheet" href="css/jquery.nestable.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="inc/fontawesome-iconpicker/css/fontawesome-iconpicker.min.css">
    <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container mt-3">

    <h1>Nav JSON builder</h1>
    <div class="row">
        

        <div class="col-8">

            <div class="dd mb-5" id="nestable">
                <?php
                    $html_menu = menuTree();
                    echo (empty($html_menu)) ? '<ol class="dd-list"></ol>' : $html_menu;
                ?>
            </div>


            <form class="mb-3" action="menu.php" method="post">
                <input type="hidden" id="nestable-output" name="menu">
                <button class="btn btn-success" type="submit">Save Menu</button>
            </form>
            <a class="text-success small" target="_blank" href="nav.json">View JSON</a>

        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5>New nav item</h5>
                    <form id="add-item">
                        <input class="form-control mb-3 col-md-3"  type="text" name="name" placeholder="Label">
                        <input class="form-control mb-3 col-md-3"  type="text" name="url" placeholder="Url">
                        <input class="form-control mb-3 col-md-3 icp"  type="text" name="icon" placeholder="Icon">

                        <button class="btn btn-primary" type="submit">Add Nav Item</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/jquery.nestable.js"></script>
    <script src="inc/fontawesome-iconpicker/js/fontawesome-iconpicker.min.js"></script>

    <script src="js/script.js"></script>
    <script>
        $('.icp').iconpicker();
    </script>
</body>

</html>