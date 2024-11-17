CREATE TABLE LoginMethodStrategy(
    LoginMethodStrategyID INT PRIMARY KEY
);

CREATE TABLE LoginMethodContext(
    LoginMethodContextID INT PRIMARY KEY AUTO_INCREMENT,
    LoginMethodStrategyID INT,
    FOREIGN KEY (LoginMethodStrategyID) REFERENCES LoginMethodStrategy(LoginMethodStrategyID)
);

CREATE TABLE LoginMethodEmail(
    LoginMethodEmailID INT PRIMARY KEY AUTO_INCREMENT,
    LoginMethodContextID INT,
    FOREIGN KEY (LoginMethodContextID) REFERENCES LoginMethodContext(LoginMethodContextID)
);

CREATE TABLE LoginMethodGoogle(
    LoginMethodGoogleID INT PRIMARY KEY AUTO_INCREMENT,
    LoginMethodContextID INT,
    FOREIGN KEY (LoginMethodContextID) REFERENCES LoginMethodContext(LoginMethodContextID)
);

CREATE TABLE LoginMethodFacebook(
    LoginMethodFacebookID INT PRIMARY KEY AUTO_INCREMENT,
    LoginMethodContextID INT,
    FOREIGN KEY (LoginMethodContextID) REFERENCES LoginMethodContext(LoginMethodContextID)
);
