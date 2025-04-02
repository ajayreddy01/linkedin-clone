<?php
require '../core/init.php'; // Include initialization (e.g., PDO connection, class definitions)

header('Content-Type: application/json');

// Get the requested action from query parameters
$action = $_GET['action'] ?? '';

try {
    // Instantiate classes (assuming they’re available via init.php)


    // Define the API actions
    switch ($action) {

        // User Actions
        case 'signup':
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $firstName = $_POST['first_name'] ?? '';
            $lastName = $_POST['last_name'] ?? '';
            $headline = $_POST['headline'] ?? null;
            $bio = $_POST['bio'] ?? null;
            $location = $_POST['location'] ?? null;
            //echo json_encode($user->signup($username, $email, $password, $firstName, $lastName, $headline, $bio, $location));
            $result = $user->signup($username, $email, $password, $firstName, $lastName, $headline, $bio, $location);
            if ($result['success']) {
                header('Location: ../index.php');
                exit; // Stop execution after redirect
            } else {
                // Pass error message back to index.php (or another error page)
                header('Location: ../signup.php?error=' . urlencode($result['message']));
                exit;
            }
            break;

        case 'login':
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $result = $user->login($email, $password);
            if ($result['success']) {
                header('Location: ../index.php');
                exit; // Stop execution after redirect
            } else {
                // Pass error message back to index.php (or another error page)
                header('Location: ../login.php?error=' . urlencode($result['message']));
                exit;
            }
            break;

        case 'updateProfile':
            $userId = $_POST['user_id'] ?? '';
            $firstName = $_POST['first_name'] ?? '';
            $lastName = $_POST['last_name'] ?? '';
            $headline = $_POST['headline'] ?? null;
            $bio = $_POST['bio'] ?? null;
            $location = $_POST['location'] ?? null;
            $profilePictureUrl = $_POST['profile_picture_url'] ?? null;
            echo json_encode($user->updateProfile($userId, $firstName, $lastName, $headline, $bio, $location, $profilePictureUrl));
            break;

        // Skills
        case 'addSkill':
            $userId = $_POST['user_id'] ?? '';
            $skillName = $_POST['skill_name'] ?? '';
            $proficiencyLevel = $_POST['proficiency_level'] ?? '';
            echo json_encode($user->addSkill($userId, $skillName, $proficiencyLevel));
            break;

        case 'editSkill':
            $userId = $_POST['user_id'] ?? '';
            $skillId = $_POST['skill_id'] ?? '';
            $skillName = $_POST['skill_name'] ?? '';
            $proficiencyLevel = $_POST['proficiency_level'] ?? '';
            echo json_encode($user->editSkill($userId, $skillId, $skillName, $proficiencyLevel));
            break;

        case 'deleteSkill':
            $userId = $_POST['user_id'] ?? '';
            $skillId = $_POST['skill_id'] ?? '';
            echo json_encode($user->deleteSkill($userId, $skillId));
            break;

        case 'getSkills':
            $userId = $_POST['user_id'] ?? '';
            echo json_encode($user->getSkills($userId));
            break;

        // Education
        case 'addEducation':
            $userId = $_POST['user_id'] ?? '';
            $institutionName = $_POST['institution_name'] ?? '';
            $degree = $_POST['degree'] ?? '';
            $fieldOfStudy = $_POST['field_of_study'] ?? '';
            $startDate = $_POST['start_date'] ?? '';
            $endDate = $_POST['end_date'] ?? null;
            echo json_encode($user->addEducation($userId, $institutionName, $degree, $fieldOfStudy, $startDate, $endDate));
            break;

        case 'editEducation':
            $userId = $_POST['user_id'] ?? '';
            $educationId = $_POST['education_id'] ?? '';
            $institutionName = $_POST['institution_name'] ?? '';
            $degree = $_POST['degree'] ?? '';
            $fieldOfStudy = $_POST['field_of_study'] ?? '';
            $startDate = $_POST['start_date'] ?? '';
            $endDate = $_POST['end_date'] ?? null;
            echo json_encode($user->editEducation($userId, $educationId, $institutionName, $degree, $fieldOfStudy, $startDate, $endDate));
            break;

        case 'deleteEducation':
            $userId = $_POST['user_id'] ?? '';
            $educationId = $_POST['education_id'] ?? '';
            echo json_encode($user->deleteEducation($userId, $educationId));
            break;

        case 'getEducation':
            $userId = $_POST['user_id'] ?? '';
            echo json_encode($user->getEducation($userId));
            break;

        // Experience
        case 'addExperience':
            $userId = $_POST['user_id'] ?? '';
            $companyName = $_POST['company_name'] ?? '';
            $jobTitle = $_POST['job_title'] ?? '';
            $location = $_POST['location'] ?? '';
            $startDate = $_POST['start_date'] ?? '';
            $endDate = $_POST['end_date'] ?? null;
            $description = $_POST['description'] ?? null;
            echo json_encode($user->addExperience($userId, $companyName, $jobTitle, $location, $startDate, $endDate, $description));
            break;

        case 'editExperience':
            $userId = $_POST['user_id'] ?? '';
            $experienceId = $_POST['experience_id'] ?? '';
            $companyName = $_POST['company_name'] ?? '';
            $jobTitle = $_POST['job_title'] ?? '';
            $location = $_POST['location'] ?? '';
            $startDate = $_POST['start_date'] ?? '';
            $endDate = $_POST['end_date'] ?? null;
            $description = $_POST['description'] ?? null;
            echo json_encode($user->editExperience($userId, $experienceId, $companyName, $jobTitle, $location, $startDate, $endDate, $description));
            break;

        case 'deleteExperience':
            $userId = $_POST['user_id'] ?? '';
            $experienceId = $_POST['experience_id'] ?? '';
            echo json_encode($user->deleteExperience($userId, $experienceId));
            break;

        case 'getExperience':
            $userId = $_POST['user_id'] ?? '';
            echo json_encode($user->getExperience($userId));
            break;

        // Connections
        case 'sendConnectionRequest':
            $userId = $_POST['user_id'] ?? '';
            $connectedUserId = $_POST['connected_user_id'] ?? '';
            echo json_encode($user->sendConnectionRequest($userId, $connectedUserId));
            break;

        case 'acceptConnectionRequest':
            $connectionId = $_POST['connection_id'] ?? '';
            $userId = $_POST['user_id'] ?? '';
            echo json_encode($user->acceptConnectionRequest($connectionId, $userId));
            break;

        case 'getConnections':
            $userId = $_POST['user_id'] ?? '';
            echo json_encode($user->getConnections($userId));
            break;

        // Follows
        case 'follow':
            $followerId = $_POST['follower_id'] ?? '';
            $followedUserId = $_POST['followed_user_id'] ?? '';
            echo json_encode($user->follow($followerId, $followedUserId));
            break;

        case 'getFollows':
            $followerId = $_POST['follower_id'] ?? '';
            echo json_encode($user->getFollows($followerId));
            break;

        // Messages
        case 'sendMessage':
            $senderId = $_POST['sender_id'] ?? '';
            $recipientId = $_POST['recipient_id'] ?? '';
            $content = $_POST['content'] ?? '';
            echo json_encode($message->sendMessage($senderId, $recipientId, $content));
            break;

        case 'receiveMessages':
            $userId = $_POST['user_id'] ?? '';
            echo json_encode($message->receiveMessages($userId));
            break;

        case 'getChatHistory':
            $userId = $_POST['user_id'] ?? '';
            $otherUserId = $_POST['other_user_id'] ?? '';
            echo json_encode($message->getChatHistory($userId, $otherUserId));
            break;

        case 'getInteractedUsers':
            $userId = $_POST['user_id'] ?? '';
            echo json_encode($message->getInteractedUsers($userId));
            break;

        // Posts
        case 'createPost':
            $userId = $_POST['user_id'] ?? '';
            $content = $_POST['content'] ?? '';
            $mediaUrl = $_POST['media_url'] ?? null;
            echo json_encode($post->createPost($userId, $content, $mediaUrl));
            break;

        case 'editPost':
            $userId = $_POST['user_id'] ?? '';
            $postId = $_POST['post_id'] ?? '';
            $content = $_POST['content'] ?? '';
            $mediaUrl = $_POST['media_url'] ?? null;
            echo json_encode($post->editPost($userId, $postId, $content, $mediaUrl));
            break;

        case 'deletePost':
            $userId = $_POST['user_id'] ?? '';
            $postId = $_POST['post_id'] ?? '';
            echo json_encode($post->deletePost($userId, $postId));
            break;

        case 'likePost':
            $userId = $_POST['user_id'] ?? '';
            $postId = $_POST['post_id'] ?? '';
            echo json_encode($post->likePost($userId, $postId));
            break;

        case 'commentOnPost':
            $userId = $_POST['user_id'] ?? '';
            $postId = $_POST['post_id'] ?? '';
            $content = $_POST['content'] ?? '';
            echo json_encode($post->commentOnPost($userId, $postId, $content));
            break;

        case 'getPostHistory':
            $userId = $_POST['user_id'] ?? '';
            echo json_encode($post->getPostHistory($userId));
            break;

        case 'getLikesCount':
            $postId = $_POST['post_id'] ?? '';
            echo json_encode($post->getLikesCount($postId));
            break;

        case 'getLikedUsers':
            $postId = $_POST['post_id'] ?? '';
            echo json_encode($post->getLikedUsers($postId));
            break;

        case 'getCommentsHistory':
            $postId = $_POST['post_id'] ?? '';
            echo json_encode($post->getCommentsHistory($postId));
            break;
        case 'recommendUsers':
            $userId = $_POST['user_id'] ?? '';
            $limit = $_POST['limit'] ?? 3; // Default to 3 recommendations
            echo json_encode($user->recommendUsers($userId, $limit));
            break;
        default:
            echo json_encode(['error' => 'Invalid action']);
            break;
    }
} catch (PDOException $e) {
    // Handle database errors
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    // Handle general errors
    echo json_encode(['error' => 'General error: ' . $e->getMessage()]);
}
