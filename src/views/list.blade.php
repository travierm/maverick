@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ ucfirst($modelName) }}</div>

                 {{ Breadcrumbs::render("$modelName/list") }}

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <a href="/{{ $modelName }}/create" class="btn btn-success mb-4 float-right">Create {{ $modelName }}</a>

                    <table class="table table-bordered">
                        <tr>
                           @foreach($fillable as $header)
                            <th>{{ $header }}</th>
                           @endforeach
                           <th>Update</th>
                           <th>Delete</th>
                        </tr>

                        @foreach($modelAll as $model)
                        <tr>
                            @foreach($model->getFillable() as $header)
                            <td>{{ $model->{$header} }}</td>
                            @endforeach
                            <td><a class="btn btn-primary" href="/{{ $modelName }}/update/{{ $model->id }}">Update</a></td>
                            <td><a onclick="return confirm('Are you sure?')" class="btn btn-danger" href="/{{ $modelName }}/delete/{{ $model->id }}">Delete</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
