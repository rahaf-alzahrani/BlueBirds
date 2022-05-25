<?php
function encryptPassword($password)
{
    $options = [
        'cost' => 12,
    ];
    return password_hash($password, PASSWORD_BCRYPT, $options);
}

function getManagerInfo($id)
{
    global $conn;
    global $error_msg;

    $id = mysqli_real_escape_string($conn, $id);

    $sql = "SELECT * FROM `Manager` WHERE id = '$id';";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
        return $user;
    }

    $error_msg = "Error, can not get manager info.";
    return false;
}

function getEmployeeInfo($id)
{
    global $conn;
    global $error_msg;

    $id = mysqli_real_escape_string($conn, $id);

    $sql = "SELECT * FROM `Employee` WHERE id = '$id';";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
        return $user;
    }

    $error_msg = "Error, can not get emplyee info.";
    return false;
}

function isEmailExists($email, $table, $conn)
{
    $sql = "SELECT * FROM `$table` WHERE email='$email'; ";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0)
        return true;
    return false;
}

function isUsernameExists($username, $table, $conn)
{
    $sql = "SELECT * FROM `$table` WHERE emp_number ='$username'; ";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0)
        return true;
    return false;
}

function esignup($emp_number, $first_name, $last_name, $job_title, $password)
{
    global $conn;
    global $error_msg;

    if (isUsernameExists($emp_number, 'Employee', $conn)) {
        $error_msg = "Username aready exists.";
        return false;
    }

    $emp_number = mysqli_real_escape_string($conn, $emp_number);
    $first_name = mysqli_real_escape_string($conn, $first_name);
    $last_name = mysqli_real_escape_string($conn, $last_name);
    $job_title = mysqli_real_escape_string($conn, $job_title);
    $password = mysqli_real_escape_string($conn, $password);
    $hashed_password = encryptPassword($password);

    $sql = "INSERT INTO `Employee` (emp_number, first_name, last_name, job_title, password) VALUES ($emp_number, '$first_name', '$last_name', '$job_title', '$hashed_password')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return mysqli_insert_id($conn);
    }

    $error_msg = "Error, Can not add employee.";
    return false;
}

function loginManager($username, $password)
{
    global $conn;
    global $error_msg;

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM `manager` WHERE username = '$username';";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            return $user['id'];
        } else {
            $error_msg = "Username or password not matched.";
            return false;
        }
    }

    $error_msg = "Error, Can not login.";
    return false;
}

function loginEmployee($emp_number, $password)
{
    global $conn;
    global $error_msg;

    $emp_number = mysqli_real_escape_string($conn, $emp_number);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM `employee` WHERE emp_number = '$emp_number';";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            return $user['id'];
        } else {
            $error_msg = "Username or password not matched.";
            return false;
        }
    }

    $error_msg = "Error, Can not login.";
    return false;
}

function getEmployeeInProgressRequests($id)
{
    global $conn;
    global $error_msg;

    $id = mysqli_real_escape_string($conn, $id);

    $sql = "SELECT r.*, s.type AS service_type FROM `Request` r, `Service` s WHERE r.service_id = s.id AND emp_id = '$id' AND `status` LIKE '%In progress%'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return $result;
    }

    $error_msg = "Error, Can not get Rrequests.";
    return false;
}

function getEmployeePreviousRequests($id)
{
    global $conn;
    global $error_msg;

    $id = mysqli_real_escape_string($conn, $id);

    $sql = "SELECT r.*, s.type AS service_type FROM `Request` r, `Service` s WHERE r.service_id = s.id AND emp_id = '$id' AND `status` NOT LIKE '%In progress%'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return $result;
    }

    $error_msg = "Error, Can not get Rrequests.";
    return false;
}

function getNextID($table_name)
{
    global $conn;
    global $database;
    global $error_msg;

    $table_name = mysqli_real_escape_string($conn, $table_name);

    $sql = "SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = '$table_name' AND table_schema = '$database' ;";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['AUTO_INCREMENT'];
    }

    $error_msg = "Error, Can not getAUTO_INCREMENT." . $sql;
    return false;
}


