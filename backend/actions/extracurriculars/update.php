<?php
// actions/extracurriculars/update.php
include '../../../config/connection.php';
include '../../../config/escapeString.php';
session_start();

if (isset($_POST['tombol'])) {
    $id = (int) $_GET['id'];

    // Ambil data lama
    $qSelect = "SELECT * FROM extracurriculars WHERE id='$id'";
    $resSelect = mysqli_query($connect, $qSelect);
    $ekskul = mysqli_fetch_object($resSelect);

    if (!$ekskul) {
        echo "<script>
                alert('Data tidak ditemukan');
                window.location.href='../../pages/extracurriculars/index.php';
              </script>";
        exit;
    }

    // Data dari form
    $name        = escapeString($_POST['name']);
    $description = escapeString($_POST['description']);
    $coach       = escapeString($_POST['coach']);

    // Default pakai gambar lama
    $image = $ekskul->image;

    // Track perubahan
    $changes = [];
    if ($ekskul->name != $name) $changes[] = "name: '{$ekskul->name}' → '$name'";
    if ($ekskul->description != $description) $changes[] = "description diubah";
    if ($ekskul->coach != $coach) $changes[] = "coach: '{$ekskul->coach}' → '$coach'";

    // Kalau ada file gambar baru
    if (!empty($_FILES['image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($ext, $allowedExt)) {
            $newFileName = time() . "_ekskul." . $ext;
            $imageTmp = $_FILES['image']['tmp_name'];

            // Hapus gambar lama jika ada
            $oldPath = "../../../storages/extracurriculars/" . $ekskul->image;
            if (!empty($ekskul->image) && file_exists($oldPath)) {
                unlink($oldPath);
            }

            // Pastikan folder ada
            $storages = "../../../storages/extracurriculars/";
            if (!is_dir($storages)) {
                mkdir($storages, 0777, true);
            }

            // Upload gambar baru
            move_uploaded_file($imageTmp, $storages . $newFileName);
            $changes[] = "image diganti";
            $image = $newFileName;
        } else {
            echo "<script>
                    alert('Format gambar tidak didukung. Gunakan JPG, PNG, GIF, atau WEBP.');
                    window.location.href='../../pages/extracurriculars/edit.php?id=$id';
                  </script>";
            exit;
        }
    }

    // Update query
    $qUpdate = "UPDATE extracurriculars 
                SET name='$name', description='$description', coach='$coach', image='$image' 
                WHERE id='$id'";

    if (mysqli_query($connect, $qUpdate)) {
        // Catat aktivitas user
        $user_id = $_SESSION['user_id'] ?? 0;
        $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        $desc    = !empty($changes) ? implode(", ", $changes) : "Tidak ada perubahan";

        $qLog = "INSERT INTO user_activities 
                    (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
                 VALUES
                    ('$user_id', 'update', 'extracurriculars', '$id', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";
        mysqli_query($connect, $qLog);

        echo "<script>
                alert('Data berhasil diedit');
                window.location.href='../../pages/extracurriculars/index.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal diedit: " . mysqli_error($connect) . "');
                window.location.href='../../pages/extracurriculars/edit.php?id=$id';
              </script>";
    }
}
?>
