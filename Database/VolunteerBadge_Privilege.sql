CREATE TABLE VolunteerBadge_Privilege(
    VolunteerBadge_PrivilegeID INT PRIMARY KEY AUTO_INCREMENT,
    VolunteerBadgeID INT,
    FOREIGN KEY (VolunteerBadgeID) REFERENCES VolunteerBadge(badge_id),
    PrivilegeID INT,
    FOREIGN KEY (PrivilegeID) REFERENCES Privilege(PrivilegeID)
    
);