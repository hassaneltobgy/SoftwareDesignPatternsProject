<?php
require_once 'VolunteerModel.php';
require_once 'AdminModel.php';
// Interface that both the RealAdmin and AdminProxy will implement
interface IAdmin {
    public function assignBadge(int $volunteerId, string $badgeType): void;
    public function updateBadge(int $volunteerId, string $oldBadge, string $newBadge): void;
    public function removeBadge(int $volunteerId, string $badgeType): void;
    public function getVolunteerBadges(int $volunteerId): array;
}

// Enum-like class for different badge types
class BadgeType {
    const STARTER = 'STARTER';
    const VOLUNTEER = 'VOLUNTEER';
    const ADVANCED = 'ADVANCED';
    const EXPERT = 'EXPERT';
    const MASTER = 'MASTER';
    const LEADER = 'LEADER';
}

// The real admin class that does the actual work
class RealAdmin implements IAdmin {
    private $volunteerBadges;

    public function __construct() {
        $this->volunteerBadges = [];
    }

    public function assignBadge(int $volunteerId, string $badgeType): void {
        if (!isset($this->volunteerBadges[$volunteerId])) {
            $this->volunteerBadges[$volunteerId] = [];
        }
        $this->volunteerBadges[$volunteerId][] = $badgeType;
        $this->updateBadgeDecorator($volunteerId, $badgeType);
    }

    public function updateBadge(int $volunteerId, string $oldBadge, string $newBadge): void {
        if (isset($this->volunteerBadges[$volunteerId])) {
            $index = array_search($oldBadge, $this->volunteerBadges[$volunteerId]);
            if ($index !== false) {
                $this->volunteerBadges[$volunteerId][$index] = $newBadge;
                $this->updateBadgeDecorator($volunteerId, $newBadge);
            }
        }
    }

    public function removeBadge(int $volunteerId, string $badgeType): void {
        if (isset($this->volunteerBadges[$volunteerId])) {
            $this->volunteerBadges[$volunteerId] = array_diff($this->volunteerBadges[$volunteerId], [$badgeType]);
        }
    }

    public function getVolunteerBadges(int $volunteerId): array {
        return $this->volunteerBadges[$volunteerId] ?? [];
    }

    private function updateBadgeDecorator(int $volunteerId, string $badgeType): void {
        $decorator = null;
        switch ($badgeType) {
            case BadgeType::STARTER:
                $decorator = new StarterBadge();
                break;
            case BadgeType::VOLUNTEER:
                $decorator = new VolunteerBadge();
                break;
            case BadgeType::ADVANCED:
                $decorator = new AdvancedBadgeDecorator(new VolunteerBadge());
                break;
            case BadgeType::EXPERT:
                $decorator = new ExpertBadgeDecorator(new VolunteerBadge());
                break;
            case BadgeType::MASTER:
                $decorator = new MasterBadgeDecorator(new VolunteerBadge());
                break;
            case BadgeType::LEADER:
                $decorator = new LeaderBadgeDecorator(new VolunteerBadge());
                break;
            default:
                throw new InvalidArgumentException("Invalid badge type");
        }
        $decorator->updateBadgeInDb();
    }
}

// The proxy class that adds security checks
class AdminProxy implements IAdmin {
    private $realAdmin;
    private $adminModel;

    public function __construct() {
        $this->realAdmin = new RealAdmin();
        $this->adminModel = new AdminModel();
    }

    private function checkAdminPrivileges(int $adminId): bool {
        $context = new PrivilegeContext();
        return $this->adminModel->executeGetPrivilege($context, $adminId) !== null;
    }

    public function assignBadge(int $volunteerId, string $badgeType): void {
        $adminId = $this->getCurrentAdminId();

        if ($this->checkAdminPrivileges($adminId)) {
            $this->realAdmin->assignBadge($volunteerId, $badgeType);
        } else {
            throw new Exception("Insufficient privileges to assign badges");
        }
    }

    public function updateBadge(int $volunteerId, string $oldBadge, string $newBadge): void {
        $adminId = $this->getCurrentAdminId();

        if ($this->checkAdminPrivileges($adminId)) {
            $this->realAdmin->updateBadge($volunteerId, $oldBadge, $newBadge);
        } else {
            throw new Exception("Insufficient privileges to update badges");
        }
    }

    public function removeBadge(int $volunteerId, string $badgeType): void {
        $adminId = $this->getCurrentAdminId();

        if ($this->checkAdminPrivileges($adminId)) {
            $this->realAdmin->removeBadge($volunteerId, $badgeType);
        } else {
            throw new Exception("Insufficient privileges to remove badges");
        }
    }

    public function getVolunteerBadges(int $volunteerId): array {
        return $this->realAdmin->getVolunteerBadges($volunteerId);
    }

    private function getCurrentAdminId(): int {
        // Placeholder for real session logic
        return 1;
    }
}

// Example usage
try {
    $admin = new AdminProxy();

    // Assign a starter badge to volunteer
    $admin->assignBadge(1001, BadgeType::STARTER);

    // Upgrade to volunteer badge
    $admin->updateBadge(1001, BadgeType::STARTER, BadgeType::VOLUNTEER);

    // Get all badges for volunteer
    $badges = $admin->getVolunteerBadges(1001);
    echo "Volunteer badges: " . implode(", ", $badges) . PHP_EOL;

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}

// Badge Decorator interfaces and implementations
interface BadgeDecorator {
    public function updateBadgeInDb(): void;
}

class StarterBadge implements BadgeDecorator {
    public function updateBadgeInDb(): void {
        echo "Starter badge updated in DB." . PHP_EOL;
    }
}

class VolunteerBadge implements BadgeDecorator {
    public function updateBadgeInDb(): void {
        echo "Volunteer badge updated in DB." . PHP_EOL;
    }
}

class AdvancedBadgeDecorator implements BadgeDecorator {
    private $badge;

    public function __construct(BadgeDecorator $badge) {
        $this->badge = $badge;
    }

    public function updateBadgeInDb(): void {
        $this->badge->updateBadgeInDb();
        echo "Advanced badge updated in DB." . PHP_EOL;
    }
}
