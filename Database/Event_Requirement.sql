CREATE TABLE Event_Requirement (
    EventID INT NOT NULL,  -- Unique identifier for each event requirement
    EventRequirementID INT NOT NULL,  -- Unique identifier for each event requirement
    PRIMARY KEY (EventID, EventRequirementID),
    FOREIGN KEY (EventID) REFERENCES Event(EventID),
    FOREIGN KEY (EventRequirementID) REFERENCES Requirement(RequirementID)
);