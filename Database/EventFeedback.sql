CREATE TABLE EventFeedback (
    FeedbackID INT PRIMARY KEY AUTO_INCREMENT,
    Comments TEXT,
    FeedbackDate DATE,
    Rating INT,
    FeedbackTimeStamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    EventID INT,
    FOREIGN KEY (EventID) REFERENCES Event(EventID)
);