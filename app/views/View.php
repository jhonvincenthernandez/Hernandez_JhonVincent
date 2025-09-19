<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="icon"  href="<?=base_url().'public/icon.png';?>">
    <link rel="stylesheet" href="<?=base_url().'public/style.css';?>"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
  <div class="container mt-3 ">
      <form action="<?=site_url('View');?>" method="get" class="col-sm-4 float-end d-flex">
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
                    <?php foreach (html_escape($all) as $row): ?>
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
                <?php
                echo $page;
                ?>
        </div>
    </div>

        <script src="<?=base_url().'public/script.js';?>"></script>
</body>
</html>
