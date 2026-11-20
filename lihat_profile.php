<?php
session_start();
require_once 'koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['id'];

$sql = "SELECT users.*,
        COALESCE(siswa.nama, guru.nama) AS nama,
        siswa.nis, siswa.kelas,
        guru.nip
        FROM users
        LEFT JOIN siswa ON users.id = siswa.user_id
        LEFT JOIN guru ON users.id = guru.user_id
        WHERE users.id = '$id'";

$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($query);

$nama = $data['nama'] ?? '';

if ($data['role'] == 'admin') {
    $nama = 'Admin';
} elseif ($nama == '') {
    $nama = $data['username'];
}

$inisial = strtoupper(substr($nama, 0, 1));

require_once 'navbar.php';
?>

<style>
    body {
        background-color: #fff7fa;
    }

    .profile-card {
    border: 1px solid #f3c5d8;
    border-radius: 10px;
    overflow: hidden;
    background-color: white;
    width: 100%;
    max-width: 750px;
    margin: auto;
    }

    .profile-header {
        padding: 25px;
        text-align: center;
        border-bottom: 1px solid #f3c5d8;
    }

    .avatar {
        width: 85px;
        height: 85px;
        border-radius: 50%;
        background-color: #fce4ec;
        color: #8e4564;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 35px;
        font-weight: bold;
        margin: auto;
    }

    .profile-name {
        color: #8e4564;
        margin-top: 12px;
        font-weight: bold;
    }

    .role-badge {
        background-color: #d982a5;
        color: white;
    }

    .profile-section {
        padding: 15px;
        border-bottom: 1px solid #f3c5d8;
    }

    .profile-section h5 {
        color: #8e4564;
        font-weight: bold;
        margin-bottom: 25px;
    }

    .info-label {
        color: #777;
        margin-bottom: 3px;
    }

    .info-value {
        font-weight: 600;
        margin-bottom: 18px;
    }

    .btn-pink {
        background-color: #d982a5;
        color: white;
        border: none;
    }

    .btn-pink:hover {
        background-color: #c75b83;
        color: white;
    }
</style>

<div class="container mt-4 mb-5" style="max-width: 850px;">

    <h4 class="fw-bold">Profile</h4>
    <p class="text-muted">Informasi akun yang sedang login</p>

    <div class="profile-card mt-4">

        <div class="profile-header">

            <div class="avatar">
                <?= htmlspecialchars($inisial) ?>
            </div>

            <h5 class="profile-name">
                <?= htmlspecialchars($nama) ?>
            </h5>

            <span class="badge role-badge">
                <?= htmlspecialchars(strtoupper($data['role'])) ?>
            </span>

        </div>

        <div class="profile-section">

            <h5>Informasi Akun</h5>

            <div class="info-label">Username</div>
            <div class="info-value">
                <?= htmlspecialchars($data['username']) ?>
            </div>

            <div class="info-label">Role</div>
            <div class="info-value">
                <span class="badge role-badge">
                    <?= htmlspecialchars(ucfirst($data['role'])) ?>
                </span>
            </div>

        </div>

        <div class="profile-section">

            <h5>Data <?= htmlspecialchars(ucfirst($data['role'])) ?></h5>

            <div class="info-label">Nama</div>
            <div class="info-value">
                <?= htmlspecialchars($nama) ?>
            </div>

            <?php if ($data['role'] == 'siswa') { ?>

                <div class="info-label">NIS</div>
                <div class="info-value">
                    <?= htmlspecialchars($data['nis'] ?? '-') ?>
                </div>

                <div class="info-label">Kelas</div>
                <div class="info-value">
                    <?= htmlspecialchars($data['kelas'] ?? '-') ?>
                </div>

            <?php } ?>

            <?php if ($data['role'] == 'guru') { ?>

                <div class="info-label">NIP</div>
                <div class="info-value">
                    <?= htmlspecialchars($data['nip'] ?? '-') ?>
                </div>

            <?php } ?>

        </div>

        <div class="p-3 text-end">

            <a href="index.php" class="btn btn-secondary">
                Kembali
            </a>

            <a href="pengaturan.php" class="btn btn-pink">
                Edit Profile
            </a>

        </div>

    </div>

</div>

<?php require_once 'footer.php'; ?>
