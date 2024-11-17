CREATE TABLE Location(
    AddressID INT PRIMARY KEY AUTO_INCREMENT,  -- Unique identifier for each address
    Name VARCHAR(50) NOT NULL,                 -- Name of the location
    -- parent id will self reference to the same table
    ParentID INT,                              -- Parent location id
    FOREIGN KEY (ParentID) REFERENCES Location(AddressID)
)