CREATE TABLE Organization_Event (
    OrganizationID INT,
    EventID INT,
    PRIMARY KEY (OrganizationID, EventID),
    FOREIGN KEY (OrganizationID) REFERENCES Organization(OrganizationID) ON DELETE CASCADE,
    FOREIGN KEY (EventID) REFERENCES Event(EventID) ON DELETE CASCADE
);