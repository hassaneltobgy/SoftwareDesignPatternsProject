CREATE TABLE Organization (
    OrganizationID INT PRIMARY KEY,
    OrganizationName VARCHAR(50) NOT NULL,
    OrganizationDescription VARCHAR(500) NOT NULL,
    OrganizationEmail VARCHAR(50) NOT NULL,
    OrganizationPhone VARCHAR(50) NOT NULL,
    OrganizationAddressID INT,
    OrganizationTypeID INT,
    FOREIGN KEY (OrganizationTypeID) REFERENCES OrganizationType(OrganizationTypeID),
    OrganizationWebsite VARCHAR(50) NOT NULL,
    FOREIGN KEY (OrganizationAddressID) REFERENCES Location(AddressID)
    UserID INT,
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);