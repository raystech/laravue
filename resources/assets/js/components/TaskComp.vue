<template>
    <div class='row'>
        <div class="col-lg-12">
          <h1>My Tasks</h1>
          <h4>New Task</h4>
        </div>
        <div class="col-lg-12">
          <form action="#" @submit.prevent="createTask()">
              <div class="input-group">
                  <input v-model="task.name" type="text" name="name" class="form-control" autofocus>
                  <span class="input-group-btn">
                      <button type="submit" class="btn btn-primary">New Task</button>
                  </span>
              </div>
          </form>
        </div>
        
        <div class="col-lg-12">
          <h4>All Tasks</h4>
          <ul class="list-group">
              <li v-if='list.length === 0'>There are no tasks yet!</li>
              <li class="list-group-item" v-for="(task, index) in list">
                   {{ task.procedure_name }}
                   <button @click="deleteTask(task.id)" class="btn btn-danger btn-xs pull-right">Delete</button>
              </li>
          </ul>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                list: [],
                task: {
                    id: '',
                    name: ''
                }
            };
        },
        
        created() {
            this.fetchTaskList();
        },
        
        methods: {
            fetchTaskList() {
                axios.get('api/procedures').then((res) => {
                    this.list = res.data;
                });
            },
 
            createTask() {
                axios.post('api/procedures', this.task)
                    .then((res) => {
                        this.task.name = '';
                        this.edit = false;
                        this.fetchTaskList();
                    })
                    .catch((err) => console.error(err));
            },
 
            deleteTask(id) {
                axios.delete('api/procedures/' + id)
                    .then((res) => {
                        this.fetchTaskList()
                    })
                    .catch((err) => console.error(err));
            },
        }
    }
</script>
</script>