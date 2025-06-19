<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                    <div class="flex items-center me-2">
                        <div style="position:relative;display:inline-block;">
                            <button id="notifBtn" style="background:none;border:none;outline:none;cursor:pointer;position:relative;">
                                <span style="font-size:1.25rem;vertical-align:middle;line-height:1;display:inline-flex;align-items:center;">🔔</span>
                                @if(Auth::user()->unreadNotifications->count())
                                    <span style="position:absolute;top:-10px;right:-10px;background:#e3342f;color:#fff;font-size:0.75rem;padding:2px 7px;border-radius:50%;font-weight:bold;box-shadow:0 1px 4px rgba(0,0,0,0.10);z-index:2;">{{ Auth::user()->unreadNotifications->count() }}</span>
                                @endif
                            </button>
                            <div id="notifDropdown" style="display:none;position:absolute;right:0;z-index:1000;background:#fff;color:#222;min-width:320px;box-shadow:0 4px 24px rgba(0,0,0,0.12);border-radius:1rem;padding:1rem;max-height:350px;overflow-y:auto;">
                                <h5 style="font-weight:bold;margin-bottom:0.7rem;">Notifications</h5>
                                @forelse(Auth::user()->unreadNotifications as $notification)
                                    <div style="margin-bottom:1rem;padding-bottom:0.7rem;border-bottom:1px solid #e5e7eb;">
                                        <div style="font-size:1rem;font-weight:600;">Assignment Graded: {{ $notification->data['assignment_title'] ?? '' }}</div>
                                        <div style="font-size:0.97rem;">Grade: <span style="font-weight:bold;">{{ $notification->data['grade'] ?? '-' }}</span></div>
                                        <div style="font-size:0.97rem;">Feedback: <span style="font-style:italic;">{{ $notification->data['feedback'] ?? '-' }}</span></div>
                                        <form method="POST" action="{{ route('notifications.markAsRead', $notification->id) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" style="background:none;border:none;color:#059669;font-weight:bold;cursor:pointer;font-size:0.97rem;">Mark as read</button>
                                        </form>
                                    </div>
                                @empty
                                    <div style="font-size:0.97rem;">No new notifications.</div>
                                @endforelse
                            </div>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var btn = document.getElementById('notifBtn');
                                var dropdown = document.getElementById('notifDropdown');
                                btn.addEventListener('click', function(e) {
                                    e.stopPropagation();
                                    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                                });
                                document.addEventListener('click', function() {
                                    dropdown.style.display = 'none';
                                });
                            });
                        </script>
                    </div>
                @endif

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
