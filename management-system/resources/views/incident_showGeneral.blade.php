@extends('components/layout')
@section('components/sidebar')
@section('page-header','違規通報#'.$incident->id.'-'.$incident->area()->first()->name)
@section('page-header-detail','在這裡檢視違規通報的詳細資訊。')
@section('content')
<div class="ts-grid is-relaxed">
    <div class="column is-13-wide">
        <div class="ts-procedure">
            <a class="item is-completed">
                <div class="content">
                    <div class="indicator">
                        <span class="ts-icon is-user-icon icon"></span>
                    </div>
                    <div class="label">違規單建立</div>
                </div>
                <div class="line"></div>
            </a>
            <a class="item {{$incident->status==0 ? " is-active" : "" }} {{$incident->status==1 ? "is-completed" :
                ""}}">
                <div class="content">
                    <div class="indicator">
                        <span class="ts-icon is-id-card-icon icon"></span>
                    </div>
                    <div class="label">等待處理</div>
                </div>
                <div class="line"></div>
            </a>
            <a class="item  {{$incident->status==1 ? " is-completed":""}}">
                <div class="content">
                    <div class="indicator">
                        <span class="ts-icon is-eye-icon icon"></span>
                    </div>
                    <div class="label">結案</div>
                </div>
                <div class="line"></div>
            </a>
        </div>
    </div>
    <div class="column is-13-wide">
        <div class="ts-box is-top-indicated">
            <div class="ts-content is-dense">
                <div class="ts-header is-heavy">違規資料
                    <form action="/incident/{{$incident->id}}" method="POST">
                        @csrf
                        @method("DELETE")
                        @if ($incident->status==0)
                        <button class="ts-button is-circular is-small is-dense is-short is-negative is-outlined"
                            style="margin-left: 1rem;" type="submit">刪除
                        </button>
                        @endif
                    </form>
                </div>
            </div>
            <div class="ts-divider"></div>
            <div class="ts-content">
                @if ($incident->has_image)
                <div class="ts-row is-center-aligned">
                    <div class="column">
                        <div class="ts-image is-4-by-3">
                            <img src="/incident/image/{{$incident->id}}" style="max-height: 220px;">
                        </div>
                    </div>
                </div>
                <div class="ts-space"></div>
                @else
                <div class="ts-row is-center-aligned">
                    <div class="column">
                        <div class="ts-text is-disabled">無照片</div>
                    </div>
                </div>
                <div class="ts-space is-large"></div>
                @endif
                <form action='/incident/{{$incident->id}}' method="POST">
                    @csrf
                    @method("PUT")
                    <div class="ts-grid">
                        <div class="column is-8-wide">
                            <div class="ts-text is-label">工區</div>
                            <div class="ts-space"></div>
                            <div class="ts-input is-underlined is-fluid">
                                <input name="area" type="text" value="{{$incident->area()->first()->name}}" disabled>
                            </div>
                            <div class="ts-space"></div>
                        </div>
                        <div class="column is-8-wide">
                            <div class="ts-text is-label">管理者</div>
                            <div class="ts-space"></div>
                            @foreach ($incident->managers() as $user)
                            <div class="ts-chip">
                                <div class="ts-image">
                                    <img src="/assets/images/user.webp" />
                                </div>
                                {{$user->name}}
                            </div>
                            @endforeach
                            <div class="ts-space"></div>
                        </div>
                        <div class="column is-8-wide">
                            <div class="ts-text is-label">違規類別</div>
                            <div class="ts-space"></div>
                            <div class="ts-input is-underlined is-fluid">
                                <input name="area" type="text" value="{{$incident->incidentType()->first()->name}}"
                                    disabled>
                            </div>
                            <div class="ts-space"></div>
                        </div>
                        <div class="column is-8-wide">
                            <div class="ts-text is-label">違規時間</div>
                            <div class="ts-space"></div>
                            <div class="ts-input is-underlined is-fluid">
                                <input name="area" type="text" value="{{$incident->created_at}}" disabled>
                            </div>
                            <div class="ts-space"></div>
                        </div>
                        <div class="column is-16-wide">
                            <div class="ts-text is-label is-required">處理意見</div>
                            <div class="ts-space"></div>
                            <div class="ts-input is-resizable is-fluid">
                                <textarea name="deal_description" placeholder="填入處理後的相關說明…" required
                                    {{$incident->status == 0 ? "" : "disabled"}}></textarea>
                            </div>
                            <div class="ts-space"></div>
                        </div>
                        @if ($incident->status==0)
                        <div class="column is-16-wide">
                            <button class="ts-button" name="status" value="1" type="submit">儲存並標記為已處理</button>
                        </div>
                        @endif
                    </div>
                </form>
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