<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="index.html">
            <div class="logo-img">
                <img src="src/img/brand-white.svg" class="header-brand-img" alt="lavalite">
            </div>
            <span class="text">ThemeKit</span>
        </a>
        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-lavel">ParkNow</div>

                <div class="nav-item <?php echo ($this->router->fetch_class() == 'home' && $this->router->fetch_method() == 'index' ? 'active' : '' );  ?>">
                    <a data-toggle="tooltip" data-placement="right" title="Home" href="<?php echo base_url(''); ?>"><i class="ik ik-home"></i><span>Home</span></a>
                </div>

                <div class="nav-item <?php echo ($this->router->fetch_class() == 'mensalistas' && $this->router->fetch_method() == 'index' ? 'active' : '' );  ?>">
                    <a data-toggle="tooltip" data-placement="right" title="Gerenciar mensalistas" href="<?php echo base_url('mensalistas'); ?>"><i class="fas fa-users"></i><span>Mensalistas</span></a>
                </div>


               <!--
                <div class="nav-item has-sub">
                    <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Widgets</span> <span class="badge badge-danger">150+</span></a>
                    <div class="submenu-content">
                        <a href="pages/widgets.html" class="menu-item">Basic</a>
                        <a href="pages/widget-statistic.html" class="menu-item">Statistic</a>
                        <a href="pages/widget-data.html" class="menu-item">Data</a>
                        <a href="pages/widget-chart.html" class="menu-item">Chart Widget</a>
                    </div>
                </div>
                -->

                <div class="nav-lavel">Administração</div>

                <div class="nav-item <?php echo ($this->router->fetch_class() == 'usuarios' && $this->router->fetch_method() == 'index' ? 'active' : '' );  ?>">
                    <a data-toggle="tooltip" data-placement="right" title="Gerenciar usuários" href="<?php echo base_url('usuarios'); ?>"><i class="ik ik-users"></i><span>Usuários</span></a>
                </div>
                <div class="nav-item <?php echo ($this->router->fetch_class() == 'sistema' && $this->router->fetch_method() == 'index' ? 'active' : '' );  ?>">
                    <a data-toggle="tooltip" data-placement="right" title="Gerenciar sistema"  href="<?php echo base_url('sistema'); ?>"><i class="ik ik-settings"></i><span>Sistema</span></a>
                </div>
                <div class="nav-item <?php echo ($this->router->fetch_class() == 'precificacoes' && $this->router->fetch_method() == 'index' ? 'active' : '' );  ?>">
                    <a data-toggle="tooltip" data-placement="right" title="Gerenciar Precificações" href="<?php echo base_url('precificacoes'); ?>"><i class="ik ik-dollar-sign"></i><span>Precificações</span></a>
                </div>

                <div class="nav-item <?php echo ($this->router->fetch_class() == 'mensalidades' && $this->router->fetch_method() == 'index' ? 'active' : '' );  ?>">
                    <a data-toggle="tooltip" data-placement="right" title="Gerenciar Mensalidades" href="<?php echo base_url('mensalidades'); ?>"><i class="fas fa-hand-holding-usd"></i><span>Mensalidades</span></a>
                </div>

                <div class="nav-item <?php echo ($this->router->fetch_class() == 'formas' && $this->router->fetch_method() == 'index' ? 'active' : '' );  ?>">
                    <a data-toggle="tooltip" data-placement="right" title="Gerenciar formas de pagamento" href="<?php echo base_url('formas'); ?>"><i class="fas fa-comment-dollar"></i><span>Formas de Pagamento</span></a>
                </div>

            </nav>
        </div>
    </div>
</div>