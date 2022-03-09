<template>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Todo </div>

                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" class="form-control" v-model="name">
                            <div class="input-group-append">
                                <button v-if="!update" class="btn btn-primary" v-on:click="saveTodo">
                                    Add
                                </button>
                                <button v-else class="btn btn-primary" v-on:click="updateTodo(editId)">
                                    Update
                                </button>
                            </div>
                            
                        </div>
                        <button class="btn btn-sm text-danger float-right" @click="resetTodo">
                                Reset
                            </button>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr. #</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(items,index) in todos" :key="index">
                                    <td>{{++index}}</td>
                                    <td>{{items.name}}</td>
                                    <td>
                                        <button class="btn btn-danger" @click="deleteTodo(items.id)">
                                            Delete
                                        </button>
                                         <button class="btn btn-info" @click="editTodo(--index)">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
       data(){
           return{
                todos: [],
                api: 'http://127.0.0.1:8000/api/todo',
                name: "",
                update: false,
                editId: ""
           }
       },
       mounted(){
          this.getTodo();
       },
       methods:{
           saveTodo(){
                this.axios.post(this.api,{'name':this.name}).then((response) => {
                    console.log(response);
                    this.getTodo();
                    this.name = "";
                });
           },
           getTodo(){
               console.log("get Data");
                this.axios.get(this.api).then((response) => {
                    this.todos = response.data;
                });
           },
           deleteTodo(id){
               console.log("kill Data");
                this.axios.delete(this.api+'/'+id).then((response) => {
                    this.getTodo();
                });
           },
           editTodo(index){
               console.log("edit Data");
               if(this.todos[index].id){
                   this.name = this.todos[index].name;
                   this.update = true;
                   this.editId = index;
               }
           },
            updateTodo(index){
               console.log("update Data");
               if(this.name.length > 0){
                  console.log("Get Update",this.todos[index].name)
                  this.axios.patch(this.api+"/"+this.todos[index].id,{'name':this.name}).then((response) => {
                    console.log(response);
                    this.getTodo();
                    this.name = "";
                });
               }
               else{
                   console.log("Empty");
               }
           },
           resetTodo(){
                this.name= "",
                this.update= false,
                this.editId= ""
           }
       }
    }
</script>
