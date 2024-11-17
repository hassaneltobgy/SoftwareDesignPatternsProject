CREATE TABLE Volunteer_Notification (
    VolunteerNotificationID INT PRIMARY KEY AUTO_INCREMENT,
    VolunteerID INT,
    NotificationID INT,
    FOREIGN KEY (VolunteerID) REFERENCES Volunteer(VolunteerID),
    FOREIGN KEY (NotificationID) REFERENCES Notification(NotificationID)
);