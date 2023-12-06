@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-3">

                <form method="post" action="{{ route('post.update', ['postId' => $post->id]) }}" class="mb-3">
                    @csrf
                    @method('PUT')
                    <textarea class="form-control mb-3" name="content">{{ $post->content }}</textarea>
                    <div class="d-flex justify-content-between">
                        <div>
                            <input type="checkbox" id="public" name="public" value="true">
                            <label for="public">Опубликовать?</label>
                        </div>
                        <button class="btn btn-success" type="submit">Сохранить изменения</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
