CREATE TABLE OrganizeEvent(
    OrganizeEventID INT PRIMARY KEY AUTO_INCREMENT,
    Date DATE,
    Time TIME,
    OrganizationID INT,
    FOREIGN KEY (OrganizationID) REFERENCES Organization(OrganizationID)
    
)