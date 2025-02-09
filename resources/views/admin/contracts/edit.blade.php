@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.contract.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.contracts.update", [$contract->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="unit_id">{{ trans('cruds.contract.fields.unit') }}</label>
                <select class="form-control select2 {{ $errors->has('unit') ? 'is-invalid' : '' }}" name="unit_id" id="unit_id" required>
                    @foreach($units as $id => $entry)
                        <option value="{{ $id }}" {{ (old('unit_id') ? old('unit_id') : $contract->unit->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('unit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('unit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contract.fields.unit_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tenant_id">{{ trans('cruds.contract.fields.tenant') }}</label>
                <select class="form-control select2 {{ $errors->has('tenant') ? 'is-invalid' : '' }}" name="tenant_id" id="tenant_id">
                    @foreach($tenants as $id => $entry)
                        <option value="{{ $id }}" {{ (old('tenant_id') ? old('tenant_id') : $contract->tenant->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('tenant'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tenant') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contract.fields.tenant_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start">{{ trans('cruds.contract.fields.start') }}</label>
                <input class="form-control date {{ $errors->has('start') ? 'is-invalid' : '' }}" type="text" name="start" id="start" value="{{ old('start', $contract->start) }}" required>
                @if($errors->has('start'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contract.fields.start_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end">{{ trans('cruds.contract.fields.end') }}</label>
                <input class="form-control date {{ $errors->has('end') ? 'is-invalid' : '' }}" type="text" name="end" id="end" value="{{ old('end', $contract->end) }}" required>
                @if($errors->has('end'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contract.fields.end_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rent_amount">{{ trans('cruds.contract.fields.rent_amount') }}</label>
                <input class="form-control {{ $errors->has('rent_amount') ? 'is-invalid' : '' }}" type="number" name="rent_amount" id="rent_amount" value="{{ old('rent_amount', $contract->rent_amount) }}" step="0.01">
                @if($errors->has('rent_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rent_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contract.fields.rent_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.contract.fields.status') }}</label>
                @foreach(App\Models\Contract::STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', $contract->status) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contract.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="contract_file">{{ trans('cruds.contract.fields.contract_file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('contract_file') ? 'is-invalid' : '' }}" id="contract_file-dropzone">
                </div>
                @if($errors->has('contract_file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contract_file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contract.fields.contract_file_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contract_link">{{ trans('cruds.contract.fields.contract_link') }}</label>
                <input class="form-control {{ $errors->has('contract_link') ? 'is-invalid' : '' }}" type="text" name="contract_link" id="contract_link" value="{{ old('contract_link', $contract->contract_link) }}">
                @if($errors->has('contract_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contract_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contract.fields.contract_link_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    var uploadedContractFileMap = {}
Dropzone.options.contractFileDropzone = {
    url: '{{ route('admin.contracts.storeMedia') }}',
    maxFilesize: 20, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="contract_file[]" value="' + response.name + '">')
      uploadedContractFileMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedContractFileMap[file.name]
      }
      $('form').find('input[name="contract_file[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($contract) && $contract->contract_file)
          var files =
            {!! json_encode($contract->contract_file) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="contract_file[]" value="' + file.file_name + '">')
            }
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
@endsection