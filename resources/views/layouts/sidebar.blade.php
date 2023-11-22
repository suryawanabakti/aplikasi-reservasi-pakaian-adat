<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="index.html">{{ DB::table('tokos')->first()->name ?? null }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">MP</a>
    </div>
    <ul class="sidebar-menu">

        @role('super-admin')
            <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="{{ route('dashboardsuperadmin') }}"><i class="fas fa-fire"></i>
                    <span>Dashboard</span></a></li>
            <li class="menu-header">Master Data</li>
            <li><a class="nav-link" href="{{ route('adminsuper.users.index') }}"><i class="fas fa-users"></i>
                    <span>Users</span></a></li>
            <li><a class="nav-link" href="{{ route('adminsuper.tokos.index') }}"><i class="fas fa-store"></i>
                    <span>Toko</span></a></li>
            <li><a class="nav-link" href="{{ route('adminsuper.categories.index') }}"><i class="fas fa-box"></i>
                    <span>Category</span></a></li>
            <li><a class="nav-link" href="{{ route('adminsuper.featured-product.index') }}"><i class="fas fa-box"></i>
                    <span>Featured Product</span></a></li>
            <li><a class="nav-link" href="{{ route('adminsuper.transactions.index') }}"><i class="fas fa-exchange-alt"></i>
                    <span>Transaction</span></a></li>
        @endrole

        @role('admintoko')
            <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>
            <li><a class="nav-link" href="{{ route('admintoko.products.index') }}"><i class="fas fa-box"></i>
                    <span>Products</span></a></li>
            <li><a class="nav-link" href="{{ route('admintoko.profile.index') }}"><i class="fas fa-user"></i> <span>My
                        Profile</span></a></li>
            <li><a class="nav-link" href="{{ route('admintoko.transactions.index') }}"><i class="fas fa-exchange-alt"></i>
                    <span>Transactions</span></a></li>
            <li class="menu-header">Pengaturan</li>
            <li><a class="nav-link" href="{{ route('adminsuper.categories.index') }}"><i class="fas fa-box"></i>
                    <span>Category</span></a></li>
            <li><a class="nav-link" href="{{ route('adminsuper.banners.index') }}"><i class="fas fa-box"></i>
                    <span>Event</span></a></li>
        @endrole

    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        <a href="/" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Halaman Utama
        </a>
    </div>
</aside>
