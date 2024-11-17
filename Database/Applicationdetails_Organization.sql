CREATE TABLE Applicationdetails_Organization (
    ApplicationID INT,
    OrganizationID INT,
    PRIMARY KEY (ApplicationID, OrganizationID),
    FOREIGN KEY (ApplicationID) REFERENCES ApplicationDetails(ApplicationDetailsID) ON DELETE CASCADE,
    FOREIGN KEY (OrganizationID) REFERENCES Organization(OrganizationID) ON DELETE CASCADE
);