CREATE TABLE Privilege (
    PrivilegeID INT PRIMARY KEY AUTO_INCREMENT,  -- Unique identifier for each privilege
    PrivilegeName VARCHAR(50) NOT NULL,  -- Name of the privilege
    Description VARCHAR(255) NOT NULL,  -- Description of the privilege
    AccessLevel INT NOT NULL  -- Access level of the privilege
);