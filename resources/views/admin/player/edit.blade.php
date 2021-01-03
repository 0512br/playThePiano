@extends('layouts.front')
@section('title', 'プロフィール画面の編集')
    
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <h2>プロフィール編集</h2>
                {{ Form::open(['action' => 'Admin\PlayerController@update', 'files' => true, 'class' => "form-horizontal"]) }}
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                
                <!--画像の設定-->
                <div class="form-group row">
                    <div class="col-md-2">
                        {{ Form::label('image', __('messages.image')) }}
                    </div>
                    <div class="col-md-10">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="col-md-4">
                            {{ Form::file('image', ['class' => 'form-control custom-file-input', 'id' => 'image'.'_'.$i]) }}
                            {{ Form::label('image', '写真を選択', ['class' => 'custom-file-label']) }}
                        </div>
                    @endfor
                    </div>
                </div>
                <!--名前-->
                <div class="form-group row">
                    <div class="col-md-2">
                        {{ Form::label('name_1', __('messages.name_1')) }}
                    </div>
                    <div class="col-md-5">
                        {{ Form::text('firstname_1', $player_form->firstname_1, ['class' => 'form-control', 'placeholder' => '山田']) }}
                    </div>
                    <div class="col-md-5">
                        {{ Form::text('lastname_1', $player_form->lastname_1, ['class' => 'form-control', 'placeholder' => '太郎']) }}
                    </div>
                </div>
                <!--ナマエ-->
                <div class="form-group row">
                    <div class="col-md-2">
                        {{ Form::label('name_2', __('messages.name_2')) }}
                    </div>
                    <div class="col-md-5">
                        {{ Form::text('firstname_2', $player_form->firstname_2, ['class' => 'form-control', 'placeholder' => 'ヤマダ']) }}
                    </div>
                    <div class="col-md-5">
                        {{ Form::text('lastname_2', $player_form->lastname_2, ['class' => 'form-control', 'placeholder' => 'タロウ']) }}
                    </div>
                </div>
                <!--生年月日-->
                <div class="form-group row">
                    <div class="col-md-2">
                        {{ Form::label('birthday', __('messages.birthday')) }}
                    </div>
                    <div class="col-md-10">
                        {{ Form::text('birthday', $player_form->birthday, ['class'=>'form-control datepicker_1'])}}
                    </div>
                    {{--<!--<div class="col-md-3">-->
                    <!--    {{ Form::selectMonth('birth_month', old('birth_month'), ['class'=>'form-control'])}}-->
                    <!--</div>-->
                    <!--<div class="col-md-3">-->
                    <!--    {{ Form::selectRange('birth_ day' , 1, 31, old('birth_day'), ['class'=>'form-control'])}}-->
                    <!--</div>-->--}}
                </div>
                <!--性別 -->
                {{--<!--<div class="form-group row">-->
                <!--    <div class="col-md-2">-->
                <!--        {{ Form::label('gender', __('messages.gender')), ['class' => 'form-control'] }}-->
                <!--    </div>-->
                <!--    <div class="col-md-10">-->
                        <!--foreachの引数を強制的に配列-->
                <!--        @foreach ($genders as $key as $gender)-->
                        <!--クラスを再確認-->
                <!--        <div class="form-group form-check form-check-inline">-->
                            <!--201227 訂正-->
                <!--            @if ($key == $player_form->gender)-->
                <!--            {{ Form::radio('gender', $gender->type, true, ['class'=>'form-check-input','id'=>'gender-'.$gender->type])}}-->
                <!--            {{ Form::label('gender-'.$gender->type, $gender->name, ['class' => 'form-check-label']) }}-->
                <!--            @else-->
                <!--            {{ Form::radio('gender', $gender->type, false, ['class'=>'form-check-input','id'=>'gender-'.$gender->type])}}-->
                <!--            {{ Form::label('gender-'.$gender->type, $gender->name, ['class' => 'form-check-label']) }}-->
                <!--            @endif-->
                <!--        </div>-->
                <!--        @endforeach-->
                <!--    </div>-->
                <!--</div>-->--}}
                <!--ピアノ暦-->
                <div class="form-group row">
                    <div class="col-md-2">
                        {{ Form::label('experience', __('messages.experience')) }}
                    </div>
                    <div class="col-md-8">
                        {{ Form::number('experience', $player_form->experience, ['class' => 'form-control', 'placeholder' => '半角数字で入力']) }}
                    </div>
                    <div class="col-md-2">
                        <label>年</label>
                    </div>
                </div>
                <!--活動エリア-->
                <div class="form-group row">
                    <div class="col-md-2">
                        {{ Form::label('prefecture', '活動エリア', null) }}
                        <!--選択にするか入力にするか-->
                    </div>
                    <div class="col-md-10">
                        <!--初期値を東京にしたい-->
                        {{ Form::select('prefecture', $prefectures, $player_form->prefecture, ['class'=>'form-control']) }}
                    </div>
                </div>
                <!--自己紹介-->
                <div class="form-group row">
                    <div class="col-md-2">
                        {{ Form::label('introduction', __('messages.introduction')) }}
                    </div>
                    <div class="col-md-10">
                    {{ Form::textarea('introduction', $player_form->introduction, ['class' => 'form-control', 'rows' => '5']) }}
                    </div>
                </div>
                <!--参考動画-->
                <div class="form-group row">
                    <div class="col-md-2">
                        {{ Form::label('performance', __('messages.performance')) }}
                    </div>
                    <div class="col-md-10">
                        {{ Form::text('performance', $player_form->performance, ['class' => 'form-control', 'placeholder' => 'URL']) }}
                    </div>
                </div>
                <!--登録ボタン-->
                <!--hiddenについて-->
                {{ Form::hidden('id', $player_form->id) }}
                {{ Form::submit(__('messages.update'), ['class' => 'btn btn-secondary']) }}
                @csrf
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection