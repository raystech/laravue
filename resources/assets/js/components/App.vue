<template>
  <div id="app">
    <div class="heading">
      <h1>Cruds</h1>
    </div>
    <crud-component
      v-for="crud in cruds"
      v-bind="crud"
      :key="crud.id"
      @update="update"
      @delete="del"
    ></crud-component>
    <div>
      <button @click="create()">Add</button>
    </div>
  </div>
</template>

<script>
  function Crud({ id, procedure_name, name}) {
    this.id = id;
    this.procedure_name = procedure_name;
    this.name = name;
  }

  import ProcedureComp from './components/ProcedureComp.vue';

  export default {
    data() {
      return {
        cruds: [],
        mute: false
      }
    },
    methods: {
      create() {
        window.axios.get('/api/cruds/create').then(({ data }) => {
          this.cruds.push(new Crud(data));
        });
      },
      read() {
        window.axios.get('/api/procedures').then(({ data }) => {
            console.log(data);
            data.forEach(crud => {
              this.cruds.push(new Crud(crud));
            });
          });
      },
      update(id, procedure_name) {
        window.axios.put(`/api/cruds/${id}`, { procedure_name }).then(() => {
          // Once AJAX resolves we can update the Crud with the new procedure_name
          this.cruds.find(crud => crud.id === id).procedure_name = procedure_name;
          this.mute = false;
        });
      },
      del(id) {
        window.axios.delete(`/api/cruds/${id}`).then(() => {
          let index = this.cruds.findIndex(crud => crud.id === id);
          this.cruds.splice(index, 1);
        });
      },
    },
    watch: {
      mute(val) {
        document.getElementById('mute').className = val ? "on" : "";
      }
    },
    components: {
      ProcedureComp
    }
  }
</script>