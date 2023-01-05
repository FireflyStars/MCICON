@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="container-fluid" id="app">
        <a class="btn btn-success mr-3" href="javascript:history.back()">
            back
        </a>
        <div class="mt-1" >
            <div class="col-12 p-0">
                <div class="card-box">
                    <h4 class="text-capitalize">tags</h4>
                    <div class="col-md-12 p-0">
                        <vue-tags-input 
                            class="col-12 p-0" style="max-width: 100%"
                            v-model="tag"
                            :tags="tags"
                            :max-tags="maxTags"
                            placeholder="Add Image Tag From Category Tag"
                            :autocomplete-items="filteredItems"
                            :autocomplete-always-open="false"
                            {{-- :validation="validation" --}}
                            @before-adding-tag="addTagToServer"
                            @before-saving-tag="updateTagContent"
                            @before-deleting-tag="deleteTagFromSever"
                            @tags-changed="updateTags"/>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container -->

@endsection
@section('script')
<!-- Dashboard init js-->
{{-- <script src="https://unpkg.com/@johmun/vue-tags-input/dist/vue-tags-input.js"></script> --}}

<script src="{{ asset('libs/tag/tag-input.min.js') }}"></script>
<script src="{{ asset('js/backend/pages/imagetag.init.js') }}"></script>
@endsection
