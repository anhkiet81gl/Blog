<x-layouts.base>
    <h3 class="text-dark mb-4">Post Categories</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Post Categories List</p>
        </div>
        <div class="card-body">
            {!! $dataTable->table() !!}
        </div>
    </div>

    @section('css')
        <link rel="stylesheet" href="{{asset('modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('modules/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}">
    @endsection

    @section('scripts')
        <script src="{{asset('modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('modules/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('modules/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{asset('vendor/laravel-datatables-buttons/buttons.server-side.js')}}"></script>
        {{ $dataTable->scripts() }}
    @endsection
</x-layouts.base>



