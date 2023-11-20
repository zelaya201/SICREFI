{{-- Navegacion entre panel --}}
<ul class="nav nav-pills" role="tablist">
  <li class="nav-item " role="presentation">
    <a class="nav-link
    @php
        $currentRoute = Route::currentRouteName();

        if($currentRoute == 'clientes.edit'){
            echo 'active';
        }
 @endphp
    " type="button" aria-selected="false" tabindex="-1"
       href="{{ route('clientes.edit', $cliente->id_cliente) }}">
      <i class="bx bx-user"></i> Cliente
    </a>
  </li>

  <li class="nav-item" role="presentation">
    <a class="nav-link @php
        $currentRoute = Route::currentRouteName();

        if($currentRoute == 'conyuge.edit'){
            echo 'active';
        }
 @endphp {{ ($cliente->estado_civil_cliente != 'Casado') ? 'disabled' : '' }}" type="button" aria-selected="false" tabindex="-1"
       href="{{ route('conyuge.edit', $cliente->id_cliente) }}">
      <i class="bx bx-user-check"></i> Cónyuge
    </a>
  </li>

  <li class="nav-item" role="presentation">
    <a class="nav-link @php
        $currentRoute = Route::currentRouteName();

        if($currentRoute == 'negocios.show'){
            echo 'active';
        }
 @endphp" type="button" aria-selected="false" tabindex="-1"
       href="{{ route('negocios.show', $cliente->id_cliente) }}">
      <i class="tf-icons bx bx-store-alt"></i> Negocio
    </a>
  </li>

  <li class="nav-item" role="presentation">
    <a class="nav-link @php
        $currentRoute = Route::currentRouteName();

        if($currentRoute == 'referencias.show'){
            echo 'active';
        }
 @endphp" type="button" aria-selected="false" tabindex="-1"
       href="{{ route('referencias.show', $cliente->id_cliente) }}">
      <i class="bx bx-user-plus"></i> Referencias
    </a>
  </li>

  <li class="nav-item" role="presentation">
    <a class="nav-link @php
        $currentRoute = Route::currentRouteName();

        if($currentRoute == 'bienes.show'){
            echo 'active';
        }
 @endphp" type="button" aria-selected="false" tabindex="-1"
       href="{{ route('bienes.show', $cliente->id_cliente) }}">
      <i class="bx bx-building"></i> Bienes
    </a>
  </li>
</ul>
{{--  Fin --}}
