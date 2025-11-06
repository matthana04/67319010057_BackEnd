<?php
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function is_seller() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'seller';
}

function redirect($url) {
    header("Location: $url");
    exit;
}
?>
