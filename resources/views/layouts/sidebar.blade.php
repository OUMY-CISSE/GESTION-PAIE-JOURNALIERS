<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
  
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('journaliers') }}">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Admin</div>
  </a>
  
  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  
 
  
  <li class="nav-item">
    <a class="nav-link" href="{{ route('journaliers') }}">
        <i class="fas fa-fw fa-briefcase"></i>
        <span>Journaliers</span>
    </a>
    <!-- Deuxième lien de navigation -->
    <a class="nav-link" href="{{ route('pointages') }}">
        <i class="fas fa-fw fa-money-check-alt"></i>
        <span>Paiements</span>
    </a>

    <a class="nav-link" href="{{ route('pointages.pointage') }}">
      <i class="fas fa-fw fa-calculator"></i>
      <span>Pointages</span>
    </a>


</li>


  <li class="nav-item">
    <a class="nav-link" href="{{ route('tarif_horaires') }}">
    <i class="fas fa-fw fa-wallet"></i>
      <span>Tarifs Horaires</span></a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" href="{{ route('chef_de_quarts') }}">
    <i class="fas fa-fw fa-hard-hat"></i>
      <span>Chefs de quart</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('ateliers') }}">
    <i class="fas fa-fw fa-building"></i>
      <span>Ateliers</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('excels') }}">
    <i class="fas fa-fw fa-upload"></i>
      <span>Imports AND Exports</span></a>
  </li>

 
  
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
  
  
</ul>