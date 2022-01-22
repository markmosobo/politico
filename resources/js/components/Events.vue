<template>
<div class="container">
        <div class="row mt-3">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Events List</h3>

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
                      <th>Title</th>
                      <th>Date</th>
                      <th>Venue</th>
                      <th>Details</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr data-widget="expandable-table" aria-expanded="false"
                        v-for="item in events.data" :key="item.id">
                      <td>{{item.id}}</td>
                      <td>{{item.title | truncate(30,'...')}}</td>
                      <td>{{item.date}}</td>
                      <td>{{item.venue}}</td>
                      <td>{{item.details | truncate(30,'...')}}</td>                     
                      <td>
                          <a href="#" @click = "previewModal(item.id)">
                              <i class="fa fa-eye green"></i>
                          </a>                        
                          <a href="#" @click = "editModal(item)">
                              <i class="fa fa-edit blue"></i>
                          </a>
                          <a href="#" @click = "deleteEvent(item.id)">
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
                <pagination :data="events" @pagination-change-page="getResults">
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
                    <form @submit.prevent="editmode ? updateEvent() : createEvent()"> 
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="editmode" id="addNewModalTitle">
                            Update Event Info
                            </h5>
                        <h5 class="modal-title" v-show="!editmode" id="addNewModalTitle">
                            Add New Event
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
                            <label>Category</label>
                                    <select class="form-control" v-model="form.category_id">
                                      <option value="">Select Category</option>
                                      <option 
                                          v-for="item in categories" :key="item.id"
                                          :value="item.id"
                                          :selected="item.id == form.category_id">{{ item.name }}</option>
                                    </select>
                                    <div v-if="form.errors.has('category_id')" v-html="form.errors.get('category_id')" />
                            </div>

                            <div class="form-group">
                            <label>Date</label>  
                                    <input v-model="form.date" type="date"
                                    name="date" class="form-control">
                                    <div v-if="form.errors.has('date')" v-html="form.errors.get('date')" />
                            </div>

                            <div class="form-group">
                            <label>Start Time</label>  
                                    <input v-model="form.start_time" type="time"
                                    name="start_time" class="form-control">
                                    <div v-if="form.errors.has('start_time')" v-html="form.errors.get('start_time')" />
                            </div>

                            <div class="form-group">
                            <label>End Time</label>  
                                    <input v-model="form.end_time" type="time"
                                    name="end_time" class="form-control">
                                    <div v-if="form.errors.has('end_time')" v-html="form.errors.get('end_time')" />
                            </div>   

                            <div class="form-group">
                            <label>Venue</label>  
                                    <input v-model="form.venue" type="text"
                                    name="venue" class="form-control">
                                    <div v-if="form.errors.has('venue')" v-html="form.errors.get('venue')" />
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

        <!--preview modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="addNewModalTitle">
                            Event Preview
                        </h3>   
                        <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <table class="table table-hover">
                        <tbody>
                        <tr v-for="event in eventpreview" :key="event.id">
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                            <li class="item">                                
                                <div class="product-info">
                                <a href="javascript:void(0)" class="product-title float-right">
                                    {{event.title}}</a>
                                </div>
                            </li>
                            <li class="item">
                                <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Date
                                    <span class="badge badge-warning float-right">Ksh500</span></a>
                                </div>
                            </li>
                            <li class="item">
                                <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Venue
                                    <span class="badge badge-info float-right">Ksh700</span></a>
                                </div>
                            </li>
                            <li class="item">
                                <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">
                                    Duration <span class="badge badge-danger float-right">
                                    Ksh350
                                </span>
                                </a>
                                </div>
                            </li>
                            <li class="item">
                                <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Category
                                    <span class="badge badge-success float-right">6</span></a>
                                </div>
                            </li>
                            <li class="item">
                                <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Details
                                    <span class="badge badge-info float-right">Ksh7000</span></a>
                                </div>
                            </li>                            
                            </ul>
                        </div>
                        <!-- /.card-body -->
                        </tr>
                        </tbody>
                      </table> 
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
                </div>
            </div>         
        <!--end of preview modal -->        
</div>
</template>

<script>
    export default {
        data(){
            return{
                editmode: false,
                events: {},
                eventpreview: {},
                form: new Form({
                    id: '',
                    category: '',
                    title : '',
                    details : '',
                    photo : '',
                    date : '',
                    start_time: '',
                    end_time: '',
                    venue: '',
                    details: '',
                    category_id: '',
                }),
                categories: {},                   
            }
        },
        methods: {
            getResults(page = 1) {
              this.$Progress.start();  
              axios.get('api/event?page=' + page).then(({ data }) => (this.events = data));
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
                  axios.get('api/event/'+id).then(({data}) =>
                   {this.eventpreview = data});

                   $('#myModal').modal('show')
              },              
              updateEvent(){
                  this.$Progress.start();
                  this.form.put('api/event/'+this.form.id)
                  .then(() => {
                    $('#addNew').modal('hide')
                    this.$Progress.finish();
                    Swal.fire(
                    'Updated!',
                    'Event has been updated.',
                    'success'
                    )
                    Fire.$emit('Refresh');
                  })
                  .catch(() => {
                    this.$Progress.fail();
                  })
              },
              createEvent(){
                  this.$Progress.start();
                  this.form.post('api/event')
                  .then(() => {
                  $('#addNew').modal('hide')
                  this.$Progress.finish();                                      
                  toast.fire({
                      icon: 'success',
                      title: 'Event created successfully'
                      })
                  Fire.$emit('Refresh');      
                  })
                  .catch(() => {
                  this.$Progress.fail(); 
                  console.log('error'); 
                  })
              },             
              deleteEvent(id){
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
                  this.form.delete('api/event/'+id).then(() => {
                  this.$Progress.finish();
                  Swal.fire(
                    'Deleted!',
                    'Event has been deleted.',
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
              loadEvents(){
                  axios.get('api/event').then(({data}) => (this.events = data));
              },
              loadCategories(){
                  axios.get('api/categories').then((response) => {
                  this.categories = response.data.data;  
                  });                  
              },                
        },
        mounted() {
            this.loadEvents();
            this.loadCategories();
            Fire.$on('Refresh',() => {
            this.loadEvents();
            })
        },
        filters: {
          truncate: function(text,length, suffix) {
            return text.substring(0,length) + suffix;
          }
        },
    }
</script>
