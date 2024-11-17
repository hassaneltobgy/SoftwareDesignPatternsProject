CREATE TABLE OrganizeDetails(
    OrganizeDetailsID INT PRIMARY KEY AUTO_INCREMENT,
    OrganizeEventId INT,
    FOREIGN KEY (OrganizeEventId) REFERENCES OrganizeEvent(OrganizeEventID),
    EventID INT,
    FOREIGN KEY (EventID) REFERENCES Event(EventID)
)