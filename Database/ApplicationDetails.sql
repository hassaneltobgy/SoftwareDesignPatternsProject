CREATE TABLE ApplicationDetails(
    ApplicationDetailsID INT PRIMARY KEY AUTO_INCREMENT,
    ApplicationDate DATE,

    EventID INT,
    FOREIGN KEY (EventID) REFERENCES Event(EventID),
    ApplicationStatusID INT,
    FOREIGN KEY (ApplicationStatusID) REFERENCES ApplicationStatus(ApplicationStatusID),
    ApplyForEventID INT,
    FOREIGN KEY (ApplyForEventID) REFERENCES ApplyForEvent(Id)
);