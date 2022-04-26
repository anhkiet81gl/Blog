<x-layouts.base>
    <form method="post" action="{{route("admin.authors.update",$author->getAttribute('id'))}}" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header">
                Post Author Edit
            </div>
            <div class="card-body">
                @csrf
                @method('PUT')
                <input type="number" value="{{$author->getAttribute('id')}}" class="form-control" name="id" placeholder="id" hidden>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" value="{{$author->getAttribute('name')}}" class="form-control" name="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label>Url Key</label>
                    <input type="text" value="{{$author->getAttribute('url_key')}}" class="form-control" name="url_key" placeholder="Url Key">
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</x-layouts.base>
