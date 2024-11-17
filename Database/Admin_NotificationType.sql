CREATE TABLE Admin_NotificationType (
    AdminID INT,
    NotificationTypeID INT,
    PRIMARY KEY (AdminID, NotificationTypeID),
    FOREIGN KEY (AdminID) REFERENCES Admin(AdminID),
    FOREIGN KEY (NotificationTypeID) REFERENCES NotificationType(NotificationTypeID)
);