@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-3">
                <form action="/post" method="post">
                    @csrf
                    <textarea class="form-control mb-3" type="text" name="content" placeholder="Текст поста"></textarea>
                    @error('content')
                        <div style="color: red; font-size: 14px">{{$message}}</div>
                    @enderror
                    <div class="d-flex justify-content-between">
                        <div>
                            <input type="checkbox" id="public" name="public" value="true">
                            <label for="public">Опубликовать?</label>
                        </div>
                        <button class="btn btn-success" type="submit">Создать пост</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
