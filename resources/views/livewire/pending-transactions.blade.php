<div>
    <div class="card">
        <div class="card-header font-weight-bold">
            Pending Transactions
        </div>
        <ul class="list-group list-group-flush container">
            @isset($transactions)
                @if ($transactions->count() > 0)
                    @foreach ($transactions as $index=>$transaction)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            #{{$transaction->id}}
                                        </div>
                                        <div class="col text-left font-weight-bold" style="font-size:1rem">
                                            Price: {{$transaction->price}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            {{$transaction->canteen->name}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            {{$transaction->created_at}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    @if ($user->role_id == 2)
                                        <div class="row">
                                            <div class="col">
                                                <button type="button" wire:click="$emit('confirmTransaction','cancelTransaction','{{$transaction->id}}','Cancel Transaction #{{$transaction->id}}?')" wire:key="{{ time().$loop->index }}" class="btn btn-warning">Cancel</button>
                                            </div>
                                        </div>
                                    @elseif ($user->role_id == 3)
                                        <div class="row">
                                            <div class="col">
                                                <button type="button" wire:click="$emit('confirmTransaction','acceptTransaction','{{$transaction->id}}','Confirm Transaction #{{$transaction->id}}?')" wire:key="{{ time().$loop->index }}" class="btn btn-primary">Confirm</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="list-group-item">No Pending Transactions</li>
                @endif
            @else
                <li class="list-group-item">No Pending Transactions</li>
            @endisset
        </ul>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    document.addEventListener('livewire:load', function () {
        console.log( "Stack:ready!" );

        window.livewire.on('confirmTransaction', (action,id,msg) => {
            Swal.fire({
            title: 'Are you sure?',
            text: msg,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, proceed',
            cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('confirm');
                    window.livewire.emit(action,id);
                }
            })
        });

        window.livewire.on('alertMessage', msg => {
            iziToast.success({
                message: msg,
            });
        });

        window.livewire.on('notifyMessage', (title,msg) => {
            iziToast.info({
                title: title,
                message: msg,
                layout: 2,
            });
        });
        window.livewire.on('updateBalance', (balance) => {
            $('#app #userBalance').text(balance);
        });
        window.livewire.on('getTransactionHistory', () => {
            LoadUsrTbl2();
        });
    })
    </script>
@endpush
