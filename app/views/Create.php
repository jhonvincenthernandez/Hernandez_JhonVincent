<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link rel="stylesheet" href="<?=base_url().'public/style.css';?>"/>
</head>
<body>
<div class="container">
    <div class="toggle-btn">
        <button onclick="toggleTheme()">🌙 Toggle Dark Mode</button>
    </div>
    <h1>Create User</h1>
    <form action="<?=site_url('/crud/create'); ?>" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <input type="submit" value="Create">
    </form>
</div>
    <script src="<?=base_url().'public/script.js';?>"></script>
</body>
</html>