function addRequest($user_id, $service_type, $description, $files)
{
    global $conn;
    global $error_msg;

    $emp_id = mysqli_real_escape_string($conn, $user_id);
    $service_id = mysqli_real_escape_string($conn, $service_type);
    $description = mysqli_real_escape_string($conn, $description);

    $status = "In progress";

    if (empty(trim($emp_id)) || empty(trim($service_id)) || empty(trim($description))) {
        $error_msg = "Provide all requested data.";
        return false;
    }
    if ($files != null) {
        $attachment1 = mysqli_real_escape_string($conn, $files[0]);
        $attachment2 = mysqli_real_escape_string($conn, $files[1]);
    }

    $sql = "INSERT INTO `Request` (emp_id, service_id, description, attachment1, attachment2, status) values ('$emp_id', '$service_id', '$description', '$attachment1', '$attachment2', '$status');";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return mysqli_insert_id($conn);
    }

    $error_msg = "Error, Can not add Request.";
    return false;
}

function editRequest($request_id, $service_type, $description, $files)
{
    global $conn;
    global $error_msg;

    $request_id = mysqli_real_escape_string($conn, $request_id);
    $service_id = mysqli_real_escape_string($conn, $service_type);
    $description = mysqli_real_escape_string($conn, $description);
    $attachment1 = isset($files[0]) ? mysqli_real_escape_string($conn, $files[0]) : '';
    $attachment2 = isset($files[1]) ? mysqli_real_escape_string($conn, $files[1]) : '';

    if (empty(trim($request_id)) || empty(trim($service_id)) || empty(trim($description))) {
        $error_msg = "Please, Provide all request data.";
        return false;
    }

    $sql = "UPDATE `Request` SET service_id = '$service_id', description = '$description', attachment1 = '$attachment1', attachment2 = '$attachment2' WHERE id = '$request_id';";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return true;
    }

    $error_msg = "Error, Can not edit Request." . $sql;
    return false;
}

function getRequestInfo($id)
{
    global $conn;
    global $error_msg;

    $id = mysqli_real_escape_string($conn, $id);

    $sql = "SELECT r.*, e.first_name AS emp_first_name, e.last_name AS emp_last_name, s.type AS service_type FROM `Request` r, `Employee` e, `Service` s WHERE r.emp_id = e.id AND r.service_id = s.id AND r.id = '$id';";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $request = mysqli_fetch_assoc($result);
        return $request;
    }

    $error_msg = "Error, Can not get request info.";
    return false;
}

function getServices()
{
    global $conn;
    global $error_msg;

    $sql = "SELECT * FROM `Service`";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return $result;
    }

    $error_msg = "Error, Can not get data.";
    return false;
}

function getRequestsByServiceType($service_id)
{
    global $conn;
    global $error_msg;

    $service_id = mysqli_real_escape_string($conn, $service_id);

    $sql = "SELECT r.*, e.first_name AS emp_first_name, e.last_name AS emp_last_name, s.type AS service_type FROM `Request` r, `Employee` e, `Service` s WHERE r.emp_id = e.id AND r.service_id = s.id AND r.service_id = '$service_id';";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return $result;
    }

    $error_msg = "Error, Can not get request info.";
    return false;
}

function approveRequest($request_id)
{
    global $conn;
    global $error_msg;

    $request_id = mysqli_real_escape_string($conn, $request_id);

    $sql = "UPDATE `Request` SET status = 'Approved' WHERE id = '$request_id';";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_affected_rows($conn) > 0) {
        return true;
    }

    $error_msg = "Error, Can not approve Request.";
    return false;
}

function declineRequest($request_id)
{
    global $conn;
    global $error_msg;

    $request_id = mysqli_real_escape_string($conn, $request_id);

    $sql = "UPDATE `Request` SET status = 'Declined' WHERE id = '$request_id';";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_affected_rows($conn) > 0) {
        return true;
    }

    $error_msg = "Error, Can not approve Request.";
    return false;
}

