<!---################################--->
<!-- ////// Shop Header Navbar  ////// -->
<!---################################--->
<div class="shop-nav">
    <ul class="nav">
        @hasPermission('admin.individual.show')
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.individual.show') ? 'active' : '' }}"
                href="{{ route('admin.individual.show', $shop->id) }}">
                {{ __('Shop overview') }}
            </a>
        </li>
        @endhasPermission

        @hasPermission('admin.individual.orders')
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.individual.orders') ? 'active' : '' }}" href="{{ route('admin.individual.orders', $shop->id) }}">
                {{ __('Order') }}
            </a>
        </li>
        @endhasPermission

        @hasPermission('admin.individual.products')
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.individual.products') ? 'active' : '' }}" href="{{ route('admin.individual.products', $shop->id) }}">
                {{ __('Product') }}
            </a>
        </li>
        @endhasPermission

        @hasPermission('admin.individual.reviews')
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.individual.category') ? 'active' : '' }}" href="{{ route('admin.individual.category', $shop->id) }}">
                {{ __('Category') }}
            </a>
        </li>
        @endhasPermission

        @hasPermission('admin.individual.reviews')
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.individual.reviews') ? 'active' : '' }}" href="{{ route('admin.individual.reviews', $shop->id) }}">
                {{ __('Review') }}
            </a>
        </li>
        @endhasPermission
    </ul>
</div>
