<template>
    <div class="container">
        <div class="row mt-3">
          <div class="col-12">
            <div class="card collapsed-card">
              <div class="card-header">
                <h3 class="card-title">About</h3>


                <div class="card-tools">
                       <button type="button" class="btn btn-primary"
                        @click = "moreaboutModal">Add More Info <i class="fas fa-clipboard"></i></button>   
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>                        
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Mission</th>
                      <th>Introduction</th>
                      <th>Media</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in about.data" :key="item.id">
                      <td>{{item.mission | truncate(30,'...')}}</td>
                      <td>{{item.introduction | truncate(30,'...')}}</td>
                      <td>{{item.media | truncate(30,'...')}}</td>
                      <td>
                          <a href="#" @click = "previewModal(item.id)">
                              <i class="fa fa-eye green"></i>
                          </a>                        
                          <a href="#" @click = "editModal(item)">
                              <i class="fa fa-edit blue"></i>
                          </a>
                      </td> 
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->               
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">More Information</h3>


              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Attribute</th>
                      <th>Description</th>
                      <th>Photo</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in moreabout.data" :key="item.id">
                      <td>{{item.id}}</td>
                      <td>{{item.attribute | truncate(30,'...')}}</td>
                      <td>{{item.description | truncate(30,'...')}}</td>
                      <td>{{item.photo}}</td>
                      <td>
                          <a href="#" @click = "previewmoreaboutModal(item.id)">
                              <i class="fa fa-eye green"></i>
                          </a>                        
                          <a href="#" @click = "editmoreaboutModal(item)">
                              <i class="fa fa-edit blue"></i>
                          </a>
                          <a href="#" @click = "deleteMoreAbout(item.id)">
                              <i class="fa fa-trash red"></i>
                          </a>
                      </td> 
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->               
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
           <div class="modal fade" id="addNew" tabindex="-1" role="dialog"
            aria-labelledby="addNewModal" aria-hidden="true">
            <div class="modal-dialog model-dialog-centered" role="document">
                <div class="modal-content">
                    <form @submit.prevent="editmode ? updateAbout() : createAbout()"> 
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="editmode" id="addNewModalTitle">
                            Update About Info
                            </h5>
                        <h5 class="modal-title" v-show="!editmode" id="addNewModalTitle">
                            Create New About
                            </h5>    
                        <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"> 
                            <div class="form-group">
                            <label>Mission</label>  
                                    <input v-model="form.mission" type="text"
                                    name="mission" class="form-control">
                                    <div v-if="form.errors.has('mission')" v-html="form.errors.get('mission')" />
                            </div> 

                            <div class="form-group">
                            <label>Introduction</label>  
                                    <textarea v-model="form.introduction" id="introduction"
                                    name="introduction" class="form-control">
                                    </textarea>
                                    <div v-if="form.errors.has('introduction')" v-html="form.errors.get('introduction')" />
                            </div>                             

                            <div class="form-group">
                                <label for="media">Feature Media</label>
                                <div class="col-sm-12">
                                <input type="file" @change="uploadMedia" name="media" class="form-input">
                                </div>  
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                        data-dismiss="modal">Close</button>
                        <button type="submit" v-show="editmode" class="btn btn-success">
                        Update</button>
                        <button type="submit" v-show="!editmode" class="btn btn-primary">
                        Create</button>     
                    </div>
                   
                    </form>    
                </div>
            </div>
            </div>
        <!-- end of modal -->  

        <!--More info about Modal -->
           <div class="modal fade" id="moreNew" tabindex="-1" role="dialog"
            aria-labelledby="addNewModal" aria-hidden="true">
            <div class="modal-dialog model-dialog-centered" role="document">
                <div class="modal-content">
                    <form @submit.prevent="editmode ? updateMoreAbout() : createMoreAbout()"> 
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="editmode" id="addNewModalTitle">
                            Update More About Info
                            </h5>
                        <h5 class="modal-title" v-show="!editmode" id="addNewModalTitle">
                            Create More About
                            </h5>    
                        <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"> 
                            <div class="form-group">
                            <label>Attribute</label>  
                                    <input v-model="form.attribute" type="text"
                                    name="attribute" class="form-control">
                                    <div v-if="form.errors.has('attribute')" v-html="form.errors.get('attribute')" />
                            </div> 

                            <div class="form-group">
                            <label>Description</label>  
                                    <textarea v-model="form.description" id="description"
                                    name="description" class="form-control">
                                    </textarea>
                                    <div v-if="form.errors.has('description')" v-html="form.errors.get('description')" />
                            </div>                             

                            <div class="form-group">
                                <label for="media">Feature Photo</label>
                                <div class="col-sm-12">
                                <input type="file" @change="uploadPhoto" name="photo" class="form-input">
                                </div>  
                            </div>

                            <div class="form-group">
                               <label for="tags">Tags</label>
                               <vue-tags-input
                                  v-model="form.tag"
                                  :tags="form.tags"
                                  :autocomplete-items="filteredItems"
                                  @tags-changed="newTags => form.tags = newTags"
                                />
                                <div v-if="form.errors.has('tags')" v-html="form.errors.get('tags')" />
                            </div>                            

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                        data-dismiss="modal">Close</button>
                        <button type="submit" v-show="editmode" class="btn btn-success">
                        Update</button>
                        <button type="submit" v-show="!editmode" class="btn btn-primary">
                        Create</button>     
                    </div>
                   
                    </form>    
                </div>
            </div>
            </div>
        <!-- end of more modal -->               
    </div>
