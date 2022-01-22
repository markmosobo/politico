<template>
    <div class="container">
        <div class="row mt-3">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Photos</h3>

                <div class="card-tools">
                       <button type="button" class="btn btn-primary"
                        @click = "newModal">Add New <i class="fas fa-clipboard"></i></button>   
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Photo</th>
                      <th>Category</th>
                      <th>Description</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in photos.data" :key="item.id">
                      <td>{{item.id}}</td>
                      <td>{{item.photo}}</td>
                      <td>{{item.category}}</td>                      
                      <td>{{item.description | truncate(30,'...')}}</td>
                      <td>
                          <a href="#" @click = "previewModal(item.id)">
                              <i class="fa fa-eye green"></i>
                          </a>                          
                          <a href="#" @click = "editModal(item)">
                              <i class="fa fa-edit blue"></i>
                          </a>
                          <a href="#" @click = "deletePhoto(item.id)">
                              <i class="fa fa-trash red"></i>
                          </a>
                      </td> 
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <pagination :data="photos" @pagination-change-page="getResults">
                  	<span slot="prev-nav">&lt; Previous</span>
	                  <span slot="next-nav">Next &gt;</span>
                </pagination>
              </div>              
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
           <div class="modal fade" id="addNew" tabindex="-1" role="dialog"
            aria-labelledby="addNewModal" aria-hidden="true">
            <div class="modal-dialog model-dialog-centered" role="document">
                <div class="modal-content">
                    <form @submit.prevent="editmode ? updatePhoto() : createPhoto()"> 
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="editmode" id="addNewModalTitle">
                            Update Photo Info
                            </h5>
                        <h5 class="modal-title" v-show="!editmode" id="addNewModalTitle">
                            Create New Photo
                            </h5>    
                        <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"> 
                                        <div class="form-group">
                                            <label>Category</label>  
                                                    <input type="text" list="photocategories" v-model="form.category" id="category"
                                                    name="category" class="form-control" :class="{ 'is-invalid': form.errors.has('category') }" />
                                                    <datalist id="photocategories">
                                                    <option value="">Select Category</option>
                                                    <option value="Meeting">Meeting</option>
                                                    <option value="Event">Event</option>
                                                    <option value="Politics">Politics</option>
                                                    <option value="Agenda">Agenda</option>
                                                    </datalist>
                                                    <div v-if="form.errors.has('category')" v-html="form.errors.get('category')" />
                                        </div> 

                            <div class="form-group">
                            <label>Description</label>  
                                    <input v-model="form.description" type="text"
                                    name="tagline" class="form-control">
                                    <div v-if="form.errors.has('description')" v-html="form.errors.get('description')" />
                            </div>                             

                            <div class="form-group">
                                <label for="photo">Feature Photo</label>
                                <div class="col-sm-12">
                                <input type="file" @change="uploadPhoto" name="photo" class="form-input">
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
    </div>
</template>

<script>
    export default {
        data(){
            return{
                editmode: false,
                photos: {},
                form: new Form({
                    id: '',
                    category : '',
                    description : '',
                    photo : '',
                }),
            }
        },
        methods: {
            getResults(page = 1) {
              this.$Progress.start();  
              axios.get('api/photo?page=' + page).then(({ data }) => (this.photos = data));
              this.$Progress.finish();
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
              updatePhoto(){
                  this.$Progress.start();
                  this.form.put('api/photo/'+this.form.id)
                  .then(() => {
                    $('#addNew').modal('hide')
                    this.$Progress.finish();
                    Swal.fire(
                    'Updated!',
                    'Photo has been updated.',
                    'success'
                    )
                    Fire.$emit('Refresh');
                  })
                  .catch(() => {
                    this.$Progress.fail();
                  })
              },
              createPhoto(){
                  this.$Progress.start();
                  this.form.post('api/photo')
                  .then(() => {
                  $('#addNew').modal('hide')
                  this.$Progress.finish();                                      
                  toast.fire({
                      icon: 'success',
                      title: 'Photo created successfully'
                      })
                  Fire.$emit('Refresh');      
                  })
                  .catch(() => {
                  this.$Progress.fail(); 
                  console.log('error'); 
                  })
              },             
              deletePhoto(id){
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
                  this.form.delete('api/photo/'+id).then(() => {
                  this.$Progress.finish();
                  Swal.fire(
                    'Deleted!',
                    'Photo has been deleted.',
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
              loadPhotos(){
                  axios.get('api/photo').then(({data}) => (this.photos = data));
              },                
        },
        mounted() {
            this.loadPhotos();
            Fire.$on('Refresh',() => {
            this.loadPhotos();
            })
        },
        filters: {
          truncate: function(text,length, suffix) {
            return text.substring(0,length) + suffix;
          }
        },
    }
</script>
