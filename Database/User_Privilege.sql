CREATE TABLE User_Privilege (
    User_ID INT NOT NULL,  -- Unique identifier for each user
    User_PrivilegeID INT NOT NULL,  -- Unique identifier for each user privilege
    PRIMARY KEY (User_ID, User_PrivilegeID),
    FOREIGN KEY (User_ID) REFERENCES User(UserID),  -- Reference to User table
    FOREIGN KEY (User_PrivilegeID) REFERENCES Privilege(PrivilegeID)  -- Reference to Privilege table
);