<aside class="sidebar container-fluid">
    <div class="row text-center">
        <div class="col-12 brand-logo">
            <img src="<?php echo URL_ROOT ?>/public/img/navbar-logo.webp" alt="logo" height="100px">
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
                            <img src="' . URL_ROOT . '/public/img/icons/' . $value['icon'] . '-active.png" alt="' .
                        $value['icon'] . '-selected-icon" height="30px">
                            <span>' . $key . '</span>
                        </a>
                      </li>';
                } else {
                    echo '<li>
                        <a href="' . $value['link'] . '">
                            <img src="' . URL_ROOT . '/public/img/icons/' . $value['icon'] . '.png" alt="' .
                        $value['icon'] . '-icon" height="30px">
                            <span>' . $key . '</span>
                        </a>
                      </li>';
                }
            }
            ?>
        </ul>
    </div>
</aside>