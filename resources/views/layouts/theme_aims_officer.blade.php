<!-- <!DOCTYPE html> -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="facebook-domain-verification" content="ivluv6fl8xu5z5g667pjv05ohohrv1" />
    <title>AIMS - Officer</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link rel="shortcut icon" href="{{ asset('/partner_new/images/logo/aims logo.png') }}" type="image/x-icon" />
    <!-- Favicons -->
    <!-- icon -->
    <link href="https://kit-pro.fontawesome.com/releases/v6.4.0/css/pro.min.css" rel="stylesheet">

    <!-- tailwind -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=K2D:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

</head>

<style>
    :root {
        --background_primary: linear-gradient(260deg, rgba(40, 86, 250, 1) 0%, rgba(6, 162, 253, 1) 100%);
    }

    *:not(i) {
        font-family: "K2D", sans-serif;
    }

      /* เพิ่ม CSS สำหรับ Transition ถ้า Headless UI ไม่ได้จัดการให้อัตโนมัติในบางกรณี */
        .duration-150 {
            transition-duration: 150ms;
        }
        .data-closed\:opacity-0 {
            opacity: 0;
            pointer-events: none; /* เพื่อไม่ให้คลิกผ่านเมื่อซ่อนอยู่ */
        }
        .data-closed\:scale-95 {
            transform: scale(0.95);
        }
        .data-enter\:ease-out {
            transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
        }
        .data-leave\:ease-in {
            transition-timing-function: cubic-bezier(0.4, 0, 1, 1);
        }
</style>

<body class="min-h-screen flex flex-col">

    <div class="flex w-full flex-col flex-grow">

        <!-- HEADER -->
        <header class="relative z-50 flex-none pb-2" style="height:var(--header-height);margin-bottom:var(--header-mb)">
            <div class="top-0 z-10 h-16 pt-2" style="position:var(--header-position)">
                <div class="px-0 w-full" style="position:var(--header-inner-position)">
                    <div class="w-full px-2 lg:px-8">
                        <div class="relative px-2 sm:px-8 lg:px-2">
                            <div class="mx-auto max-w-2xl lg:max-w-5xl">
                                <div class="relative flex items-center justify-between w-full">
                                    <!-- โลโก้ด้านซ้าย -->
                                    <div class="flex items-center">
                                        <a href="/" class="flex items-center">
                                            <img src="{{ asset('/partner_new/images/logo/aims full logo.png') }}" alt="Logo" class="h-15">
                                        </a>
                                    </div>

                                    <!-- เมนู -->
                                    <div class="flex ml-auto justify-end">
                                        <div class="pointer-events-auto md:hidden" data-headlessui-state="" data-open="">
                                            <button class="group flex items-center rounded-full bg-white/90 px-4 py-2 text-sm font-medium text-zinc-800 shadow-lg ring-1 shadow-zinc-800/5 ring-zinc-900/5 backdrop-blur-sm dark:bg-zinc-800/90 dark:text-zinc-200 dark:ring-white/10 dark:hover:ring-white/20" type="button" aria-expanded="false" id="headlessui-popover-button-menu">
                                                {{ Auth::user()->name }}
                                                <svg viewBox="0 0 8 6" aria-hidden="true" class="ml-3 h-auto w-2 stroke-zinc-500 group-hover:stroke-zinc-700 dark:group-hover:stroke-zinc-400">
                                                    <path d="M1.75 1.75 4 4.25l2.25-2.5" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </button>

                                            <!-- เมนูแบบ mobile -->
                                            <div class="fixed inset-0 z-50 bg-zinc-800/40 backdrop-blur-xs duration-150 data-closed:opacity-0 data-enter:ease-out data-leave:ease-in dark:bg-black/80" id="headlessui-popover-backdrop" aria-hidden="true" style="opacity: 0; pointer-events: none;"></div>

                                            <div class="fixed inset-x-4 top-8 z-50 origin-top rounded-3xl bg-white p-8 ring-1 ring-zinc-900/5 duration-150 data-closed:scale-95 data-closed:opacity-0 data-enter:ease-out data-leave:ease-in dark:bg-zinc-900 dark:ring-zinc-800" id="headlessui-popover-panel" tabindex="-1" style="opacity: 0; transform: scale(0.95); pointer-events: none;">
                                                <div class="flex flex-row-reverse items-center justify-between">
                                                    <button aria-label="Close menu" class="-m-1 p-1" type="button" data-close-menu>
                                                        <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 text-zinc-500 dark:text-zinc-400">
                                                            <path d="m17.25 6.75-10.5 10.5M6.75 6.75l10.5 10.5" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <nav class="mt-6">
                                                    <ul class="-my-2 divide-y divide-zinc-100 text-base text-zinc-800 dark:divide-zinc-100/5 dark:text-zinc-300">
                                                        <li><a class="block py-2" href="{{ url('/officer_register_operating') }}">ลงทะเบียนหน่วย</a></li>
                                                        <li><a class="block py-2" href="{{ url('/aims_edit_profile') }}">แก้ไขข้อมูล</a></li>
                                                        <li>
                                                            <a class="block py-2" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                                ออกจากระบบ
                                                            </a>
                                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                                @csrf
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>

                                        <!-- เมนู Desktop -->
                                        <nav class="pointer-events-auto hidden md:block">
                                            <ul class="flex rounded-full bg-white/90 px-3 text-sm font-medium text-zinc-800 shadow-lg ring-1 shadow-zinc-800/5 ring-zinc-900/5 backdrop-blur-sm dark:bg-zinc-800/90 dark:text-zinc-200 dark:ring-white/10">
                                                <li><a class="relative block px-3 py-2 transition hover:text-teal-500 dark:hover:text-teal-400" href="{{ url('/officer_register_operating') }}">ลงทะเบียนหน่วย</a></li>
                                                <li><a class="relative block px-3 py-2 transition hover:text-teal-500 dark:hover:text-teal-400" href="{{ url('/aims_edit_profile') }}">แก้ไขข้อมูล</a></li>
                                                <li>
                                                    <a class="relative block px-3 py-2 transition hover:text-teal-500 dark:hover:text-teal-400" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                        ออกจากระบบ
                                                    </a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- เนื้อหาหลัก -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer class="bg-zinc-100 dark:bg-zinc-800 py-3">
            <div class="container mx-auto text-center text-sm text-zinc-600 dark:text-zinc-400">
                AIMS
            </div>
        </footer>
    </div>

