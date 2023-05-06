<aside class="sidebar">
    <div class="row text-center brand-logo-container">
        <div class="col-12 brand-logo-large">
            <a href="/krushi-arunalu/login">
                <img src="<?php echo URL_ROOT ?>/public/img/navbar-logo-large.webp" alt="logo" height="96px">
            </a>
        </div>
        <div class="col-12 brand-logo-small pt-2">
            <a href="/krushi-arunalu/login">
                <img src="<?php echo URL_ROOT ?>/public/img/navbar-logo-small.webp" alt="logo" height="72px">
            </a>
        </div>
    </div>
    <div class="col-12">
        <ul class="sidebar-links">
            <?php
            try {
                assert(isset($this?->sidebarLinks), '(Sidebar links not set)');
                foreach ($this->sidebarLinks as $key => $value) {
                    if ($value['link'] == $this->activeLink) {
                        echo '<li>
                        <a href="' . URL_ROOT . '/' . $value['link'] . '" class="selected">
                            <img src="' . URL_ROOT . '/public/img/icons/sidebar/' . $value['icon'] . '-active.png" 
                            alt="' . $value['icon'] . '-selected-icon" height="30px" title="' . $key . '">
                            <span>' . $key . '</span>
                        </a>
                      </li>';
                    } else {
                        echo '<li>
                        <a href="' . URL_ROOT . '/' . $value['link'] . '">
                            <img src="' . URL_ROOT . '/public/img/icons/sidebar/' . $value['icon'] . '.png" alt="' .
                            $value['icon'] . '-icon" height="30px" title="' . $key . '">
                            <span>' . $key . '</span>
                        </a>
                      </li>';
                    }
                }
            } catch (AssertionError $e) {
                echo '<span class="server-error">' . $e->getMessage() . '</span>';
            }
            ?>
        </ul>
    </div>
</aside>
