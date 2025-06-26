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


<div class="flex w-full">

    <div class="relative flex w-full flex-col">
        <header class="pointer-events-none relative z-50 flex flex-none flex-col" style="height:var(--header-height);margin-bottom:var(--header-mb)">

        <div class="top-0 z-10 h-16 pt-6" style="position:var(--header-position)">
            <div class="sm:px-8 top-(--header-top,--spacing(6)) w-full" style="position:var(--header-inner-position)">
                <div class="mx-auto w-full max-w-7xl lg:px-8">
                    <div class="relative px-4 sm:px-8 lg:px-12">
                        <div class="mx-auto max-w-2xl lg:max-w-5xl">
                            <div class="relative flex gap-4">
                                <div class="flex flex-1 justify-center md:justify-center">
                                    <div class="pointer-events-auto md:hidden" data-headlessui-state="" data-open="">
                                        <button class="group flex items-center rounded-full bg-white/90 px-4 py-2 text-sm font-medium text-zinc-800 shadow-lg ring-1 shadow-zinc-800/5 ring-zinc-900/5 backdrop-blur-sm dark:bg-zinc-800/90 dark:text-zinc-200 dark:ring-white/10 dark:hover:ring-white/20" type="button" aria-expanded="false" data-headlessui-state="" id="headlessui-popover-button-menu">Menu<svg viewBox="0 0 8 6" aria-hidden="true" class="ml-3 h-auto w-2 stroke-zinc-500 group-hover:stroke-zinc-700 dark:group-hover:stroke-zinc-400">
                                            <path d="M1.75 1.75 4 4.25l2.25-2.5" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg></button>
                                        <div class="fixed inset-0 z-50 bg-zinc-800/40 backdrop-blur-xs duration-150 data-closed:opacity-0 data-enter:ease-out data-leave:ease-in dark:bg-black/80" id="headlessui-popover-backdrop" aria-hidden="true" data-headlessui-state="" style="opacity: 0; pointer-events: none;"></div>
                                        <div class="fixed inset-x-4 top-8 z-50 origin-top rounded-3xl bg-white p-8 ring-1 ring-zinc-900/5 duration-150 data-closed:scale-95 data-closed:opacity-0 data-enter:ease-out data-leave:ease-in dark:bg-zinc-900 dark:ring-zinc-800" id="headlessui-popover-panel" tabindex="-1" data-headlessui-state="" style="--button-width: 87.75px; opacity: 0; transform: scale(0.95); pointer-events: none;">
                                            <div class="flex flex-row-reverse items-center justify-between">
                                                <button aria-label="Close menu" class="-m-1 p-1" type="button" data-close-menu>
                                                    <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 text-zinc-500 dark:text-zinc-400">
                                                        <path d="m17.25 6.75-10.5 10.5M6.75 6.75l10.5 10.5" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </button>
                                                <h2 class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Navigation</h2>
                                            </div>
                                            <nav class="mt-6">
                                                <ul class="-my-2 divide-y divide-zinc-100 text-base text-zinc-800 dark:divide-zinc-100/5 dark:text-zinc-300">
                                                    <li><a class="block py-2" href="/about">About</a></li>
                                                    <li><a class="block py-2" href="/articles">Articles</a></li>
                                                    <li><a class="block py-2" href="/projects">Projects</a></li>
                                                    <li><a class="block py-2" href="/speaking">Speaking</a></li>
                                                    <li><a class="block py-2" href="/uses">Uses</a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                    <div hidden="" style="position:fixed;top:1px;left:1px;width:1px;height:0;padding:0;margin:-1px;overflow:hidden;clip:rect(0, 0, 0, 0);white-space:nowrap;border-width:0;display:none"></div>
                                    <nav class="pointer-events-auto hidden md:block">
                                        <ul class="flex rounded-full bg-white/90 px-3 text-sm font-medium text-zinc-800 shadow-lg ring-1 shadow-zinc-800/5 ring-zinc-900/5 backdrop-blur-sm dark:bg-zinc-800/90 dark:text-zinc-200 dark:ring-white/10">
                                            <li><a class="relative block px-3 py-2 transition hover:text-teal-500 dark:hover:text-teal-400" href="/about">About</a></li>
                                            <li><a class="relative block px-3 py-2 transition hover:text-teal-500 dark:hover:text-teal-400" href="/articles">Articles</a></li>
                                            <li><a class="relative block px-3 py-2 transition hover:text-teal-500 dark:hover:text-teal-400" href="/projects">Projects</a></li>
                                            <li><a class="relative block px-3 py-2 transition hover:text-teal-500 dark:hover:text-teal-400" href="/speaking">Speaking</a></li>
                                            <li><a class="relative block px-3 py-2 transition hover:text-teal-500 dark:hover:text-teal-400" href="/uses">Uses</a></li>
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

        @yield('content')


        <footer class="mt-32 flex-none">
            <div class="sm:px-8">
                <div class="mx-auto w-full max-w-7xl lg:px-8">
                    <div class="border-t border-zinc-100 pt-10 pb-16 dark:border-zinc-700/40">
                        <div class="relative px-4 sm:px-8 lg:px-12">
                            <div class="mx-auto max-w-2xl lg:max-w-5xl">
                                <div class="flex flex-col items-center justify-center gap-6 md:flex-row">
                                  
                                    <p class="text-sm text-zinc-400 dark:text-zinc-500">© <!-- -->2025<!-- --> Spencer Sharp. All rights reserved.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
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