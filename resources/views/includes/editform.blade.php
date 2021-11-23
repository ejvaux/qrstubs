<input type="hidden" name="employee_id" id="emp_id" value="">
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">Username</label>

    <div class="col-md-7">
        <input disabled id="uname" name="uname" type="text" class="form-control" required>
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

    <div class="col-md-7">
        <input disabled id="email" name="email" type="email" class="form-control" required>
    </div>
</div>
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

    <div class="col-md-7">
        <input id="name2" name="name2" type="text" class="form-control" required>
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="department" class="col-md-4 col-form-label text-md-right">Department</label>

    <div class="col-md-7">
        <select id="department" class="form-control" name="department" style=" height: calc(1.6em + 0.75rem + 2px); " required>
            @foreach ($departments as $department)
                <option value="{{$department->id}}">{{$department->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
<label for="name" class="col-md-4 col-form-label text-md-right">Status</label>

<div class="col-md-7">
    <select id="status" class="form-control" name="status" style=" height: calc(1.6em + 0.75rem + 2px); " required>
        <option value="0">Active</option>
        <option value="1">Inactive</option>
    </select>
</div>
</div>