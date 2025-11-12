<?php
// Include the config file
require_once 'config.php';

// Common response helpers
function sendSuccess($message, $data = [], $statusCode = 200) {
    http_response_code($statusCode);
    echo json_encode([
        'status' => 'success',
        'message' => $message,
        'data' => $data
    ]);
    exit;
}

function sendError($message, $statusCode = 400) {
    http_response_code($statusCode);
    echo json_encode([
        'status' => 'error',
        'message' => $message
    ]);
    exit;
}

class EmployeeAPI {
    private $db;
    private $conn;
    
    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->connect();
    }

    private function formatDate($date) {
        if (empty($date)) return null;
        $timestamp = strtotime($date);
        return $timestamp ? date("Y-m-d", $timestamp) : null;
    }
    
    // CREATE
    public function createProfile($data) {
        try {
            if (empty($data['full_name']) || empty($data['email_address']) || empty($data['selected_role'])) {
                sendError('Full name, email address, and role are required fields', 400);
            }
            if (!filter_var($data['email_address'], FILTER_VALIDATE_EMAIL)) {
                sendError('Invalid email format', 400);
            }

            // Check email uniqueness
            $checkEmail = "SELECT id FROM employee_profiles WHERE email_address = :email";
            $stmt = $this->conn->prepare($checkEmail);
            $stmt->bindParam(':email', $data['email_address']);
            $stmt->execute();
            if ($stmt->rowCount() > 0) sendError('Email already exists', 409);

            // Check employee_id uniqueness
            if (!empty($data['employee_id'])) {
                $checkId = "SELECT id FROM employee_profiles WHERE employee_id = :emp_id";
                $stmt = $this->conn->prepare($checkId);
                $stmt->bindParam(':emp_id', $data['employee_id']);
                $stmt->execute();
                if ($stmt->rowCount() > 0) sendError('Employee ID already exists', 409);
            }

            // Insert query
            $sql = "INSERT INTO employee_profiles (
                selected_role, full_name, date_of_birth, gender, marital_status, nationality,
                phone_number, email_address, permanent_address, current_address,
                employee_id, job_title, department, date_of_joining, reporting_to, employee_type,
                highest_qualification, year_of_passing, university, specialization,
                previous_company, designation, duration, skills_technologies_used,
                bank_name, account_number, ifsc_code,
                pan_card_number, aadhar_number, passport_number,
                emergency_contact_name, emergency_contact_relation, emergency_contact_address
            ) VALUES (
                :selected_role, :full_name, :date_of_birth, :gender, :marital_status, :nationality,
                :phone_number, :email_address, :permanent_address, :current_address,
                :employee_id, :job_title, :department, :date_of_joining, :reporting_to, :employee_type,
                :highest_qualification, :year_of_passing, :university, :specialization,
                :previous_company, :designation, :duration, :skills_technologies_used,
                :bank_name, :account_number, :ifsc_code,
                :pan_card_number, :aadhar_number, :passport_number,
                :emergency_contact_name, :emergency_contact_relation, :emergency_contact_address
            )";

            $stmt = $this->conn->prepare($sql);

            // Bind params
            $stmt->bindParam(':selected_role', $data['selected_role']);
            $stmt->bindParam(':full_name', $data['full_name']);
            $stmt->bindParam(':date_of_birth', $this->formatDate($data['date_of_birth'] ?? ''));
            $stmt->bindParam(':gender', $data['gender'] ?? '');
            $stmt->bindParam(':marital_status', $data['marital_status'] ?? '');
            $stmt->bindParam(':nationality', $data['nationality'] ?? '');
            $stmt->bindParam(':phone_number', $data['phone_number'] ?? '');
            $stmt->bindParam(':email_address', $data['email_address']);
            $stmt->bindParam(':permanent_address', $data['permanent_address'] ?? '');
            $stmt->bindParam(':current_address', $data['current_address'] ?? '');
            $stmt->bindParam(':employee_id', $data['employee_id'] ?? '');
            $stmt->bindParam(':job_title', $data['job_title'] ?? '');
            $stmt->bindParam(':department', $data['department'] ?? '');
            $stmt->bindParam(':date_of_joining', $this->formatDate($data['date_of_joining'] ?? ''));
            $stmt->bindParam(':reporting_to', $data['reporting_to'] ?? '');
            $stmt->bindParam(':employee_type', $data['employee_type'] ?? '');
            $stmt->bindParam(':highest_qualification', $data['highest_qualification'] ?? '');
            $stmt->bindParam(':year_of_passing', $data['year_of_passing'] ?? '');
            $stmt->bindParam(':university', $data['university'] ?? '');
            $stmt->bindParam(':specialization', $data['specialization'] ?? '');
            $stmt->bindParam(':previous_company', $data['previous_company'] ?? '');
            $stmt->bindParam(':designation', $data['designation'] ?? '');
            $stmt->bindParam(':duration', $data['duration'] ?? '');
            $stmt->bindParam(':skills_technologies_used', $data['skills_technologies_used'] ?? '');
            $stmt->bindParam(':bank_name', $data['bank_name'] ?? '');
            $stmt->bindParam(':account_number', $data['account_number'] ?? '');
            $stmt->bindParam(':ifsc_code', $data['ifsc_code'] ?? '');
            $stmt->bindParam(':pan_card_number', $data['pan_card_number'] ?? '');
            $stmt->bindParam(':aadhar_number', $data['aadhar_number'] ?? '');
            $stmt->bindParam(':passport_number', $data['passport_number'] ?? '');
            $stmt->bindParam(':emergency_contact_name', $data['emergency_contact_name'] ?? '');
            $stmt->bindParam(':emergency_contact_relation', $data['emergency_contact_relation'] ?? '');
            $stmt->bindParam(':emergency_contact_address', $data['emergency_contact_address'] ?? '');

            if ($stmt->execute()) {
                $profileId = $this->conn->lastInsertId();
                sendSuccess('Employee profile created successfully!', [
                    'profile_id' => (int)$profileId
                ]);
            } else {
                sendError('Failed to create profile', 500);
            }
        } catch (PDOException $e) {
            error_log("DB error in createProfile: " . $e->getMessage());
            sendError('Database error occurred', 500);
        }
    }

    // READ - all
    public function getAllProfiles($limit = 50, $offset = 0) {
        try {
            $sql = "SELECT * FROM employee_profiles ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

            $profiles = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $countSql = "SELECT COUNT(*) as total FROM employee_profiles";
            $countStmt = $this->conn->prepare($countSql);
            $countStmt->execute();
            $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

            sendSuccess('Profiles retrieved', [
                'profiles' => $profiles,
                'total' => (int)$total,
                'limit' => (int)$limit,
                'offset' => (int)$offset
            ]);
        } catch (PDOException $e) {
            error_log("DB error in getAllProfiles: " . $e->getMessage());
            sendError('Database error', 500);
        }
    }

    // READ - by ID
    public function getProfileById($id) {
        try {
            $sql = "SELECT * FROM employee_profiles WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $profile = $stmt->fetch(PDO::FETCH_ASSOC);
                sendSuccess('Profile retrieved', $profile);
            } else {
                sendError('Profile not found', 404);
            }
        } catch (PDOException $e) {
            error_log("DB error in getProfileById: " . $e->getMessage());
            sendError('Database error', 500);
        }
    }

    // UPDATE
    public function updateProfile($id, $data) {
        try {
            $checkSql = "SELECT id FROM employee_profiles WHERE id = :id";
            $checkStmt = $this->conn->prepare($checkSql);
            $checkStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $checkStmt->execute();
            if ($checkStmt->rowCount() === 0) sendError('Profile not found', 404);

            $allowedFields = [
                'selected_role','full_name','date_of_birth','gender','marital_status','nationality',
                'phone_number','email_address','permanent_address','current_address',
                'employee_id','job_title','department','date_of_joining','reporting_to','employee_type',
                'highest_qualification','year_of_passing','university','specialization',
                'previous_company','designation','duration','skills_technologies_used',
                'bank_name','account_number','ifsc_code',
                'pan_card_number','aadhar_number','passport_number',
                'emergency_contact_name','emergency_contact_relation','emergency_contact_address'
            ];

            $updateFields = [];
            $params = [':id' => $id];

            foreach ($data as $field => $value) {
                if (in_array($field, $allowedFields)) {
                    $paramKey = ':' . $field;
                    $updateFields[] = "$field = $paramKey";
                    if (in_array($field, ['date_of_birth', 'date_of_joining'])) {
                        $params[$paramKey] = $this->formatDate($value);
                    } else {
                        $params[$paramKey] = $value;
                    }
                }
            }

            if (empty($updateFields)) sendError('No valid fields to update', 400);

            $sql = "UPDATE employee_profiles SET " . implode(', ', $updateFields) . " WHERE id = :id";
            $stmt = $this->conn->prepare($sql);

            foreach ($params as $key => $val) {
                $stmt->bindValue($key, $val);
            }

            if ($stmt->execute()) {
                sendSuccess('Profile updated successfully');
            } else {
                sendError('Failed to update profile', 500);
            }
        } catch (PDOException $e) {
            error_log("DB error in updateProfile: " . $e->getMessage());
            sendError('Database error', 500);
        }
    }

    // DELETE
    public function deleteProfile($id) {
        try {
            $sql = "DELETE FROM employee_profiles WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    sendSuccess('Profile deleted successfully');
                } else {
                    sendError('Profile not found', 404);
                }
            } else {
                sendError('Failed to delete profile', 500);
            }
        } catch (PDOException $e) {
            error_log("DB error in deleteProfile: " . $e->getMessage());
            sendError('Database error', 500);
        }
    }
}
