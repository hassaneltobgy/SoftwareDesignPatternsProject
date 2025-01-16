<?php
class BadgeFactory {
    public static function createBadge($badge_name, $badge_id) {
        // Create the base badge object
        $baseBadge = new StarterBadgeDecorator($badge_id);

        // Return decorated badge based on the badge name
        $badge_name = strtolower($badge_name);
        if ($badge_name === 'leader badge') {
            return new LeaderBadgeDecorator(
                new MasterBadgeDecorator(
                    new ExpertBadgeDecorator(
                        new AdvancedBadgeDecorator($baseBadge)
                    )
                )
            );
                } elseif ($badge_name === 'master badge') {
            return new MasterBadgeDecorator(
                new ExpertBadgeDecorator(
                    new AdvancedBadgeDecorator($baseBadge)
                )
            );
        } elseif ($badge_name === 'expert badge') {
            return new ExpertBadgeDecorator(
                new AdvancedBadgeDecorator($baseBadge)
            );
        } elseif ($badge_name === 'advanced badge') {
            return new AdvancedBadgeDecorator($baseBadge);
        } elseif ($badge_name === 'starter badge') {
            return $baseBadge;
        } else {
            echo "No valid badge found for the name: " . $badge_name;
            return null;
        }
    }
}
?>