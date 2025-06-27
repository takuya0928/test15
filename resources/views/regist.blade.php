@extends('layouts.app')

@section('title' , '投稿画面')

@section('content')
<div class="container">
    <div class="row">
        <h1>ユーザーログイン画面</h1>
        <from action="{{route('submit')}}" method="post">
            @csrf

            <div class="form-group">
                <!-- <label for="title">タイトル</label> -->
                <input type="text" class="form-control" id="title" name="title" placeholder="パスワード" value="{{ old('title') }}">
                @if($errors->has('title'))
                    <p>{{ $errors->first('title') }}</p>
                @endif

            </div>

            <div class="form-group">
                <!-- <label for="url">URL</label> -->
                <input type="text" class="form-control" id="url" name="url" placeholder="アドレス" value="{{ old('url') }}">
                @if($errors->has('url'))
                    <p>{{ $errors->first('url') }}</p>
                @endif
            </div>

            <div class="form-group">
                <!-- <label for="comment">コメント</label> -->
                <!-- <textarea class="form-control" name="comment" id="comment" placeholder="Comment"></textarea> -->
            </div>

            <button type="submit" class="btn btn-default">新規登録</button>

            <button type="submit" class="btn btn-default">ログイン</button>
        </form>
    </div>
</div>
@endsection