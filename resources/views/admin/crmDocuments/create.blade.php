@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.crmDocument.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.crm-documents.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('customer_id') ? 'has-error' : '' }}">
                            <label for="customer">{{ trans('cruds.crmDocument.fields.customer') }}*</label>
                            <select name="customer_id" id="customer" class="form-control select2" required>
                                @foreach($customers as $id => $customer)
                                    <option value="{{ $id }}" {{ (isset($crmDocument) && $crmDocument->customer ? $crmDocument->customer->id : old('customer_id')) == $id ? 'selected' : '' }}>{{ $customer }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('customer_id'))
                                <p class="help-block">
                                    {{ $errors->first('customer_id') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('document_file') ? 'has-error' : '' }}">
                            <label for="document_file">{{ trans('cruds.crmDocument.fields.document_file') }}*</label>
                            <div class="needsclick dropzone" id="document_file-dropzone">

                            </div>
                            @if($errors->has('document_file'))
                                <p class="help-block">
                                    {{ $errors->first('document_file') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.crmDocument.fields.document_file_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ trans('cruds.crmDocument.fields.name') }}</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($crmDocument) ? $crmDocument->name : '') }}">
                            @if($errors->has('name'))
                                <p class="help-block">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.crmDocument.fields.name_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.crmDocument.fields.description') }}</label>
                            <textarea id="description" name="description" class="form-control ">{{ old('description', isset($crmDocument) ? $crmDocument->description : '') }}</textarea>
                            @if($errors->has('description'))
                                <p class="help-block">
                                    {{ $errors->first('description') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.crmDocument.fields.description_helper') }}
                            </p>
                        </div>
                        <div>
                            <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                        </div>
                    </form>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    Dropzone.options.documentFileDropzone = {
    url: '{{ route('admin.crm-documents.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="document_file"]').remove()
      $('form').append('<input type="hidden" name="document_file" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="document_file"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($crmDocument) && $crmDocument->document_file)
      var file = {!! json_encode($crmDocument->document_file) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="document_file" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@stop