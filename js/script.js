const { createApp } = Vue;

createApp({

    data() {
        return {
            todos: [],

            newTodo: '',
        }
    },

    methods: {
        getTodos() {
            // faccio richiesta axios
            axios.get('./server.php').then(response => {

                this.todos = response.data;

            });
        },

        addTodo() {

            let data = {
                newTodo: "",
            }
            data.newTodo = this.newTodo;


            // richiesta API al server per il nuovo Todo
            axios.post('./server.php', data, { headers: { 'Content-Type': 'multipart/form-data' } }).then(response => {

                // ricarico i todo
                this.getTodos();
            });


            this.newTodo = "";
        },

        toggleTodo(todoIndex) {

            let data = {
                toggleTodoIndex: 0,
            }
            data.toggleTodoIndex = todoIndex;

            axios.post('./server.php', data, { headers: { 'Content-Type': 'multipart/form-data' } }).then(response => {

                this.getTodos();
            });


        },


        deleteTodo(todoIndex) {

            let data = {
                deleteTodoIndex: 0
            }
            data.deleteTodoIndex = todoIndex;

            axios.post('./server.php', data, { headers: { 'Content-Type': 'multipart/form-data' } }).then(response => {
                console.log('indice da cancellare: ', response.data);

                this.getTodos();
            });

        }
    },

    mounted() {
        this.getTodos();
    },

}).mount('#app');