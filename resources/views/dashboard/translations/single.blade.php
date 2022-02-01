@extends('dashboard.layouts.app')
@section("main")

<form class="inner-form" action="{{ route('translations.update') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input type="hidden" name="tag" value="{{ $tag }}">

    <div class="form-group">
        <pre id="json-display"></pre>
        <input type="hidden" id="json-input" value="{{ $file }}">
    </div>

    <div class="inner-form__actions">
        <button class="button button--main" type="submit">
            <span class="material-icons-outlined">done_all</span> Сохранить
        </button>
    </div>
</form>

@endsection