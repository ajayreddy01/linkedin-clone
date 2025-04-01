<?php
class Message {
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Send a message
    public function sendMessage($senderId, $recipientId, $content) {
        try {
            $query = "INSERT INTO Messages (sender_id, recipient_id, content, sent_at) 
                      VALUES (:sender_id, :recipient_id, :content, NOW())";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':sender_id' => $senderId,
                ':recipient_id' => $recipientId,
                ':content' => $content
            ]);
            return ['success' => true, 'message_id' => $this->pdo->lastInsertId(), 'message' => 'Message sent successfully'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Receive messages (unread messages for the user)
    public function receiveMessages($userId) {
        try {
            $query = "SELECT m.message_id, m.sender_id, u.username AS sender_username, m.content, m.sent_at 
                      FROM Messages m 
                      JOIN Users u ON m.sender_id = u.user_id 
                      WHERE m.recipient_id = :user_id 
                      ORDER BY m.sent_at DESC";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':user_id' => $userId]);
            $messages = $stmt->fetchAll(PDO::FETCH_OBJ);
            return ['success' => true, 'messages' => $messages];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Get chat history with a specific user
    public function getChatHistory($userId, $otherUserId) {
        try {
            $query = "SELECT m.message_id, m.sender_id, m.recipient_id, u1.username AS sender_username, 
                             u2.username AS recipient_username, m.content, m.sent_at 
                      FROM Messages m 
                      JOIN Users u1 ON m.sender_id = u1.user_id 
                      JOIN Users u2 ON m.recipient_id = u2.user_id 
                      WHERE (m.sender_id = :user_id AND m.recipient_id = :other_user_id) 
                         OR (m.sender_id = :other_user_id AND m.recipient_id = :user_id) 
                      ORDER BY m.sent_at ASC";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':user_id' => $userId,
                ':other_user_id' => $otherUserId
            ]);
            $history = $stmt->fetchAll(PDO::FETCH_OBJ);
            return ['success' => true, 'chat_history' => $history];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Get users with whom the current user has interacted
    public function getInteractedUsers($userId) {
        try {
            $query = "SELECT DISTINCT u.user_id, u.username, u.first_name, u.last_name 
                      FROM Messages m 
                      JOIN Users u ON (u.user_id = m.sender_id OR u.user_id = m.recipient_id) 
                      WHERE (m.sender_id = :user_id OR m.recipient_id = :user_id) 
                        AND u.user_id != :user_id 
                      ORDER BY u.username";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':user_id' => $userId]);
            $users = $stmt->fetchAll(PDO::FETCH_OBJ);
            return ['success' => true, 'interacted_users' => $users];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
}
?>