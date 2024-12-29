CREATE TABLE Organization (
    OrganizationID INT PRIMARY KEY AUTO_INCREMENT,
    OrganizationName VARCHAR(50) NOT NULL,
    OrganizationDescription VARCHAR(500) NOT NULL,
    OrganizationEmail VARCHAR(50) NOT NULL,
    OrganizationPhone VARCHAR(50) NOT NULL,
    OrganizationWebsite VARCHAR(50) NOT NULL,
    OrganizationUsername VARCHAR(50) NOT NULL,
    OrganizationPASSWORD_HASH VARCHAR(100) NOT NULL,
    LAST_LOGIN DATE,                              -- Volunteer last login date
    ACCOUNT_CREATION_DATE DATE, 
    DateOfCreation DATE NOT NULL,

    OrganizationTypeID INT NOT NULL,
    FOREIGN KEY (OrganizationTypeID) REFERENCES OrganizationType(OrganizationTypeID),

    UserID INT,
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);