CREATE TABLE VolunteerHistory(
    VolunteerHistoryID INT PRIMARY KEY AUTO_INCREMENT,  -- Unique identifier for each volunteer history
    StartDate DATE NOT NULL,                           -- Volunteer history start date
    EndDate DATE,                                      -- Volunteer history end date
    
    -- one volunteer history can have 1 event and event can be in many volunteer history
    EventID INT NOT NULL,                              -- Volunteer history event id
    FOREIGN KEY (EventID) REFERENCES Event(EventID) ON DELETE CASCADE
);