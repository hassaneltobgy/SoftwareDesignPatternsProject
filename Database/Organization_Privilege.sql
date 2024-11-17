CREATE TABLE Organization_Privilege (
    OrganizationID INT PRIMARY KEY AUTO_INCREMENT,  -- Unique identifier for each organization
    Organization_PrivilegeID INT,                   -- Unique identifier for each organization privilege
    FOREIGN KEY (OrganizationID) REFERENCES Organization(OrganizationID),
    FOREIGN KEY (Organization_PrivilegeID) REFERENCES Privilege(PrivilegeID)
);