<x-backend>

    @section('SEO')
        <title>Блог статии</title>
    @endsection

    <!-- Breadcrumb Start -->
    <section class="breadcrumb__area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">

                        <h2 class="title">Управление на блог статии</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="shape">
            <img src="{{ asset('assets/img/images/breadcrumb_shape.png') }}" alt="">
        </div>
    </section>
    <!-- Breadcrumb End -->


    <!-- Blog Posts Start -->
    <section class="blog__post-area section-pb-120">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-40">
                <div>
                    <h3 class="mb-1">Всички статии</h3>
                    <p class="mb-0">Управлявайте публикуваните блог статии.</p>
                </div>

                <a href="{{ route('super_admin.blog.create-view') }}" class="tg-btn tg-border-btn-three">Създай
                    статия</a>
            </div>


            @if (session('successUploadingBlog'))
                <div class="alert alert-success mb-4">{{ session('successUploadingBlog') }}</div>
            @endif

            @if (session('successUpdatingBlog'))
                <div class="alert alert-success mb-4">{{ session('successUpdatingBlog') }}</div>
            @endif

            @if (session('successDeletingBlog'))
                <div class="alert alert-success mb-4">{{ session('successDeletingBlog') }}</div>
            @endif


            @if ($blogs->isNotEmpty())

                <div class="row">

                    @foreach ($blogs as $blog)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="blog__post-item">

                                <div class="blog__post-thumb">
                                    <a href="{{ route('super_admin.blog.show', $blog->blog_slug) }}">
                                        <img src="{{ asset('images/blog/' . $blog->blog_image) }}"
                                            alt="{{ $blog->blog_name }}">
                                    </a>

                                    @if ($blog->lang)
                                        <a href="{{ route('super_admin.blog.show', $blog->blog_slug) }}"
                                            class="blog__post-tag">{{ strtoupper($blog->lang) }}</a>
                                    @endif
                                </div>

                                <div class="blog__post-content">

                                    <div class="blog__post-meta mb-15">
                                        <ul class="list-wrap">
                                            <li><i class="fa-regular fa-calendar"></i>
                                                {{ $blog->created_at->format('d.m.Y') }}</li>
                                        </ul>
                                    </div>

                                    <h2 class="blog__post-title">
                                        <a
                                            href="{{ route('super_admin.blog.show', $blog->blog_slug) }}">{{ $blog->blog_name }}</a>
                                    </h2>

                                    <div class="d-flex align-items-center gap-2 mt-4">
                                        <a href="{{ route('super_admin.blog.show', $blog->blog_slug) }}"
                                            class="btn btn-info text-white">Редактирай</a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteBlogModal{{ $blog->id }}">Изтрий</button>
                                    </div>

                                </div>

                            </div>
                        </div>


                        <div class="modal fade" id="deleteBlogModal{{ $blog->id }}" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <form method="POST" action="{{ route('super_admin.blog.delete', $blog) }}">
                                        @csrf
                                        @method('DELETE')

                                        <div class="modal-header">
                                            <h5 class="modal-title">Изтриване на статия</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Затвори"></button>
                                        </div>

                                        <div class="modal-body">
                                            <p class="mb-0">Сигурни ли сте, че искате да изтриете статията
                                                <strong>{{ $blog->blog_name }}</strong>?</p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-info text-white"
                                                data-bs-dismiss="modal">Отказ</button>
                                            <button type="submit" class="btn btn-danger">Да, изтрий</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            @else
                <div class="alert alert-info p-3 rounded-3 w-fit">Все още нямате качени статии</div>

            @endif

        </div>
    </section>
    <!-- Blog Posts End -->




</x-backend>
