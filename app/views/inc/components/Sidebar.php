<aside class="sidebar container-fluid">
    <div class="row text-center brand-logo-container">
        <div class="col-12 brand-logo-large">
            <img src="<?php echo URL_ROOT ?>/public/img/navbar-logo-large.webp" alt="logo" height="96px">
        </div>
        <div class="col-12 brand-logo-small pt-2">
            <img src="<?php echo URL_ROOT ?>/public/img/navbar-logo-small.webp" alt="logo" height="72px">
        </div>
    </div>
    <div class="row"></div>
    <div class="col-12">
        <ul class="sidebar-links">
            <?php
            foreach ($this->sidebarLinks as $key => $value) {
                if ($value['link'] == $this->activeLink) {
                    echo '<li>
                        <a href="' . $value['link'] . '" class="selected">
                            <img src="' . URL_ROOT . '/public/img/icons/sidebar/' . $value['icon'] . '-active.png" 
                            alt="' . $value['icon'] . '-selected-icon" height="30px" title="' . $key . '">
                            <span>' . $key . '</span>
                        </a>
                      </li>';
                } else {
                    echo '<li>
                        <a href="' . $value['link'] . '">
                            <img src="' . URL_ROOT . '/public/img/icons/sidebar/' . $value['icon'] . '.png" alt="' .
                        $value['icon'] . '-icon" height="30px" title="' . $key . '">
                            <span>' . $key . '</span>
                        </a>
                      </li>';
                }
            }
            ?>
        </ul>
    </div>
</aside>