CREATE TABLE Volunteer_Location (
    VolunteerID INT,
    LocationID INT,
    PRIMARY KEY (VolunteerID, LocationID),
    FOREIGN KEY (VolunteerID) REFERENCES Volunteer(VolunteerID),
    FOREIGN KEY (LocationID) REFERENCES Location(AddressID)
);