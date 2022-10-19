<div class="form-group row">
    <div class="col-md">
        <div class="row">
        <div class="col-4">
            <label for="email_name" class="col-form-label">Name:</label>
        </div>
        <div class="col-8">
            <input id="email_name" type="text" class="form-control" name="name" placeholder="" value="@isset($email){{$email->name}}@endisset">
        </div>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-md">
        <div class="row">
        <div class="col-4">
            <label for="email_add" class="col-form-label">Email Address:</label>
        </div>
        <div class="col-8">
            <input id="email_add" type="email" class="form-control" name="email" value="
            @isset($email)
                {{$email->email}}
            @endisset
            " placeholder="">
        </div>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-md">
        <div class="row">
        <div class="col-4">
            <label for="email_type" class="col-form-label">Type:</label>
        </div>
        <div class="col-8">
            <select id="email_type" name="type" class="custom-select custom-select-lg mb-3">
                <option value="to"
                @isset($email)
                    @if ($email->type == 'to')
                        selected
                    @endif
                @endisset
                >TO</option>
                <option value="cc"
                @isset($email)
                    @if ($email->type == 'cc')
                        selected
                    @endif
                @endisset
                >CC</option>
            </select>
        </div>
        </div>
    </div>
</div>
