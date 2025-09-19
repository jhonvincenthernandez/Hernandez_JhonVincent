<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="icon"  href="<?=base_url().'public/icon.png';?>">
    <link rel="stylesheet" href="<?=base_url().'public/style.css';?>"/>
</head>
<body>
  <div class="container mt-3 ">
	<form action="<?=site_url('author');?>" method="get" class="col-sm-4 float-end d-flex">
		<?php
		$q = '';
		if(isset($_GET['q'])) {
			$q = $_GET['q'];
		}
		?>
        <input class="form-control me-2" name="q" type="text" placeholder="Search" value="<?=html_escape($q);?>">
        <button type="submit" class="btn btn-primary" type="button">Search</button>
	</form>
<div class="container">
    <div class="toggle-btn">
        <button onclick="toggleTheme()">🌙 Toggle Dark Mode</button>
    </div>
    <h1>User List</h1>
    <a href="https://www.google.com" target="_blank">Google</a>
    <a href="<?=site_url('crud/create'); ?>">+ Add User</a>

    <!-- 🔍 Search bar -->
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search by name or email...">
    </div>

    <table id="userTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach (html_escape($data) as $row): ?>
              <tr>
                <td><?=($row['id']); ?></td>
                <td><?=($row['name']); ?></td>
                <td><?=($row['email']); ?></td>
                <td>
                  <a href="<?=site_url('crud/update/'.$row['id']); ?>" onclick="return confirm('Are you sure you want to update this user?')">Edit</a>
                  <a href="<?=site_url('crud/delete/'.$row['id']); ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

 
</div>
        <!-- External JS -->
        <script src="<?=base_url().'public/script.js';?>"></script>
</body>
</html>
