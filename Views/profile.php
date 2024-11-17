<?php
// Simulate logged-in user data
$user = [
    'name' => 'Mariam',
    'email' => 'volunteer@example.com',
    'phone' => '+1234567890',
    'badges' => ['Environmentalist', 'First Responder'] // Example badges
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simulate adding a badge
    $newBadge = $_POST['badge'];
    if ($newBadge && !in_array($newBadge, $user['badges'])) {
        $user['badges'][] = $newBadge;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Volunteer Profile</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            padding: 20px;
        }
        .profile-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            max-width: 600px;
            margin: 20px auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #2d3e50;
        }
        .badges {
            margin: 10px 0;
        }
        .badge {
            display: inline-block;
            background-color: #2d3e50;
            color: white;
            padding: 5px 10px;
            margin: 5px;
            border-radius: 15px;
            font-size: 14px;
        }
        .form-group {
            margin: 20px 0;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
        }
        .form-group select, .form-group button {
            padding: 10px;
            font-size: 14px;
        }
        button {
            background-color: #2d3e50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #1a2736;
        }
    </style>
</head>
<body>
    <div class="profile-card">
        <h2>Profile Information</h2>
        <p><strong>Name:</strong> <?= $user['name']; ?></p>
        <p><strong>Email:</strong> <?= $user['email']; ?></p>
        <p><strong>Phone:</strong> <?= $user['phone']; ?></p>

        <h2>Badges</h2>
        <div class="badges">
            <?php foreach ($user['badges'] as $badge): ?>
                <span class="badge"><?= $badge; ?></span>
            <?php endforeach; ?>
        </div>

        <form method="POST">
            <div class="form-group">
                <label for="badge">Add Badge:</label>
                <select name="badge" id="badge">
                    <option value="Environmentalist">Environmentalist</option>
                    <option value="Community Helper">Community Helper</option>
                    <option value="First Responder">First Responder</option>
                    <option value="Animal Rescuer">Animal Rescuer</option>
                </select>
            </div>
            <button type="submit">Add Badge</button>
        </form>
    </div>
</body>
</html>
