CREATE TABLE Event_EventType (
    EventID INT,
    EventTypeID INT,
    PRIMARY KEY (EventID, EventTypeID),
    FOREIGN KEY (EventID) REFERENCES Event(EventID) ON DELETE CASCADE,
    FOREIGN KEY (EventTypeID) REFERENCES EventType(EventTypeID) ON DELETE CASCADE
);