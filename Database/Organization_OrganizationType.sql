CREATE TABLE Organization_OrganizationType (
    OrganizationID INT NOT NULL,
    OrganizationTypeID INT NOT NULL,
    PRIMARY KEY (OrganizationID, OrganizationTypeID),
    FOREIGN KEY (OrganizationID) REFERENCES Organization(OrganizationID),
    FOREIGN KEY (OrganizationTypeID) REFERENCES OrganizationType(OrganizationTypeID)
);