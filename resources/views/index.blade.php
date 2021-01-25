@extends('layouts.app')

@section('content-base')
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">{{ __('Reserva hora per visitar el centre') }} {{ config('app.name') }}</h1>
            <p class="lead">{{ __('Aquesta plataforma està dirigida a les famílies interessades en visitar l\'escola de') }} {{ config('app.name') }}</p>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ __('Formulari de reserva') }}</h5>
                <h6 class="card-subtitle mb-4 text-muted">{{ __('Per demanar cita, ompliu aquest formulari') }}</h6>

                <p class="font-weight-bold font-italic text-center">{{ __('Us recordem que només podrà assistir un dels tutors') }}</p>

                @include('includes.error-alerts')

                @if($available->count() > 0)
                    <form method="post" action="{{ route('appointments.store') }}">
                        @csrf
                        <div class="form-group">
                            @include('includes.input', ['name' => 'tutor', 'text' => __('Nom del pare/mare/tutor legal')])
                        </div>
                        <div class="form-group">
                            @include('includes.input', ['name' => 'student', 'text' => __('Nom de l\'alumne/a')])
                        </div>
                        <div class="form-group">
                            @include('includes.input', ['name' => 'course', 'text' => __('Curs de l\'alumne/a')])
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-md-6">
                                @include('includes.input', ['name' => 'email', 'text' => __('Email del tutor/a'), 'type' => 'email'])
                            </div>
                            <div class="col-md-6">
                                @include('includes.input', ['name' => 'phone', 'text' => __('Número del telèfon del tutor/a legal'), 'type' => 'tel'])
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="month">{{ __('Selecciona el mes per la cita') }}</label>
                                @php($availableMonths = $available->groupBy('month'))
                                <select type="text" class="form-control @error('month') is-invalid @enderror" id="month" name="month">
                                    @foreach($availableMonths as $month)
                                        <option value="{{ $month->first()->month }}">{{ $month->first()->month }}</option>
                                    @endforeach
                                </select>

                                @error('month')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="day">{{ __('Selecciona el día del mes per la cita') }}</label>
                                <select type="text" class="form-control @error('day') is-invalid @enderror" id="day" name="day">
                                </select>

                                @error('day')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="hour">{{ __('Selecciona l\'hora de la cita') }}</label>
                                <select type="text" class="form-control @error('hour') is-invalid @enderror" id="hour" name="hour">
                                </select>

                                @error('hour')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <hr class="my-3">
                        <button type="submit" class="btn btn-success btn-block">Enviar</button>
                    </form>
                @else
                    @if (!session('success'))
                        <div class="alert alert-danger">{{ __('No hay ninguna cita disponible') }}</div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const available = Object.values(@json($available));

        const monthInput = document.getElementById('month');
        const dayInput = document.getElementById('day');
        const hourInput = document.getElementById('hour');

        const setDays = () => {
            const month = monthInput.value;
            const days = available.filter((a) => a.month == month);

            dayInput.innerHTML = '';

            const existingDays = [];
            for (const d of days) {
                const day = d.day;

                if (existingDays.includes(day))
                    continue;

                existingDays.push(day)

                const child = document.createElement('option');

                child.value = day;
                child.text = day;

                dayInput.appendChild(child)
            }

            setHours()
        }

        const setHours = () => {
            const day = dayInput.value;
            const hours = available.filter((a) => a.day == day);

            hourInput.innerHTML = '';

            const existingHours = [];
            for (const h of hours) {
                const hour = h.hour;

                if (existingHours.includes(hour))
                    continue;

                existingHours.push(hour)

                const child = document.createElement('option');

                child.value = hour;
                child.text = hour;

                hourInput.appendChild(child)
            }
        }

        if (monthInput && dayInput && hourInput) {
            monthInput.addEventListener('change', () => {
                setDays()
            })

            dayInput.addEventListener('change', () => {
                setHours()
            })

            setDays()
        }
    </script>
@endpush
