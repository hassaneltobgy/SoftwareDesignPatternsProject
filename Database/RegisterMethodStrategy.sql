CREATE TABLE RegisterMethodStrategy(
    RegisterMethodStrategyID INT PRIMARY KEY
);

CREATE TABLE RegisterMethodContext(
    RegisterMethodContextID INT PRIMARY KEY AUTO_INCREMENT,
    RegisterMethodStrategyID INT,
    FOREIGN KEY (RegisterMethodStrategyID) REFERENCES RegisterMethodStrategy(RegisterMethodStrategyID)
);

CREATE TABLE RegisterMethodEmail(
    RegisterMethodEmailID INT PRIMARY KEY AUTO_INCREMENT,
    RegisterMethodContextID INT,
    FOREIGN KEY (RegisterMethodContextID) REFERENCES RegisterMethodContext(RegisterMethodContextID)
);

CREATE TABLE RegisterMethodGoogle(
    RegisterMethodGoogleID INT PRIMARY KEY AUTO_INCREMENT,
    RegisterMethodContextID INT,
    FOREIGN KEY (RegisterMethodContextID) REFERENCES RegisterMethodContext(RegisterMethodContextID)
);

CREATE TABLE RegisterMethodFacebook(
    RegisterMethodFacebookID INT PRIMARY KEY AUTO_INCREMENT,
    RegisterMethodContextID INT,
    FOREIGN KEY (RegisterMethodContextID) REFERENCES RegisterMethodContext(RegisterMethodContextID)
);
