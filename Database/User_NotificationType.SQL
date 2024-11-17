CREATE TABLE User_NotificationType (
    UserID INT,
    NotificationTypeID INT,
    PRIMARY KEY (UserID, NotificationTypeID),
    FOREIGN KEY (UserID) REFERENCES User(UserID),
    FOREIGN KEY (NotificationTypeID) REFERENCES NotificationType(NotificationTypeID)
);
