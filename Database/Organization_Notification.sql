CREATE TABLE Organization_Notification (
    OrganizationNotificationID INT PRIMARY KEY AUTO_INCREMENT,
    OrganizationID INT,
    NotificationID INT,
    FOREIGN KEY (OrganizationID) REFERENCES Organization(OrganizationID),
    FOREIGN KEY (NotificationID) REFERENCES Notification(NotificationID)
);