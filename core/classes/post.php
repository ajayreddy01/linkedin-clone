<?php
class Post {
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create a post
    public function createPost($userId, $content, $mediaUrl = null) {
        try {
            $query = "INSERT INTO Posts (user_id, content, media_url, created_at) 
                      VALUES (:user_id, :content, :media_url, NOW())";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':user_id' => $userId,
                ':content' => $content,
                ':media_url' => $mediaUrl
            ]);
            return ['success' => true, 'post_id' => $this->pdo->lastInsertId(), 'message' => 'Post created successfully'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
   
    // Like a post
    public function likePost($userId, $postId) {
        try {
            // Check if the user already liked the post
            $checkQuery = "SELECT COUNT(*) FROM PostLikes WHERE user_id = :user_id AND post_id = :post_id";
            $checkStmt = $this->pdo->prepare($checkQuery);
            $checkStmt->execute([':user_id' => $userId, ':post_id' => $postId]);
            if ($checkStmt->fetchColumn() > 0) {
                return ['success' => false, 'message' => 'Post already liked by this user'];
            }

            $query = "INSERT INTO PostLikes (user_id, post_id, created_at) 
                      VALUES (:user_id, :post_id, NOW())";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':user_id' => $userId,
                ':post_id' => $postId
            ]);
            return ['success' => true, 'like_id' => $this->pdo->lastInsertId(), 'message' => 'Post liked successfully'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Comment on a post
    public function commentOnPost($userId, $postId, $content) {
        try {
            $query = "INSERT INTO Comments (user_id, post_id, content, created_at) 
                      VALUES (:user_id, :post_id, :content, NOW())";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':user_id' => $userId,
                ':post_id' => $postId,
                ':content' => $content
            ]);
            return ['success' => true, 'comment_id' => $this->pdo->lastInsertId(), 'message' => 'Comment added successfully'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Get post history of a user
    public function getPostHistory($userId) {
        try {
            $query = "SELECT p.post_id, p.content, p.media_url, p.created_at, u.username 
                      FROM Posts p 
                      JOIN Users u ON p.user_id = u.user_id 
                      WHERE p.user_id = :user_id 
                      ORDER BY p.created_at DESC";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':user_id' => $userId]);
            $posts = $stmt->fetchAll(PDO::FETCH_OBJ);
            return ['success' => true, 'posts' => $posts];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
    public function getAllPosts() {
        try {
            $query = "
                SELECT p.post_id, p.user_id, p.content, p.media_url, p.created_at, 
                       u.first_name, u.last_name, u.profile_picture_url
                FROM Posts p
                JOIN Users u ON p.user_id = u.user_id
                ORDER BY p.created_at DESC
            ";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $posts;
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
        }
    }

    // Get likes count of a post
    public function getLikesCount($postId) {
        try {
            $query = "SELECT COUNT(*) as likes_count FROM PostLikes WHERE post_id = :post_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':post_id' => $postId]);
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return ['success' => true, 'likes_count' => (int)$result->likes_count];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Get users who liked a post
    public function getLikedUsers($postId) {
        try {
            $query = "SELECT pl.user_id, u.username, u.first_name, u.last_name 
                      FROM PostLikes pl 
                      JOIN Users u ON pl.user_id = u.user_id 
                      WHERE pl.post_id = :post_id 
                      ORDER BY pl.created_at ASC";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':post_id' => $postId]);
            $users = $stmt->fetchAll(PDO::FETCH_OBJ);
            return ['success' => true, 'liked_users' => $users];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Get comments history of a post
    public function getCommentsHistory($postId) {
        try {
            $query = "SELECT c.comment_id, c.user_id, u.username, c.content, c.created_at 
                      FROM Comments c 
                      JOIN Users u ON c.user_id = u.user_id 
                      WHERE c.post_id = :post_id 
                      ORDER BY c.created_at ASC";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':post_id' => $postId]);
            $comments = $stmt->fetchAll(PDO::FETCH_OBJ);
            return ['success' => true, 'comments' => $comments];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Edit a post
    public function editPost($userId, $postId, $content, $mediaUrl = null) {
        try {
            // Check if the user owns the post
            $checkQuery = "SELECT COUNT(*) FROM Posts WHERE post_id = :post_id AND user_id = :user_id";
            $checkStmt = $this->pdo->prepare($checkQuery);
            $checkStmt->execute([':post_id' => $postId, ':user_id' => $userId]);
            if ($checkStmt->fetchColumn() == 0) {
                return ['success' => false, 'message' => 'You can only edit your own posts'];
            }

            $query = "UPDATE Posts SET content = :content, media_url = :media_url, updated_at = NOW() 
                      WHERE post_id = :post_id AND user_id = :user_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':content' => $content,
                ':media_url' => $mediaUrl,
                ':post_id' => $postId,
                ':user_id' => $userId
            ]);
            return ['success' => true, 'message' => 'Post updated successfully'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Delete a post
    public function deletePost($userId, $postId) {
        try {
            // Check if the user owns the post
            $checkQuery = "SELECT COUNT(*) FROM Posts WHERE post_id = :post_id AND user_id = :user_id";
            $checkStmt = $this->pdo->prepare($checkQuery);
            $checkStmt->execute([':post_id' => $postId, ':user_id' => $userId]);
            if ($checkStmt->fetchColumn() == 0) {
                return ['success' => false, 'message' => 'You can only delete your own posts'];
            }

            $query = "DELETE FROM Posts WHERE post_id = :post_id AND user_id = :user_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':post_id' => $postId, ':user_id' => $userId]);
            return $stmt->rowCount() > 0 
                ? ['success' => true, 'message' => 'Post deleted successfully'] 
                : ['success' => false, 'message' => 'Post not found'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
   
    
    public function updatePost($postId, $content, $mediaUrl = '') {
        try {
            $query = "UPDATE Posts SET content = :content, media_url = :media_url WHERE post_id = :post_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['post_id' => $postId, 'content' => $content, 'media_url' => $mediaUrl]);
            return ['success' => true, 'message' => 'Post updated'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
    
    public function getUserPosts($userId) {
        try {
            $query = "
                SELECT p.post_id, p.content, p.media_url, p.created_at, u.first_name, u.last_name, u.profile_picture_url
                FROM Posts p
                JOIN Users u ON p.user_id = u.user_id
                WHERE p.user_id = :user_id
                ORDER BY p.created_at DESC
            ";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['user_id' => $userId]);
            return ['success' => true, 'posts' => $stmt->fetchAll(PDO::FETCH_ASSOC)];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
}
?>