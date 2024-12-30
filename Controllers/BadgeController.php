<?php
require_once '../Models/BadgeDecorator.php';

class BadgeController {
    public function __construct() {
    }

    public function get_all_Badges() {
        return VolunteerBadge::get_all_badges();
    }
}

?>