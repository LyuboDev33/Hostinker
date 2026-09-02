<x-backend>

    @section('SEO')
        <title>Създаване на статия | Табло за управление</title>
    @endsection

    <div class="page-contact-us">
        <div class="container">

            <div class="row align-items-start">

                <div class="col-12">

                    <div class="contact-us-form pt-1">

                        <div class="section-title mt-3">
                            <h3>Създаване на нова статия</h3>
                        </div>

                        <div class="contact-form">

                            <form action="{{ route('super_admin.blog.create') }}" method="POST" enctype="multipart/form-data">

                                @csrf

                                <div class="row">

                                    <!-- Article Name -->
                                    <div class="form-group col-md-4 mb-4">

                                        <label class="mb-2">Име на статията</label>

                                        <input type="text" name="name" class="form-control" placeholder="Заглавие на статията" value="{{ old('name') }}" required>

                                        @error('name')
                                            <div class="help-block with-errors text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>


                                    <!-- Main Image -->
                                    <div class="form-group col-md-4 mb-5">

                                        <label class="mb-2">Главна снимка на статията</label>

                                        <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp" required>

                                        <small>Допустими формати: JPG, JPEG, PNG, WEBP. Максимален размер: 2MB.</small>

                                        @error('image')
                                            <div class="help-block with-errors text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>


                                    <!-- Content -->
                                    <div class="form-group col-md-12 mb-5">

                                        <label class="mb-2">Съдържание на статията</label>

                                        <textarea name="content" class="form-control" rows="12" placeholder="Съдържание на статията">{{ old('content') }}</textarea>

                                        @error('content')
                                            <div class="help-block with-errors text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>


                                    <!-- Submit -->
                                    <div class="col-lg-4">

                                        <div class="contact-form-btn d-flex gap-3">

                                            <button type="submit" class="btn-default">
                                                <span>Добави статия</span>
                                            </button>

                                            <a href="{{ route('super_admin.blog.index') }}" class="btn btn-secondary">
                                                Назад
                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>


    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: [
                'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media',
                'searchreplace', 'table', 'visualblocks', 'wordcount',
            ],
            toolbar: 'undo redo | tinymceai-chat tinymceai-quickactions tinymceai-review | blocks fontfamily fontsize | bold italic underline strikethrough | link media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography uploadcare | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>

</x-backend>
