@extends('layouts.front')
@section('title', '演奏者の一覧')
    
@section('content')
    <div class="container-fluid">
        <div class="col-md-10 mx-auto">
            <h1>演奏者の一覧</h1>
            <!--カードで表示したい-->
                <div class="post">
                    <div class="row row-cols-2">
                        @foreach ($posts as $post)
                            <div class="col-md-6 col-sm-12">
                                <div class="card mr-1 mt-3">
                                    @if($post->image_path_1)
                                    <img src="{{ asset('image/'. $post->image_path_1) }}" class="card-image-top">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->firstname_1 }} {{ $post->lastname_1 }} </h5>
                                        <p class="card-title">{{ $post->firstname_2 }} {{ $post->lastname_2 }}</p>
                                        <p class="card-text">{{ $post->introduction }}</p>
                                        <a href="{{ action('PlayerController@showProfile', ['id' => $post->id]) }}" class="btn btn-outline-primary">詳細をみる</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            <!--カードここまで-->
        </div>
    </div>
@endsection