<div style="overflow-x:auto;">
    <table id="mytable" class="table table-bordred table-striped" style="width:100%;">  
        <thead>
        <tr> &nbsp; &nbsp; 
            <th><i class="fa fa-users"></i>&nbsp; &nbsp; &nbsp;ID NO</th>
            <th>Name</th>
            <th>Scanned By</th>
            <th>PRICE</th>
            <th>DATE</th>
        </tr>
        </thead>
        <tbody>
            @if(Auth::user()->role_id==2)
                @isset($transactions)
                    @if ($transactions->count() > 0)
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{$transaction->id}}</td>
                                <td>{{$transaction->user->name}}</td>
                                <td>{{$transaction->scanner->name}}</td>
                                <td>{{$transaction->price}}</td>
                                <td>{{$transaction->created_at}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">NO DATA</td>
                        </tr>
                    @endif
                @else
                    <tr>
                        <td colspan="7">NO DATA</td>
                    </tr>
                @endisset
                    
            @else
                <td colspan="8">-- ACCOUNT NOT PERMITTED --</td>
            @endif
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-md">
        @isset($transactions)
            {{-- {{ $employees->appends(request()->query())->links() }} --}}
            {!! $transactions->appends(\Request::except('page'))->render() !!}
            {{-- Input::except(array('page')) --}}
        @endisset                        
    </div>    
</div>