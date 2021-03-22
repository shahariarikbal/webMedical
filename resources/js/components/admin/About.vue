<template>
    <div class="container-fluid">
        <div class="panel vld-parent">
            <loading :active.sync="isLoading"
                     :can-cancel="true"
                     :on-cancel="onCancel"
                     :is-full-page="fullPage"></loading>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <span class="new-patient">{{ titleMode ? 'Update About Us Section' : 'Decorate About Us Section' }}</span>
                    </div>
                </div>
                <hr/>

                <div class="col-md-12">
                    <form method="POST" @submit.prevent="editMode ? update() : store()">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>About Title</label>
                                    <textarea v-model="title" class="form-control" placeholder="About Title" cols="30" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>First Text</label>
                                    <textarea v-model="text_one" class="form-control" placeholder="First Text" cols="30" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Second Text</label>
                                    <textarea v-model="text_two" class="form-control" placeholder="Second Text" cols="30" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-success pull-right manage-font">{{ editMode ? 'Update' : 'Save' }}</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
// Import component
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
export default {
    data(){
        return{
            // Conditions for loading & edit-update
            isLoading   : false,
            fullPage    : true,
            editMode    : false,
            titleMode   : false,

            // store
            title    : '',
            text_one : '',
            text_two : '',
        }
    },
    components: {
        Loading
    },
    created(){
        this.getAbout()
    },
    methods:{
        onCancel() {
           console.log('User cancelled the loader.')
       },
       getAbout(){
           this.isLoading = true,
           axios.get('/settings/get_about')
           .then(response =>{
               this.isLoading = false
               this.title = response.data.title
               this.text_one = response.data.text_one
               this.text_two = response.data.text_two
               if (Object.keys(response.data).length > 0) {
                   this.editMode = true
                   this.titleMode = true
               }
           })
           .catch(error =>{
               console.log(error);
           })
       },
       store(){
           this.isLoading = true,
           axios.post('/settings/store' ,{
               title : this.title,
               text_one : this.text_one,
               text_two : this.text_two,
           })
           .then(response =>{
               this.isLoading = false
               this.title = ''
               this.text_one = ''
               this.text_two = ''
               flash('About Section Decarated Successfully')
               this.getAbout()
           })
           .catch(error =>{
               console.log(error);
           })
       },
       update(){
           this.isLoading = true,
           axios.post('/settings/update' ,{
               title : this.title,
               text_one : this.text_one,
               text_two : this.text_two,
           })
           .then(response =>{
               this.isLoading = false
               this.title = ''
               this.text_one = ''
               this.text_two = ''
               flash('About Section Updated Successfully')
               this.getAbout()
           })
           .catch(error =>{
               console.log(error);
           })
       },
    },
    
}
</script>