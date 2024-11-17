CREATE TABLE skill_skilltype (
    SkillID INT,
    SkillTypeID INT,
    PRIMARY KEY (SkillID, SkillTypeID),
    FOREIGN KEY (SkillID) REFERENCES Skill(SkillID) ON DELETE CASCADE,
    FOREIGN KEY (SkillTypeID) REFERENCES SkillType(SkillTypeID) ON DELETE CASCADE
);