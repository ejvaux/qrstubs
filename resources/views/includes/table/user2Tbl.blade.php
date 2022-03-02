<table class="table table-responsive-sm text-nowrap">
    <thead>
        <tr>
            <th>ID</th>
            <th>CANTEEN</th>
            <th>PRICE</th>
            <th>DATE</th>
            {{--<th>SCANNED BY</th>--}}
        </tr>
    </thead>
    <tbody>
        @if(Auth::user()->role_id==3)
            @isset($transactions)
                @if ($transactions->count() > 0)
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{$transaction->id}}</td>
                            <td>{{$transaction->canteen->name}}</td>
                            <td>{{$transaction->price}}</td>
                            <td>{{$transaction->created_at}}</td>
                            {{--<td>{{$transaction->scanner->name}}</td>--}}
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">NO DATA</td>
                    </tr>
                @endif
            @else
                <tr>
                    <td colspan="4">NO DATA</td>
                </tr>
            @endisset

        @else
            <td colspan="8">-- ACCOUNT NOT PERMITTED --</td>
        @endif
    </tbody>
</table>

