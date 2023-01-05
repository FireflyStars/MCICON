let app = new Vue({
    el: '#app',
    data: {
        imageId: null,
        cate_tags: [],
        autocompleteItems: [],
        tag: '',
        tags: [],
        maxTags: 1000,
    },
    computed: {
        filteredItems() {
            return this.autocompleteItems.filter(item => {
                return item.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
            });
        },
    },
    methods: {
        updateTags(newTags) {
            this.tags = newTags;
        },
        addTagToServer(tagObject) {
            console.log(tagObject.tag)
            const app = this;
            let formData = new FormData;
            formData.append('cate_tag_id', tagObject.tag.cateTagId);
            axios.post('/admin/image/' + this.imageId + '/tags', formData).then(function(response) {
                tagObject.tag.id = response.data.id;
                tagObject.addTag();
            }).catch(function(errors) {
                console.lg(errors);
            });
        },
        updateTagContent(tagObject) {
            const app = this;
            let formData = new FormData;
            formData.append('cate_tag_id', tagObject.tag.cateTagId);
            axios.post('/admin/image/tags/' + tagObject.tag.id + '/update', formData).then(function(response) {
                tagObject.saveTag();
            }).catch(function(errors) {
                console.lg(errors);
            });
        },
        deleteTagFromSever(tagObject) {
            const app = this;
            axios.get('/admin/image/tags/' + tagObject.tag.id + '/delete').then(function(response) {
                tagObject.deleteTag();
            }).catch(function(errors) {
                console.log(errors);
            });
        },
    },
    mounted() {
        this.imageId = window.image_id;
        for (let index = 0; index < window.tags.length; index++) {
            const element = window.tags[index];
            this.tags.push({
                text: element.name,
                id: element.id
            })
        }
        for (let index = 0; index < window.cate_tags.length; index++) {
            const element = window.cate_tags[index];
            this.autocompleteItems.push({
                text: element.name,
                cateTagId: element.id
            })
        }
    },
    updated() {

    },
    created() {

    }
});