@extends('layouts.app')
@section('upload_document_form')

    <div class="container w-50">

        <form class="mx-auto my-5" method="POST" action="{{ route('attachment.store') }}"  enctype="multipart/form-data">
            @CSRF
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group pb-4">
                <label class="form-label" for="customFile">Upload Document</label>
                <input type="file" class="form-control" id="customFile" name="file"/>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
@endsection
