<li class="side-menus {{ Request::is('home') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('home') }}">
        <i class=" fas fa-tachometer-alt"></i><span>Dashboard</span>
    </a>
</li>
<li class="side-menus {{ Request::is('negocios') ? 'active' : '' }}">
    <a href="{{ route('negocios.index') }}" class="nav-link">
        <i class="fas fa-building"></i><span>Negocios</span>
    </a>
</li>
<li class="side-menus {{ Request::is('sucursales') ? 'active' : '' }}">
    <a href="{{ route('sucursales.index') }}" class="nav-link">
        <i class="fas fa-landmark"></i><span>Sucursales</span>
    </a>
</li>
<li class="side-menus {{ Request::is('usuarios') ? 'active' : '' }}">
    <a href="{{ route('usuarios.index') }}" class="nav-link">
        <i class="fas fa-users"></i><span>Usuarios</span>
    </a>
</li>
<li class="side-menus {{ Request::is('boxes') ? 'active' : '' }}">
    <a href="{{ route('boxes.index') }}" class="nav-link">
        <i class="fas fa-money-check-alt"></i><span>Cajas</span>
    </a>
</li>
<li class="side-menus {{ Request::is('almacenes') ? 'active' : '' }}">
    <a href="{{ route('almacenes.index') }}" class="nav-link">
        <i class="fas fa-archive"></i><span>Almacen</span>
    </a>
</li>
<li class="side-menus {{ Request::is('categorias') ? 'active' : '' }}">
    <a href="{{ route('categorias.index') }}" class="nav-link">
        <i class="fas fa-tags"></i><span>Categorias</span>
    </a>
</li>
<li class="side-menus {{ Request::is('proveedores') ? 'active' : '' }}">
    <a href="{{ route('proveedores.index') }}" class="nav-link">
        <i class="fas fa-user-tie"></i><span>Proveedores</span>
    </a>
</li>
<li class="side-menus {{ Request::is('productos') ? 'active' : '' }}">
    <a href="{{ route('productos.index') }}" class="nav-link">
        <i class="fas fa-gifts"></i><span>Productos</span>
    </a>
</li>
<li class="side-menus {{ Request::is('servicios') ? 'active' : '' }}">
    <a href="{{ route('servicios.index') }}" class="nav-link">
        <i class="fas fa-tools"></i><span>Servicios</span>
    </a>
</li>
<li class="side-menus {{ Request::is('clientes') ? 'active' : '' }}">
    <a href="{{ route('clientes.index') }}" class="nav-link">
        <i class="fas fa-user-friends"></i><span>Clientes</span>
    </a>
</li>
<li class="side-menus {{ Request::is('creditos') ? 'active' : '' }}">
    <a href="{{ route('creditos.index') }}" class="nav-link">
        <i class="fas fa-handshake"></i><span>Creditos</span>
    </a>
</li>
<li class="side-menus {{ Request::is('usercash') ? 'active' : '' }}">
    <a href="{{ route('usercash.index') }}" class="nav-link">
        <i class="fas fa-cash-register"></i><span>Vender</span>
    </a>
</li>
<li class="side-menus {{ Request::is('ventas') ? 'active' : '' }}">
    <a href="{{ route('ventas.index') }}" class="nav-link">
        <i class="fas fa-trophy"></i><span>Ventas</span>
    </a>
</li>
<li class="side-menus {{ Request::is('reportes') ? 'active' : '' }}">
    <a href="{{ route('reportes.index') }}" class="nav-link">
        <i class="fas fa-chart-pie"></i><span>Reportes</span>
    </a>
</li>

