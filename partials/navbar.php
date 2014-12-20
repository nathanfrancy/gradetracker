<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="dashboard.php">Grade Tracker</a>
    </div>
    <ul class="nav navbar-right top-nav">
        <li ng-controller="DropdownCtrl" class="dropdown" dropdown is-open="status.isopen">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" dropdown-toggle ng-disabled="disabled">
                <i class="fa fa-user"></i>&nbsp;
                <?php echo $user[ 'username']; ?>&nbsp;
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                </li>
                <li><a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav" ng-controller="HeaderController">
            <li ng-class="{ active: isActive('/home')}"><a href="#/home"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a></li>
            <li ng-class="{ active: isActive('/browse')}"><a href="#/browse"><i class="fa fa-fw fa-folder-o"></i> Browse</a></li>
        </ul>
    </div>
</nav>
