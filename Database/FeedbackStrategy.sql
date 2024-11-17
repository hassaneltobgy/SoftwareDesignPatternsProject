-- Strategy table for defining feedback submission strategies
CREATE TABLE SubmitFeedbackStrategy (
    SubmitFeedbackStrategyID INT PRIMARY KEY AUTO_INCREMENT,
    strategy_name VARCHAR(100)  -- Name of the strategy, e.g., "EventFeedback", "VolunteerFeedback"
);

-- Context table to hold the context and associate it with a specific strategy
CREATE TABLE SubmitFeedbackContext (
    SubmitFeedbackContextID INT PRIMARY KEY AUTO_INCREMENT,
    SubmitFeedbackStrategyID INT,
    FOREIGN KEY (SubmitFeedbackStrategyID) REFERENCES SubmitFeedbackStrategy(SubmitFeedbackStrategyID)
);

-- Table for event-related feedback
CREATE TABLE SubmitEventFeedback (
    SubmitEventFeedbackID INT PRIMARY KEY AUTO_INCREMENT,
    FeedbackID INT,
    EventID INT,
    FOREIGN KEY (FeedbackID) REFERENCES Feedback(FeedbackID),
    FOREIGN KEY (EventID) REFERENCES Event(EventID)
);

-- Table for volunteer-specific feedback
CREATE TABLE SubmitVolunteerFeedback (
    SubmitVolunteerFeedbackID INT PRIMARY KEY AUTO_INCREMENT,
    FeedbackID INT,
    VolunteerID INT,
    FOREIGN KEY (FeedbackID) REFERENCES Feedback(FeedbackID),
    FOREIGN KEY (VolunteerID) REFERENCES Volunteer(VolunteerID)
);
