<template>
<div class="container">
        <div class="row mt-3">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">News List</h3>

                <div class="card-tools">
                       <button type="button" class="btn btn-primary"
                        @click = "newModal">Add New <i class="fas fa-clipboard"></i></button>   
                </div>
              </div>
              <!-- ./card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Headline</th>
                      <th>Details</th>
                      <th>Photo</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr data-widget="expandable-table" aria-expanded="false"
                        v-for="item in news.data" :key="item.id">
                      <td>{{item.id}}</td>
                      <td>{{item.headline | truncate(30,'...')}}</td>
                      <td>{{item.details | truncate(30,'...')}}</td>  
                      <td>{{item.photo}}</td>
                      <td>
                          <a href="#" @click = "previewModal(item.id)">
                              <i class="fa fa-eye green"></i>
                          </a>                        
                          <a href="#" @click = "editModal(item)">
                              <i class="fa fa-edit blue"></i>
                          </a>
                          <a href="#" @click = "deleteNews(item.id)">
                              <i class="fa fa-trash red"></i>
                          </a>
                      </td>
                    </tr>
                    <tr class="expandable-body d-none">
                       <td colspan="5">
                         <p style="display: none;">
                             Info
                         </p>
                       </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <pagination :data="news" @pagination-change-page="getResults">
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
                    <form @submit.prevent="editmode ? updateNews() : createNews()"> 
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="editmode" id="addNewModalTitle">
                            Update News Info
                            </h5>
                        <h5 class="modal-title" v-show="!editmode" id="addNewModalTitle">
                            Create News
                            </h5>    
                        <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"> 
                            <div class="form-group">
                            <label>Headline</label>  
                                    <input v-model="form.headline" type="text"
                                    name="headline" class="form-control">
                                    <div v-if="form.errors.has('headline')" v-html="form.errors.get('headline')" />
                            </div> 

                            <div class="form-group">
                                <label for="photo">Feature Photo</label>
                                <div class="col-sm-12">
                                <input type="file" @change="uploadPhoto" name="photo" class="form-input">
                                </div>  
                            </div>

                            <div class="form-group">
                            <label>Details</label>  
                                    <textarea v-model="form.details" id="details"
                                    name="details" class="form-control">
                                    </textarea>
                                    <div v-if="form.errors.has('details')" v-html="form.errors.get('details')" />
                            </div>

                            <div class="form-group">
                            <label>Links(optional)</label>  
                                    <input v-model="form.slug" type="text"
                                    name="slug" class="form-control" placeholder="Links to external sources e.g youtube">
                                    <div v-if="form.errors.has('slug')" v-html="form.errors.get('slug')" />
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
                news: {},
                form: new Form({
                    id: '',
                    headline : '',
                    details : '',
                    photo : '',
                    slug: ''
                }),
            }
        },
        methods: {
            getResults(page = 1) {
              this.$Progress.start();  
              axios.get('api/news?page=' + page).then(({ data }) => (this.news = data));
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
              editModal(event){
                  this.editmode = true,
                  this.form.reset();
                  $('#addNew').modal('show')
                  this.form.fill(event);  
              },
              previewModal(id){

              },              
              updateNews(){
                  this.$Progress.start();
                  this.form.put('api/news/'+this.form.id)
                  .then(() => {
                    $('#addNew').modal('hide')
                    this.$Progress.finish();
                    Swal.fire(
                    'Updated!',
                    'News has been updated.',
                    'success'
                    )
                    Fire.$emit('Refresh');
                  })
                  .catch(() => {
                    this.$Progress.fail();
                  })
              },
              createNews(){
                  this.$Progress.start();
                  this.form.post('api/news')
                  .then(() => {
                  $('#addNew').modal('hide')
                  this.$Progress.finish();                                      
                  toast.fire({
                      icon: 'success',
                      title: 'News created successfully'
                      })
                  Fire.$emit('Refresh');      
                  })
                  .catch(() => {
                  this.$Progress.fail(); 
                  console.log('error'); 
                  })
              },             
              deleteNews(id){
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
                  this.form.delete('api/news/'+id).then(() => {
                  this.$Progress.finish();
                  Swal.fire(
                    'Deleted!',
                    'News has been deleted.',
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
              loadNews(){
                  axios.get('api/news').then(({data}) => (this.news = data));
              },                
        },
        mounted() {
            this.loadNews();
            Fire.$on('Refresh',() => {
            this.loadNews();
            })
        },
        filters: {
          truncate: function(text,length, suffix) {
            return text.substring(0,length) + suffix;
          }
        },
    }
</script>
