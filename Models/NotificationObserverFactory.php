<?php


class NotificationObserverFactory {
    public static function createObserver($notificationType, $notificationServiceForOrganization) {
        switch ($notificationType->TypeName) {
            case 'sms':
                return new NotifyBySMSObserver($notificationServiceForOrganization);
            case 'email':
                return new NotifyByEmailObserver($notificationServiceForOrganization);
            case 'push notifications':
                return new NotifyByInAppObserver($notificationServiceForOrganization);
            default:
                throw new Exception("Invalid notification type: " . $notificationType->TypeName);
        }
    }
}

?> 