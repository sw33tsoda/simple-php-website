<nav class="navbar has-shadow" role="navigation" aria-label="main navigation">
  <div class="container">
    
    <!-- logo or branding image on left side -->
    <div class="navbar-brand">
      <a class="navbar-item" href="/?site=welcome">
        <img src="src/Storage/Web/Logo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="35px" height="35px">
      </a>
    </div>

    <!-- children of navbar-menu must be navbar-start and/or navbar-end -->
    <div class="navbar-end navbar-item" id="navbar-menu">

      <!-- navbar items | right side -->
      <div class="navbar-end columns is-vcentered">
        @if (!isset($_SESSION['user']))
            <a class="navbar-item" href="/?site=login">Login</a>
            <a class="navbar-item" href="/?site=register">Register</a>
        @else
            <a class="navbar-item button is-success is-small" href="/?site=add_post">ADD POST</a>
            <a class="navbar-item button is-warning is-small" href="/?site=my_post">MY POST</a>
            <a class="navbar-item" href="/?site=edit">{{$_SESSION['user']['username']}}</a>
            <a class="navbar-item" href="/?site=logout">Log out</a>
        @endif
      </div>

    </div>
  </div>

  
</nav>