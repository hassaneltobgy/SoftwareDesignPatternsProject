CREATE TABLE user_notifications (
    user_id INT,
    notification_id INT,
    PRIMARY KEY (user_id, notification_id),
    FOREIGN KEY (user_id) REFERENCES User(UserID) ON DELETE CASCADE, 
    FOREIGN KEY (notification_id) REFERENCES notification(notificationid) ON DELETE CASCADE 
);
