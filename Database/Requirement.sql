CREATE TABLE Requirement(
    RequirementID INT PRIMARY KEY AUTO_INCREMENT,  -- Unique identifier for each requirement
    RequirementName VARCHAR(50) NOT NULL,  -- Name of the requirement
    Description VARCHAR(255) NOT NULL,  -- Description of the requirement
    isMandatory BOOLEAN NOT NULL,  -- Whether the requirement is mandatory
    minYearsExperience INT,  -- Minimum years of experience required
    maxParticipants INT  -- Maximum number of participants    
  
)