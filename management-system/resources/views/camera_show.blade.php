@extends('components/layout')
@section('components/sidebar')
@section('page-header','檢視攝影機-'.$camera->area()->first()->name.'-'.$camera->name)
@section('page-header-detail','在這裡檢視攝影機的詳細資訊。')
@section('content')
<div class="ts-grid is-relaxed">
    <div class="column is-13-wide">
        <div class="ts-box is-top-indicated">
            <div class="ts-content is-dense">
                <div class="ts-header is-heavy">攝影機資料
                    <a href="/camera/{{$camera->id}}/edit">
                        <button class="ts-button is-circular is-small is-dense is-short" style="margin-left: 2rem;">編輯
                        </button>
                    </a>
                    <form action="/camera/{{$camera->id}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button class="ts-button is-circular is-small is-dense is-short is-negative is-outlined"
                            style="margin-left: 1rem;" type="submit">刪除
                        </button>
                    </form>
                </div>
            </div>
            <div class="ts-divider"></div>
            <div class="ts-content">
                <div class="ts-text is-label">名稱</div>
                <div class="ts-space"></div>
                <div class="ts-input is-underlined is-fluid">
                    <input name="name" type="text" value="{{$camera->name}}" disabled>
                </div>
                <div class="ts-space is-large"></div>
                <div class="ts-text is-label">所屬工區</div>
                <div class="ts-space"></div>
                <select data-placeholder="請輸入工區名稱..." class="chosen-select is-fluid" name="area" disabled>
                    <option value=""></option>
                    <option value="{{$camera->area()->first()->id}}" selected>{{$camera->area()->first()->name}}
                    </option>
                </select>
                <div class="ts-space is-large"></div>
                <div class="ts-text is-label">Token</div>
                <div class="ts-space"></div>
                <div class="ts-input is-underlined is-fluid">
                    <input name="token" type="text" value="{{$camera->token}}" disabled>
                </div>
                <div class="ts-space is-large"></div>
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