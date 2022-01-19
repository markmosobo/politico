<template>
    <div class="container">
        <div class="row mt-3">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Slides</h3>

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
                      <th>Title</th>
                      <th>Tagline</th>
                      <th>Photo</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in slides.data" :key="item.id">
                      <td>{{item.id}}</td>
                      <td>{{item.title}}</td>
                      <td>{{item.tagline}}</td>
                      <td>{{item.photo}}</td>
                      <td>
                          <a href="#" @click = "editModal(item)">
                              <i class="fa fa-edit blue"></i>
                          </a>
                          <a href="#" @click = "previewModal(item.id)">
                              <i class="fa fa-upload green"></i>
                          </a>
                          <a href="#" @click = "deleteSlide(item.id)">
                              <i class="fa fa-trash red"></i>
                          </a>
                      </td> 
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <pagination :data="slides" @pagination-change-page="getResults">
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
                    <form @submit.prevent="editmode ? updateSlide() : createSlide()"> 
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="editmode" id="addNewModalTitle">
                            Update Slide Info
                            </h5>
                        <h5 class="modal-title" v-show="!editmode" id="addNewModalTitle">
                            Create New Slide
                            </h5>    
                        <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"> 
                            <div class="form-group">
                            <label>Title</label>  
                                    <input v-model="form.title" type="text"
                                    name="title" class="form-control">
                                    <div v-if="form.errors.has('title')" v-html="form.errors.get('title')" />
                            </div> 

                            <div class="form-group">
                            <label>Tagline</label>  
                                    <input v-model="form.tagline" type="text"
                                    name="tagline" class="form-control">
                                    <div v-if="form.errors.has('tagline')" v-html="form.errors.get('tagline')" />
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
                slides: {},
                form: new Form({
                    id: '',
                    title : '',
                    tagline : '',
                    photo : '',
                }),
            }
        },
        methods: {
            getResults(page = 1) {
              this.$Progress.start();  
              axios.get('api/slide?page=' + page).then(({ data }) => (this.slides = data));
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
              updateSlide(){
                  this.$Progress.start();
                  this.form.put('api/slide/'+this.form.id)
                  .then(() => {
                    $('#addNew').modal('hide')
                    this.$Progress.finish();
                    Swal.fire(
                    'Updated!',
                    'Slide has been updated.',
                    'success'
                    )
                    Fire.$emit('Refresh');
                  })
                  .catch(() => {
                    this.$Progress.fail();
                  })
              },
              createSlide(){
                  this.$Progress.start();
                  this.form.post('api/slide')
                  .then(() => {
                  $('#addNew').modal('hide')
                  this.$Progress.finish();                                      
                  toast.fire({
                      icon: 'success',
                      title: 'Slide created successfully'
                      })
                  Fire.$emit('Refresh');      
                  })
                  .catch(() => {
                  this.$Progress.fail(); 
                  console.log('error'); 
                  })
              },             
              deleteSlide(id){
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
                  this.form.delete('api/slide/'+id).then(() => {
                  this.$Progress.finish();
                  Swal.fire(
                    'Deleted!',
                    'Slide has been deleted.',
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
              loadSlides(){
                  axios.get('api/slide').then(({data}) => (this.slides = data));
              },                
        },
        mounted() {
            this.loadSlides();
            Fire.$on('Refresh',() => {
            this.loadSlides();
            })
        },
        filters: {
          truncate: function(text,length, suffix) {
            return text.substring(0,length) + suffix;
          }
        },
    }
</script>
