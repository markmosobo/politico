<template>
    <div class="container">
        <div class="row mt-3">
          <div class="col-12">
            <div class="card collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Why I'm Running</h3>


                <div class="card-tools">
                       <button type="button" class="btn btn-primary"
                        @click = "pledgeModal">Make Pledge <i class="fas fa-clipboard"></i></button>  
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
                      <th>Pledge</th>
                      <th>Details</th>
                      <th>Photo</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in pledge.data" :key="item.id">
                      <td>{{item.pledge | truncate(30,'...')}}</td>
                      <td>{{item.details | truncate(30,'...')}}</td>
                      <td>{{item.photo}}</td>
                      <td>
                          <a href="#" @click = "editpledgeModal(item)">
                              <i class="fa fa-edit blue"></i>
                          </a>
                          <a href="#" @click = "previewpledgeModal(item.id)">
                              <i class="fa fa-eye green"></i>
                          </a>
                          <a href="#" @click = "deletePledge(item.id)">
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

        <div class="row mt-3">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Issues</h3>

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
                      <th>Issue</th>
                      <th>Details</th>
                      <th>Photo</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in issues.data" :key="item.id">
                      <td>{{item.id}}</td>
                      <td>{{item.name | truncate(30,'...')}}</td>
                      <td>{{item.details | truncate(30,'...')}}</td>
                      <td>{{item.photo}}</td>
                      <td>
                          <a href="#" @click = "editModal(item)">
                              <i class="fa fa-edit blue"></i>
                          </a>
                          <a href="#" @click = "previewModal(item.id)">
                              <i class="fa fa-upload green"></i>
                          </a>
                          <a href="#" @click = "deleteIssue(item.id)">
                              <i class="fa fa-trash red"></i>
                          </a>
                      </td> 
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <pagination :data="issues" @pagination-change-page="getResults">
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
                    <form @submit.prevent="editmode ? updateIssue() : createIssue()"> 
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="editmode" id="addNewModalTitle">
                            Update Issue Info
                            </h5>
                        <h5 class="modal-title" v-show="!editmode" id="addNewModalTitle">
                            Create New Issue
                            </h5>    
                        <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"> 
                            <div class="form-group">
                            <label>Name</label>  
                                    <input v-model="form.name" type="text"
                                    name="name" class="form-control">
                                    <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                            </div> 

                            <div class="form-group">
                            <label>Details</label>  
                                    <textarea v-model="form.details" id="details"
                                    name="details" class="form-control">
                                    </textarea>
                                    <div v-if="form.errors.has('details')" v-html="form.errors.get('details')" />
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

        <!-- Pledge Modal -->
           <div class="modal fade" id="pledgeNew" tabindex="-1" role="dialog"
            aria-labelledby="addNewModal" aria-hidden="true">
            <div class="modal-dialog model-dialog-centered" role="document">
                <div class="modal-content">
                    <form @submit.prevent="editmode ? updatePledge() : createPledge()"> 
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="editmode" id="addNewModalTitle">
                            Update Pledge Info
                            </h5>
                        <h5 class="modal-title" v-show="!editmode" id="addNewModalTitle">
                            Create New Pledge
                            </h5>    
                        <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"> 
                            <div class="form-group">
                            <label>Pledge</label>  
                                    <input v-model="form.pledge" type="text"
                                    name="pledge" class="form-control">
                                    <div v-if="form.errors.has('pledge')" v-html="form.errors.get('pledge')" />
                            </div> 

                            <div class="form-group">
                            <label>Details</label>  
                                    <textarea v-model="form.details" id="details"
                                    name="details" class="form-control">
                                    </textarea>
                                    <div v-if="form.errors.has('details')" v-html="form.errors.get('details')" />
                            </div>                            

                            <div class="form-group">
                                <label for="photo">Feature Photo</label>
                                <div class="col-sm-12">
                                <input type="file" @change="uploadPhoto" name="photo" class="form-input">
                                </div>  
                            </div>

                            <div class="form-group">
                            <label>Links(optional)</label>  
                                    <input v-model="form.slug" type="text"
                                    name="slug" class="form-control">
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
        <!-- end of pledge modal -->               
    </div>
