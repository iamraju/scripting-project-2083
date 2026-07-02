<?php
// Define any custom functions for the application here
function get_site_title($pageTitle = "") {
    return ($pageTitle ?  $pageTitle . ' - ' : '') . SITE_NAME;
}

function get_current_page() {
    return basename($_SERVER['SCRIPT_NAME']);
}

function get_menu_item_class(string $menuItemLink) {
    return get_current_page() === basename($menuItemLink) ? 'active' : '';
}

function get_menu_items() {
    global $mainMenuItems;
    return $mainMenuItems;
}