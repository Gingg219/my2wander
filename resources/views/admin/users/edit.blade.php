@extends('admin.layout.master')
@section('content')
    <form action="">
        <div class="form-group">
            <label for="simpleinput">Name</label>
            <input type="text" id="simpleinput" class="form-control" name="name" value="{{ $user['name'] }}">
        </div>
    
        <div class="form-group">
            <label for="example-email">Email</label>
            <input type="email" id="example-email" name="example-email" class="form-control" placeholder="Email">
        </div>
    
        <div class="form-group">
            <label for="example-password">Password</label>
            <input type="password" id="example-password" class="form-control" value="password">
        </div>
    
        <div class="form-group">
            <label for="password">Show/Hide Password</label>
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" placeholder="Enter your password">
                <div class="input-group-append" data-password="false">
                    <div class="input-group-text">
                        <span class="password-eye"></span>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="form-group">
            <label for="example-palaceholder">Placeholder</label>
            <input type="text" id="example-palaceholder" class="form-control" placeholder="placeholder">
        </div>
    
        <div class="form-group">
            <label for="example-helping">Helping text</label>
            <input type="text" id="example-helping" class="form-control" placeholder="Helping text">
            <span class="help-block"><small>A block of help text that breaks onto a new line and may extend beyond one
                    line.</small></span>
        </div>

        <div class="form-group">
            <label for="example-multiselect">Multiple Select</label>
            <select id="example-multiselect" multiple class="form-control">
                <option>1</option>
                <option>2</option>
                <option>3</option>
            </select>
        </div>

        <div class="form-group">
            <label for="example-fileinput">Default file input</label>
            <input type="file" id="example-fileinput" class="form-control-file">
        </div>
    
        <div class="form-group">
            <label for="example-date">Date</label>
            <input class="form-control" id="example-date" type="date" name="date">
        </div>
    </form>
@endsection
