@extends('layouts.app')
@section('style')
    <link href="{{ asset('libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <div class="container-fluid" id="app">
        <button v-if="!addReviewPanelShow && !editReviewPanelShow" class="btn btn-primary col-2"
        @click="addReviewPanelShow = true; selectedAvatarPath = ''; label='Select Image'; selectedName = ''; selectedEmail = ''; selectedContent = ''">Add Review</button>
        <div class="row mt-1"  v-if="!addReviewPanelShow && !editReviewPanelShow">
            <div class="col-12">
                <div class="card-box">
                    <div>
                        <table id="reviews" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="num">No</th>
                                <th class="avatar">avatar</th>
                                <th class="name">Name</th>
                                <th class="email">Email</th>
                                <th class="date">Date</th>
                                <th class="content">Content</th>
                                <th class="edit">Edit</th>
                                <th class="delete">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(review, index) in reviewList">
                                    <td class="num" v-html="index+1"></td>
                                    <td class="avatar"><div class="small-avatar-img" :style="'background:url('+ review.avatar_path +') no-repeat center center'" title="avatar"> </div></td>
                                    <td class="name" v-html="review.name"></td>
                                    <td class="email" v-html="review.email"></td>
                                    <td class="date" v-html="review.date"></td>
                                    <td class="content">@{{ review.content }}</td>
                                    <td class="edit"><i class="fas fa-edit" @click="editReview(review.id)"></i></td>
                                    <td class="delete"><i class="fas fa-trash-alt" @click="deleteReview(review.id)"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row review-add-panel" v-if="addReviewPanelShow">
            <div class="col-12">
                <h4>Add Review</h4>
                <div class="card-box form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="name">Name:</label>
                        <div class="col-sm-11">
                            <input type="text" id="name" class="form-control" v-model="selectedName" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="email">Email:</label>
                        <div class="col-sm-11">
                            <input type="text" id="email" class="form-control" v-model="selectedEmail" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="content">Content:</label>
                        <div class="col-sm-11">
                            <textarea class="form-control" rows="10" id="content" v-model="selectedContent"  required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="avatar">avatar</label>
                        <div class="col-sm-11">
                            <div class="avatar-img" :style="'background:url('+ selectedAvatarPath +') no-repeat center center'" @click="triggerImage">@{{ label }}</div>
                        </div>
                    </div>
                    <input
                        type="file"
                        ref="fileInput"
                        style="display: none;"
                        accept="image/*"
                        @change="onFileChange"
                        name="image">
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="avatar"></label>
                        <div class="col-sm-11">
                            <button class="btn btn-primary col-1 mt-1" @click="addReview">Add</button>
                            <button class="btn btn-primary col-1 offset-1 mt-1" @click="cancel">Cancel</button>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
        <div class="row slide-edit-panel" v-if="editReviewPanelShow">
            <div class="col-12">
                <h4>Edit Review</h4>
                <div class="card-box form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="name">Name:</label>
                        <div class="col-sm-11">
                            <input type="text" id="name" class="form-control" v-model="selectedName" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="email">Email:</label>
                        <div class="col-sm-11">
                            <input type="text" id="email" class="form-control" v-model="selectedEmail" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="content">Content:</label>
                        <div class="col-sm-11">
                            <textarea class="form-control" rows="10" id="content" v-model="selectedContent"  required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="avatar">avatar</label>
                        <div class="col-sm-11">
                            <div class="avatar-img" :style="'background:url('+ selectedAvatarPath +') no-repeat center center'" @click="triggerImage">@{{ label }}</div>
                        </div>
                    </div>
                    <input
                        type="file"
                        ref="fileInput"
                        style="display: none;"
                        accept="image/*"
                        @change="onFileChange"
                        name="image">
                    <div class="form-group row">
                        <label class="col-sm-1  col-form-label" for="avatar"></label>
                        <div class="col-sm-11">
                            <button class="btn btn-primary col-1 mt-1" @click="updateReview">Update</button>
                            <button class="btn btn-primary col-1 offset-1 mt-1" @click="cancel">Cancel</button>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
    </div> <!-- container -->

@endsection
@section('script')
    <!-- Dashboard init js-->
    <script src="{{ asset('libs/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('libs/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('js/backend/pages/review.init.js') }}"></script>
@endsection
