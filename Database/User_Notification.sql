CREATE TABLE User_Notification (
    UserNotificationID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    NotificationID INT,
    FOREIGN KEY (UserID) REFERENCES User(UserID),
    FOREIGN KEY (NotificationID) REFERENCES Notification(NotificationID)
);