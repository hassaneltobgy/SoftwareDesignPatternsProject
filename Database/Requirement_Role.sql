CREATE TABLE Requirement_Role (
    RequirementID INT NOT NULL,  -- Unique identifier for each requirement
    RoleID INT NOT NULL,  -- Unique identifier for each role
    PRIMARY KEY (RequirementID, RoleID),
    FOREIGN KEY (RequirementID) REFERENCES Requirement(RequirementID),
    FOREIGN KEY (RoleID) REFERENCES Role(RoleID)
);