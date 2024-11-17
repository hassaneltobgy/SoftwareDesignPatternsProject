CREATE TABLE Role (
    RoleID INT PRIMARY KEY AUTO_INCREMENT,  -- Unique identifier for each role
    RoleName VARCHAR(50) NOT NULL,  -- Name of the role
    RoleDescription VARCHAR(255) NOT NULL  -- Description of the role
);