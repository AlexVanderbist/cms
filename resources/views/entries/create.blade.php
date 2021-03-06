@extends('statamic::layout')
@section('title', $breadcrumbs->title('Create Entry'))

@section('content')
    <base-entry-create-form
        :actions="{{ json_encode($actions) }}"
        collection-handle="{{ $collection }}"
        :fieldset="{{ json_encode($blueprint) }}"
        :values="{{ json_encode($values) }}"
        :meta="{{ json_encode($meta) }}"
        :published="{{ json_encode($published) }}"
        :localizations="{{ json_encode($localizations) }}"
        :revisions="{{ Statamic\Support\Str::bool($revisionsEnabled ) }}"
        :breadcrumbs="{{ $breadcrumbs->toJson() }}"
    ></base-entry-create-form>

@endsection
