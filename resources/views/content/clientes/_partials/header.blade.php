{{--  Header de botones --}}
<div class="d-flex align-items-center justify-content-between pt-3">
  <div class="flex-grow-1">
    <div
      class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column gap-4">
      <div class="user-profile-info">
        <h4 class="fw-bold m-0">
          <span class="text-muted fw-light">Clientes /</span> {{ $title }}
        </h4>
      </div>
      <ul
        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
        <li class="list-inline-item fw-semibold">
          <button type="button" class="btn rounded-pill btn-icon btn-warning"
                  data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd"
                  data-bs-offset="0,4"
                  data-bs-placement="top" data-bs-html="true" title="Ayuda">
            <span class="tf-icons bx bx-question-mark"></span>
          </button>
        </li>
        <li class="list-inline-item fw-semibold">
          <a class="nav-link btn btn-secondary" type="button" href="{{ route('clientes.index') }}">
            <i class="bx bx-arrow-back"></i> Volver
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>

