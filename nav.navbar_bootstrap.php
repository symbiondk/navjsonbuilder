<?php 
/*****************************
 * Template for rendered nav.
 * Include this file via php to load the nav
 * Template description: Standard Bootstrap 5 navbar template
 *****************************/
require_once __DIR__.'/functions.php';

//Template for nav-item render
function renderNavItem($nav_item) {
    $NavItemHTML = '';

    //Render dropdown node
    if(!empty($nav_item['children'])){
        $NavItemHTML .= 
        '<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="item_'.$nav_item['id'].'" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">';
          $NavItemHTML .= (!empty($nav_item['icon'])) ? '<i class="me-1 '.$nav_item['icon'].'"></i>' : '';
          $NavItemHTML .= $nav_item['label'].'</a>
          <ul class="dropdown-menu" aria-labelledby="item_'.$nav_item['id'].'">';

            foreach ($nav_item['children'] as $key => $nav_item_child) {
                $NavItemHTML .= renderNavItem($nav_item_child);
            }
            
        $NavItemHTML .= '</ul>
        </li>';

    }
    //Render single node
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