<nav class="navbar navbar-expand-lg bg-body-tertiary" style="min-width: 350px;">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php?pg=home"><?=esc(APP_NAME)?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php?pg=home">Point of sale</a>
        </li>

        <?php if(Auth::access('supervisor')):?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?pg=admin">Admin</a>
          </li>
        <?php endif;?>

        <?php if(Auth::access('admin')):?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?pg=signup">Create user</a>
          </li>
        <?php endif;?>

        <?php if(!Auth::logged_in()):?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?pg=login">Login</a>
          </li>
          
        <?php else:?>
      
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Hi, <?=auth('username')?> (<?=Auth::get('role')?>)
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?pg=profile">Profile</a></li>
            <li><a class="dropdown-item" href="index.php?pg=edit-user&id=<?=Auth::get('id')?>">Profile-Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="index.php?pg=logout">Logout</a></li>
          </ul>
        </li>
        <?php endif;?>

      </ul>

<?php if ($_GET['pg'] == "home"): ?>

        <div class="float-end btn btn-danger p-2 " style="background: red;">      
            <a class="nav-link" href="index.php?pg=logout" style="color:white;"><i class="fa fa-sign-out"> </i> Logout</a>          
        </div>

<?php endif ?>

      <!--
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      -->

    </div>
  </div>
</nav>