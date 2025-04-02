<?php
class User {
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // User signup
    public function signup($username, $email, $password, $firstName, $lastName, $headline = null, $bio = null, $location = null) {
        try {
            if ($this->checkEmailExists($email)) {
                return ['success' => false, 'message' => 'Email already registered'];
            }
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO Users (username, email, password_hash, first_name, last_name, headline, bio, location) 
                      VALUES (:username, :email, :password_hash, :first_name, :last_name, :headline, :bio, :location)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':password_hash' => $passwordHash,
                ':first_name' => $firstName,
                ':last_name' => $lastName,
                ':headline' => $headline,
                ':bio' => $bio,
                ':location' => $location
            ]);
            $userId = $this->pdo->lastInsertId();
            $_SESSION['user_id'] = $userId;
            return ['success' => true, 'user_id' => $userId, 'message' => 'User registered successfully'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // User login
    public function login($email, $password) {
        try {
            $query = "SELECT user_id, password_hash FROM Users WHERE email = :email LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            if ($user && password_verify($password, $user->password_hash)) {
                $_SESSION['user_id'] = $user->user_id;
                $_SESSION['user_data'] = $user;
                return ['success' => true, 'user_id' => $user->user_id, 'message' => 'Login successful'];
            }
            return ['success' => false, 'message' => 'Invalid email or password'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Update user profile
    public function updateProfile($userId, $firstName, $lastName, $headline = null, $bio = null, $location = null, $profilePictureUrl = null) {
        try {
            $query = "UPDATE Users SET first_name = :first_name, last_name = :last_name, headline = :headline, bio = :bio, 
                      location = :location, profile_picture_url = :profile_picture_url 
                      WHERE user_id = :user_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':first_name' => $firstName,
                ':last_name' => $lastName,
                ':headline' => $headline,
                ':bio' => $bio,
                ':location' => $location,
                ':profile_picture_url' => $profilePictureUrl,
                ':user_id' => $userId
            ]);
            return ['success' => true, 'message' => 'Profile updated successfully'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Add a skill
    public function addSkill($userId, $skillName, $proficiencyLevel) {
        try {
            $query = "INSERT INTO Skills (user_id, skill_name, proficiency_level) VALUES (:user_id, :skill_name, :proficiency_level)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':user_id' => $userId,
                ':skill_name' => $skillName,
                ':proficiency_level' => $proficiencyLevel
            ]);
            return ['success' => true, 'skill_id' => $this->pdo->lastInsertId(), 'message' => 'Skill added successfully'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Edit a skill
    public function editSkill($userId, $skillId, $skillName, $proficiencyLevel) {
        try {
            $checkQuery = "SELECT COUNT(*) FROM Skills WHERE skill_id = :skill_id AND user_id = :user_id";
            $checkStmt = $this->pdo->prepare($checkQuery);
            $checkStmt->execute([':skill_id' => $skillId, ':user_id' => $userId]);
            if ($checkStmt->fetchColumn() == 0) {
                return ['success' => false, 'message' => 'Skill not found or you do not own it'];
            }

            $query = "UPDATE Skills SET skill_name = :skill_name, proficiency_level = :proficiency_level 
                      WHERE skill_id = :skill_id AND user_id = :user_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':skill_name' => $skillName,
                ':proficiency_level' => $proficiencyLevel,
                ':skill_id' => $skillId,
                ':user_id' => $userId
            ]);
            return ['success' => true, 'message' => 'Skill updated successfully'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Delete a skill
    public function deleteSkill($userId, $skillId) {
        try {
            $checkQuery = "SELECT COUNT(*) FROM Skills WHERE skill_id = :skill_id AND user_id = :user_id";
            $checkStmt = $this->pdo->prepare($checkQuery);
            $checkStmt->execute([':skill_id' => $skillId, ':user_id' => $userId]);
            if ($checkStmt->fetchColumn() == 0) {
                return ['success' => false, 'message' => 'Skill not found or you do not own it'];
            }

            $query = "DELETE FROM Skills WHERE skill_id = :skill_id AND user_id = :user_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':skill_id' => $skillId, ':user_id' => $userId]);
            return $stmt->rowCount() > 0 
                ? ['success' => true, 'message' => 'Skill deleted successfully'] 
                : ['success' => false, 'message' => 'Skill not found'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Get user skills
    public function getSkills($userId) {
        try {
            $query = "SELECT skill_id, skill_name, proficiency_level FROM Skills WHERE user_id = :user_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':user_id' => $userId]);
            return ['success' => true, 'skills' => $stmt->fetchAll(PDO::FETCH_OBJ)];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Add education
    public function addEducation($userId, $institutionName, $degree, $fieldOfStudy, $startDate, $endDate = null) {
        try {
            $query = "INSERT INTO Education (user_id, institution_name, degree, field_of_study, start_date, end_date) 
                      VALUES (:user_id, :institution_name, :degree, :field_of_study, :start_date, :end_date)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':user_id' => $userId,
                ':institution_name' => $institutionName,
                ':degree' => $degree,
                ':field_of_study' => $fieldOfStudy,
                ':start_date' => $startDate,
                ':end_date' => $endDate
            ]);
            return ['success' => true, 'education_id' => $this->pdo->lastInsertId(), 'message' => 'Education added successfully'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Edit education
    public function editEducation($userId, $educationId, $institutionName, $degree, $fieldOfStudy, $startDate, $endDate = null) {
        try {
            $checkQuery = "SELECT COUNT(*) FROM Education WHERE education_id = :education_id AND user_id = :user_id";
            $checkStmt = $this->pdo->prepare($checkQuery);
            $checkStmt->execute([':education_id' => $educationId, ':user_id' => $userId]);
            if ($checkStmt->fetchColumn() == 0) {
                return ['success' => false, 'message' => 'Education not found or you do not own it'];
            }

            $query = "UPDATE Education SET institution_name = :institution_name, degree = :degree, 
                      field_of_study = :field_of_study, start_date = :start_date, end_date = :end_date 
                      WHERE education_id = :education_id AND user_id = :user_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':institution_name' => $institutionName,
                ':degree' => $degree,
                ':field_of_study' => $fieldOfStudy,
                ':start_date' => $startDate,
                ':end_date' => $endDate,
                ':education_id' => $educationId,
                ':user_id' => $userId
            ]);
            return ['success' => true, 'message' => 'Education updated successfully'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Delete education
    public function deleteEducation($userId, $educationId) {
        try {
            $checkQuery = "SELECT COUNT(*) FROM Education WHERE education_id = :education_id AND user_id = :user_id";
            $checkStmt = $this->pdo->prepare($checkQuery);
            $checkStmt->execute([':education_id' => $educationId, ':user_id' => $userId]);
            if ($checkStmt->fetchColumn() == 0) {
                return ['success' => false, 'message' => 'Education not found or you do not own it'];
            }

            $query = "DELETE FROM Education WHERE education_id = :education_id AND user_id = :user_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':education_id' => $educationId, ':user_id' => $userId]);
            return $stmt->rowCount() > 0 
                ? ['success' => true, 'message' => 'Education deleted successfully'] 
                : ['success' => false, 'message' => 'Education not found'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Get user education
    public function getEducation($userId) {
        try {
            $query = "SELECT education_id, institution_name, degree, field_of_study, start_date, end_date 
                      FROM Education WHERE user_id = :user_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':user_id' => $userId]);
            return ['success' => true, 'education' => $stmt->fetchAll(PDO::FETCH_OBJ)];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Add experience
    public function addExperience($userId, $companyName, $jobTitle, $location, $startDate, $endDate = null, $description = null) {
        try {
            $query = "INSERT INTO Experience (user_id, company_name, job_title, location, start_date, end_date, description) 
                      VALUES (:user_id, :company_name, :job_title, :location, :start_date, :end_date, :description)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':user_id' => $userId,
                ':company_name' => $companyName,
                ':job_title' => $jobTitle,
                ':location' => $location,
                ':start_date' => $startDate,
                ':end_date' => $endDate,
                ':description' => $description
            ]);
            return ['success' => true, 'experience_id' => $this->pdo->lastInsertId(), 'message' => 'Experience added successfully'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Edit experience
    public function editExperience($userId, $experienceId, $companyName, $jobTitle, $location, $startDate, $endDate = null, $description = null) {
        try {
            $checkQuery = "SELECT COUNT(*) FROM Experience WHERE experience_id = :experience_id AND user_id = :user_id";
            $checkStmt = $this->pdo->prepare($checkQuery);
            $checkStmt->execute([':experience_id' => $experienceId, ':user_id' => $userId]);
            if ($checkStmt->fetchColumn() == 0) {
                return ['success' => false, 'message' => 'Experience not found or you do not own it'];
            }

            $query = "UPDATE Experience SET company_name = :company_name, job_title = :job_title, location = :location, 
                      start_date = :start_date, end_date = :end_date, description = :description 
                      WHERE experience_id = :experience_id AND user_id = :user_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':company_name' => $companyName,
                ':job_title' => $jobTitle,
                ':location' => $location,
                ':start_date' => $startDate,
                ':end_date' => $endDate,
                ':description' => $description,
                ':experience_id' => $experienceId,
                ':user_id' => $userId
            ]);
            return ['success' => true, 'message' => 'Experience updated successfully'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Delete experience
    public function deleteExperience($userId, $experienceId) {
        try {
            $checkQuery = "SELECT COUNT(*) FROM Experience WHERE experience_id = :experience_id AND user_id = :user_id";
            $checkStmt = $this->pdo->prepare($checkQuery);
            $checkStmt->execute([':experience_id' => $experienceId, ':user_id' => $userId]);
            if ($checkStmt->fetchColumn() == 0) {
                return ['success' => false, 'message' => 'Experience not found or you do not own it'];
            }

            $query = "DELETE FROM Experience WHERE experience_id = :experience_id AND user_id = :user_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':experience_id' => $experienceId, ':user_id' => $userId]);
            return $stmt->rowCount() > 0 
                ? ['success' => true, 'message' => 'Experience deleted successfully'] 
                : ['success' => false, 'message' => 'Experience not found'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Get user experience
    public function getExperience($userId) {
        try {
            $query = "SELECT experience_id, company_name, job_title, location, start_date, end_date, description 
                      FROM Experience WHERE user_id = :user_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':user_id' => $userId]);
            return ['success' => true, 'experience' => $stmt->fetchAll(PDO::FETCH_OBJ)];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Send connection request
    public function sendConnectionRequest($userId, $connectedUserId) {
        try {
            $query = "INSERT INTO Connections (user_id, connected_user_id, status) VALUES (:user_id, :connected_user_id, 'pending')";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':user_id' => $userId, ':connected_user_id' => $connectedUserId]);
            return ['success' => true, 'connection_id' => $this->pdo->lastInsertId(), 'message' => 'Connection request sent'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Accept connection request
    public function acceptConnectionRequest($connectionId, $userId) {
        try {
            $query = "UPDATE Connections SET status = 'accepted' WHERE connection_id = :connection_id AND connected_user_id = :user_id AND status = 'pending'";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':connection_id' => $connectionId, ':user_id' => $userId]);
            return $stmt->rowCount() > 0 
                ? ['success' => true, 'message' => 'Connection request accepted'] 
                : ['success' => false, 'message' => 'Request not found or already processed'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }


    // Get user connections
    public function getConnections($userId) {
        try {
            $query = "SELECT c.connection_id, c.connected_user_id, u.username, u.first_name, u.last_name, c.status , u.profile_picture_url 
                      FROM Connections c JOIN Users u ON c.connected_user_id = u.user_id 
                      WHERE c.user_id = :user_id AND c.status = 'accepted'";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':user_id' => $userId]);
            return ['success' => true, 'connections' => $stmt->fetchAll(PDO::FETCH_OBJ)];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Follow a user
    public function follow($followerId, $followedUserId) {
        try {
            $query = "INSERT INTO Follows (follower_id, followed_user_id) VALUES (:follower_id, :followed_user_id)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':follower_id' => $followerId, ':followed_user_id' => $followedUserId]);
            return ['success' => true, 'follow_id' => $this->pdo->lastInsertId(), 'message' => 'User followed successfully'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Get user follows
    public function getFollows($followerId) {
        try {
            $query = "SELECT f.follow_id, f.followed_user_id, u.username, u.first_name, u.last_name 
                      FROM Follows f JOIN Users u ON f.followed_user_id = u.user_id 
                      WHERE f.follower_id = :follower_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':follower_id' => $followerId]);
            return ['success' => true, 'follows' => $stmt->fetchAll(PDO::FETCH_OBJ)];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Helper method to check if email exists
    private function checkEmailExists($email) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM Users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

    public function isloggedin(){
        if(isset($_SESSION['user_id'])){
            return true;
        }else{
            return false;
        }
    }
}
?>