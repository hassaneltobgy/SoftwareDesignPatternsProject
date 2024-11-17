CREATE TABLE LoginStrategy (
    LoginStrategyID INT PRIMARY KEY         -- Unique ID for the login strategy
);

CREATE TABLE LoginContext (
    LoginContextID INT PRIMARY KEY AUTO_INCREMENT,    -- Unique ID for the login context
    LoginStrategyID INT,                             -- Unique ID for the login strategy
    FOREIGN KEY (LoginStrategyID) REFERENCES LoginStrategy(LoginStrategyID)
);

CREATE TABLE LoginAdmin (
    LoginAdminID INT PRIMARY KEY,                    -- Unique ID for the login admin
    LoginContextID INT,                               -- Foreign Key for LoginContext
    FOREIGN KEY (LoginContextID) REFERENCES LoginContext(LoginContextID)
);

CREATE TABLE LoginVolunteer (
    LoginVolunteerID INT PRIMARY KEY,                -- Unique ID for the login volunteer
    LoginContextID INT,                               -- Foreign Key for LoginContext
    FOREIGN KEY (LoginContextID) REFERENCES LoginContext(LoginContextID)
);

CREATE TABLE LoginOrganization (
    LoginOrganizationID INT PRIMARY KEY,             -- Unique ID for the login organization
    LoginContextID INT,                               -- Foreign Key for LoginContext
    FOREIGN KEY (LoginContextID) REFERENCES LoginContext(LoginContextID)
);

