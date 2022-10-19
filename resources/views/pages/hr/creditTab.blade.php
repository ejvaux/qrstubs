<div id="userModalDiv"></div>
@include('includes.modal.creditImportModal')
<div class="row mt-2">
    <div class="col-4 text-left">
        <input class="form-control" type="text" name="" id="creditSearch" placeholder="Type NAME or USERNAME and press ENTER">
    </div>
    <div class="col text-right">
        <button id="uploadCreditsBtn" class="btn btn-outline-secondary py-1">Upload</button>
        <button id="userExportBtn" class="btn btn-outline-secondary py-1">Export</button>
    </div>
</div>
<div class="row mt-2">
    <div class="col">
        <div id="creditTable">
        </div>
    </div>
</div>
