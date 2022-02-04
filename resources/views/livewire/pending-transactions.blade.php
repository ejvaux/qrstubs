<div>
    <div class="card">
        <div class="card-header font-weight-bold">
            <div class="row">
                <div class="col">
                    Pending Transactions
                </div>
                <div class="col text-right">
                    @isset($transactions)
                        @if ($transactions->count() > 1)
                            @if ($user->role_id == 2)
                                <div class="row">
                                    <div class="col">
                                        <button type="button" wire:click="$emit('updateAllTransaction','cancelAllTransaction','{{$transactions}}','Cancel All Transaction?')" class="btn btn-warning">Cancel All</button>
                                    </div>
                                </div>
                            @elseif ($user->role_id == 3)
                                <div class="row">
                                    <div class="col">
                                        <button type="button" wire:click="$emit('updateAllTransaction','confirmAllTransaction','{{$transactions}}','Confirm All Transaction?')" class="btn btn-primary">Confirm All</button>
                                    </div>
                                </div>
                            @endif
                            {{--<button type="button" wire:click="$emit('confirmAllTransactions','{{$transactions}}')" class="btn btn-warning">Accept All</button>--}}
                        @endif
                    @endisset
                </div>
            </div>
        </div>
        <ul class="list-group list-group-flush container">
            @isset($transactions)
                @if ($transactions->count() > 0)
                    @foreach ($transactions as $index=>$transaction)
                        <li id="row_{{$transaction->id}}" class="list-group-item" wire:key="{{ time().$loop->index }}">
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
                                            @if ($user->role_id == 2)
                                            {{$transaction->user->uname}} - {{$transaction->user->name}}
                                            @elseif ($user->role_id == 3)
                                                {{$transaction->canteen->name}}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            {{$transaction->created_at}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 text-right">
                                    @if ($user->role_id == 2)
                                        <div class="row">
                                            <div class="col">
                                                <button type="button" wire:click="$emit('updateTransaction','cancelTransaction','{{$transaction->id}}','Cancel Transaction #{{$transaction->id}}?')" class="btn btn-warning">Cancel</button>
                                            </div>
                                        </div>
                                    @elseif ($user->role_id == 3)
                                        <div class="row">
                                            <div class="col">
                                                <button type="button" wire:click="$emit('updateTransaction','confirmTransaction','{{$transaction->id}}','Confirm Transaction #{{$transaction->id}}?')" class="btn btn-primary">Confirm</button>
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

        window.livewire.on('updateTransaction', (action,id,msg) => {
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
                    console.log('update');
                    window.livewire.emit(action,id);
                }
            })
        });

        window.livewire.on('updateAllTransaction', (action,transactions,msg) => {
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
                    console.log('updateAll');
                    window.livewire.emit(action,transactions);
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

        window.livewire.on('focusTransaction', (id) => {
            $('html, body').animate({
                scrollTop: $('#row_'+id).offset().top - $(window).height() / 2
            }, 1000);
        });
    })
    </script>
@endpush
