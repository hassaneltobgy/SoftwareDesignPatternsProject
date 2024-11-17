CREATE TABLE Admin_Privilege (
    AdminID INT PRIMARY KEY AUTO_INCREMENT,  -- Unique identifier for each admin
    Admin_PrivilegeID INT,                   -- Unique identifier for each admin privilege
    FOREIGN KEY (AdminID) REFERENCES Admin(AdminID),
    FOREIGN KEY (Admin_PrivilegeID) REFERENCES Privilege(PrivilegeID)
);