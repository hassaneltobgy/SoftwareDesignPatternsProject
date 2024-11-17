CREATE TABLE VolunteerFeedback (
    FeedbackID INT PRIMARY KEY AUTO_INCREMENT,
    Comments TEXT,
    FeedbackDate DATE,
    Rating INT,
    FeedbackTimestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
