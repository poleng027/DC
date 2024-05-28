<?php
$current_page = basename($_SERVER['PHP_SELF']);
$id = $_SESSION['user_id'];
$data = $con->viewdata($id);

// Assuming the profile picture URL is stored in the session or fetched from the database
$profilePicture = $_SESSION['user_profile_picture'] ?? 'path/to/default/profile_picture.jpg';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Welcome, <?php echo $_SESSION['user']; ?>!</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
 

    
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="<?php echo $data['user_profile_picture']; ?>" width="30" height="30" class="rounded-circle mr-1"  alt="Profile Picture"> <?php echo $_SESSION['user']; ?>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changeProfilePictureModal"><i class="fas fa-user-circle"></i> Change Profile Picture</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateAccountInfoModal"><i class="fas fa-user-edit"></i> Update Account Information</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changePasswordModal"><i class="fas fa-key"></i> Change Password</a>
            <a class="dropdown-item" href="logout.php" onclick="return confirm('Are you sure you want to leave?')"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>

      </li>
    </ul>
  </div>
</nav>