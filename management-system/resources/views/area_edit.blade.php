@extends('components/layout')
@section('components/sidebar')
@section('page-header','編輯工區-'.$area->name)
@section('page-header-detail','在這裡編輯工區資料。')
@section('content')
<div class="ts-grid is-relaxed">
    <div class="column is-13-wide">
        <div class="ts-box is-top-indicated">
            <div class="ts-content is-dense">
                <div class="ts-header is-heavy">工區資料
                </div>
            </div>
            <div class="ts-divider"></div>
            <div class="ts-content">
                <form action="/area/{{$area->id}}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="ts-text is-label is-required">名稱</div>
                    <div class="ts-space"></div>
                    <div class="ts-input is-underlined is-fluid">
                        <input name="name" type="text" value="{{$area->name}}" required>
                    </div>
                    <div class="ts-space is-large"></div>
                    <div class="ts-text is-label is-required">描述</div>
                    <div class="ts-space"></div>
                    <div class="ts-input is-resizable is-fluid">
                        <textarea name="description" placeholder="有關本工區的相關資料…"
                            required>{{$area->description}}</textarea>
                    </div>
                    <div class="ts-space is-large"></div>
                    <div class="ts-text is-label is-required">管理者</div>
                    <div class="ts-space"></div>
                    <select data-placeholder="請輸入帳號..." multiple class="chosen-select is-fluid" name="managers[]"
                        required>
                        <option value=""></option>
                        @foreach ($users as $user)
                        <option value="{{$user->id}}" {{in_array($user->id,$area->managers) ? "selected" :
                            ""}}>{{$user->name.'('.$user->email.')'}}</option>
                        @endforeach
                    </select>
                    <div class="ts-space is-large"></div>
                    <button class="ts-button" type="submit">更新</button>
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