@extends('components/layout')
@section('components/sidebar')
@section('page-header','建立違規通報')
@section('page-header-detail','在這裡建立一個違規通報。')
@section('content')
<div class="ts-grid is-relaxed">
    <div class="column is-13-wide">
        <div class="ts-procedure">
            <a class="item is-active">
                <div class="content">
                    <div class="indicator">
                        <span class="ts-icon is-pen-to-square-icon icon"></span>
                    </div>
                    <div class="label">違規單建立</div>
                </div>
                <div class="line"></div>
            </a>
            <a class="item">
                <div class="content">
                    <div class="indicator">
                        <span class="ts-icon is-clipboard-question-icon icon"></span>
                    </div>
                    <div class="label">等待處理</div>
                </div>
                <div class="line"></div>
            </a>
            <a class="item">
                <div class="content">
                    <div class="indicator">
                        <span class="ts-icon is-clipboard-check-icon icon"></span>
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
                    @if (auth()->user()->role==2)
                    <a href="/incident/type/" style="text-decoration: none;">
                        <button class="ts-button is-circular is-small is-dense is-short is-outlined"
                            style="margin-left: 1rem;" type="submit">新增違規類別
                        </button>
                    </a>
                    @endif
                </div>
            </div>
            <div class="ts-divider"></div>
            <div class="ts-content">
                <form action='/incident/' enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="ts-grid">
                        <div class="column is-8-wide">
                            <div class="ts-text is-label is-required">工區</div>
                            <div class="ts-space"></div>
                            <select data-placeholder="請輸入工區名稱..." class="chosen-select is-fluid" name="area" required>
                                <option value=""></option>
                                @foreach ($areas as $area)
                                <option value="{{$area->id}}">{{$area->name}}</option>
                                @endforeach
                            </select>
                            <div class="ts-space"></div>
                        </div>
                        <div class="column is-8-wide">
                            <div class="ts-text is-label is-required">時間</div>
                            <div class="ts-space"></div>
                            <div class="ts-input">
                                <input type="datetime-local" name="time" required>
                            </div>
                            <div class="ts-space"></div>
                        </div>
                        <div class="column is-8-wide">
                            <div class="ts-text is-label is-required">違規類別</div>
                            <div class="ts-space"></div>
                            <select data-placeholder="請輸入違規類別..." class="chosen-select is-fluid" name="incident_type"
                                required>
                                <option value=""></option>
                                @foreach ($incident_types as $it)
                                <option value="{{$it->id}}">{{$it->name}}</option>
                                @endforeach
                            </select>
                            <div class="ts-space"></div>
                        </div>
                        <div class="column is-8-wide">
                            <div class="ts-text is-label">照片</div>
                            <div class="ts-space"></div>
                            <div class="ts-file">
                                <input type="file" name="image" accept=".jpg,.jpeg" />
                            </div>
                            <div class="ts-space"></div>
                        </div>
                        <div class="column is-16-wide">
                            <div class="ts-text is-label is-required">違規說明</div>
                            <div class="ts-space"></div>
                            <div class="ts-input is-resizable is-fluid">
                                <textarea name="description" placeholder="有關本違規的詳細資料…" required></textarea>
                            </div>
                            <div class="ts-space"></div>
                        </div>
                        <div class="column is-16-wide">
                            <button class="ts-button" name="status" value="1" type="submit">建立</button>
                        </div>
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