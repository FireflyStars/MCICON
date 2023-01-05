let app = new Vue({
    el: '#app',
    data: {
        content: '',
        contentSP: '',
        contentPT: '',
        contentFR: '',
        contentDU: '',
        contentIT: '',
        editContent: 0,
        editor: null
    },
    methods: {
        updateContent() {
            const app = this;
            let content = $('.ql-editor').html();
            if ($('.ql-toolbar') != undefined) {
                $('.ql-toolbar').remove();
            }
            if (this.editContent == 1) {
                this.content = content;
            } else if (this.editContent == 2) {
                // content = $('.ql-editor').html();
                this.contentSP = content;
            } else if (this.editContent == 3) {
                // content = $('.ql-editor').html();
                this.contentPT = content;
            } else if (this.editContent == 4) {
                // content = $('.ql-editor').html();
                this.contentFR = content;
            } else if (this.editContent == 5) {
                // content = $('.ql-editor').html();
                this.contentIT = content;
            } else {
                // content = $('.ql-editor').html();
                this.contentDU = content;
            }
            axios.post('/admin/resource-rule/1 ', {
                    content: content,
                    lang: this.editContent
                })
                .then(function(response) {
                    app.showUpdateSuccessToastr();
                    app.editContent = false;
                }).catch(function(error) {
                    console.log(error)
                });
        },
        showUpdateSuccessToastr() {
            toastr["success"]("Successfully Updated!")
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "500",
                "timeOut": "2000",
                "extendedTimeOut": "500",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        },
        cancelUpdate() {
            this.editContent = false;
            if ($('.ql-toolbar') != undefined) {
                $('.ql-toolbar').remove();
            }
        }
    },
    mounted() {
        const app = this;
        axios.get('/admin/resource-rule/1')
            .then(function(response) {
                app.content = response.data.data.content;
                app.contentSP = response.data.data.content_sp;
                app.contentPT = response.data.data.content_pt;
                app.contentFR = response.data.data.content_fr;
                app.contentDU = response.data.data.content_du;
                app.contentIT = response.data.data.content_it;
            }).catch(function(error) {
                console.log(error)
            });
    },
    updated() {
        // if (this.editor == null) {
        this.editor = new Quill('#text-editor', {
            theme: 'snow',
            modules: {
                'toolbar': [
                    [{ 'font': [] }, { 'size': [] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'script': 'super' }, { 'script': 'sub' }],
                    [{ 'header': [false, 1, 2, 3, 4, 5, 6] }, 'blockquote', 'code-block'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
                    ['direction', { 'align': [] }],
                    ['link', 'image', 'video', 'formula'],
                    ['clean']
                ]
            },
        });
        if (this.editContent == 1) {
            $('.ql-editor').html(this.content);
        } else if (this.editContent == 2) {
            $('.ql-editor').html(this.contentSP);
        } else if (this.editContent == 3) {
            $('.ql-editor').html(this.contentPT);
        } else if (this.editContent == 4) {
            $('.ql-editor').html(this.contentFR);
        } else if (this.editContent == 5) {
            $('.ql-editor').html(this.contentIT);
        } else {
            $('.ql-editor').html(this.contentDU);
        }
        // }
    },
    created() {

    }
});