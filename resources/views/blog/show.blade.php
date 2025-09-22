@extends('layouts.app')

@section('title', 'TodoMotor - Blog Detalle')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 fw-bold">{{ $post->title }}</h1>
    <hr class="mx-auto" style="width: 350px; border-top: 3px solid orange;">

    <div class="text-muted mb-3">
        <p>Autor: {{ $post->author_name }}</p>
        <p>Publicado: {{ $post->created_at->format('d-m-Y H:i') }}</p>
    </div>

    <div class="content">
        <p>{{ $post->content }}</p>
    </div>

    <a href="{{ route('blog.index') }}" class="btn btn-secondary mt-3">Volver al Blog</a>
</div>
@endsection
