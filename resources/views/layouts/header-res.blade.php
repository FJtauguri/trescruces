<header class="headerOne">
    <div id="drawerContainer" class="drawerContainer">
        @livewire('notification-component')
        <div id="notifDaw" class="notifDaw">
            <div class="notifClose">
                <h4>Messages</h4>
                <span id="notifClose">X</span>
            </div>
            <div>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis odit molestiae
                dignissimos et asperiores a excepturi ut dolores nesciunt necessitatibus laudantium
                perspiciatis similique, labore quidem quisquam! Dolores eum quia beatae.
            </div>
        </div>
        <div id="dimmer" class="dimmer"></div>
    </div>

    <div class="burgerButton">
        <button id="offcanvas">
            <svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#cbb782">
                <g id="SVGRepo_bgCarrier" stroke-width="0" />
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                <g id="SVGRepo_iconCarrier">
                    <path d="M4 18L20 18" stroke="#585756" stroke-width="2" stroke-linecap="round" />
                    <path d="M4 12L20 12" stroke="#585756" stroke-width="2" stroke-linecap="round" />
                    <path d="M4 6L20 6" stroke="#585756" stroke-width="2" stroke-linecap="round" />
                </g>
            </svg>
        </button>
    </div>
    
    <div class="logoHeader">
        <a href="/">
             @php
        use App\Models\GeneralConf;

        // Fetch the configuration data
        $generalConfig = GeneralConf::first();
    @endphp
            <img style="border-radius:50%;" src="{{ asset('assets/head_logo/' . ($generalConfig->logo ?? 'default-logo.png')) }}" alt="" width="40" height="40">
            <div class="sysTitle">
                <p>Brgy. Tres Cruses, Tanza, Cavite</p>
            </div>
        </a>
    </div>
    
  <div id="notifMess" class="notifMess">
    <div style="position: relative;">
        <button id="notifDawBTN">
            <!-- Notification Icon -->
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_iconCarrier">
                    <path d="M12.0009 5C13.4331 5 14.8066 5.50571 15.8193 6.40589C16.832 7.30606 17.4009 8.52696 17.4009 9.8C17.4009 11.7691 17.846 13.2436 18.4232 14.3279C19.1606 15.7133 19.5293 16.406 19.5088 16.5642C19.4849 16.7489 19.4544 16.7997 19.3026 16.9075C19.1725 17 18.5254 17 17.2311 17H6.77066C5.47638 17 4.82925 17 4.69916 16.9075C4.54741 16.7997 4.51692 16.7489 4.493 16.5642C4.47249 16.406 4.8412 15.7133 5.57863 14.3279C6.1558 13.2436 6.60089 11.7691 6.60089 9.8C6.60089 8.52696 7.16982 7.30606 8.18251 6.40589C9.19521 5.50571 10.5687 5 12.0009 5ZM12.0009 5V3M9.35489 20C10.0611 20.6233 10.9888 21.0016 12.0049 21.0016C13.0209 21.0016 13.9486 20.6233 14.6549 20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </svg>
            <!-- Notification Badge Counter -->
            @livewire('unread-notification-badge-counter')
        </button>
    </div>
</div>

    <style>
     /* General Styles for Notification Icon */
.notifMess {
    position: relative; /* Contain the badge relative to the button */
}

/* Notification Icon button styling */
#notifDawBTN {
    position: relative; /* Ensures the badge is positioned relative to the button */
    padding: 10px; /* Add some space around the button */
    background-color: transparent; /* Transparent background */
    border: none; /* Remove border */
    cursor: pointer; /* Pointer cursor on hover */
    display: flex; /* Use flexbox to align elements */
    align-items: center; /* Align icon vertically */
    justify-content: center; /* Center content */
}

/* Notification Badge Styles */
.notification-badge {
    position: absolute;
    top: -2px;       /* Keeps the badge slightly above the button */
    right: 4px;      /* Moves the badge a bit to the left to prevent cutting */
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 2px 4px; /* Slightly adjust padding if necessary */
    font-size: 14px;
    font-weight: bold;
    min-width: 20px;
    text-align: center;
    display: inline-block;
    box-sizing: content-box; /* Ensures padding does not affect shape */
}


/* Make the badge smaller on mobile */
@media (max-width: 768px) {
    .notification-badge {
        font-size: 10px;  /* Smaller font size on mobile */
        padding: 3px 6px;  /* Adjust padding for smaller screens */
    }
}

/* Styles for Notification Drawer */
.drawerContainerShow {
    display: block;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.5);
     z-index: 1050;;
}

/* Notification panel */
.notification-container {
    position: fixed;
    top: 50px;
    right: 0;
    width: 700px;
    max-height: 80vh;
    background: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    border-radius: 5px;
    z-index: 1051;
    overflow-y: auto;
}

    </style>
</header>
