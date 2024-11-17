CREATE TABLE Volunteer_VolunteerHistory (
    VolunteerID INT,
    HistoryID INT,
    PRIMARY KEY (VolunteerID, HistoryID),
    FOREIGN KEY (VolunteerID) REFERENCES Volunteer(VolunteerID) ON DELETE CASCADE,
    FOREIGN KEY (HistoryID) REFERENCES VolunteerHistory(VolunteerHistoryID) ON DELETE CASCADE
);
