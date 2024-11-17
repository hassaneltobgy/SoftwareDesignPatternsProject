CREATE TABLE Skill (
    SkillID INT PRIMARY KEY AUTO_INCREMENT,
    SkillName VARCHAR(255) NOT NULL UNIQUE,
    SkillDescription TEXT,
    SkillLevel VARCHAR(255)
);