</template>

<script>
    import VueTagsInput from '@johmun/vue-tags-input';
    export default {
        components: {
          VueTagsInput,
        },      
        data(){
            return{
                editmode: false,
                about: {},
                moreabout: {},
                form: new Form({
                    id: '',
                    mission : '',
                    introduction : '',
                    media : '',
                    attribute: '',
                    description :'',
                    photo: '',
                    tags: [],
                }),
                tag: '',
                autocompleteItems: [],                  
            }
        },
        methods: {    
            uploadMedia(element){
            // console.log('Uploading')
            let file = element.target.files[0];
            let reader = new FileReader();
            console.log(file)
            if(file['size'] < 711177){
            reader.onloadend = (file) => {
              // console.log('RESULT',reader.result)
            this.form.media = reader.result
            }
            reader.readAsDataURL(file);    
            }else{
            Swal.fire({
              icon: 'error',
              title: 'Large file...',
              text: 'Please upload a smaller file'
            })  
            }  
            },  
              newModal(){
                  this.editmode = false,
                  this.form.reset();
                  $('#addNew').modal('show')  
              },
              editModal(item){
                  this.editmode = true,
                  this.form.reset();
                  $('#addNew').modal('show')
                  this.form.fill(item);  
              },
              previewModal(id){

              },              
              updateSlide(){
                  this.$Progress.start();
                  this.form.put('api/about/'+this.form.id)
                  .then(() => {
                    $('#addNew').modal('hide')
                    this.$Progress.finish();
                    Swal.fire(
                    'Updated!',
                    'About has been updated.',
                    'success'
                    )
                    Fire.$emit('Refresh');
                  })
                  .catch(() => {
                    this.$Progress.fail();
                  })
              },
              createAbout(){
                  this.$Progress.start();
                  this.form.post('api/about')
                  .then(() => {
                  $('#addNew').modal('hide')
                  this.$Progress.finish();                                      
                  toast.fire({
                      icon: 'success',
                      title: 'About created successfully'
                      })
                  Fire.$emit('Refresh');      
                  })
                  .catch(() => {
                  this.$Progress.fail(); 
                  console.log('error'); 
                  })
              },             
              deleteAbout(id){
                this.$Progress.start();
                Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.isConfirmed) { 
                  //send request to the server
                  this.form.delete('api/about/'+id).then(() => {
                  this.$Progress.finish();
                  Swal.fire(
                    'Deleted!',
                    'About has been deleted.',
                    'success'
                  )
                  Fire.$emit('Refresh');
                  }).catch(() => {
                  this.$Progress.fail();  
                    Swal.fire(
                    'Failed!',
                    'There was something wrong.',
                    'warning'
                  )
                  }); 
                  }else if(result.isDenied) {
                    console.log('cancelled')
                  }
                                   
                })
              },
              moreaboutModal(){
                  this.editmode = false,
                  this.form.reset();
                  $('#moreNew').modal('show')  
              },
              editmoreaboutModal(item){
                  this.editmode = true,
                  this.form.reset();
                  $('#moreNew').modal('show')
                  this.form.fill(item);  
              },
              previewmoreaboutModal(id){

              }, 
            uploadPhoto(element){
            // console.log('Uploading')
            let file = element.target.files[0];
            let reader = new FileReader();
            console.log(file)
            if(file['size'] < 711177){
            reader.onloadend = (file) => {
              // console.log('RESULT',reader.result)
            this.form.photo = reader.result
            }
            reader.readAsDataURL(file);    
            }else{
            Swal.fire({
              icon: 'error',
              title: 'Large file...',
              text: 'Please upload a smaller file'
            })  
            }  
            },              
              updateMoreAbout(){
                  this.$Progress.start();
                  this.form.put('api/moreabout/'+this.form.id)
                  .then(() => {
                    $('#moreNew').modal('hide')
                    this.$Progress.finish();
                    Swal.fire(
                    'Updated!',
                    'More about has been updated.',
                    'success'
                    )
                    Fire.$emit('RefreshMoreAbout');
                  })
                  .catch(() => {
                    this.$Progress.fail();
                  })
              },
              createMoreAbout(){
                  this.$Progress.start();
                  this.form.post('api/moreabout')
                  .then(() => {
                  $('#moreNew').modal('hide')
                  this.$Progress.finish();                                      
                  toast.fire({
                      icon: 'success',
                      title: 'More about created successfully'
                      })
                  Fire.$emit('RefreshMoreAbout');      
                  })
                  .catch(() => {
                  this.$Progress.fail(); 
                  console.log('error'); 
                  })
              },            
              deleteMoreAbout(id){
                this.$Progress.start();
                Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.isConfirmed) { 
                  //send request to the server
                  this.form.delete('api/moreabout/'+id).then(() => {
                  this.$Progress.finish();
                  Swal.fire(
                    'Deleted!',
                    'More about has been deleted.',
                    'success'
                  )
                  Fire.$emit('RefreshMoreAbout');
                  }).catch(() => {
                  this.$Progress.fail();  
                    Swal.fire(
                    'Failed!',
                    'There was something wrong.',
                    'warning'
                  )
                  }); 
                  }else if(result.isDenied) {
                    console.log('cancelled')
                  }
                                   
                })
              },                           
              loadAbout(){
                  axios.get('api/about').then(({data}) => (this.about = data));
              }, 
              loadMoreAbout(){
                  axios.get('api/moreabout').then(({data}) => (this.moreabout = data));
              },
              loadTags(){
              axios.get("/api/tags").then(response => {
                  this.autocompleteItems = response.data.data.map(a => {
                      return { text: a.name, id: a.id };
                  });
              }).catch(() => console.warn('Oh. Something went wrong'));
              } ,                              
        },
        mounted() {
            this.loadAbout();
            this.loadMoreAbout();
            Fire.$on('Refresh',() => {
            this.loadAbout();
            });
            Fire.$on('RefreshMoreAbout',() => {
            this.loadMoreAbout();
            });            
        },
        filters: {
          truncate: function(text,length, suffix) {
            return text.substring(0,length) + suffix;
          }
        },
        computed: {
          filteredItems() {
            return this.autocompleteItems.filter(i => {
              return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
            });
          },
        },        
    }
</script>
