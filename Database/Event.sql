CREATE TABLE Event (
    EventID INT PRIMARY KEY AUTO_INCREMENT,
    EventName VARCHAR(255),
    EventDate DATE,
    EventLocationID INT,
    FOREIGN KEY (EventLocationID) REFERENCES Location(AddressID),
    EventDescription TEXT
);