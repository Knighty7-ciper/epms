<nav class="navbar">
        <div class="nav_icon" onclick="toggleSidebar()">
          <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
        <div class="navbar__left">
          <a href="eggsSummary.php" onclick="toggle()">Eggs</a>
          <a href="birdsSummary.php" onclick="toggle()">Birds</a>
          <a href="feedSummary.php">Feed</a>
        </div>
        <div class="navbar__right">
            <h1 class="session__username"><?php echo 'Logged in as ' . $_SESSION["Username"]; ?></h1>
        </div>
      </nav>
