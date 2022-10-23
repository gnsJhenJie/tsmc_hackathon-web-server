@extends('components/layout')
@section('components/sidebar')
@section('page-header','新增攝影機')
@section('page-header-detail','在這裡為系統增加一個攝影機。')
@section('content')
<div class="ts-grid is-relaxed">
    <div class="column is-13-wide">
        <div class="ts-box is-top-indicated">
            <div class="ts-content is-dense">
                <div class="ts-header is-heavy">攝影機資料
                </div>
            </div>
            <div class="ts-divider"></div>
            <div class="ts-content">
                <form action="/camera/create" method="POST">
                    @csrf
                    <div class="ts-text is-label">名稱</div>
                    <div class="ts-space"></div>
                    <div class="ts-input is-underlined is-fluid">
                        <input name="name" type="text">
                    </div>
                    <div class="ts-space is-large"></div>
                    <div class="ts-text is-label">所屬工區</div>
                    <div class="ts-space"></div>
                    <select data-placeholder="請輸入工區名稱..." class="chosen-select is-fluid" name="area">
                        <option value=""></option>
                        @foreach ($areas as $area)
                        <option value="{{$area->id}}">{{$area->name}}</option>
                        @endforeach
                    </select>
                    <div class="ts-space is-large"></div>
                    <button class="ts-button" type="submit">建立</button>
                    <div class="ts-space is-large"></div>
                </form>
            </div>
        </div>
        <div class="ts-space is-big"></div>
    </div>
</div>
<script>
    // https://harvesthq.github.io/chosen/
    $(".chosen-select").chosen({
  no_results_text: "Oops, nothing found!",
  width: "100%",
})
</script>
@stop