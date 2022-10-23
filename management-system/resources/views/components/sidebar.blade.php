<div class="cell" style="width: 240px;">
    <div class="ts-content is-center-aligned">
        <div class="ts-wrap is-vertical is-compact is-middle-aligned">
            <div class="ts-image is-mini is-circular">
                <img src="/assets/images/user.webp" alt="使用者頭像">
            </div>
            <div class="ts-header">{{Auth::user()->name}}</div>
        </div>
    </div>
    <div class="ts-divider"></div>
    <a href="/" class="ts-content is-interactive is-dense">
        <div class="ts-row">
            <div class="column is-fluid">
                <div class="ts-text is-bold">儀表板</div>
            </div>
            <div class="column">
                <span class="ts-icon is-table-columns-icon"></span>
            </div>
        </div>
    </a>
    <div class="ts-divider"></div>
    <div class="ts-content is-dense">
        <div class="ts-row">
            <div class="column is-fluid">
                <div class="ts-text is-bold">違規通報</div>
            </div>
            <div class="column">
                <span class="ts-icon is-newspaper-icon"></span>
            </div>
        </div>
    </div>
    <div class="ts-menu is-dense is-small" style="opacity: 0.8">
        <a href="/incident/pending" class="item">待處理</a>
        <a href="/incident/done" class="item">已處理</a>
        <a href="/incident/create" class="item">手動新增</a>
        <a href="/incident/statistics" class="item">統計報表</a>
    </div>
    <div class="ts-space is-small"></div>
    <div class="ts-divider"></div>
    <div class="ts-content is-dense">
        <div class="ts-row">
            <div class="column is-fluid">
                <div class="ts-text is-bold">工區</div>
            </div>
            <div class="column">
                <span class="ts-icon is-sliders-icon"></span>
            </div>
        </div>
    </div>
    <div class="ts-menu is-dense is-small" style="opacity: 0.8">
        <a href="/admin/settings/policy" class="item">即時影像</a>
        <a href="/admin/settings/policy" class="item">訊息推播</a>
        <a href="/area" class="item">工區管理</a>
        <a href="/camera" class="item">攝影機管理</a>
    </div>
    <div class="ts-space is-small"></div>
    <div class="ts-divider"></div>
    <div class="ts-content is-dense">
        <div class="ts-row">
            <div class="column is-fluid">
                <div class="ts-text is-bold">記錄檔</div>
            </div>
            <div class="column">
                <span class="ts-icon is-box-archive-icon"></span>
            </div>
        </div>
    </div>
    <div class="ts-menu is-dense is-small" style="opacity: 0.8">
        <a href="/admin/logs" class="item">系統記錄</a>
    </div>
    <div class="ts-space is-small"></div>
    <div class="ts-divider"></div>
    <div class="ts-content is-dense">
        <div class="ts-row">
            <div class="column is-fluid">
                <div class="ts-text is-bold">網站管理</div>
            </div>
            <div class="column">
                <span class="ts-icon is-sliders-icon"></span>
            </div>
        </div>
    </div>
    <div class="ts-menu is-dense is-small" style="opacity: 0.8">
        <a href="/admin/settings" class="item">一般</a>
        <a href="/admin/settings/policy" class="item">使用者管理</a>
        <a href="/admin/" class="item">Line綁定</a>
    </div>

</div>