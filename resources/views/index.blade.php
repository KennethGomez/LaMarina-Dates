@extends('layouts.app')

@section('content-base')
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">{{ __('Reserva hora para visitar el centro') }} {{ config('app.name') }}</h1>
            <p class="lead">{{ __('Esta plataforma está hecha para los tutores de los alumnos que quieran visitar al equipo docente de') }} {{ config('app.name') }}</p>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ __('Formulario de reserva') }}</h5>
                <h6 class="card-subtitle mb-4 text-muted">{{ __('Para pedir cita, rellene este formulario y el equipo de') }} {{ config('app.name') }} {{ __('recibirá los datos de la cita') }}</h6>
                <form method="post" action="">
                    @csrf
                    <div class="form-group">
                        <label for="tutors-name">{{ __('Nombre del/la padre, madre o tutor/a legal del alumno/a') }}</label>
                        <input type="text" class="form-control" id="tutors-name">
                    </div>
                    <div class="form-group">
                        <label for="student-name">{{ __('Nombre del/la alumno/a') }}</label>
                        <input type="password" class="form-control" id="student-name">
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <label for="calendar-day">{{ __('Selecciona el mes para la cita') }}</label>
                            <select type="text" class="form-control" id="calendar-day">
                                @for($i = now()->month; $i <= 12; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="calendar-day">{{ __('Selecciona el día del mes para la cita') }}</label>
                            <select type="text" class="form-control" id="calendar-day">
                                @for($i = now()->day; $i <= now()->daysInMonth; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="calendar-day">{{ __('Selecciona la hora de la cita') }}</label>
                            <select type="text" class="form-control" id="calendar-day">
                                @for($i = now()->day; $i < now()->daysInMonth + 1; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <hr class="my-3">
                    <h5 class="text-center mb-3">
                        <b>{{ __('Cita libre más próxima') }}</b>: 12/12/12 16:00
                    </h5>
                    <button type="submit" class="btn btn-success btn-block">Enviar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
