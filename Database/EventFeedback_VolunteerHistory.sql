CREATE TABLE EventFeedback_VolunteerHistory (
    FeedbackID INT,
    VolunteerHistoryID INT,
    PRIMARY KEY (FeedbackID, VolunteerHistoryID),
    FOREIGN KEY (FeedbackID) REFERENCES EventFeedback(FeedbackID) ON DELETE CASCADE,
    FOREIGN KEY (VolunteerHistoryID) REFERENCES VolunteerHistory(VolunteerHistoryID) ON DELETE CASCADE
);