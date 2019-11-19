@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.crmCustomer.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.crm-customers.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                            <label for="first_name">{{ trans('cruds.crmCustomer.fields.first_name') }}*</label>
                            <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name', isset($crmCustomer) ? $crmCustomer->first_name : '') }}" required>
                            @if($errors->has('first_name'))
                                <p class="help-block">
                                    {{ $errors->first('first_name') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.crmCustomer.fields.first_name_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                            <label for="last_name">{{ trans('cruds.crmCustomer.fields.last_name') }}</label>
                            <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name', isset($crmCustomer) ? $crmCustomer->last_name : '') }}">
                            @if($errors->has('last_name'))
                                <p class="help-block">
                                    {{ $errors->first('last_name') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.crmCustomer.fields.last_name_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('status_id') ? 'has-error' : '' }}">
                            <label for="status">{{ trans('cruds.crmCustomer.fields.status') }}*</label>
                            <select name="status_id" id="status" class="form-control select2" required>
                                @foreach($statuses as $id => $status)
                                    <option value="{{ $id }}" {{ (isset($crmCustomer) && $crmCustomer->status ? $crmCustomer->status->id : old('status_id')) == $id ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status_id'))
                                <p class="help-block">
                                    {{ $errors->first('status_id') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">{{ trans('cruds.crmCustomer.fields.email') }}</label>
                            <input type="text" id="email" name="email" class="form-control" value="{{ old('email', isset($crmCustomer) ? $crmCustomer->email : '') }}">
                            @if($errors->has('email'))
                                <p class="help-block">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.crmCustomer.fields.email_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label for="phone">{{ trans('cruds.crmCustomer.fields.phone') }}</label>
                            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', isset($crmCustomer) ? $crmCustomer->phone : '') }}">
                            @if($errors->has('phone'))
                                <p class="help-block">
                                    {{ $errors->first('phone') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.crmCustomer.fields.phone_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label for="address">{{ trans('cruds.crmCustomer.fields.address') }}</label>
                            <input type="text" id="address" name="address" class="form-control" value="{{ old('address', isset($crmCustomer) ? $crmCustomer->address : '') }}">
                            @if($errors->has('address'))
                                <p class="help-block">
                                    {{ $errors->first('address') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.crmCustomer.fields.address_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('skype') ? 'has-error' : '' }}">
                            <label for="skype">{{ trans('cruds.crmCustomer.fields.skype') }}</label>
                            <input type="text" id="skype" name="skype" class="form-control" value="{{ old('skype', isset($crmCustomer) ? $crmCustomer->skype : '') }}">
                            @if($errors->has('skype'))
                                <p class="help-block">
                                    {{ $errors->first('skype') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.crmCustomer.fields.skype_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('website') ? 'has-error' : '' }}">
                            <label for="website">{{ trans('cruds.crmCustomer.fields.website') }}</label>
                            <input type="text" id="website" name="website" class="form-control" value="{{ old('website', isset($crmCustomer) ? $crmCustomer->website : '') }}">
                            @if($errors->has('website'))
                                <p class="help-block">
                                    {{ $errors->first('website') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.crmCustomer.fields.website_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.crmCustomer.fields.description') }}</label>
                            <textarea id="description" name="description" class="form-control ">{{ old('description', isset($crmCustomer) ? $crmCustomer->description : '') }}</textarea>
                            @if($errors->has('description'))
                                <p class="help-block">
                                    {{ $errors->first('description') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.crmCustomer.fields.description_helper') }}
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