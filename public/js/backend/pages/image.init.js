let app = new Vue({
    el: '#app',
    data: {
        status: 0, // 0:show Images,  1: add Image, 2: edit Image
        selectedImageId: null,
        selectedName: '',
        selectedNameSP: '',
        selectedNamePT: '',
        selectedNameDU: '',
        selectedNameFR: '',
        selectedNameIT: '',
        images: [],
        label: '',
        selectedImage: null,
        originalImageContent: null,
        cate_id: null,
        imageSelectFlag: false,
        isUploading: false,
    },
    methods: {
        triggerImage() {
            this.label = '';
            this.$refs.fileInput.click();
        },
        onFileChange(e) {
            const file = e.target.files[0];
            this.imageSelectFlag = true;
            this.label = file.name;
            this.selectedImage = file;
        },
        showAddPanel() {
            this.status = 1;
            this.selectedImageId = null;
            this.selectedName = '';
            this.selectedNameSP = '';
            this.selectedNamePT = '';
            this.selectedNameFR = '';
            this.selectedNameDU = '';
            this.selectedNameIT = '';
        },
        addImage() {
            this.isUploading = true;
            const app = this;
            let formData = new FormData();
            formData.append('name_en', this.selectedName);
            formData.append('name_sp', this.selectedNameSP);
            formData.append('name_pt', this.selectedNamePT);
            formData.append('name_du', this.selectedNameDU);
            formData.append('name_it', this.selectedNameIT);
            formData.append('name_fr', this.selectedNameFR);
            formData.append('image_file', this.selectedImage);
            axios.post('/admin/category/' + this.cate_id + '/images', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response) {
                console.log(response.data.status);
                app.isUploading = false;
                window.location = '/admin/category/' + app.cate_id + '/images';
            }).catch(function(errors) {
                console.log(errors);
            });
        },
        cancel() {
            this.label = '';
            this.status = 0;
            this.selectedImageId = null;
            this.selectedImage = null;
            this.selectedName = '';
            this.selectedNameSP = '';
            this.selectedNamePT = '';
            this.selectedNameFR = '';
            this.selectedNameDU = '';
            this.selectedNameIT = '';
            this.label = '';
            this.imageSelectFlag = false;
            // window.location = '/admin/review';
        },
        showEditPanel(image_id) {
            this.label = '';
            this.status = 2;
            this.selectedImageId = image_id;
            let image = this.images.find(item => item.id == image_id);
            this.selectedName = image.name;
            this.selectedNameSP = image.name_sp;
            this.selectedNamePT = image.name_pt;
            this.selectedNameFR = image.name_fr;
            this.selectedNameDU = image.name_du;
            this.selectedNameIT = image.name_it;
            this.originalImageContent = image.url;
        },
        updateImage() {
            this.isUploading = true;
            const app = this;
            let formData = new FormData();
            formData.append('name_en', this.selectedName);
            formData.append('name_sp', this.selectedNameSP);
            formData.append('name_pt', this.selectedNamePT);
            formData.append('name_fr', this.selectedNameFR);
            formData.append('name_it', this.selectedNameIT);
            formData.append('name_du', this.selectedNameDU);

            if (this.selectedImage != null)
                formData.append('image_file', this.selectedImage);

            axios.post('/admin/category/' + this.cate_id + '/images/' + this.selectedImageId + '/update', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response) {
                this.isUploading = false;
                window.location = '/admin/category';
            }).catch(function(errors) {
                console.log(errors);
            });
        },
        deleteImage(image_id) {
            const app = this;
            axios.post('/admin/category/images/' + image_id + '/delete').then(function(response) {
                window.location = '/admin/category/' + app.cate_id + '/images';
            }).catch(function(errors) {
                console.log(errors);
            });
        }
    },
    mounted() {
        this.images = window.images;
        this.cate_id = window.cate_id;
    },
    updated() {
        $('#images').DataTable();
    },
    created() {

    }
});