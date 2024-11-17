CREATE TABLE Volunteer_Privilege (
    VolunteerID INT PRIMARY KEY AUTO_INCREMENT,  -- Unique identifier for each volunteer
    Volunteer_PrivilegeID INT,                   -- Unique identifier for each volunteer privilege
    FOREIGN KEY (VolunteerID) REFERENCES Volunteer(VolunteerID),
    FOREIGN KEY (Volunteer_PrivilegeID) REFERENCES Privilege(PrivilegeID)
);