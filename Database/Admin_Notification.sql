CREATE TABLE Admin_Notification (
    AdminNotificationID INT PRIMARY KEY AUTO_INCREMENT,
    AdminID INT,
    NotificationID INT,
    FOREIGN KEY (AdminID) REFERENCES Admin(AdminID),
    FOREIGN KEY (NotificationID) REFERENCES Notification(NotificationID)
);