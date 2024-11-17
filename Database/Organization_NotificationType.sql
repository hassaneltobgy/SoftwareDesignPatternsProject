CREATE TABLE organization_notificationtype (
    organizationid INT,
    notificationtypeid INT,
    PRIMARY KEY (organizationid, notificationtypeid),
    FOREIGN KEY (organizationid) REFERENCES organization(organizationid),
    FOREIGN KEY (notificationtypeid) REFERENCES notificationtype(notificationtypeid)
);