    @extends('admin.admin_master')
    @section('admin')
   
            <div class="card">
                <div class="card-header">
                    Wallet
                </div>
                <div class="card-body">
                    <h5 class="card-title">Your Amount</h5>
                    <p class="card-text">{{ $userWalletSum }}</p>
                </div>
            </div>

    @endsection
