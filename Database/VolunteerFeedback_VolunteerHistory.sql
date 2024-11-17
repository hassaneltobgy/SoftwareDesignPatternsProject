CREATE TABLE VolunteerFeedBack_VolunteerHistory (
    FeedbackID INT,
    VolunteerHistoryID INT,
    PRIMARY KEY (FeedbackID, VolunteerHistoryID),
    FOREIGN KEY (FeedbackID) REFERENCES VolunteerFeedback(FeedbackID) ON DELETE CASCADE,
    FOREIGN KEY (VolunteerHistoryID) REFERENCES VolunteerHistory(VolunteerHistoryID) ON DELETE CASCADE
    
);