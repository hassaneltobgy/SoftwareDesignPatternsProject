CREATE TABLE GrantPrivilege(
    GrantPrivilegeID INT PRIMARY KEY AUTO_INCREMENT,
    DATE DATE,
    Time TIME,
    AdminID INT,
    FOREIGN KEY (AdminID) REFERENCES Admin(AdminID)
 
);