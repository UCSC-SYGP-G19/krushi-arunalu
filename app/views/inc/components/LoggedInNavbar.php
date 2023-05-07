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

    <div class="col-6 col-5-lg text-center pt-1">
        <div class="row">
            <div class="col-4 m-auto text-center">
                <div class="justify-content-end align-items-center row">
                    <button id="btn-toggle-notification-panel" class="navbar-icons mx-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 8C18 6.4087 17.3679 4.88258 16.2426 3.75736C15.1174 2.63214 13.5913 2 12 2C10.4087 2 8.88258 2.63214 7.75736 3.75736C6.63214 4.88258 6 6.4087 6 8C6 15 3 17 3 17H21C21 17 18 15 18 8Z"
                                      stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M13.7295 21C13.5537 21.3031 13.3014 21.5547 12.9978 21.7295C12.6941 21.9044 12.3499 21.9965 11.9995 21.9965C11.6492 21.9965 11.3049 21.9044 11.0013 21.7295C10.6977 21.5547 10.4453 21.3031 10.2695 21"
                                      stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                    </button>

                    <a href="./chat" class="mx-2">
                        <div id="chat-icon" class="navbar-icons">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 15C21 15.5304 20.7893 16.0391 20.4142 16.4142C20.0391 16.7893 19.5304 17 19 17H7L3 21V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V15Z"
                                      stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
<!--            <div class="col-2 m-auto px-0">-->
<!--                <div class="justify-content-center align-items-center">-->
<!--                    --><?php //echo '<img src="' . URL_ROOT . '/public/img/icons/other/lang-icon.png"
//                alt="Lang icon" height="20px">' ?>
<!---->
<!--                    <span class="fs-3 fw-bold text-primary-dark pb-2 position-absolute">&ensp;English&nbsp;-->
<!--                        <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                        <path d="M1 1L6 6L11 1" stroke="#185427" stroke-width="1.2" stroke-linecap="round"-->
<!--                              stroke-linejoin="round"/>-->
<!--                        </svg>-->
<!--                    </span>-->
<!---->
<!--                </div>-->
<!--            </div>-->
            <div class="col-5 text-right pb-1 px-2 m-auto">
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

            <div class="col-3 m-auto user-profile-pic">
                <button id="btn-toggle-navbar-options" class="overlay"></button>
                <?php echo '<img src="' . URL_ROOT . '/public/img/icons/navbar/user-avatar.webp" 
                alt="User profile icon" height="56px">' ?>
            </div>
        </div>

    </div>

    <div id="notifications-panel">
        <div class="pt-2 pb-4 px-2 justify-content-center text-center">
            <img src="<?php echo URL_ROOT ?>/public/img/other/no-notifications.gif" alt="Sleeping bell"
                 width="240px">
            <h5 class="fw-normal text-secondary text-center mb-1 py-1">No notifications</h5>
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
                <a href="<?php echo URL_ROOT ?>/manufacturerStore">
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
                    <span>My Store</span>
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
