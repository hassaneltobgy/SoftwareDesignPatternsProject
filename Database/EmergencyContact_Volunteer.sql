CREATE TABLE EmergencyContact_Volunteer (
    EmergencyContactID INT NOT NULL,
    VolunteerID INT NOT NULL,
    PRIMARY KEY (EmergencyContactID, VolunteerID),
    FOREIGN KEY (EmergencyContactID) REFERENCES EmergencyContact(EmergencyContactID) ON DELETE CASCADE,
    FOREIGN KEY (VolunteerID) REFERENCES Volunteer(VolunteerID) ON DELETE CASCADE
);