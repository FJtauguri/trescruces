<aside id="aside">
    <div class="imgBox" style="height: 90px; width: 100%;">
        <div class="vignette"></div>
        <img src="{{ asset('assets/imgs/bg-img1.png') }}" alt="" >
        <p>Brgy. Tres Cruses (Barangay Hall)</p>
    </div>
    <div class="mainNavigationTitle">
        <h2>Main Navigation</h2>
    </div>
    <nav class="mainNavigation">
        <ul class="navLinks">
            <li>
                <a href="{{route('userdashboard.index')}}" class="{{ Route::is('userdashboard.index') ? 'active' : '' }}">
                    <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">

                        <g id="SVGRepo_bgCarrier" stroke-width="0" />

                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                        <g id="SVGRepo_iconCarrier">

                            <path
                                d="M20 19V10.5C20 10.1852 19.8518 9.88885 19.6 9.7L12.6 4.45C12.2444 4.18333 11.7556 4.18333 11.4 4.45L4.4 9.7C4.14819 9.88885 4 10.1852 4 10.5V19C4 19.5523 4.44772 20 5 20H19C19.5523 20 20 19.5523 20 19Z"
                                stroke="#E2c868" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" />

                        </g>

                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{route('requestfile.index')}}" class="{{ Route::is('requestfile.index') ? 'active' : '' }}">
                    <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" stroke="#E2c868">

                        <g id="SVGRepo_bgCarrier" stroke-width="0" />

                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M13 3L13.7071 2.29289C13.5196 2.10536 13.2652 2 13 2V3ZM19 9H20C20 8.73478 19.8946 8.48043 19.7071 8.29289L19 9ZM13.109 8.45399L14 8V8L13.109 8.45399ZM13.546 8.89101L14 8L13.546 8.89101ZM10 13C10 12.4477 9.55228 12 9 12C8.44772 12 8 12.4477 8 13H10ZM8 16C8 16.5523 8.44772 17 9 17C9.55228 17 10 16.5523 10 16H8ZM8.5 9C7.94772 9 7.5 9.44772 7.5 10C7.5 10.5523 7.94772 11 8.5 11V9ZM9.5 11C10.0523 11 10.5 10.5523 10.5 10C10.5 9.44772 10.0523 9 9.5 9V11ZM8.5 6C7.94772 6 7.5 6.44772 7.5 7C7.5 7.55228 7.94772 8 8.5 8V6ZM9.5 8C10.0523 8 10.5 7.55228 10.5 7C10.5 6.44772 10.0523 6 9.5 6V8ZM17.908 20.782L17.454 19.891L17.454 19.891L17.908 20.782ZM18.782 19.908L19.673 20.362L18.782 19.908ZM5.21799 19.908L4.32698 20.362H4.32698L5.21799 19.908ZM6.09202 20.782L6.54601 19.891L6.54601 19.891L6.09202 20.782ZM6.09202 3.21799L5.63803 2.32698L5.63803 2.32698L6.09202 3.21799ZM5.21799 4.09202L4.32698 3.63803L4.32698 3.63803L5.21799 4.09202ZM12 3V7.4H14V3H12ZM14.6 10H19V8H14.6V10ZM12 7.4C12 7.66353 11.9992 7.92131 12.0169 8.13823C12.0356 8.36682 12.0797 8.63656 12.218 8.90798L14 8C14.0293 8.05751 14.0189 8.08028 14.0103 7.97537C14.0008 7.85878 14 7.69653 14 7.4H12ZM14.6 8C14.3035 8 14.1412 7.99922 14.0246 7.9897C13.9197 7.98113 13.9425 7.9707 14 8L13.092 9.78201C13.3634 9.92031 13.6332 9.96438 13.8618 9.98305C14.0787 10.0008 14.3365 10 14.6 10V8ZM12.218 8.90798C12.4097 9.2843 12.7157 9.59027 13.092 9.78201L14 8V8L12.218 8.90798ZM8 13V16H10V13H8ZM8.5 11H9.5V9H8.5V11ZM8.5 8H9.5V6H8.5V8ZM13 2H8.2V4H13V2ZM4 6.2V17.8H6V6.2H4ZM8.2 22H15.8V20H8.2V22ZM20 17.8V9H18V17.8H20ZM19.7071 8.29289L13.7071 2.29289L12.2929 3.70711L18.2929 9.70711L19.7071 8.29289ZM15.8 22C16.3436 22 16.8114 22.0008 17.195 21.9694C17.5904 21.9371 17.9836 21.8658 18.362 21.673L17.454 19.891C17.4045 19.9162 17.3038 19.9539 17.0322 19.9761C16.7488 19.9992 16.3766 20 15.8 20V22ZM18 17.8C18 18.3766 17.9992 18.7488 17.9761 19.0322C17.9539 19.3038 17.9162 19.4045 17.891 19.454L19.673 20.362C19.8658 19.9836 19.9371 19.5904 19.9694 19.195C20.0008 18.8114 20 18.3436 20 17.8H18ZM18.362 21.673C18.9265 21.3854 19.3854 20.9265 19.673 20.362L17.891 19.454C17.7951 19.6422 17.6422 19.7951 17.454 19.891L18.362 21.673ZM4 17.8C4 18.3436 3.99922 18.8114 4.03057 19.195C4.06287 19.5904 4.13419 19.9836 4.32698 20.362L6.10899 19.454C6.0838 19.4045 6.04612 19.3038 6.02393 19.0322C6.00078 18.7488 6 18.3766 6 17.8H4ZM8.2 20C7.62345 20 7.25117 19.9992 6.96784 19.9761C6.69617 19.9539 6.59545 19.9162 6.54601 19.891L5.63803 21.673C6.01641 21.8658 6.40963 21.9371 6.80497 21.9694C7.18864 22.0008 7.65645 22 8.2 22V20ZM4.32698 20.362C4.6146 20.9265 5.07354 21.3854 5.63803 21.673L6.54601 19.891C6.35785 19.7951 6.20487 19.6422 6.10899 19.454L4.32698 20.362ZM8.2 2C7.65645 2 7.18864 1.99922 6.80497 2.03057C6.40963 2.06287 6.01641 2.13419 5.63803 2.32698L6.54601 4.10899C6.59545 4.0838 6.69617 4.04612 6.96784 4.02393C7.25117 4.00078 7.62345 4 8.2 4V2ZM6 6.2C6 5.62345 6.00078 5.25117 6.02393 4.96784C6.04612 4.69617 6.0838 4.59545 6.10899 4.54601L4.32698 3.63803C4.13419 4.01641 4.06287 4.40963 4.03057 4.80497C3.99922 5.18864 4 5.65645 4 6.2H6ZM5.63803 2.32698C5.07354 2.6146 4.6146 3.07354 4.32698 3.63803L6.10899 4.54601C6.20487 4.35785 6.35785 4.20487 6.54601 4.10899L5.63803 2.32698Z"
                                fill="#f0edcf" />
                        </g>

                    </svg>
                    Request File
                </a>
            </li>
                   <!-- Dropdown Toggle Button with SVG Icon -->
                    <li>
                        <a href="javascript:void(0)" class="menu-toggle">
                            
                            <svg fill="#E2c868" width="20px" height="20px" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 15a1 1 0 0 1-.707-1.707l3-3a1 1 0 0 1 1.414 0l3 3A1 1 0 0 1 15.707 15H10zM10 3a1 1 0 0 1 .707.293l3 3A1 1 0 0 1 10 8h-5a1 1 0 0 1-.707-1.707l3-3A1 1 0 0 1 10 3z" />
                            </svg>
                            <span>News and Programs</span>
                        </a>
                    </li>
          <!-- Collapsible Dropdown Menu -->
                <div id="dropdownMenu" class="dropdown-menu">
                    <ul class="list-unstyled ps-3 m-2">
                        <li>
                <a style="color: black; text-decoration:none;" href="{{route('resident.news')}}" class="{{ Route::is('resident.news') ? 'active' : '' }}">
                    <svg fill="#E2c868" width="800px" height="800px" viewBox="0 0 1920 1920"
                        xmlns="http://www.w3.org/2000/svg">

                        <g id="SVGRepo_bgCarrier" stroke-width="0" />

                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M1587.162 31.278c11.52-23.491 37.27-35.689 63.473-29.816 25.525 6.099 43.483 28.8 43.483 55.002V570.46C1822.87 596.662 1920 710.733 1920 847.053c0 136.32-97.13 250.503-225.882 276.705v513.883c0 26.202-17.958 49.016-43.483 55.002a57.279 57.279 0 0 1-12.988 1.468c-21.12 0-40.772-11.745-50.485-31.171C1379.238 1247.203 964.18 1242.347 960 1242.347H564.706v564.706h87.755c-11.859-90.127-17.506-247.003 63.473-350.683 52.405-67.087 129.657-101.082 229.948-101.082v112.941c-64.49 0-110.57 18.861-140.837 57.487-68.781 87.868-45.064 263.83-30.269 324.254 4.18 16.828.34 34.673-10.277 48.34-10.73 13.665-27.219 21.684-44.499 21.684H508.235c-31.171 0-56.47-25.186-56.47-56.47v-621.177h-56.47c-155.747 0-282.354-126.607-282.354-282.353v-56.47h-56.47C25.299 903.523 0 878.336 0 847.052c0-31.172 25.299-56.471 56.47-56.471h56.471v-56.47c0-155.634 126.607-282.354 282.353-282.354h564.593c16.941-.112 420.48-7.002 627.275-420.48Zm-5.986 218.429c-194.71 242.371-452.216 298.164-564.705 311.04v572.724c112.489 12.876 369.995 68.556 564.705 311.04ZM903.53 564.7H395.294c-93.402 0-169.412 76.01-169.412 169.411v225.883c0 93.402 76.01 169.412 169.412 169.412H903.53V564.7Zm790.589 123.444v317.93c65.618-23.379 112.94-85.497 112.94-159.021 0-73.525-47.322-135.53-112.94-158.909Z"
                                fill-rule="evenodd" />
                        </g>

                    </svg>
                    News and Announcement
                </a>
            </li><li>
                <a style="color: black; text-decoration:none;" href="{{route('userview.prog')}}" class="{{ Route::is('userview.prog') ? 'active' : '' }}">
                    <svg width="800px" height="800px" viewBox="0 -0.5 25 25" fill="#E2c868"
                        xmlns="http://www.w3.org/2000/svg">

                        <g id="SVGRepo_bgCarrier" stroke-width="0" />

                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                        <g id="SVGRepo_iconCarrier">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.918 10.0005H7.082C6.66587 9.99708 6.26541 10.1591 5.96873 10.4509C5.67204 10.7427 5.50343 11.1404 5.5 11.5565V17.4455C5.5077 18.3117 6.21584 19.0078 7.082 19.0005H9.918C10.3341 19.004 10.7346 18.842 11.0313 18.5502C11.328 18.2584 11.4966 17.8607 11.5 17.4445V11.5565C11.4966 11.1404 11.328 10.7427 11.0313 10.4509C10.7346 10.1591 10.3341 9.99708 9.918 10.0005Z"
                                stroke="#E2c868" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.918 4.0006H7.082C6.23326 3.97706 5.52559 4.64492 5.5 5.4936V6.5076C5.52559 7.35629 6.23326 8.02415 7.082 8.0006H9.918C10.7667 8.02415 11.4744 7.35629 11.5 6.5076V5.4936C11.4744 4.64492 10.7667 3.97706 9.918 4.0006Z"
                                stroke="#E2c868" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.082 13.0007H17.917C18.3333 13.0044 18.734 12.8425 19.0309 12.5507C19.3278 12.2588 19.4966 11.861 19.5 11.4447V5.55666C19.4966 5.14054 19.328 4.74282 19.0313 4.45101C18.7346 4.1592 18.3341 3.9972 17.918 4.00066H15.082C14.6659 3.9972 14.2654 4.1592 13.9687 4.45101C13.672 4.74282 13.5034 5.14054 13.5 5.55666V11.4447C13.5034 11.8608 13.672 12.2585 13.9687 12.5503C14.2654 12.8421 14.6659 13.0041 15.082 13.0007Z"
                                stroke="#E2c868" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.082 19.0006H17.917C18.7661 19.0247 19.4744 18.3567 19.5 17.5076V16.4936C19.4744 15.6449 18.7667 14.9771 17.918 15.0006H15.082C14.2333 14.9771 13.5256 15.6449 13.5 16.4936V17.5066C13.525 18.3557 14.2329 19.0241 15.082 19.0006Z"
                                stroke="#E2c868" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </g>

                    </svg>
                    Programs
                </a>
            </li>
                    </ul>
                </div>


            {{-- <li >
    
                <a href="{{ route('userchat.index')}}" class="{{ Route::is('userchat.index') ? 'active' : '' }}">
                    <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">

                        <g id="SVGRepo_bgCarrier" stroke-width="0" />

                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M7.76953 4.58009C8.57706 3.74781 9.54639 3.08958 10.6178 2.64588C11.6892 2.20219 12.84 1.98233 13.9995 2.00001C18.4195 2.00001 21.9995 5.10005 21.9995 8.92005C21.9792 9.98209 21.7021 11.0234 21.1919 11.9551C20.6817 12.8867 19.9535 13.681 19.0696 14.27V16.75"
                                stroke="#E2c868" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M16 13.64C16 10.29 12.87 7.58008 9 7.58008C5.13 7.58008 2 10.29 2 13.64C2.01941 14.5684 2.26227 15.4785 2.70789 16.2931C3.1535 17.1077 3.78881 17.803 4.56006 18.3201V20.49C4.55903 20.7858 4.64489 21.0755 4.80701 21.3229C4.96912 21.5703 5.20032 21.7647 5.47192 21.8818C5.74353 21.999 6.04362 22.0338 6.33484 21.9819C6.62606 21.9301 6.89553 21.7938 7.10999 21.5901L9.10999 19.6901C12.94 19.6201 16 16.94 16 13.64Z"
                                stroke="#E2c868" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </g>

                    </svg>
                    Messages @livewire('unread-messages-badge')
                </a>
            </li> --}}
            <!--<li>-->
            <!--    <a href="{{route('resident.news')}}" class="{{ Route::is('resident.news') ? 'active' : '' }}">-->
            <!--        <svg fill="#E2c868" width="800px" height="800px" viewBox="0 0 1920 1920"-->
            <!--            xmlns="http://www.w3.org/2000/svg">-->

            <!--            <g id="SVGRepo_bgCarrier" stroke-width="0" />-->

            <!--            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />-->

            <!--            <g id="SVGRepo_iconCarrier">-->
            <!--                <path-->
            <!--                    d="M1587.162 31.278c11.52-23.491 37.27-35.689 63.473-29.816 25.525 6.099 43.483 28.8 43.483 55.002V570.46C1822.87 596.662 1920 710.733 1920 847.053c0 136.32-97.13 250.503-225.882 276.705v513.883c0 26.202-17.958 49.016-43.483 55.002a57.279 57.279 0 0 1-12.988 1.468c-21.12 0-40.772-11.745-50.485-31.171C1379.238 1247.203 964.18 1242.347 960 1242.347H564.706v564.706h87.755c-11.859-90.127-17.506-247.003 63.473-350.683 52.405-67.087 129.657-101.082 229.948-101.082v112.941c-64.49 0-110.57 18.861-140.837 57.487-68.781 87.868-45.064 263.83-30.269 324.254 4.18 16.828.34 34.673-10.277 48.34-10.73 13.665-27.219 21.684-44.499 21.684H508.235c-31.171 0-56.47-25.186-56.47-56.47v-621.177h-56.47c-155.747 0-282.354-126.607-282.354-282.353v-56.47h-56.47C25.299 903.523 0 878.336 0 847.052c0-31.172 25.299-56.471 56.47-56.471h56.471v-56.47c0-155.634 126.607-282.354 282.353-282.354h564.593c16.941-.112 420.48-7.002 627.275-420.48Zm-5.986 218.429c-194.71 242.371-452.216 298.164-564.705 311.04v572.724c112.489 12.876 369.995 68.556 564.705 311.04ZM903.53 564.7H395.294c-93.402 0-169.412 76.01-169.412 169.411v225.883c0 93.402 76.01 169.412 169.412 169.412H903.53V564.7Zm790.589 123.444v317.93c65.618-23.379 112.94-85.497 112.94-159.021 0-73.525-47.322-135.53-112.94-158.909Z"-->
            <!--                    fill-rule="evenodd" />-->
            <!--            </g>-->

            <!--        </svg>-->
            <!--        News and Announcement-->
            <!--    </a>-->
            <!--</li>-->
            <li>
    <a href="{{ route('resofficial.index') }}" class="{{ Route::is('resofficial.index') ? 'active' : '' }}">
        <svg fill="#E2c868" width="800px" height="800px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0" />
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
            <g id="SVGRepo_iconCarrier">
                <!-- Replace the below path with the path for your official icon -->
                <path d="M12 2C10.9 2 10 2.9 10 4s0.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 4c-1.1 0-2 .9-2 2s0.9 2 2 2 2-.9 2-2-.9-2-2-2zm6 8c-0.88 0-1.66.25-2.33.67-.2-1.2-1.14-2.17-2.67-2.17s-2.47.97-2.67 2.17C7.66 12.25 6.88 12 6 12c-3.31 0-6 2.69-6 6s2.69 6 6 6h12c3.31 0 6-2.69 6-6s-2.69-6-6-6zm0 10H6c-2.21 0-4-1.79-4-4s1.79-4 4-4c0.58 0 1.13.12 1.63.34.41 1.22 1.5 2.06 2.87 2.06s2.46-.84 2.87-2.06c.5-.22 1.05-.34 1.63-.34 2.21 0 4 1.79 4 4s-1.79 4-4 4z" />
            </g>
        </svg>
        Brgy & SK Official Chart
    </a>
