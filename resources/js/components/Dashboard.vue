<template>
    <div class="container">
        <div class="row mt-3">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number">
                  10
                  <small>%</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Events</span>
                <span class="info-box-number">41,410</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">News</span>
                <span class="info-box-number">760</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">MPESA Contributions</span>
                <span class="info-box-number">Ksh. 2,000</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>

    <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Latest Events</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>EventID</th>
                      <th>Title</th>
                      <th>Venue</th>
                      <th>Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in events.data" :key="item.id">
                      <td><a href="#">{{item.category}}</a></td>
                      <td>{{item.title | truncate(30,'...')}}</td>
                      <td><span class="badge badge-success">{{item.venue}}</span></td>
                      <td>{{item.details | truncate(30,'...')}}</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="javascript:void(0)" @click = "newModal" class="btn btn-sm btn-info float-left">Create New Event</a>
                <a href="/event" class="btn btn-sm btn-secondary float-right">View All Events</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-tag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Inventory</span>
                <span class="info-box-number">5,200</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon"><i class="far fa-heart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Mentions</span>
                <span class="info-box-number">92,050</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-danger">
              <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Downloads</span>
                <span class="info-box-number">114,381</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="far fa-comment"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Direct Messages</span>
                <span class="info-box-number">163,921</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
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
                                    <select v-model="form.category" id="category"
                                    name="category" class="form-control">
                                    <option value="">Select Category</option>
                                    <option value="Rally">Rally</option>
                                    <option value="Meeting">Meeting</option>
                                    <option value="AGM">AGM</option>
                                    </select>
                                    <div v-if="form.errors.has('category')" v-html="form.errors.get('category')" />
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
    </div>
</template>

<script>
    export default {
      data() {
        return {
          editmode :false,
          events: {},
          categories:{}, 
          form: new Form({
            id: '',
            title: '',
            category: '',
            details: '',
            photo: '',
            start_time: '',
            end_time: '',
            venue:'',
            category_id: ''
          })                 
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
