<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="<?=base_url().'public/style.css';?>"/>
</head>
<body>
<div class="container">
    <div class="toggle-btn">
        <button onclick="toggleTheme()">🌙 Toggle Dark Mode</button>
    </div>
    <h1>Update User</h1>
    <form action="<?=site_url('/crud/update/'.$data['id']); ?>" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?=($data['name']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?=($data['email']); ?>" required>

        <input type="submit" value="Update">
    </form>
</div>
    <script src="<?=base_url().'public/script.js';?>"></script>
</body>
</html>
