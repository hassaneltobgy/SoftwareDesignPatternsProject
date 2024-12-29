<?php
require_once "OrganizationTypeModel.php";
require_once "UserModel.php";
class Organization extends User
{
    private $OrganizationID;
    private $table_name = "Organization";
    private $conn;

    private $OrganizationDescription;
    private $OrganizationWebsite;
    private $OrganizationType;

    public function __construct($id = null)
    {
        parent::__construct();
        $this->conn = Database::getInstance()->getConnection();

        if (!$this->conn) {
            echo "Database connection error.";
            return;
        } else if (empty($id)) {
            return;
        } else {
            $sql = "SELECT * FROM $this->table_name WHERE OrganizationID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                // First initialize the User class with the UserID from Volunteer record
                parent::__construct($row['UserID']);  // This initializes the parent (User) class

                // Now initialize the Volunteer class properties
                $this->OrganizationID = $row['OrganizationID'];
                $this->UserID = $row['UserID'];
                $this->OrganizationDescription = $row['OrganizationDescription'];
                $this->OrganizationWebsite = $row['OrganizationWebsite'];
                $this->OrganizationType = new OrganizationType($row['OrganizationTypeID']);
            } else {
                echo "No volunteer found with ID: $id";
            }

            $stmt->close();
        }
    }

    static public function create_organization(
        $FirstName,
        $LastName= null,
        $Email,
        $PhoneNumber,
        $DateOfCreation,
        $USER_NAME,
        $password,
        $LAST_LOGIN,
        $ACCOUNT_CREATION_DATE,
        $privileges = [],
        $OrganizationDescription= null,
        $OrganizationWebsite= null,
        $OrganizationTypeName= "Charity",
        
    ) {
        $userCreated = parent::create(
            $FirstName,
            $LastName,
            $Email,
            $PhoneNumber,
            $DateOfCreation,
            $USER_NAME,
            password_hash($password, PASSWORD_BCRYPT),
            $LAST_LOGIN,
            $ACCOUNT_CREATION_DATE,
            "organization",
            $privileges
        );

        if ($userCreated) {
            echo "plain password is $password";
            echo "User created successfully in create organization.  ";
            $OrganizationTypeID = OrganizationType::get_organization_type_id_from_name($OrganizationTypeName);
            $conn = Database::getInstance()->getConnection();
            $sql = "INSERT INTO Organization (OrganizationName, OrganizationDescription, OrganizationEmail, OrganizationPhone, OrganizationTypeID, OrganizationWebsite, UserID, OrganizationUsername, OrganizationPASSWORD_HASH, LAST_LOGIN, ACCOUNT_CREATION_DATE, DateOfCreation) VALUES (?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            if ($OrganizationDescription == null) {
                $OrganizationDescription = "No description available.";
            }
            if ($OrganizationWebsite == null) {
                $OrganizationWebsite = "No website available.";
            }

            $stmt->bind_param("ssssisssssss", $FirstName, $OrganizationDescription, $Email, $PhoneNumber, $OrganizationTypeID, $OrganizationWebsite, $userCreated->UserID, $USER_NAME, $password_hash, $LAST_LOGIN, $ACCOUNT_CREATION_DATE, $DateOfCreation);
            if ($stmt->execute()) {
                echo "Organization created successfully. ";
            } else {
                echo "Organization creation failed. $stmt->error";
            }
            $stmt->close();


            $Organization = new Organization();
            $Organization->FirstName = $FirstName;
            $Organization->LastName = $LastName;
            $Organization->Email = $Email;
            $Organization->PhoneNumber = $PhoneNumber;
            $Organization->DateOfBirth = $DateOfCreation;
            $Organization->USER_NAME = $USER_NAME;
            $Organization->PASSWORD_HASH =  $password_hash;
            $Organization->LAST_LOGIN = $LAST_LOGIN;
            $Organization->ACCOUNT_CREATION_DATE = $ACCOUNT_CREATION_DATE;
            $Organization->OrganizationDescription = $OrganizationDescription;
            $Organization->OrganizationWebsite = $OrganizationWebsite;
            $Organization->OrganizationType = new OrganizationType($OrganizationTypeID);
            return $Organization;
        }
        else {
            echo "User creation failed.";
            return null;
        }

    }
    public static function deletebyUserID($UserID) {
        $conn = Database::getInstance()->getConnection();
        $query = "DELETE FROM Organization WHERE UserID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $UserID);
        if (!$stmt->execute()) {
             echo "Error deleting Organization: " . $stmt->error;
            return false;
        }
        return true;
    }

    public function update(
        $UserID= null,
        $OrganizationID = null,
        $FirstName = null,
        $LastName = null,
        $Email = null,
        $PhoneNumber = null,
        $DateOfBirth = null,
        $USER_NAME = null,
        $password = null,
        $OrganizationDescription = null,
        $OrganizationWebsite = null,
        $OrganizationTypeID = null,
        $privileges = []) {
        if (empty($UserID)) {
           $UserID= $this->getUserIDbyOrganizationID($this->OrganizationID);
        }
        {
    
            echo "updating Organization!!";
            
            
            if ($OrganizationID != null) {
                $this->OrganizationID = $OrganizationID;
            }
            else{
                echo "user id is $UserID";
                $this->OrganizationID = $this->getOrganizationIDByUserId($UserID);
                $OrganizationData= $this->getOrganizationByID($this->OrganizationID);
                echo "organization id is $this->OrganizationID";
            }
    
            
            if ($FirstName != null) {
                $this->FirstName = $FirstName;     
            }
            else {
                $this->FirstName = $OrganizationData->FirstName;
            }
            if ($LastName != null) {
                $this->LastName = $LastName;
                        }
            else {
                $this->LastName = $OrganizationData->LastName;
            }
            if ($Email != null) {
                $this->Email = $Email;
                  }
            else {
                $this->Email = $OrganizationData->Email;
            }
    
            if ($PhoneNumber != null) {
                $this->PhoneNumber = $PhoneNumber;
            }
            else {
                $this->PhoneNumber = $OrganizationData->PhoneNumber;
            }
            if ($DateOfBirth != null && $DateOfBirth != 'undefined') {
                $this->DateOfBirth = $DateOfBirth;
            }
            else {
                $this->DateOfBirth = $OrganizationData->DateOfBirth;
            }
            if ($USER_NAME != null) {
                $this->USER_NAME = $USER_NAME;
            }
            else {
                $this->USER_NAME = $OrganizationData->USER_NAME;
            }
            if ($password != null) {
                $this->PASSWORD_HASH = password_hash($password, PASSWORD_BCRYPT);
            }
            else {
                $this->PASSWORD_HASH = $OrganizationData->PASSWORD_HASH;
            }
            if ($OrganizationDescription != null) {
                $this->OrganizationDescription = $OrganizationDescription;
            }
            else {
                $this->OrganizationDescription = $OrganizationData->OrganizationDescription;
            }
            if ($OrganizationWebsite != null) {
                $this->OrganizationWebsite = $OrganizationWebsite;
            }
            else {
                $this->OrganizationWebsite = $OrganizationData->OrganizationWebsite;
            }
            if ($OrganizationTypeID != null) {
                $this->OrganizationType = new OrganizationType($OrganizationTypeID);
            }
            else {
                $this->OrganizationType = $OrganizationData->OrganizationType;
            }
        
            $query = "UPDATE " . $this->table_name . " 
                      SET OrganizationName= ?, 
                          OrganizationDescription= ?, 
                          OrganizationEmail= ?, 
                          OrganizationPhone= ?, 
                          OrganizationTypeID= ?, 
                          OrganizationWebsite= ?, 
                          UserID= ?, 
                          OrganizationUsername= ?, 
                          OrganizationPASSWORD_HASH= ?, 
                          LAST_LOGIN= ?, 
                          ACCOUNT_CREATION_DATE= ?, 
                          DateOfCreation= ?
                          
                      WHERE OrganizationID = ?";
              
        
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param(
                "ssssisssssssi",
                $this->FirstName,
                $this->OrganizationDescription,
                $this->Email,
                $this->PhoneNumber,
                $this->OrganizationType->OrganizationTypeID,
                $this->OrganizationWebsite,
                $UserID,
                $this->USER_NAME,
                $this->PASSWORD_HASH,
                $this->LAST_LOGIN,
                $this->ACCOUNT_CREATION_DATE,
                $this->DateOfBirth,
                $this->OrganizationID
            );
            $stmt->execute();
            $stmt->close();
            $status = parent::update_user($UserID, $this->FirstName, $this->LastName, $this->Email, $this->PhoneNumber, $this->DateOfBirth, $this->USER_NAME, $this->PASSWORD_HASH,"organization", $privileges);
            if ($status) {
                echo "Organization updated successfully.";
            } else {
                echo "Organization update failed.";
            }
        }
    }

     public function getOrganizationIDByUserId($UserID){
        $sql = "SELECT OrganizationID FROM Organization WHERE UserID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['OrganizationID'];
     }

        public function getUserIDbyOrganizationID($OrganizationID){
            $sql = "SELECT UserID FROM Organization WHERE OrganizationID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $OrganizationID);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row['UserID'];
        }   
