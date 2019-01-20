@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                    <?php echo $rol ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection