<div class="table-responsive">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email Address</th>
            <th scope="col">Type</th>
            <th scope="col">Active</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($emails as $email)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$email->name}}</td>
                    <td>{{$email->email}}</td>
                    <td>{{strtoupper($email->type)}}</td>
                    <td>
                        <div class="custom-control custom-switch">
                            <form id="email_{{$email->id}}_form" action="{{url('email/'.$email->id)}}" method="post">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="checkbox" class="custom-control-input activebtn" id="email_{{$email->id}}"
                                    @if ($email->active)
                                        checked
                                    @endif
                                >
                                <label class="custom-control-label" for="email_{{$email->id}}"></label>
                            </form>
                        </div>
                    </td>
                    <td>
                        <a type="button" class="btn btn-outline-secondary py-1" href="{{url('email/'.$email->id.'/edit')}}">Edit</a>
                        <button type="button" class="btn btn-outline-danger py-1 deletebtn" id="email_delete_{{$email->id}}">Delete</button>
                        <form id="email_delete_{{$email->id}}_form" action="{{url('email/'.$email->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>