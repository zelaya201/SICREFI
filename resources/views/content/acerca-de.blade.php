@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Acerca de')
@section('content')
  <div class="row py-4">
    <div class="col-lg-4 ">
      <div class="card h-100">
        <!-- Informacion de acerca de -->
        <div class="card-header pb-0">
          <i class="bx bx-info-circle"></i>
          <span class="fw-bold">Acerca de</span>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 ">
              <!-- Información de los desarrolladores -->
              <ul>
                <li>
                  <span class="fw-bold">Desarrolladores:</span>
                  <ul>
                    <li>Josue Adonay Aguilar Rivas</li>
                    <li>Mario Ernesto Zelaya Lainez</li>
                    <li>Walter Alejandro Morales Quintanilla</li>
                  </ul>
                </li>
                <li>
                  <span class="fw-bold">Descripción:</span>
                  <ul>
                    <li>SISTEMA INFORMÁTICO EN AMBIENTE WEB PARA LA ADMINISTRACIÓN Y GESTIÓN
                      DE CRÉDITOS FINANCIEROS DIRIGIDO A LICDA. DINORA QUEZADA; SAN VICENTE.</li>
                  </ul>
                </li>
                <li>
                  <span class="fw-bold">Versión:</span>
                  <ul>
                    <li>1.0.0</li>
                  </ul>
                </li>
              </ul>

            </div>
          </div>
      </div>
    </div>
  </div>
@endsection




