CREATE TABLE Notification (
    NotificationID INT PRIMARY KEY AUTO_INCREMENT,
    NotificationMessage VARCHAR(255) NOT NULL,
    NotificationTime DATETIME DEFAULT CURRENT_TIMESTAMP
    NotificationTypeID INT,
    FOREIGN KEY (NotificationTypeID) REFERENCES NotificationType(NotificationTypeID)
);
CREATE TABLE Subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,   -- e.g. "UserRegistered", "PasswordReset", "ApplicationSubmitted"
    description TEXT,            -- Optional: details about the subject/event
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Observers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    observer_type VARCHAR(50),   -- e.g., "NotifyBySMSObserver"
    subject_id INT,              -- Foreign key to Subjects table
    FOREIGN KEY (subject_id) REFERENCES Subjects(id) ON DELETE CASCADE
);
