@extends('layouts.app')
@section('style')
    <link href="{{ asset('libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .col-12.big-table{
            overflow-x: scroll !important;
        }
        .big-table .card-box{
            width: 140%;
        }
    </style>
@endsection
@section('content')

    <div class="container-fluid" id="app">
        <div class="">
            <a class="btn btn-success mr-3" href="/admin/category">
                back
            </a>
            <button v-if="status == 0" class="btn btn-primary"
            @click="showAddPanel">Add Image</button>
        <div>
        <div class="mt-1"  v-if="status == 0">
            <div class="col-12 p-0">
                <div class="card-box">
                    <div>
                        <table id="images" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Tags</th>
                                <th>Name (EN)</th>
                                <th>Name (SP)</th>
                                <th>Name (PT)</th>
                                <th>Name (FR)</th>
                                <th>Name (DU)</th>
                                <th>Name (IT)</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(image, index) in images">
                                    <td class="p-1"><div class="small-image" :style="'background:url('+ image.url +') no-repeat center center'" title="avatar"> </div></td>
                                    <td class="p-1"> <a class="btn btn-primary p-1" :href="'/admin/image/'+ image.id +'/tags'">Tags</a></td>
                                    <td class="p-1">@{{ image.name }}</td>
                                    <td class="p-1">@{{ image.name_sp }}</td>
                                    <td class="p-1">@{{ image.name_pt }}</td>
                                    <td class="p-1">@{{ image.name_fr }}</td>
                                    <td class="p-1">@{{ image.name_du }}</td>
                                    <td class="p-1">@{{ image.name_it }}</td>
                                    <td class="p-1"><button class="btn btn-success p-1" @click="showEditPanel(image.id)">edit</button></td>
                                    <td class="p-1"><button class="btn btn-danger p-1" @click="deleteImage(image.id)">delete</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="review-add-panel" v-if="status == 1">
            <div class="col-12 p-0">
                <h4>Add Image</h4>
                <form action="" class="card-box form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="name_en">Name (EN)</label>
                        <div class="col-sm-11">
                            <input type="text" id="name_en" class="form-control" v-model="selectedName" required autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="name_sp">Name (SP):</label>
                        <div class="col-sm-11">
                            <input type="text" id="name_sp" class="form-control" v-model="selectedNameSP" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="name_pt">Name (PT):</label>
                        <div class="col-sm-11">
                            <input type="text" id="name_pt" class="form-control" v-model="selectedNamePT" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="name_fr">Name (FR):</label>
                        <div class="col-sm-11">
                            <input type="text" id="name_fr" class="form-control" v-model="selectedNameFR" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="name_du">Name (DU):</label>
                        <div class="col-sm-11">
                            <input type="text" id="name_du" class="form-control" v-model="selectedNameDU" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="name_it">Name (IT):</label>
                        <div class="col-sm-11">
                            <input type="text" id="name_it" class="form-control" v-model="selectedNameIT" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="image">Image :</label>
                        <div class="col-sm-11">
                            <div class="upload hold border text-white" v-if="!imageSelectFlag" @click="triggerImage">
                                <span class="d-block">Select Zip Archive</span>
                            </div>
                            <div class="upload border text-white" v-if="imageSelectFlag" @click="triggerImage">@{{ label }}</div>
                        </div>
                    </div>
                    <input
                        type="file"
                        id="image"
                        ref="fileInput"
                        style="display: none;"
                        accept=".zip"
                        @change="onFileChange"
                        name="image">
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label"></label>
                        <div class="col-sm-11">
                            <button type="button" v-if="!isUploading" class="btn btn-primary col-1 mt-1" @click="addImage">Add</button>
                            <button type="button" v-if="isUploading" class="btn btn-primary col-2 mt-1">Saving <span class="spinner-border spinner-border-sm"></span></button>
                            <button type="button" class="btn btn-primary col-1 offset-1 mt-1" @click="cancel">Cancel</button>
                        </div>
                    </div>
                </form>
            </div><!-- end col -->
        </div>
        <div class="slide-edit-panel" v-if="status == 2">
            <div class="col-12 p-0">
                <h4>Edit Image</h4>
                <form action="" class="card-box form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="name_en">Name (EN)</label>
                        <div class="col-sm-11">
                            <input type="text" id="name_en" class="form-control" v-model="selectedName" required autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="name_sp">Name (SP):</label>
                        <div class="col-sm-11">
                            <input type="text" id="name_sp" class="form-control" v-model="selectedNameSP" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="name_pt">Name (PT):</label>
                        <div class="col-sm-11">
                            <input type="text" id="name_pt" class="form-control" v-model="selectedNamePT" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="name_fr">Name (FR):</label>
                        <div class="col-sm-11">
                            <input type="text" id="name_fr" class="form-control" v-model="selectedNameFR" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="name_du">Name (DU):</label>
                        <div class="col-sm-11">
                            <input type="text" id="name_du" class="form-control" v-model="selectedNameDU" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="name_it">Name (IT):</label>
                        <div class="col-sm-11">
                            <input type="text" id="name_it" class="form-control" v-model="selectedNameIT" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="image">Image :</label>
                        <div class="col-sm-11">
                            <div class="big-image border cursor-pointer" v-if="!imageSelectFlag" 
                            :style="'background:url('+ originalImageContent +') no-repeat center center'" 
                            @click="triggerImage"><span>Change Image</span></div>
                            <div class="upload border text-white" v-if="imageSelectFlag" @click="triggerImage">@{{ label }}</div>
                        </div>
                    </div>
                    <input
                        type="file"
                        id="image"
                        ref="fileInput"
                        style="display: none;"
                        accept=".zip"
                        @change="onFileChange"
                        name="image">                           
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label"></label>
                        <div class="col-sm-11">
                            <button type="button" v-if="!isUploading" class="btn btn-primary col-1 mt-1" @click="updateImage">Update</button>
                            <button type="button" v-if="isUploading" class="btn btn-primary col-2 mt-1">Saving <span class="spinner-border spinner-border-sm"></span></button>
                            <button type="button" class="btn btn-primary col-1 offset-1 mt-1" @click="cancel">Cancel</button>
                        </div>
                    </div>
                </form>
            </div><!-- end col -->            
        </div>
    </div> <!-- container -->

@endsection
@section('script')
    <!-- Dashboard init js-->
    <script src="{{ asset('libs/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('libs/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('js/backend/pages/image.init.js') }}"></script>
@endsection
