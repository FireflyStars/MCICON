@extends('layouts.app')
@section('style')
    <link href="{{ asset('libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('libs/editor/quill.core.css')}}">
    <link rel="stylesheet" href="{{asset('libs/editor/quill.snow.css')}}">

@endsection
@section('content')
    <div class="container-fluid" id="app">
        <div class="row">
            <div class="card-box col-12">
                <h4 class="text-capitalize">Resource Rule</h4>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#english-content">English</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#spainish-content">Spainish</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#portuguese-content">Portuguese</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#french-content">French</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#italian-content">Italian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#dutch-content">Dutch</a>
                    </li>
                </ul>
                    
                <!-- Tab panes -->
                <div class="tab-content pt-0 pl-0 pr-0 pb-2">
                    <div id="english-content" class="container tab-pane active"><br>
                        <div class="col-md-12 p-0" v-if="editContent != 1">
                            <div class="desc" v-html="content">
                            </div>
                            <button class="btn btn-primary mt-2 col-2" @click="editContent = 1">Update</button>
                        </div>
                        <div class="col-md-12 p-0" v-if="editContent == 1">
                            <div id="text-editor" style="height: 500px">
                            </div>
                            <div class="row col-md-12">
                                <button class="btn btn-primary mt-2 col-2" @click="updateContent">Save</button>
                                <button class="btn btn-danger offset-2 mt-2 col-2" @click="cancelUpdate">Cancel</button>
                            </div>                            
                        </div>                        
                    </div>
                    <div id="spainish-content" class="container tab-pane fade"><br>
                        <div class="col-md-12 p-0" v-if="editContent != 2">
                            <div class="desc" v-html="contentSP">
                            </div>
                            <button class="btn btn-primary mt-2 col-2" @click="editContent = 2">Update</button>
                        </div>
                        <div class="col-md-12 p-0" v-if="editContent == 2">
                            <div id="text-editor" style="height: 500px">
                            </div>
                            <div class="row col-md-12">
                                <button class="btn btn-primary mt-2 col-2" @click="updateContent">Save</button>
                                <button class="btn btn-danger offset-2 mt-2 col-2" @click="cancelUpdate">Cancel</button>
                            </div>                              
                        </div>                        
                    </div>
                    <div id="portuguese-content" class="container tab-pane fade"><br>
                        <div class="col-md-12 p-0" v-if="editContent != 3">
                            <div class="desc" v-html="contentPT">
                            </div>
                            <button class="btn btn-primary mt-2 col-2" @click="editContent = 3">Update</button>
                        </div>
                        <div class="col-md-12 p-0" v-if="editContent == 3">
                            <div id="text-editor" style="height: 500px">
                            </div>
                            <div class="row col-md-12">
                                <button class="btn btn-primary mt-2 col-2" @click="updateContent">Save</button>
                                <button class="btn btn-danger offset-2 mt-2 col-2" @click="cancelUpdate">Cancel</button>
                            </div>                              
                        </div>                        
                    </div>
                    <div id="french-content" class="container tab-pane fade"><br>
                        <div class="col-md-12 p-0" v-if="editContent != 4">
                            <div class="desc" v-html="contentFR">
                            </div>
                            <button class="btn btn-primary mt-2 col-2" @click="editContent = 4">Update</button>
                        </div>
                        <div class="col-md-12 p-0" v-if="editContent == 4">
                            <div id="text-editor" style="height: 500px">
                            </div>
                            <div class="row col-md-12">
                                <button class="btn btn-primary mt-2 col-2" @click="updateContent">Save</button>
                                <button class="btn btn-danger offset-2 mt-2 col-2" @click="cancelUpdate">Cancel</button>
                            </div>   
                        </div>                        
                    </div>
                    <div id="italian-content" class="container tab-pane fade"><br>
                        <div class="col-md-12 p-0" v-if="editContent != 5">
                            <div class="desc" v-html="contentIT">
                            </div>
                            <button class="btn btn-primary mt-2 col-2" @click="editContent = 5">Update</button>
                        </div>
                        <div class="col-md-12 p-0" v-if="editContent == 5">
                            <div id="text-editor" style="height: 500px">
                            </div>
                            <div class="row col-md-12">
                                <button class="btn btn-primary mt-2 col-2" @click="updateContent">Save</button>
                                <button class="btn btn-danger offset-2 mt-2 col-2" @click="cancelUpdate">Cancel</button>
                            </div>                            
                        </div>                        
                    </div>
                    <div id="dutch-content" class="container tab-pane fade"><br>
                        <div class="col-md-12 p-0" v-if="editContent != 6">
                            <div class="desc" v-html="contentDU">
                            </div>
                            <button class="btn btn-primary mt-2 col-2" @click="editContent = 6">Update</button>
                        </div>
                        <div class="col-md-12 p-0" v-if="editContent == 6">
                            <div id="text-editor" style="height: 500px">
                            </div>
                            <div class="row col-md-12">
                                <button class="btn btn-primary mt-2 col-2" @click="updateContent">Save</button>
                                <button class="btn btn-danger offset-2 mt-2 col-2" @click="cancelUpdate">Cancel</button>
                            </div>                              
                        </div>                        
                    </div>
                </div>                
            </div>
        </div>
        <!-- end row -->
    </div>
@endsection
@section('script')
    <script src="{{ asset('libs/editor/katex.min.js')}}"></script>
    <script src="{{ asset('libs/editor/quill.min.js')}}"></script>
    <script src="{{ asset('js/backend/pages/resourcerule.init.js') }}"></script>

@endsection
