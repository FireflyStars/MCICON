let app = new Vue({
    el: '#app',
    data: {
        status: 0, // 1: add, 2: edit
        selectedCateId: null,
        selectedName: '',
        selectedNameSP: '',
        selectedNamePT: '',
        selectedNameDU: '',
        selectedNameFR: '',
        selectedNameIT: '',
        selectedCateImage: null,
        selectedCateImageContent: null,
        categories: [],
        imageSelectFlag: false,
        label: null
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
            const reader = new FileReader();
            reader.onload = e => {
                this.selectedCateImageContent = reader.result;
            };
            reader.readAsDataURL(file);
            this.selectedCateImage = file;
        },
        showAddPanel() {
            this.status = 1;
            this.selectedCateId = null;
            this.selectedName = '';
            this.selectedNameSP = '';
            this.selectedNamePT = '';
            this.selectedNameFR = '';
            this.selectedNameDU = '';
            this.selectedNameIT = '';
            this.selectedCateImage = null;
            this.selectedCateImageContent = null;
            this.imageSelectFlag = null;
        },
        addCategory() {
            const app = this;
            let formData = new FormData();
            formData.append('name_en', this.selectedName);
            formData.append('name_sp', this.selectedNameSP);
            formData.append('name_pt', this.selectedNamePT);
            formData.append('name_du', this.selectedNameDU);
            formData.append('name_it', this.selectedNameIT);
            formData.append('name_fr', this.selectedNameFR);
            formData.append('image_file', this.selectedCateImage);

            axios.post('/admin/category', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response) {
                window.location = '/admin/category';
            }).catch(function(errors) {
                console.log(errors);
            });
        },
        cancel() {
            this.label = '';
            this.status = 0;
            this.selectedCateId = null;
            this.selectedName = '';
            this.selectedNameSP = '';
            this.selectedNamePT = '';
            this.selectedNameFR = '';
            this.selectedNameDU = '';
            this.selectedNameIT = '';
            this.label = '';
            this.selectedCateImage = null;
            this.selectedCateImageContent = null;
            // window.location = '/admin/review';
        },
        updateCategory() {
            const app = this;
            let formData = new FormData();
            formData.append('name_en', this.selectedName);
            formData.append('name_sp', this.selectedNameSP);
            formData.append('name_pt', this.selectedNamePT);
            formData.append('name_fr', this.selectedNameFR);
            formData.append('name_it', this.selectedNameIT);
            formData.append('name_du', this.selectedNameDU);
            if (this.selectedCateImage != null)
                formData.append('image_file', this.selectedCateImage);
            axios.post('/admin/category/' + this.selectedCateId, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response) {
                // Vue.set(app.categories, )
                window.location = '/admin/category';
            }).catch(function(errors) {
                console.log(errors);
            });
        },
        showEditPanel(cate_id) {
            this.label = '';
            this.status = 2;
            this.selectedCateId = cate_id;
            let cate = this.categories.find(item => item.id == cate_id);
            this.selectedName = cate.name;
            this.selectedNameSP = cate.name_sp;
            this.selectedNamePT = cate.name_pt;
            this.selectedNameFR = cate.name_fr;
            this.selectedNameDU = cate.name_du;
            this.selectedNameIT = cate.name_it;
            this.selectedCateImageContent = cate.url;
        },
        deleteCategory(cate_id) {
            const app = this;
            axios.post('/admin/category/' + cate_id + '/delete').then(function(response) {
                window.location = '/admin/category';
            }).catch(function(errors) {
                console.log(errors);
            });
        }
    },
    mounted() {
        const app = this;
        axios.get('/admin/category/show').then(function(response) {
            app.categories = response.data.cate;
        }).catch(function(errors) {
            console.log(errors);
        })
    },
    updated() {
        $('#category').DataTable();
    },
    created() {

    }
});