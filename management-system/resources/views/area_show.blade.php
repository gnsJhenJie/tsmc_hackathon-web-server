@extends('components/layout')
@section('components/sidebar')
@section('page-header','工區詳情-'.$area->name)
@section('page-header-detail','在這裡檢視工區詳細資料。')
@section('content')
<div class="ts-grid is-relaxed">
    <div class="column is-13-wide">
        <div class="ts-box is-top-indicated">
            <div class="ts-content is-dense">
                <div class="ts-header is-heavy">工區資料
                    <a href="/area/{{$area->id}}/edit">
                        <button class="ts-button is-circular is-small is-dense is-short" style="margin-left: 2rem;">編輯
                        </button>
                    </a>
                    <form action="/area/{{$area->id}}" method="POST">
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
                <form action="/area/create" method="POST">
                    @csrf
                    <div class="ts-text is-label">名稱</div>
                    <div class="ts-space"></div>
                    <div class="ts-input is-underlined is-fluid">
                        <input name="name" type="text" disabled value="{{$area->name}}">
                    </div>
                    <div class="ts-space is-large"></div>
                    <div class="ts-text is-label">描述</div>
                    <div class="ts-space"></div>
                    <div class="ts-input is-resizable is-fluid">
                        <textarea name="description" placeholder="有關本工區的相關資料…"
                            disabled>{{$area->description}}</textarea>
                    </div>
                    <div class="ts-space is-large"></div>
                    <div class="ts-text is-label">管理者</div>
                    <div class="ts-space"></div>
                    <select data-placeholder="請輸入帳號..." multiple class="chosen-select is-fluid" name="managers[]"
                        disabled>
                        <option value=""></option>
                        @foreach ($area->managers() as $user)
                        <option value="{{$user->id}}" selected>{{$user->name.'('.$user->email.')'}}</option>
                        @endforeach
                    </select>
                    <div class="ts-space is-large"></div>
                </form>
            </div>
        </div>
        <div class="ts-space"></div>
    </div>
    <div class="column is-13-wide">
        <div class="ts-box is-top-indicated">
            <div class="ts-content is-dense">
                <div class="ts-header is-heavy">攝影機</div>
            </div>
            <div class="ts-divider"></div>
            <table class="ts-table is-basic">
                <thead>
                    <tr>
                        <th>名稱</th>
                        <th>工區</th>
                        <th>狀態</th>
                        <th>Token</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cameras as $camera)
                    <tr>
                        <td>{{$camera['name']}}</td>
                        <td>
                            {{$camera->area()->first()->name}}
                        </td>
                        <td>上線</td>
                        <td>{{$camera->token}}</td>
                        <td class="ts-wrap is-compact">
                            <a href="/camera/{{$camera->id}}">
                                <button class="ts-button is-small ">詳細資料</button>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">目前無屬於該工區的攝影機</td>
                    </tr>
                    @endforelse
                </tbody>
                @if($cameras->hasPages())
                <tfoot>
                    <tr>
                        <th colspan="5">{!! $cameras->links() !!}</th>
                    </tr>
                </tfoot>
                @endif
            </table>
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