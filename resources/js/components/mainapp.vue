<template>
    <div>
       <div class="container">
           <div class="row">
               <div class="col"></div>
               <!-- Main View -->
               <div class="col-8">
                   <div class="card main-card">
                    <div class="card-body">
                        <h5 class="card-title lead">ToDo App</h5>
                        <div>
                            <div class="row myBtn">
                                <a href="#!" class="btn btn-sm btn-outline-primary float-right" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i></a>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item" v-for="(task, i) in data" :key="i" v-if="data.length">
                                    <div class="row">
                                        <div class="col-1">
                                            <!-- checkbox -->
                                            <div class="form-group form-check">
                                                <input v-if="task.checkRead == 0" type="checkbox" class="form-check-input"  >
                                                <input v-if="task.checkRead == 1" type="checkbox" class="form-check-input" checked >
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <!-- Task -->
                                            <span class="badge badge-light">{{task.date}}</span>
                                            <p class="lead">
                                               {{task.task}}
                                            </p>
                                        </div>
                                        <div class="col-1">
                                            <!-- Delete Button -->
                                            <a href="#!" class="btn btn-sm btn-outline-secondary" @click="editTask(task, i)"><i class="fa fa-spell-check"></i></a>
                                            <a href="#!" class="btn btn-sm btn-outline-danger" @click="deleteTask(task, i)">Delete</a>
                                        </div>
                                    </div>
                                    <span>
                                        
                                    </span>
                                </li>                               
                            </ul>
                        </div>
                    </div>
                    </div>
               </div>
               <!-- Main View Ends -->
               <div class="col"></div>
           </div>
       </div>

       <!-- =================Modals=======================  -->

        <!-- Modal -->
        <div class="modal fade" id="createModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Add New Task</label>
                        <input type="text" class="form-control" v-model="post.value">
                    </div>
                </form>
            <div class="container">
                <button type="button" class="btn btn-outline-success btn-sm float-right" @click="createNew">Create</button>
            </div>
            </div>
            </div>
        </div>
        </div>


       <!-- ===================Modals End=================== -->
    </div>
</template>
<script>
export default {
    data(){
        return{
            post:{
                value:'',
              
            },
              data:[],
        }
    },
    methods:{
        async fetchData(){         
           
                 const res = await this.callApi(
                    'get',
                    'app/get_tasks',
                    this.post
                ) 
                if (res.status == 200) {
                    this.data = res.data
                    this.toastFetchData
                } else {
                    this.toastError('Error')
                }
        },
        async createNew(){
          
            if (this.post.value.trim() == '') {
                this.toastError('Enter a task')
            } else {
                 const res = await this.callApi(
                    'post',
                    'app/post_task',
                    this.post
                ) 
                if (res.status == 200) {
                    this.post.value = '';
                    this.toast('Task Created Successfully', 'success')
                    this.fetchData()
                } else {
                    this.toastError('Error adding Task')
                }
            }
        }
        ,async editTask(task, i){
          
                 const res = await this.callApi(
                    'post',
                    'app/edit_task',
                    task
                ) 
                if (res.status == 200) {
                    this.toast('Task Updated Successfully', 'success')
                    this.fetchData()
                } else {
                    this.toastError('Error updating Task')
                }
        }
        ,
        async deleteTask(task , i){
             const res = await this.callApi(
                    'post',
                    'app/delete_task',
                    task
                ) 
                if (res.status == 200) {
                    this.toast('Task Deleted Successfully', 'success')
                    this.fetchData()
                } else {
                    this.toastError('Error deleting Task')
                }
        }
    },
    created(){
        this.fetchData()
    }
}
</script>
<style scoped>
.main-card{
    width: 100%;
    height: 80vh;
    top: 10vh;
    background: #00ce00;
}
.myBtn{
    margin: 4% auto;
}
</style>