</body>


<script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuButton = document.getElementById('headlessui-popover-button-menu');
            const closeButton = document.querySelector('[data-close-menu]');
            const menuPanel = document.getElementById('headlessui-popover-panel');
            const menuBackdrop = document.getElementById('headlessui-popover-backdrop');

            if (!menuButton || !closeButton || !menuPanel || !menuBackdrop) {
                console.error('One or more menu elements not found. Please check IDs and data attributes.');
                return;
            }

            // Function to open the menu
            const openMenu = () => {
                menuButton.setAttribute('aria-expanded', 'true');
                menuButton.setAttribute('data-headlessui-state', 'open');
                menuButton.setAttribute('data-open', '');

                menuPanel.setAttribute('data-headlessui-state', 'open');
                menuPanel.setAttribute('data-open', '');
                menuPanel.style.opacity = '1';
                menuPanel.style.transform = 'scale(1)';
                menuPanel.style.pointerEvents = 'auto'; // Make it clickable

                menuBackdrop.setAttribute('data-headlessui-state', 'open');
                menuBackdrop.setAttribute('data-open', '');
                menuBackdrop.style.opacity = '1';
                menuBackdrop.style.pointerEvents = 'auto'; // Make backdrop clickable
            };

            // Function to close the menu
            const closeMenu = () => {
                menuButton.setAttribute('aria-expanded', 'false');
                menuButton.removeAttribute('data-headlessui-state');
                menuButton.removeAttribute('data-open');

                menuPanel.removeAttribute('data-headlessui-state');
                menuPanel.removeAttribute('data-open');
                menuPanel.style.opacity = '0';
                menuPanel.style.transform = 'scale(0.95)';
                menuPanel.style.pointerEvents = 'none'; // Prevent clicks when hidden

                menuBackdrop.removeAttribute('data-headlessui-state');
                menuBackdrop.removeAttribute('data-open');
                menuBackdrop.style.opacity = '0';
                menuBackdrop.style.pointerEvents = 'none'; // Prevent clicks on backdrop
            };

            // Event listeners
            menuButton.addEventListener('click', openMenu);
            closeButton.addEventListener('click', closeMenu);
            menuBackdrop.addEventListener('click', closeMenu); // Close when clicking outside
        });
    </script>
<script src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>

</html>