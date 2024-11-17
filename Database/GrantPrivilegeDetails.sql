CREATE TABLE GrantPrivilegeDetails(
    GrantPrivilegeDetailsID INT PRIMARY KEY AUTO_INCREMENT,
    GrantPrivilegeID INT,
    FOREIGN KEY (GrantPrivilegeID) REFERENCES GrantPrivilege(GrantPrivilegeID),
    PrivilegeID INT,
    FOREIGN KEY (PrivilegeID) REFERENCES Privilege(PrivilegeID)
);
  