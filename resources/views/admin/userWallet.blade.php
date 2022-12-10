    @extends('admin.adminUser_master')
    @section('admin')
        @if (count($errors))
            @foreach ($errors->all() as $error)
                <p class="alert alert-danger alert-dismissble fade show">{{ $error }}</p>
            @endforeach
        @endif
        <form method="post" action="{{ route('walletRaise') }}">
            @csrf
            <div class="card">
                <div class="card-header">
                    Wallet
                </div>
                <div class="card-body">
                    <h5 class="card-title">Your Amount</h5>
                    <p class="card-text">{{ $userWalletSum }}</p>
                </div>
                <div class="col-sm-6 mb-4">
                    <input type="text" name="amountToRaise" placeholder="000000">
                    <button type="submit" class="btn btn-primary">Raise Amount</button>
                </div>
            </div>
        </form>
    @endsection
