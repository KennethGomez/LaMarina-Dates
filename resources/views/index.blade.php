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

                @include('includes.error-alerts')

                <form method="post" action="{{ route('appointments.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="tutor">{{ __('Nombre del/la padre, madre o tutor/a legal del alumno/a') }}</label>
                        <input type="text" class="form-control @error('tutor') is-invalid @enderror" id="tutor" name="tutor" value="{{ old('tutor') }}">

                        @error('tutor')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="student">{{ __('Nombre del/la alumno/a') }}</label>
                        <input type="text" class="form-control @error('student') is-invalid @enderror" id="student" name="student" value="{{ old('student') }}">

                        @error('student')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="course">{{ __('Curso del alumno/a') }}</label>
                        <input type="text" class="form-control @error('course') is-invalid @enderror" id="course" name="course" value="{{ old('course') }}">

                        @error('course')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">{{ __('Email del tutor/a') }}</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <label for="month">{{ __('Selecciona el mes para la cita') }}</label>
                            <select type="text" class="form-control @error('month') is-invalid @enderror" id="month" name="month">
                                @for($i = now()->month; $i <= 12; $i++)
                                    <option value="{{ $i }}" @if(old('month') == $i) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>

                            @error('month')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="day">{{ __('Selecciona el día del mes para la cita') }}</label>
                            <select type="text" class="form-control @error('day') is-invalid @enderror" id="day" name="day">
                                @for($i = now()->day; $i <= now()->daysInMonth; $i++)
                                    <option value="{{ $i }}" @if(old('day') == $i) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>

                            @error('day')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="hour">{{ __('Selecciona la hora de la cita') }}</label>
                            <select type="text" class="form-control @error('hour') is-invalid @enderror" id="hour" name="hour">
                                @for($i = now()->day; $i < now()->daysInMonth + 1; $i++)
                                    <option value="{{ $i }}" @if(old('hour') == $i) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>

                            @error('hour')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
