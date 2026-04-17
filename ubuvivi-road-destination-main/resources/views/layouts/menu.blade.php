<li class="side-menus {{ Request::is('home*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('home') }}">
        <i class="fas fa-home"></i>
        <span>Dashboard</span>
    </a>
</li>

<li class="side-menus {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}">
        <i class="fas fa-users"></i>
        <span>Users</span>
    </a>
</li>

<li class="side-menus {{ Request::is('vehicles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('vehicles.index') }}">
        <i class="fas fa-car"></i>
        <span>Vehicles</span>
    </a>
</li>

<li class="side-menus {{ Request::is('itineraries*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('itineraries.index') }}">
        <i class="fas fa-building"></i>
        <span>Itineraries</span>
    </a>
</li>

<li class="side-menus {{ Request::is('tourBookings*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('tourBookings.index') }}">
        <i class="fas fa-building"></i>
        <span>Tour Bookings</span>
    </a>
</li>

<li class="side-menus {{ Request::is('carBookings*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('carBookings.index') }}">
        <i class="fas fa-car-side"></i>
        <span>Car Bookings</span>
    </a>
</li>

<li class="side-menus {{ Request::is('carTransfers*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('carTransfers.index') }}">
        <i class="fas fa-briefcase"></i>
        <span>Car Transfers</span>
    </a>
</li>

{{-- <li class="side-menus {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('payments.index') }}">
        <i class="fas fa-credit-card"></i>
        <span>Payments</span>
    </a>
</li> --}}


<li class="dropdown" {{ Request::is('types') ? 'active' : '' }}">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cubes"></i>
        <span>Types</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="{{ route('types.fuelTypes.index') }}">Fuel Types</a></li>
        <li><a class="nav-link" href="{{ route('types.transmissions.index') }}">Transmissions</a></li>
        <li><a class="nav-link" href="{{ route('types.vehicleBrands.index') }}">Vehicle Brands</a></li>
        <li><a class="nav-link" href="{{ route('types.vehicleModels.index') }}">Vehicle Models</a></li>
    </ul>
</li>

