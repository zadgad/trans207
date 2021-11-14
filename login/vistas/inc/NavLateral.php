 
 <section class="full-box nav-lateral">

            <div class="full-box nav-lateral-bg show-nav-lateral"></div>
            <div class="full-box nav-lateral-content">
                <figure class="full-box nav-lateral-avatar">
                    <i class="far fa-times-circle show-nav-lateral"></i>
                    <img src="<?php echo SERVERURL; ?>vistas/assets/avatar/descarga.png" class="img-fluid" alt="Avatar">
                    <figcaption class="roboto-medium text-center">
                        <?php echo $_SESSION['nombre_spm']." ".$_SESSION['apellido_spm']; ?> <br><small class="roboto-condensed-light"><?php echo $_SESSION['usuario_spm']; ?></small>

                    </figcaption>
                    
                </figure>
                
                <div class="full-box nav-lateral-bar"></div>
                <nav class="full-box nav-lateral-menu">
                    <ul>
                        <li>
                            <a href="<?php echo SERVERURL; ?>home/"><i class="fas fa-home fa-spin fa-1x"></i> &nbsp; Inicio</a>
                        </li>

                        <!--<li>
                            <a href="#" class="nav-btn-submenu"><i class="fas fa-file-invoice-dollar fa-fw"></i> &nbsp; Préstamos <i class="fas fa-chevron-down"></i></a>
                            <ul>
                                <li>
                                    <a href="<?php echo SERVERURL; ?>reservation-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; Nuevo préstamo</a>
                                </li>
                                <li>
                                    <a href="<?php echo SERVERURL; ?>reservation-reservation/"><i class="far fa-calendar-alt fa-fw"></i> &nbsp; Reservaciones</a>
                                </li>
                                <li>
                                    <a href="<?php echo SERVERURL; ?>reservation-pending/"><i class="fas fa-hand-holding-usd fa-fw"></i> &nbsp; Préstamos</a>
                                </li>
                                <li>
                                    <a href="<?php echo SERVERURL; ?>reservation-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Finalizados</a>
                                </li>
                                <li>
                                    <a href="<?php echo SERVERURL; ?>reservation-search/"><i class="fas fa-search-dollar fa-fw"></i> &nbsp; Buscar por fecha</a>
                                </li>
                            </ul>
                        </li>-->
                        <?php if ($_SESSION['privilegio_spm']==1) {               

                         ?>
                        <li>
                            <a href="#" class="nav-btn-submenu"><i class="fas  fa-user-secret fa-fw"></i> &nbsp; Usuarios <i class="fas fa-chevron-down"></i></a>
                            <ul>
                                <li>
                                    <a href="<?php echo SERVERURL; ?>user-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; Nuevo usuario</a>
                                </li>
                                <li>
                                    <a href="<?php echo SERVERURL; ?>user-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de usuarios</a>
                                </li>
                                <li>
                                    <a href="<?php echo SERVERURL; ?>user-search/"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar usuario</a>
                                </li>
                            </ul>
                        </li>
                        <?php 
                         } 
                         if ($_SESSION['privilegio_spm']==1 || $_SESSION['privilegio_spm']==2)
                         {
                         ?>
                        <!-- <li>
                            <a href="<?php echo SERVERURL; ?>company/"><i class="fas fa-store-alt fa-fw"></i> &nbsp; Empresa</a>
                        </li> -->
                       
                        <?php
                        }
                        ?>
                        
                    </ul>
                </nav>
            </div>
        </section>