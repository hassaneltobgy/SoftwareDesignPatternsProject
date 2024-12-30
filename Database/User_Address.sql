CREATE TABLE User_Address (
    UserID INT,
    AddressID INT,
    PRIMARY KEY (UserID, AddressID),
    FOREIGN KEY (UserID) REFERENCES User(UserID) ON DELETE CASCADE,
    FOREIGN KEY (AddressID) REFERENCES Location(AddressID) ON DELETE CASCADE
);