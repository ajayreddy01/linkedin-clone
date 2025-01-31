<?php
class User
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Check if an email is already registered
    public function checkEmailExists($email)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // User signup
    public function userSignup($name, $email, $password, $headline, $location)
    {
        try {
            $userId = substr(uniqid('user_'), 0, 12);
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $this->pdo->beginTransaction();

            $query = "INSERT INTO users (userid, name, email, password, headline, location) VALUES (:userid, :name, :email, :password, :headline, :location)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':userid' => $userId,
                ':name' => $name,
                ':email' => $email,
                ':password' => $hashedPassword,
                ':headline' => $headline,
                ':location' => $location
            ]);

            $this->pdo->commit();
            return ['success' => true, 'message' => 'User registered successfully.'];
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // User login
    public function userLogin($email, $password)
    {
        try {
            $query = "SELECT userid, name, email, password FROM users WHERE email = :email LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':email' => $email]);

            $user = $stmt->fetch(PDO::FETCH_OBJ);
            if ($user && password_verify($password, $user->password)) {
                $_SESSION['userid'] = $user->userid;
                $_SESSION['name'] = $user->name;
                return ['success' => true, 'message' => 'Login successful.'];
            }
            return ['success' => false, 'message' => 'Invalid email or password.'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Update user profile
    public function updateProfile($userId, $name, $headline, $location, $about)
    {
        try {
            $query = "UPDATE users SET name = :name, headline = :headline, location = :location, about = :about WHERE userid = :userid";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':name' => $name,
                ':headline' => $headline,
                ':location' => $location,
                ':about' => $about,
                ':userid' => $userId
            ]);
            return ['success' => true, 'message' => 'Profile updated successfully.'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Follow another user
    public function followUser($followerId, $followedId)
    {
        try {
            $query = "INSERT INTO connections (follower_id, followed_id) VALUES (:follower_id, :followed_id)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':follower_id' => $followerId,
                ':followed_id' => $followedId
            ]);
            return ['success' => true, 'message' => 'User followed successfully.'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Create a post
    public function createPost($userId, $content)
    {
        try {
            $postId = substr(uniqid('post_'), 0, 12);
            $query = "INSERT INTO posts (postid, userid, content, created_at) VALUES (:postid, :userid, :content, NOW())";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':postid' => $postId,
                ':userid' => $userId,
                ':content' => $content
            ]);
            return ['success' => true, 'message' => 'Post created successfully.'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Like a post
    public function likePost($userId, $postId)
    {
        try {
            $query = "INSERT INTO post_likes (userid, postid) VALUES (:userid, :postid)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':userid' => $userId,
                ':postid' => $postId
            ]);
            return ['success' => true, 'message' => 'Post liked successfully.'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Send a message
    public function sendMessage($senderId, $receiverId, $message)
    {
        try {
            $messageId = substr(uniqid('msg_'), 0, 12);
            $query = "INSERT INTO messages (messageid, sender_id, receiver_id, message_content, created_at) VALUES (:messageid, :sender_id, :receiver_id, :message_content, NOW())";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':messageid' => $messageId,
                ':sender_id' => $senderId,
                ':receiver_id' => $receiverId,
                ':message_content' => $message
            ]);
            return ['success' => true, 'message' => 'Message sent successfully.'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Search for users by name or headline
    public function searchUsers($keyword)
    {
        try {
            $query = "SELECT userid, name, headline, location FROM users WHERE name LIKE :keyword OR headline LIKE :keyword";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':keyword' => '%' . $keyword . '%']);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Get user profile by ID
    public function getUserProfile($userId)
    {
        try {
            $query = "SELECT userid, name, email, headline, location, about FROM users WHERE userid = :userid";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':userid' => $userId]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Update user's password
    public function updatePassword($userId, $newPassword)
    {
        try {
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $query = "UPDATE users SET password = :password WHERE userid = :userid";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':password' => $hashedPassword,
                ':userid' => $userId
            ]);
            return ['success' => true, 'message' => 'Password updated successfully.'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Get user's posts
    public function getUserPosts($userId)
    {
        try {
            $query = "SELECT postid, content, created_at FROM posts WHERE userid = :userid ORDER BY created_at DESC";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':userid' => $userId]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
}