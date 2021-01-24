@extends('layouts.admin')

@section('content')
    <div class="container">

        @include('includes.error-alerts')

        <h2>{{ __('Listado de citas') }}</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">{{ __('#') }}</th>
                <th scope="col">{{ __('Tutor') }}</th>
                <th scope="col">{{ __('Estudiante') }}</th>
                <th scope="col">{{ __('Curso') }}</th>
                <th scope="col">{{ __('Email') }}</th>
                <th scope="col">{{ __('Fecha') }}</th>
                <th scope="col">{{ __('Acciones') }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($appointments as $appointment)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>{{ $appointment->tutor }}</td>
                    <td>{{ $appointment->student }}</td>
                    <td>{{ $appointment->course }}</td>
                    <td>{{ $appointment->email }}</td>
                    <td>{{ $appointment->date }}</td>
                    <td>
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST">
                            @method('DELETE')
                            @csrf

                            <input type="submit" class="btn btn-danger btn-sm" value="Eliminar">
                        </form>
                    </td>
                </tr>
            @empty
                <p class="text-center">No hay ninguna cita programada</p>
            @endforelse
            </tbody>
        </table>

        <div class="float-right">
            {{ $appointments->links() }}
        </div>
    </div>
@endsection
