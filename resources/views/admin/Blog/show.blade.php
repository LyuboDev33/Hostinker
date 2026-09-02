<x-frontend>

    @section('SEO')
        <title>Редакция на статия</title>
    @endsection

    <!-- Page Service Single Start -->
    <section class="page-service-single">
        <div class="container">

            <div class="row">

                <!-- Sidebar -->
                <div class="col-lg-4">
                    @include('layouts.components.Backend.sidebar')
                </div>

                <!-- Content -->
                <div class="col-lg-8">

                    <div class="contact-us-form pt-3">

                        <!-- Section Title Start -->
                        <div class="section-title">
                            <a href="{{ route('dashboard.blog.index') }}"
                                class="btn-theme d-block w-fit mb-2">
                                Назад
                            </a>
                            <h3>
                                Администрация - Редакция на статия
                            </h3>
                        </div>
                        <!-- Section Title End -->

                        @if(session('successUpdatingBlog'))
                            <div class="alert alert-success">Промените бяха запазени успешно!</div>
                        @endif

                        <!-- Form Start -->
                        <div class="contact-form">


                            <form action="{{ route('dashboard.blog.update', $blog->blog_slug) }}"
                                method="POST"
                                enctype="multipart/form-data">

                                @csrf
                                @method('PATCH')

                                <div class="row">

                                    <!-- Current Image -->
                                    <div class="col-lg-6 mb-4">

                                        <label class="mb-3">
                                            Текуща главна снимка
                                        </label>

                                        <div class="mb-4">
                                            <img src="{{ asset('images/blog/' . $blog->blog_image) }}"
                                                alt="{{ $blog->blog_name }}"
                                                class="img-fluid rounded-3 current-blog-image">
                                        </div>

                                    </div>

                                    {{-- <div class="col-lg-12 mb-5">
                                        <label class="mb-3">
                                            Галерия
                                        </label>

                                        <div class="row">
                                            @foreach (json_decode($blog->blog_gallery) as $image)
                                                <div class="col-md-4 mb-4">
                                                    <div class="border rounded-3 p-2">
                                                        <img src="{{ asset('images/blog/' . $image) }}"
                                                            class="img-fluid rounded-3">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div> --}}
                                    <!-- Current Gallery -->


                                    <!-- Change Main Image -->
                                    <div class="form-group col-md-6 mb-5">

                                        <label class="mb-2">
                                            Смени главната снимка
                                        </label>

                                        <input type="file" name="blog_image" class="form-control"
                                            accept=".jpg,.jpeg,.png">

                                        <small>
                                            Допустими формати: JPG, JPEG, PNG.
                                            Максимален размер: 2MB.
                                        </small>

                                        @error('blog_image')
                                            <div class="help-block with-errors text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                    <!-- Gallery -->
                                    {{-- <div class="form-group col-md-6 mb-5">

                                        <label class="mb-2">
                                            Добави снимки към галерията
                                        </label>

                                        <input type="file" multiple name="blog_gallery[]" class="form-control"
                                            accept=".jpg,.jpeg,.png">

                                        <small>
                                            Можете да качите няколко снимки наведнъж.
                                        </small>

                                        @error('blog_gallery')
                                            <div class="help-block with-errors text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div> --}}

                                    <!-- Blog Name -->
                                    <div class="form-group col-md-12 mb-4">

                                        <label class="mb-2">
                                            Име на статията
                                        </label>

                                        <input type="text" name="blog_name" class="form-control"
                                            value="{{ old('blog_name', $blog->blog_name) }}"
                                            placeholder="Заглавие на статията" required>

                                        @error('blog_name')
                                            <div class="help-block with-errors text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                    <!-- Blog Content -->
                                    <div class="form-group col-md-12 mb-5">
                                        <label class="mb-2">
                                            Съдържание
                                        </label>

                                        <textarea name="blog_content" class="form-control" rows="12" placeholder="Съдържание на статията" required>{{ old('blog_content', $blog->blog_content) }}</textarea>

                                        @error('blog_content')
                                            <div class="help-block with-errors text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                    <!-- Submit -->
                                    <div class="col-lg-12">
                                        <div class="contact-form-btn d-flex gap-3">


                                            <button type="submit" class="btn-default">
                                                <span>
                                                    Запази промените
                                                </span>
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- Form End -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Service Single End -->

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

</x-frontend>
