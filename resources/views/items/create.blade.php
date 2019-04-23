@extends('layouts.app')
@section('title', '商品登録')
@section('content')
    {{ Form::open(['route' => 'items.store', 'files'=> 'true']) }}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-group">
        {{ Form::label('name', '商品名：') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('category_id', 'カテゴリー：') }}
        {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
    </div>
    <div>
        {{ Form::label('file', '画像アップロード', ['class' => 'control-label']) }}
        {{ Form::file('file') }}
    </div>
    <div class="form-group">
        {{ Form::submit('登録', ['class' => 'btn btn-primary form-control']) }}
    </div>
    {{ Form::close() }}
@endsection