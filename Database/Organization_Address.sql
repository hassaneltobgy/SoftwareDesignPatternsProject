CREATE TABLE Organization_Address (
    OrganizationID INT,
    AddressID INT,
    PRIMARY KEY (OrganizationID, AddressID),
    FOREIGN KEY (OrganizationID) REFERENCES Organization(OrganizationID),
    FOREIGN KEY (AddressID) REFERENCES Location(AddressID)
);