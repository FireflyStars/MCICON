let app = new Vue({
    el: '#app',
    data: {
        tag: '',
        cateId: null,
        tags: [],
        maxTags: 1000,
    },
    methods: {
        updateTags(newTags) {
            this.tags = newTags;
        },
        addTagToServer(tagObject) {
            const app = this;
            let formData = new FormData;
            formData.append('name', tagObject.tag.text);
            axios.post('/admin/category/' + this.cateId + '/tags', formData).then(function(response) {
                tagObject.tag.id = response.data.id;
                tagObject.addTag();
            }).catch(function(errors) {
                console.lg(errors);
            });
        },
        updateTagContent(tagObject) {
            const app = this;
            let formData = new FormData;
            formData.append('name', tagObject.tag.text);
            axios.post('/admin/category/tags/' + tagObject.tag.id + '/update', formData).then(function(response) {
                tagObject.saveTag();
            }).catch(function(errors) {
                console.lg(errors);
            });
        },
        deleteTagFromSever(tagObject) {
            const app = this;
            axios.get('/admin/category/tags/' + tagObject.tag.id + '/delete').then(function(response) {
                tagObject.deleteTag();
            }).catch(function(errors) {
                console.lg(errors);
            });
        },
    },
    mounted() {
        this.cateId = window.cateId;
        for (let index = 0; index < window.tags.length; index++) {
            const element = window.tags[index];
            this.tags.push({
                text: element.name,
                id: element.id
            })
        }
    },
    updated() {

    },
    created() {

    }
});