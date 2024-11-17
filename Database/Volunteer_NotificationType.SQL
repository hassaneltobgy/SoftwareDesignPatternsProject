CREATE TABLE Volunteer_NotificationType (
    VolunteerID INT,
    NotificationTypeID INT,
    PRIMARY KEY (VolunteerID, NotificationTypeID),
    FOREIGN KEY (VolunteerID) REFERENCES Volunteer(VolunteerID),
    FOREIGN KEY (NotificationTypeID) REFERENCES NotificationType(NotificationTypeID)
);