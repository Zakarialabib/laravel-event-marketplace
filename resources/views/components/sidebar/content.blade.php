<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    <x-sidebar.link title="{{ __('Dashboard') }}" href="{{ route('admin.dashboard') }}" :isActive="request()->routeIs('home')">
        <x-slot name="icon">
            <span class="inline-block mr-3">
                <x-icons.dashboard class="w-5 h-5" aria-hidden="true" />
            </span>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.dropdown title="{{ __('Products') }}" :active="request()->routeIs(['admin.products', 'admin.product-categories'])">

        <x-slot name="icon">
            <span class="inline-block mr-3">
                <i class="fas fa-boxes w-5 h-5"></i>
            </span>
        </x-slot>
        {{-- @can('category_access') --}}
        <x-sidebar.sublink title="{{ __('Categories') }}" href="{{ route('admin.product-categories') }}"
            :active="request()->routeIs('admin.product-categories')" />
        {{-- @endcan --}}

        <x-sidebar.sublink title="{{ __('All Products') }}" href="{{ route('admin.products') }}" :active="request()->routeIs('admin.products')" />

    </x-sidebar.dropdown>

    <x-sidebar.dropdown title="{{ __('Races') }}" :active="request()->routeIs(['admin.races', 'admin.racelocations', 'admin.categories'])">
        <x-slot name="icon">
            <span class="inline-block mr-3">
                <i class="fas fa-boxes w-5 h-5"></i>
            </span>
        </x-slot>
        <x-sidebar.sublink title="{{ __('Categories') }}" href="{{ route('admin.categories') }}" :active="request()->routeIs('admin.categories')" />

        <x-sidebar.sublink title="{{ __('All Races') }}" href="{{ route('admin.races') }}" :active="request()->routeIs('admin.races')" />
        <x-sidebar.sublink title="{{ __('Locations') }}" href="{{ route('admin.racelocations') }}"
            :active="request()->routeIs('admin.racelocations')" />

    </x-sidebar.dropdown>

    <x-sidebar.dropdown title="{{ __('Orders') }}" :active="request()->routeIs(['admin.orderforms'])">
        <x-slot name="icon">
            <span class="inline-block mr-3">
                <i class="fas fa-shopping-cart w-5 h-5"></i>
            </span>
        </x-slot>
        @can('order_access')
            <x-sidebar.sublink title="{{ __('Order Forms') }}" href="{{ route('admin.orderforms') }}" :active="request()->routeIs('admin.orderforms')" />
        @endcan
        <x-sidebar.sublink title="{{ __('Orders') }}" href="{{ route('admin.orders') }}"
            :active="request()->routeIs('admin.orders')" />
            
        <x-sidebar.sublink title="{{ __('Registrations') }}" href="{{ route('admin.registrations') }}"
            :active="request()->routeIs('admin.registrations')" />
    </x-sidebar.dropdown>

    <x-sidebar.dropdown title="{{ 'Blog' }}" :active="request()->routeIs(['admin.blogs', 'admin.blogcategories'])">
        <x-slot name="icon">
            <span class="inline-block mr-3">
                <i class="fas fa-blog w-5 h-5"></i>
            </span>
        </x-slot>
        @can('blog_access')
            <x-sidebar.sublink title="{{ __('All Blog') }}" href="{{ route('admin.blogs') }}" :active="request()->routeIs('admin.blogs')" />
            <x-sidebar.sublink title="{{ __('Blog Categories') }}" href="{{ route('admin.blogcategories') }}"
                :active="request()->routeIs('admin.blogcategories')" />
        @endcan
    </x-sidebar.dropdown>
    {{-- Settings --}}

    {{-- @can('user_access') --}}
    <x-sidebar.dropdown title="{{ __('People') }}" :active="request()->routeIs(['admin.users', 'admin.roles', 'admin.permissions'])">
        <x-slot name="icon">
            <span class="inline-block mr-3">
                <i class="fas fa-users w-5 h-5"></i>
            </span>
        </x-slot>
        {{-- @can('user_access') --}}
        <x-sidebar.sublink title="{{ __('Users') }}" href="{{ route('admin.users') }}" :active="request()->routeIs('admin.users')" />
        <x-sidebar.sublink title="{{ __('Participants') }}" href="{{ route('admin.participants') }}"
            :active="request()->routeIs('admin.participants')" />
        {{-- @endcan
            @can('role_access')  --}}
        <x-sidebar.sublink title="{{ __('Roles') }}" href="{{ route('admin.roles') }}" :active="request()->routeIs('admin.roles')" />
        {{-- @endcan
            @can('permission_access') --}}
        <x-sidebar.sublink title="{{ __('Permissions') }}" href="{{ route('admin.permissions') }}"
            :active="request()->routeIs('admin.permissions')" />
        {{-- @endcan --}}
    </x-sidebar.dropdown>
    {{-- @endcan --}}

    <x-sidebar.dropdown title="{{ __('Content') }}" :active="request()->routeIs([
        'admin.pages',
        'admin.page.settings',
        'admin.sections',
        'admin.sliders',
        'admin.featuredBanners',
    ])">
        <x-slot name="icon">
            <span class="inline-block mr-3">
                <i class="fas fa-file-alt w-5 h-5"></i>
            </span>
        </x-slot>
        <x-sidebar.sublink title="{{ __('Pages') }}" href="{{ route('admin.pages') }}" :active="request()->routeIs('admin.pages')" />
        <x-sidebar.sublink title="{{ __('Page Settings') }}" href="{{ route('admin.page.settings') }}"
            :active="request()->routeIs('admin.page.settings')" />
        <x-sidebar.sublink title="{{ __('Sections') }}" href="{{ route('admin.sections') }}" :active="request()->routeIs('admin.sections')" />
        <x-sidebar.sublink title="{{ __('Sliders') }}" href="{{ route('admin.sliders') }}" :active="request()->routeIs('admin.sliders')" />
        <x-sidebar.sublink title="{{ __('Featured Banners') }}" href="{{ route('admin.featuredBanners') }}"
            :active="request()->routeIs('admin.featuredBanners')" />
    </x-sidebar.dropdown>

    <x-sidebar.dropdown title="{{ __('Settings') }}" :active="request()->routeIs([
        'admin.settings',
        'admin.language',
        'admin.setting.redirects',
    ])">
        <x-slot name="icon">
            <span class="inline-block mr-3">
                <i class="fas fa-cog w-5 h-5"></i>
            </span>
        </x-slot>
        {{-- @can('setting_access') --}}
        <x-sidebar.sublink title="{{ __('Settings') }}" href="{{ route('admin.settings') }}" :active="request()->routeIs('admin.settings')" />
        <x-sidebar.sublink title="{{ __('Languages') }}" href="{{ route('admin.language') }}" :active="request()->routeIs('admin.language')" />
        {{-- @endcan --}}
        <x-sidebar.sublink title="{{ __('Shipping') }}" href="{{ route('admin.setting.shipping') }}"
            :active="request()->routeIs('admin.setting.shipping')" />
        <x-sidebar.sublink title="{{ __('Redirects') }}" href="{{ route('admin.setting.redirects') }}"
            :active="request()->routeIs('admin.setting.redirects')" />

    </x-sidebar.dropdown>


    <x-sidebar.link title="{{ __('Logout') }}"
        onclick="event.preventDefault();
                        document.getElementById('logoutform').submit();"
        href="#">
        <x-slot name="icon">
            <span class="inline-block mr-3">
                <i class="fas fa-sign-out-alt w-5 h-5" aria-hidden="true"></i>
            </span>
        </x-slot>
    </x-sidebar.link>

</x-perfect-scrollbar>
