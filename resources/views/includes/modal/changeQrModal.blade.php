<div class="modal modal-primary fade" id="changeQRModal" tabindex="-1" data-backdrop="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <div class="col-md-3"></div> --}}
                <div class="col-md-4"><h4><b>CONFIRMATION</b></h4></div>
                <button type="button" name="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="changeQRForm" method="POST" action="{{ url('generateQR') }}" >
                @csrf
            <div class="modal-body">
                <input type="hidden" name="employee_id" id="emp_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="username" id="uname" value="{{Auth::user()->uname}}">
                <h4>Are you sure you want to change your QR code?</h4>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success mr-auto" type="submit" id="newQrBtn" >Yes, Definitely!</button>
                <button class="btn btn-secondary" data-dismiss="modal">Close</button></div>
            </div>
            </form>
        </div>
    </div>
</div>