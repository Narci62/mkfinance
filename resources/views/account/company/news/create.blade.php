<x-app-layout>

    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <div>
                <h1 class="flex-grow-1 fs-3 fw-semibold mb-2">{{ __('Redaction d\'article') }}</h1>
                <p class="fw-medium my-0 text-muted">
                    {{ __('Vous pouve rediger votre article pour soumission') }}
                </p>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row mb-3">
            <div class="col-md-12 m-auto">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible d-flex align-items-center" role="alert">
                    <div class="flex-shrink-0">
                        <i class="fa fa-fw fa-exclamation-circle fa-sm"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="mb-0">{{ __($error) }}</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endforeach
                @endif

                @if (session('error'))
                <div class="alert alert-danger">
                    {!! session('error') !!}
                </div>
                @endif

                @if (session('success'))
                <div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
                    <div class="flex-shrink-0">
                        <i class="fa fa-fw fa-check fa-sm"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="mb-0">{{ __(session('success')) }}</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>
        </div>
        @if(Auth::check())
        <div class="block block-rounded">
            <div class="block-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="block block-rounded">
                            <div class="block-header d-block pb-0 mb-0">
                                <h3 class="block-title">{{ __('Information de base') }}</h3>
                            </div>
                            <div class="block-content pt-0 mt-0">
                                <div class="col-8">
                                    <form method="POST" action="{{ route('co.newpost') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-floating mb-4">
                                            <input type="text" class="form-control" id="title" name="title" placeholder="titre" required autofocus>
                                            <label class="form-label" for="title">{{ __('Titre') }}</label>
                                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                        </div>

                                        <div class="mb-4">
                                            <input type="file" class="form-control form-control-alt form-control-lg" id="thumbnail" name="thumbnail" required accept="image/png, image/jpg">
                                            <label class="form-label" for="thumbnail"> {{ __('Image en  miniature') }} </label>
                                            <span class="text-muted fs-sm fst-italic"> {{ __('Taille maximale exigée : 2Mo; Format : png,jpg') }} </span>
                                            <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                                        </div>

                                        <div class="mb-4">
                                            <input type="file" class="form-control form-control-alt form-control-lg" id="attach" name="attach" accept="application/pdf">
                                            <label class="form-label" for="attach"> {{ __('Joindre un fichier') }} </label>
                                            <span class="text-muted fs-sm fst-itailc">{{ __('Facultatif') }}</span>
                                            <span class="text-muted fs-sm fst-italic"> {{ __('Taille maximale exigée : 2Mo; Format : pdf') }} </span>

                                            <x-input-error :messages="$errors->get('attach')" class="mt-2" />
                                        </div>
                                        
                                        <div class="form-floating mb-4">
                                            <textarea class="form-control" maxlength="1000" id="content" name="description" style="height: 150px" placeholder="Décrivez votre projet"></textarea>
                                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                        </div>

                                        <div class="text-start">
                                            <button type="submit" class="btn btn-md btn-outline-secondary"> {{ __('Enregistrer') }} </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

</x-app-layout>