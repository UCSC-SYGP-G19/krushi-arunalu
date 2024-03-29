<nav class="navbar logged-in-navbar justify-content-space-between">
    <div class="col-1 pt-1">
        <button id="btn-toggle-sidebar">
            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.75 15H26.25" stroke="white" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"/>
                <path d="M3.75 7.5H26.25" stroke="white" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"/>
                <path d="M3.75 22.5H26.25" stroke="white" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"/>
            </svg>
        </button>
    </div>

    <div class="col-5 text-center pt-1">
        <div class="row">
            <div class="col-3 pt-2 position-relative">
                <a class="btn-shopping-cart p-2 pb-1" href="shopping-cart">
                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 15H5.5L3.5 1H1" stroke="#185427" stroke-width="1.5" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M3.78564 3H19.9999L16.9999 12H5.07135" stroke="#185427" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 19C9.1046 19 10 18.1046 10 17C10 15.8954 9.1046 15 8 15C6.89543 15 6 15.8954 6 17C6 18.1046 6.89543 19 8 19Z"
                              stroke="#185427" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 19C17.1046 19 18 18.1046 18 17C18 15.8954 17.1046 15 16 15C14.8954 15 14 15.8954 14 17C14 18.1046 14.8954 19 16 19Z"
                              stroke="#185427" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
            <div class="col-1 m-auto">
                <div class="justify-content-center align-items-center">
                    <?php echo '<img src="' . URL_ROOT . '/public/img/icons/other/lang-icon.png" 
                alt="Lang icon" height="20px">' ?>

                    <span class="fs-3 fw-bold text-primary-dark pb-2 position-absolute">&ensp;English&nbsp;
                        <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L6 6L11 1" stroke="#185427" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </div>
            </div>

            <div class="col-6 text-right pb-1 px-2 m-auto">
                <?php
                try {
                    assert(isset($this?->user), '(User not set)');
                    echo '<p class="user-name"><?php echo $this->' . $this->user->name . '</p>
                            <p class="user-role"><?php echo $this->' . $this->user->role . '</p>';
                } catch (AssertionError $e) {
                    echo '<span class="server-error">' . $e->getMessage() . '</span>';
                }
                ?>
            </div>

            <div class="col-2 m-auto user-profile-pic">
                <?php echo '<img src="' . URL_ROOT . '/public/img/icons/navbar/user-avatar.webp" 
                alt="User profile icon" height="56px">' ?>
            </div>
        </div>
    </div>


    <div id="navbar-options-panel" class="py-1">
        <ul>
            <li>
                <a href="<?php echo URL_ROOT ?>/manageProfile">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.6668 17.5V15.8333C16.6668 14.9493 16.3156 14.1014 15.6905 13.4763C15.0654 12.8512
                        14.2176 12.5 13.3335 12.5H6.66683C5.78277 12.5 4.93493 12.8512 4.30981 13.4763C3.68469 14.1014
                        3.3335 14.9493 3.3335 15.8333V17.5" stroke="black" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M9.99984 9.16667C11.8408 9.16667 13.3332 7.67428 13.3332 5.83333C13.3332 3.99238
                        11.8408 2.5 9.99984 2.5C8.15889 2.5 6.6665 3.99238 6.6665 5.83333C6.6665 7.67428 8.15889
                        9.16667 9.99984 9.16667Z" stroke="black" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                    <span>Profile</span>
                </a>
            </li>
            <li>
                <a href="<?php echo URL_ROOT ?>/logout">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.5 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993
                        2.5 16.2754 2.5 15.8333V4.16667C2.5 3.72464 2.67559 3.30072 2.98816 2.98816C3.30072 2.67559
                        3.72464 2.5 4.16667 2.5H7.5" stroke="#CC3636" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M13.3335 14.1666L17.5002 9.99992L13.3335 5.83325" stroke="#CC3636" stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17.5 10H7.5" stroke="#CC3636" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
