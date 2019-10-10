<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>
                    <div class="card-body">
                        <form @submit.prevent="createUser">
                            <div class="form-group">
                        <input v-model="form.username" type="text" name="username"
        class="form-control" :class="{ 'is-invalid': form.errors.has('username') }">
      <has-error :form="form" field="username"></has-error>
                            </div>
                            <div class="form-group">
                    <input v-model="form.password" type="password" name="password"
        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
      <has-error :form="form" field="password"></has-error>
                  </div>
                  <input type="submit" class="btn btn-primary" value="submit">
                  </form>
                  <br>
                  <br>
                  <table class="table table-borderless table-dark">
  <thead>
    <tr>
      <th scope="col">SR</th>
      <th scope="col">User Name</th>
      <th scope="col">Password</th>
      <th scope="col">Modify</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="user in users" :key="user.id">
      <td>{{user.id}}</td>
      <td>{{user.username}}</td>
      <td>{{user.password}}</td>
      <td><a href="#" @click="editmodal(user)"><i class="fas fa-edit"></i></a>/ <a href="#" @click="deleteuser(user.id)"><i class="fas fa-trash-alt"></i></a></td>
    </tr>
  </tbody>
                  </table>
                        </div>
                </div>     
                    </div>
                </div>
   <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form @submit.prevent="updateuser">
                            <div class="form-group">
                        <input v-model="form.username" type="text" name="username"
        class="form-control" :class="{ 'is-invalid': form.errors.has('username') }">
      <has-error :form="form" field="username"></has-error>
                            </div>
                            <div class="form-group">
                    <input v-model="form.password" type="password" name="password"
        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
      <has-error :form="form" field="password"></has-error>
                  </div>
                  <input type="submit" class="btn btn-primary" value="submit">
                  </form>
      </div>
    </div>
  </div>
</div>
            </div>
            
</template>

<script>
    export default {
            data () {
    return {
        users : [],
      // Create a new form instance
      form: new Form({
        id:'',
        username: '',
        password: ''
      })
    }
    },
     methods: {
       updateuser(){
         this.form.put('api/user/'+this.form.id)
         .then(()=>{
           Swal.fire(
      'Updated!',
      'Your file has been Updated.',
      'success'
    );
    $('#edit').modal('hide');
    Fire.$emit('aftercreated');
         }).catch(()=>{

         });
       },
       editmodal(user){
         $('#edit').modal('show');
         this.form.fill(user);
       },
       deleteuser(id){
         Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  this.form.delete('api/user/'+id).then(()=>{
     Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    );
    Fire.$emit('aftercreated');
  }).catch(()=>{
    Swal("Failed","There was something wrong.","Warning")
  });
})
       },
             loaduser(){
                 axios.get("api/user").then(({data}) => (this.users = data));
             },
    createUser () {
      // Submit the form via a POST request
      this.form.post('api/user')
      .then(() => {
          Toast.fire({
                type: 'success',
                title: 'User created successfully'
        });

        Fire.$emit('aftercreated');
      })
      .catch(() => {
          
      });

    

    }
  },
        created() {
            this.loaduser();
            Fire.$on('aftercreated',() => {
                this.loaduser();
            });
        }
    }
</script>
