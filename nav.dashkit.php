<?php 
/*****************************
 * Template for rendered nav.
 * Include this file via php to load the nav
 * Template description: Dashkit Bootstrap Theme sidebar nav
 *****************************/
require_once __DIR__.'/functions.php';


//Template for nav-item render
function renderNavItem($nav_item) {
    $NavItemHTML = '';

    //Render multilevel nav-item
    if(!empty($nav_item['children'])){
        $NavItemHTML .= 
        '<li class="nav-item">
          <a class="nav-link" href="#item_'.$nav_item['id'].'" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="item_'.$nav_item['id'].'">';
          $NavItemHTML .= (!empty($nav_item['icon'])) ? '<i class="me-1 '.$nav_item['icon'].'"></i>' : '';
          $NavItemHTML .= $nav_item['label'].'</a>

          <div class="collapse " id="item_'.$nav_item['id'].'">
            <ul class="nav nav-sm flex-column">';

            foreach ($nav_item['children'] as $key => $nav_item_child) {
                $NavItemHTML .= renderNavItem($nav_item_child);
            }
            
        $NavItemHTML .= '</ul>
            </div>
        </li>';

    }
    //Render single level nav-item
    else {
        $NavItemHTML = 
        '<li class="nav-item">
          <a class="nav-link" id="item_'.$nav_item['id'].'" href="'.$nav_item['url'].'">';
        $NavItemHTML .= (!empty($nav_item['icon'])) ? '<i class="me-1 '.$nav_item['icon'].'"></i>' : '';
        $NavItemHTML .= $nav_item['label'].'</a>
        </li>';
    }
    return $NavItemHTML;
}

$nav = getNav(); // Load nav data from JSON

//Nav-item HTML output below:
 foreach ($nav as $key => $nav_item) { 
  echo renderNavItem($nav_item); 
} ?> 