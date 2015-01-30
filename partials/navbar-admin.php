<nav class="navbar navbar-default navbar-inverse navbar-static-top" role="navigation" ng-controller="NavBarController">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" ng-click="navbarCollapsed = !navbarCollapsed">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#/home">Gradetracker</a>
        </div>
        <div class="collapse navbar-collapse" collapse="navbarCollapsed">
            <ul class="nav navbar-nav">
                <li ng-class="{ active: isActive('/overview')}"><a href="#/overview">Overview</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <form class="navbar-form">
                        <div class="btn-group" dropdown>
                            <a href="#/profile" type="button" class="btn btn-primary">
                                <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;
                                <?php echo $user[ 'username']; ?>
                            </a>
                            <button type="button" class="btn btn-primary dropdown-toggle" dropdown-toggle>
                                <span class="caret"></span>
                                <span class="sr-only">Split button!</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#/profile">Profile</a></li></li>
                                <li class="divider"></li>
                                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                            </ul>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>