public function getOrganizationByID($OrganizationID){
    $sql = "SELECT * FROM Organization WHERE OrganizationID = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $OrganizationID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $Organization = new Organization();
    $Organization->OrganizationID = $row['OrganizationID'];
    $Organization->UserID = $row['UserID'];
    $Organization->OrganizationDescription = $row['OrganizationDescription'];
    $Organization->OrganizationWebsite = $row['OrganizationWebsite'];
    $Organization->OrganizationType = new OrganizationType($row['OrganizationTypeID']);
    $Organization->FirstName = $row['OrganizationName'];
    $Organization->LastName =null;
    $Organization->Email = $row['OrganizationEmail'];
    $Organization->PhoneNumber = $row['OrganizationPhone'];
    $Organization->DateOfBirth = $row['DateOfCreation'];
    $Organization->USER_NAME = $row['OrganizationUsername'];
    $Organization->PASSWORD_HASH = $row['OrganizationPASSWORD_HASH'];
    $Organization->LAST_LOGIN = $row['LAST_LOGIN'];
    $Organization->ACCOUNT_CREATION_DATE = $row['ACCOUNT_CREATION_DATE'];



    return $Organization;
}


public function delete(){
    $query = "DELETE FROM " . $this->table_name . " WHERE OrganizationID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $this->OrganizationID);
    if (!$stmt->execute()) {
        return false;
    }
    if (parent::delete($this->UserID)) {
        return true;
    } else {
        return false;
    }
}
}


?>