</li>  
            <li>
                <a href="{{route('settings.userview')}}" class="{{ Route::is('settings.userview') ? 'active' : '' }}">
                    <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">

                        <g id="SVGRepo_bgCarrier" stroke-width="0" />

                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                        <g id="SVGRepo_iconCarrier">
                            <circle cx="12" cy="12" r="3" stroke="#E2c868" stroke-width="1.5" />
                            <path
                                d="M13.7654 2.15224C13.3978 2 12.9319 2 12 2C11.0681 2 10.6022 2 10.2346 2.15224C9.74457 2.35523 9.35522 2.74458 9.15223 3.23463C9.05957 3.45834 9.0233 3.7185 9.00911 4.09799C8.98826 4.65568 8.70226 5.17189 8.21894 5.45093C7.73564 5.72996 7.14559 5.71954 6.65219 5.45876C6.31645 5.2813 6.07301 5.18262 5.83294 5.15102C5.30704 5.08178 4.77518 5.22429 4.35436 5.5472C4.03874 5.78938 3.80577 6.1929 3.33983 6.99993C2.87389 7.80697 2.64092 8.21048 2.58899 8.60491C2.51976 9.1308 2.66227 9.66266 2.98518 10.0835C3.13256 10.2756 3.3397 10.437 3.66119 10.639C4.1338 10.936 4.43789 11.4419 4.43786 12C4.43783 12.5581 4.13375 13.0639 3.66118 13.3608C3.33965 13.5629 3.13248 13.7244 2.98508 13.9165C2.66217 14.3373 2.51966 14.8691 2.5889 15.395C2.64082 15.7894 2.87379 16.193 3.33973 17C3.80568 17.807 4.03865 18.2106 4.35426 18.4527C4.77508 18.7756 5.30694 18.9181 5.83284 18.8489C6.07289 18.8173 6.31632 18.7186 6.65204 18.5412C7.14547 18.2804 7.73556 18.27 8.2189 18.549C8.70224 18.8281 8.98826 19.3443 9.00911 19.9021C9.02331 20.2815 9.05957 20.5417 9.15223 20.7654C9.35522 21.2554 9.74457 21.6448 10.2346 21.8478C10.6022 22 11.0681 22 12 22C12.9319 22 13.3978 22 13.7654 21.8478C14.2554 21.6448 14.6448 21.2554 14.8477 20.7654C14.9404 20.5417 14.9767 20.2815 14.9909 19.902C15.0117 19.3443 15.2977 18.8281 15.781 18.549C16.2643 18.2699 16.8544 18.2804 17.3479 18.5412C17.6836 18.7186 17.927 18.8172 18.167 18.8488C18.6929 18.9181 19.2248 18.7756 19.6456 18.4527C19.9612 18.2105 20.1942 17.807 20.6601 16.9999C21.1261 16.1929 21.3591 15.7894 21.411 15.395C21.4802 14.8691 21.3377 14.3372 21.0148 13.9164C20.8674 13.7243 20.6602 13.5628 20.3387 13.3608C19.8662 13.0639 19.5621 12.558 19.5621 11.9999C19.5621 11.4418 19.8662 10.9361 20.3387 10.6392C20.6603 10.4371 20.8675 10.2757 21.0149 10.0835C21.3378 9.66273 21.4803 9.13087 21.4111 8.60497C21.3592 8.21055 21.1262 7.80703 20.6602 7C20.1943 6.19297 19.9613 5.78945 19.6457 5.54727C19.2249 5.22436 18.693 5.08185 18.1671 5.15109C17.9271 5.18269 17.6837 5.28136 17.3479 5.4588C16.8545 5.71959 16.2644 5.73002 15.7811 5.45096C15.2977 5.17191 15.0117 4.65566 14.9909 4.09794C14.9767 3.71848 14.9404 3.45833 14.8477 3.23463C14.6448 2.74458 14.2554 2.35523 13.7654 2.15224Z"
                                stroke="#E2c868" stroke-width="1.5" />
                        </g>

                    </svg>
                    Settings
                </a>
            </li>
            
            <li>
                <a href="{{ route('my-useractivity') }}" class="{{ Route::is('my-useractivity') ? 'active' : '' }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.03 20 3 15.97 3 11C3 6.03 7.03 2 12 2C16.97 2 21 6.03 21 11C21 15.97 16.97 20 12 20ZM12 4H14V11H12V4ZM12 13H14V16H12V13Z" fill="#E2c868"/>
                    </svg>
                    Activity Logs
                </a>
            </li>            
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="10" stroke="#E2c868" stroke-width="1.5"/>
                        <path d="M15 12H8M15 12L11 16M15 12L11 8" stroke="#E2c868" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>                    
                    Sign out
                </a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>
            </li>            
        </ul>
    </nav>
  <style>
        @media (max-width: 768px) {
    #aside {
        width: 80%;
    }
    .imgBox img {
        width: 100%;
        height: auto;
    }
    .mainNavigation {
        font-size: 14px;
    }
}

    </style>
</aside>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the toggle button and the dropdown menu
        const toggleButton = document.querySelector('.menu-toggle');
        const dropdownMenu = document.getElementById('dropdownMenu');

        // Add an event listener for the toggle action
        toggleButton.addEventListener('click', function() {
            // Toggle the 'collapsed' class on the menu
            dropdownMenu.classList.toggle('collapsed');

            // Check if the menu is collapsed or visible
            if (dropdownMenu.classList.contains('collapsed')) {
                // If collapsed, hide the menu
                dropdownMenu.style.display = 'none';
            } else {
                // If not collapsed, show the menu
                dropdownMenu.style.display = 'block';
            }
        });
    });
</script>
