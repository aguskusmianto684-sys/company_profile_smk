<?php
// backend/config/logActivity.php
function logActivity($connect, $userId, $activity, $tableName = null, $recordId = null, $description = null) {
    $ip        = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

    $activity    = mysqli_real_escape_string($connect, $activity);
    $tableName   = $tableName ? mysqli_real_escape_string($connect, $tableName) : null;
    $description = $description ? mysqli_real_escape_string($connect, $description) : null;

    $recordIdSql  = $recordId !== null ? "'$recordId'" : "NULL";
    $tableNameSql = $tableName ? "'$tableName'" : "NULL";
    $descSql      = $description ? "'$description'" : "NULL";

    $loginAtSql  = ($activity === 'login')  ? "NOW()" : "NULL";
    $logoutAtSql = ($activity === 'logout') ? "NOW()" : "NULL";

    // ✅ Cek apakah user masih ada
    $checkUser = mysqli_query($connect, "SELECT id FROM users WHERE id = '$userId' LIMIT 1");
    if (!$checkUser || mysqli_num_rows($checkUser) === 0) {
        // Kalau user tidak ada, jangan insert agar tidak error foreign key
        return false;
    }

    $qLog = "
        INSERT INTO user_activities 
        (user_id, activity, table_name, record_id, description, ip_address, user_agent, login_at, logout_at, created_at) 
        VALUES (
            '$userId',
            '$activity',
            $tableNameSql,
            $recordIdSql,
            $descSql,
            '$ip',
            '$userAgent',
            $loginAtSql,
            $logoutAtSql,
            NOW()
        )
    ";

    return mysqli_query($connect, $qLog);
}
