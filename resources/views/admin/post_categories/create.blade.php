<x-layouts.base>
    <form method="post" action="{{route("admin.post-categories.store")}}" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header">
                Post Categories Create
            </div>
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" id="name">
                </div>
                <div class="form-group">
                    <label>Url Key</label>
                    <input type="text" class="form-control" name="url_key" placeholder="Url Key" id="urlkey">
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

    @section('scripts')
        <script type="text/javascript">
            function slug(title) {
                let slug;
                //Convert string to lower case
                slug = title.toLowerCase();
                //Replace string
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                slug = slug.replace(/ /gi, "-");
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //Output slug
                return slug;
            }

            $("#name").on("input", function () {
                $('#urlkey').val(slug($(this).val()));
            });
        </script>
    @endsection
</x-layouts.base>
