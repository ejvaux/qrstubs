<div id="userModalDiv"></div>
@include('includes.modal.creditImportModal')
<div class="row mt-2">
    {{--<div class="col"></div>--}}
    <div class="col text-right">
        <button id="uploadCreditsBtn" class="btn btn-outline-secondary py-1">Upload</button>
        <button id="userExportBtn" class="btn btn-outline-secondary py-1">Export</button>
    </div>
    {{--<div class="col">
        <button id="userExportBtn" class="btn btn-outline-secondary py-1">Export</button>
    </div>--}}
</div>
<div class="row">
    <div class="col">
        <div id="creditTable">
            {{-- FUNCTION IN JS HAS AUTO RELOAD --}}
            {{-- @include('includes.table.creditTbl') --}}
        </div>
    </div>
</div>
