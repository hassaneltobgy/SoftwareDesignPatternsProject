CREATE TABLE ApplyForEvent(
   Id INT PRIMARY KEY AUTO_INCREMENT,
   Date DATE,
   Time TIME,
    
    VolunteerId INT,
    FOREIGN KEY (VolunteerId) REFERENCES Volunteer(VolunteerID)
)