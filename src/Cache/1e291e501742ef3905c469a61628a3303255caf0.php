<nav class="navbar has-shadow" role="navigation" aria-label="main navigation">
  <div class="container">
    
    <!-- logo or branding image on left side -->
    <div class="navbar-brand">
      <a class="navbar-item" href="/">
        <img src="https://bulma.io/images/bulma-logo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
      </a>
      <div class="navbar-burger"  data-target="navbar-menu">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>

    <!-- children of navbar-menu must be navbar-start and/or navbar-end -->
    <div class="navbar-menu" id="navbar-menu">
      <!-- navbar items | left side -->
      <div class="navbar-start">
        <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">Docs</a>
            <div class="navbar-dropdown">
              <a class="navbar-item" href="#">Overview</a>
              <a class="navbar-item" href="#">Elements</a>
              <a class="navbar-item" href="#">Components</a>
              <hr class="navbar-divider">
              <div class="navbar-item"> Version 0.1.0</div>
            </div>
          </div>
      </div>

      <!-- navbar items | right side -->
      <div class="navbar-end">
        <?php if(!isset($_SESSION['user'])): ?>
            <a class="navbar-item" href="/?site=login">Login</a>
            <a class="navbar-item" href="/?site=register">Register</a>
        <?php else: ?>
            <a class="navbar-item" href="/?site=edit"><?php echo e($_SESSION['user']['username']); ?></a>
            <a class="navbar-item" href="/?site=logout">Log out</a>
        <?php endif; ?>
      </div>

    </div>
  </div>
</nav><?php /**PATH C:\xampp\htdocs\yourlaravel/src/Layouts/Navbar.blade.php ENDPATH**/ ?>