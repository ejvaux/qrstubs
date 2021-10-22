

<div class="col-md-10">
    <div class="form-group">
        <input type="text" placeholder="Company ID *" class="form-control" name="uname" value="" required>
    </div>
    <div class="form-group">
        <input type="text" minlength="8" placeholder="Name *" maxlength="11" name="name" class="form-control"  value="" />
    </div>
    <div class="form-group">
        <input type="password" placeholder="Password *" class="form-control"  name="password" required>
    </div>
    <div class="form-group">
        <input type="password" placeholder="Confirm Password *" class="form-control" name="password_confirmation" required>
    </div>

    <input type="hidden" id="qrcode" name="qrcode" value="">
    <input type="hidden" id="qrcode"name="credit_id" value="">
    <input type="hidden" id="role_id" name="role_id" value="3">
    
    
    <div class="form-group">
        <select id="department_id" name="department_id" class="form-control{{ $errors->has('department') ? ' is-invalid' : '' }}" value="{{ old('department') }}" required autofocus>
            <option value="" class="hidden" selected disabled>-- Select Department --</option>
            <option value="1"> Taiwanase Sup</option>
            <option value="2"> Chinese Sup</option> 
            <option value="3"> Warehouse Hub</option> 
            <option value="4"> Hr</option> 
        </select>
    </div>
    
</div>