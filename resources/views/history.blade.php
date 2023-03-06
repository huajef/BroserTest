@extends('layouts.app')

@section('content')

    <section class="intro">
        <div class="container">
            <div class="col-12">
                <div class="card bg-dark shadow-2-strong">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-dark table-borderless mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">CITY</th>
                                        <th scope="col">CONTRY</th>
                                        <th scope="col">%HR</th>
                                        <th scope="col">DATA</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $data)
                                        <tr>
                                            <td>{{ $data->cityName }}</td>
                                            <td>{{ $data->contryName }}</td>
                                            <td>{{ $data->wet }}%Hr</td>
                                            <td>{{ $data->created_at }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </section>
@endsection
