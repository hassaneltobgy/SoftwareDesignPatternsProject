CREATE TABLE User (
    UserID INT PRIMARY KEY AUTO_INCREMENT,  -- Unique identifier for each volunteer
    FirstName VARCHAR(50) NOT NULL,              -- Volunteer first name
    LastName VARCHAR(50) NOT NULL,                -- Volunteer last name
    Email VARCHAR(100) NOT NULL UNIQUE,           -- Volunteer email address
    PhoneNumber VARCHAR(15),                      -- Volunteer phone number
    DateOfBirth DATE,                             -- Volunteer date of birth
    USER_NAME VARCHAR(50) NOT NULL,               -- Volunteer username
    PASSWORD_HASH VARCHAR(100) NOT NULL,          -- Volunteer password hash
    LAST_LOGIN DATE,                              -- Volunteer last login date
    ACCOUNT_CREATION_DATE DATE,   
    UserTypeID INT,                               -- Volunteer user type
    FOREIGN KEY (UserTypeID) REFERENCES UserType(UserTypeID)

 
);