</template>

<script>
    export default {
        data(){
            return{
                editmode: false,
                issues: {},
                pledge: {},
                form: new Form({
                    id: '',
                    name : '',
                    details : '',
                    photo : '',
                    pledge: '',
                    slug: ''
                }),
            }
        },
        methods: {
            getResults(page = 1) {
              this.$Progress.start();  
              axios.get('api/issue?page=' + page).then(({ data }) => (this.issues = data));
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
              updateIssue(){
                  this.$Progress.start();
                  this.form.put('api/issue/'+this.form.id)
                  .then(() => {
                    $('#addNew').modal('hide')
                    this.$Progress.finish();
                    Swal.fire(
                    'Updated!',
                    'Issue has been updated.',
                    'success'
                    )
                    Fire.$emit('Refresh');
                  })
                  .catch(() => {
                    this.$Progress.fail();
                  })
              },
              createIssue(){
                  this.$Progress.start();
                  this.form.post('api/issue')
                  .then(() => {
                  $('#addNew').modal('hide')
                  this.$Progress.finish();                                      
                  toast.fire({
                      icon: 'success',
                      title: 'Issue created successfully'
                      })
                  Fire.$emit('Refresh');      
                  })
                  .catch(() => {
                  this.$Progress.fail(); 
                  console.log('error'); 
                  })
              },             
              deleteIssue(id){
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
                  this.form.delete('api/issue/'+id).then(() => {
                  this.$Progress.finish();
                  Swal.fire(
                    'Deleted!',
                    'Issue has been deleted.',
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

              //pledge
              pledgeModal(){
                  this.editmode = false,
                  this.form.reset();
                  $('#pledgeNew').modal('show')  
              },
              editpledgeModal(item){
                  this.editmode = true,
                  this.form.reset();
                  $('#pledgeNew').modal('show')
                  this.form.fill(item);  
              },
              previewpledgeModal(id){

              },              
              updatePledge(){
                  this.$Progress.start();
                  this.form.put('api/pledge/'+this.form.id)
                  .then(() => {
                    $('#pledgeNew').modal('hide')
                    this.$Progress.finish();
                    Swal.fire(
                    'Updated!',
                    'Pledge has been updated.',
                    'success'
                    )
                    Fire.$emit('RefreshPledge');
                  })
                  .catch(() => {
                    this.$Progress.fail();
                  })
              },
              createPledge(){
                  this.$Progress.start();
                  this.form.post('api/pledge')
                  .then(() => {
                  $('#pledgeNew').modal('hide')
                  this.$Progress.finish();                                      
                  toast.fire({
                      icon: 'success',
                      title: 'Pledge created successfully'
                      })
                  Fire.$emit('RefreshPledge');      
                  })
                  .catch(() => {
                  this.$Progress.fail(); 
                  console.log('error'); 
                  })
              },             
              deletePledge(id){
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
                  this.form.delete('api/pledge/'+id).then(() => {
                  this.$Progress.finish();
                  Swal.fire(
                    'Deleted!',
                    'Pledge has been deleted.',
                    'success'
                  )
                  Fire.$emit('RefreshPledge');
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
              
              //loaders
              loadIssues(){
                  axios.get('api/issue').then(({data}) => (this.issues = data));
              }, 
              loadPledge(){
                  axios.get('api/pledge').then(({data}) => (this.pledge = data));
              },                              
        },
        mounted() {
            this.loadIssues();
            this.loadPledge();
            Fire.$on('Refresh',() => {
            this.loadIssues();
            });
            Fire.$on('RefreshPledge',() => {
            this.loadPledge();
            })            
        },
        filters: {
          truncate: function(text,length, suffix) {
            return text.substring(0,length) + suffix;
          }
        },
    }
</script>
