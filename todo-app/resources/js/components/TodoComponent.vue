<template>
    <div class="main">
        <div class="head">
            <div class="form">
                <!-- Form for creating or editing todos -->
                <form @submit.prevent="createOrEditTodo" class="mb-5 mt-5">
                    <div class="form-floating mb-3 mb-md-0 d-flex justify-between">
                        <input class="form-control w-100" id="inputCategoryName" type="text"
                            placeholder="Enter your name" v-model="title" />
                        <label for="inputName">{{ todoBeingEdited ? 'Edit your todo' : 'Enter your todo' }}</label>
                        <button class="btn btn-sm btn-primary mx-2">
                            {{ todoBeingEdited ? 'Update Todo' : 'Add Todo' }}
                        </button>
                    </div>
                </form>

                <!-- Display Incomplete and Complete Todos -->
                <div class="container com_incom d-flex justify-content-between">
                    <div class="incomplete w-50">
                        <h4>Incomplete Todo</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Sn</th>
                                    <th scope="col">Todo Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(todo, index) in incompleteTodos" :key="todo.id">
                                    <th scope="row">{{ index + 1 }}</th>
                                    <td>{{ todo.title }}</td>
                                    <td>
                                        <button class="btn btn-link text-primary" @click="editTodo(todo)">
                                            <i class="fas fa-edit"></i> <!-- Font Awesome edit icon -->
                                        </button>
                                        <button class="btn btn-link text-success" @click="markAsComplete(todo.id)">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="Complete w-50 ms-3">
                        <h4>Complete Todo</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Sn</th>
                                    <th scope="col">Todo Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(todo, index) in completetodos" :key="todo.id">
                                    <th scope="row">{{ index + 1 }}</th>
                                    <td>{{ todo.title }}</td>
                                    <td>
                                        <button class="btn btn-link text-danger" @click="deleteTodo(todo.id)">
                                            <i class="fas fa-trash"></i> <!-- Font Awesome delete icon -->
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
import axios from 'axios';
export default {
    data() {
        return {
            id: '', 
            title: '', 
            completetodos: [],
            incompleteTodos: [],
            todoBeingEdited: null
        };
    },
    methods: {
        createOrEditTodo() {
            if (this.todoBeingEdited) {
                axios.put(`/api/todos/${this.id}`, { title: this.title })
                    .then((res) => {
                        this.resetForm();
                        this.fetchCompleteTodo();
                        this.fetchInCompleteTodo();
                        Toast.fire({
                            icon: 'success',
                            title: 'Todo updated successfully!'
                        });
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            } else {
                axios.post('/api/todos', { title: this.title })
                    .then((res) => {
                        this.resetForm();
                        this.fetchCompleteTodo();
                        this.fetchInCompleteTodo();
                        Toast.fire({
                            icon: 'success',
                            title: 'New Todo added successfully!'
                        });
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            }
        },
        editTodo(todo) {
            this.todoBeingEdited = todo;
            this.title = todo.title;
            this.id = todo.id;
        },
        resetForm() {
            this.title = '';
            this.todoBeingEdited = null;
            this.id = '';
        },
        fetchCompleteTodo() {
            axios.get('/api/todos/complete')
                .then((res) => {
                    this.completetodos = res.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        fetchInCompleteTodo() {
            axios.get('/api/todos/incomplete')
                .then((res) => {
                    this.incompleteTodos = res.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        markAsComplete(id) {
            axios.put('/api/todos/status/' + id)
                .then((res) => {
                    console.log(res)
                    this.fetchCompleteTodo();
                    this.fetchInCompleteTodo();
                    Toast.fire({
                        icon: 'success',
                        title: 'Todo marked as complete!'
                    });
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        deleteTodo(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/api/todos/${id}`)
                        .then((res) => {
                            this.fetchCompleteTodo();
                            this.fetchInCompleteTodo();
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                        })
                        .catch((error) => {
                            console.error(error);
                        });

                }
            });
        }
    },
    created() {
        this.fetchCompleteTodo();
        this.fetchInCompleteTodo();
    }
};
</script>

<style scoped>
.main {
    background-color: powderblue;
    width: 100%;
    height: 100vh;
    position: relative;
}

.head {
    max-width: 60%;
    max-height: 42rem;
    background-color: white;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    margin: auto;
    position: absolute;
    border-radius: 10px;
}

.form {
    width: 90%;
    height: 5rem;
    background-color: white;
    margin: 30px auto;
    border-radius: 6px;
    position: relative;
}

.uu {
    position: absolute;
}
</style>
