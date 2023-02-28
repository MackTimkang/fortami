<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@600&display=swap"
      rel="stylesheet"
    />
    <title></title>
  </head>
  <body>
    <nav class="navbar navbar-expand" style="background-color: #4990b5">
      <div class="container-fluid">
        <a
          class="navbar-brand"
          href="#"
          style="font-family: 'Montserrat Alternates', sans-serif; color: white"
          >Fortami</a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#" style="color: white">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="menu.php"style="color: white">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="shop.php"style="color: white">Food Shops</a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                style="color: white"
              >
                Account
              </a>
              <ul class="dropdown-menu">
                <li><a <?=(isset($_SESSION['user']))?'class="dropdown-item disabled"':'class="dropdown-item"'?> href="login.php">Login</a></li>
                <li><a <?=(isset($_SESSION['user']))?'class="dropdown-item"':'class="dropdown-item disabled"'?> href="./logout.php" >Logout</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                  <a <?=(isset($_SESSION['user']))?'class="dropdown-item disabled"':'class="dropdown-item"'?> href="./register.php">Create Account</a>
                </li>
              </ul>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-success" type="submit"style="color: white;background-color: black;">
              Search
            </button>
          </form>
          
        </div>
        
      </div>
    </nav>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
