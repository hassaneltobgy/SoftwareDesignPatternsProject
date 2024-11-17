CREATE TABLE Volunteer_Skills (
    VolunteerID INT,
    SkillID INT,
    PRIMARY KEY (VolunteerID, SkillID),
    FOREIGN KEY (VolunteerID) REFERENCES Volunteer(VolunteerID) ON DELETE CASCADE,
    FOREIGN KEY (SkillID) REFERENCES Skill(SkillID) ON DELETE CASCADE
);
