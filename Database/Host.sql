CREATE TABLE Host (
    HostID INT PRIMARY KEY AUTO_INCREMENT,
    OrganizationID INT,
    FOREIGN KEY (OrganizationID) REFERENCES Organization(OrganizationID)
);