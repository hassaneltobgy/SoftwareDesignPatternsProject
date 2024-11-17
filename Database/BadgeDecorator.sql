-- Abstract Table: VolunteerBadge
CREATE TABLE VolunteerBadge (
    badge_id INT AUTO_INCREMENT PRIMARY KEY,  -- Ensure AUTO_INCREMENT is used here
    score INT NOT NULL,                       -- Base score for the badge
    title VARCHAR(100) NOT NULL               -- Title of the badge
);

-- Abstract Table: BadgeDecorator
CREATE TABLE BadgeDecorator (
    decorator_id INT AUTO_INCREMENT PRIMARY KEY,
    badge_id INT NOT NULL,  -- Make this UNSIGNED if needed
    FOREIGN KEY (badge_id) REFERENCES VolunteerBadge(badge_id)
);


-- -- Table: StarterBadge
CREATE TABLE StarterBadge (
    badge_id INT PRIMARY KEY,                      -- badge_id INT, referenced to VolunteerBadge
    score INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    FOREIGN KEY (badge_id) REFERENCES VolunteerBadge(badge_id)  -- Reference to VolunteerBadge(badge_id)
);

CREATE TABLE AdvancedBadgeDecorator (
    decorator_id INT AUTO_INCREMENT PRIMARY KEY,  -- decorator_id with AUTO_INCREMENT
    score INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    FOREIGN KEY (decorator_id) REFERENCES BadgeDecorator(decorator_id)  -- Reference to BadgeDecorator(decorator_id)
);

CREATE TABLE ExpertBadgeDecorator (
    decorator_id INT AUTO_INCREMENT PRIMARY KEY,  -- decorator_id with AUTO_INCREMENT
    score INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    FOREIGN KEY (decorator_id) REFERENCES BadgeDecorator(decorator_id)  -- Reference to BadgeDecorator(decorator_id)
);

CREATE TABLE MasterBadgeDecorator (
    decorator_id INT AUTO_INCREMENT PRIMARY KEY,  -- decorator_id with AUTO_INCREMENT
    score INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    FOREIGN KEY (decorator_id) REFERENCES BadgeDecorator(decorator_id)  -- Reference to BadgeDecorator(decorator_id)
);

CREATE TABLE LeaderBadgeDecorator (
    decorator_id INT AUTO_INCREMENT PRIMARY KEY,  -- decorator_id with AUTO_INCREMENT
    score INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    FOREIGN KEY (decorator_id) REFERENCES BadgeDecorator(decorator_id)  -- Reference to BadgeDecorator(decorator_id)
);
