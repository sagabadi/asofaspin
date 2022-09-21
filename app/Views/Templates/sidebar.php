<div class="nav-left-sidebar sidebar-dark">
    <?php 
        $uri = current_url(true);
     ?>
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (($uri->getTotalSegments() >= 1 && $uri->getSegment(1) == 'dashboard')): ?>
                        active
                    <?php endif ?>" href="<?= base_url('/dashboard')?>"><i class="fa fa-fw fa-user-circle"></i>Dashboard <span class="badge badge-success">6</span></a>                                
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link <?php if (($uri->getTotalSegments() >= 1 && $uri->getSegment(1) == 'link')): ?>
                        active
                    <?php endif ?>" href="<?= base_url('/link')?>"><i class="fas fa-link mr-2"></i>Generate Link <span class="badge badge-success">6</span></a>                                
                    </li>          
                    <li class="nav-item ">
                        <a class="nav-link" href="<?= base_url('/logout')?>"><i class="fas fa-power-off mr-2"></i>Logout <span class="badge badge-success">6</span></a>                                
                    </li>                    
                </ul>
            </div>
        </nav>
    </div>
</div>
