<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Todo-List</div>

                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" placeholder="Todo.." class="form-control" aria-label="todo"
                                aria-describedby="Adicionar nova tarefa..." v-model="todo_input">
                            <div class="input-group-append">
                                <button title="Adicionar tarefa" v-if="!edit_todo_id" type="button"
                                    class="btn btn-info text-white" @click="saveTodo()"><i class="fas fa-plus"></i></button>
                                <button v-else type="button" class="btn btn-info text-white"
                                    @click="updateTodo()">Atualizar</button>
                            </div>
                        </div>
                        <textarea class="form-control mt-3" placeholder="Descrição da Tarefa.." rows="2"
                            v-model="todo_description"></textarea>
                        <button type="button" class="btn btn-sm text-danger float-right"
                            @click="resetTodo()">Resetar</button>

                        <table class="table table-bordered mt-4">
                            <thead>
                                <th>N°Tarefa</th>
                                <th>Nome</th>
                                <th>Ação</th>
                            </thead>
                            <tbody>
                                <tr v-for="(todo, index) in todos" :key="index">
                                    <td>{{ ++index }}</td>
                                    <td>{{ todo.name }}</td>
                                    <td>
                                        <button title="Deletar Tarefa" type="button" class="btn btn-sm btn-danger"
                                            @click="deleteTodo(--index)"><i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                        <button title="Editar Tarefa" type="button" class="btn btn-sm btn-info"
                                            @click="editTodo(--index)"><i class="fas fa-edit"
                                                style="color: white;"></i></button>
                                        <button title="Visualizar Descrição" type="button" class="btn btn-warning"
                                            @click="abrirSwal(todo.description)">
                                            <i class="fa fa-window-restore" style="color: white;"></i>
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
import Swal from 'sweetalert2';
export default {
    data() {
        return {
            todos: [],
            api: 'http://localhost:8000/api/todos',
            todo_input: '',
            edit_todo_id: '',
            edit_index: '',
            todo_description: '',
        }
    },
    mounted() {
        //get api data
        this.axios.get(this.api).then(res => {
            this.todos = res.data;
        });
    },
    methods: {
        saveTodo() {
            if (this.todo_input.length > 0) {
                let data = { 'name': this.todo_input, 'description': this.todo_description };
                this.axios.post(this.api, data).then(res => {
                    this.todos.push(res.data);
                    this.todo_input = '';
                    this.todo_description = '';
                })
            }
        },
        abrirSwal(descricao) {
            Swal.fire({
                title: 'Descrição da Tarefa',
                text: descricao,
                icon: 'info',
                confirmButtonText: 'Fechar',
            });
        },
        deleteTodo(index) {
            Swal.fire({
                title: 'Tem certeza?',
                text: 'Você está prestes a deletar este item.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!',
                heightAuto: false,
                customClass: {
                    content: 'custom-swal2-content',
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    if (this.todos[index].id) {
                        this.axios.delete(this.api + '/' + this.todos[index].id).then(res => {
                            this.todos.splice(index, 1);
                            Swal.fire({
                                title: 'Sucesso!',
                                text: 'Item excluído com sucesso!',
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                            });
                        })
                    }
                }
            })

        },
        editTodo(index) {
            if (this.todos[index].id) {
                this.todo_input = this.todos[index].name;
                this.todo_description = this.todos[index].description;
                this.edit_todo_id = this.todos[index].id;
                this.edit_index = index;
            }
        },
        updateTodo() {
            console.log('aqui2', this.todos[this.edit_index].id);
            if (this.todo_input.length >= 0) {

                let data = { 'name': this.todo_input, 'description': this.todo_description };
                this.axios.patch(this.api + '/' + this.todos[this.edit_index].id, data).then(res => {
                    this.todos[this.edit_index].name = res.data.name;
                    this.todos[this.edit_index].description = res.data.description;
                    this.resetTodo();
                })
            }

        },
        resetTodo() {
            this.todo_input = "";
            this.todo_description = "";
            this.edit_index = "";
            this.edit_todo_id = "";
        }
    }
}
</script>
