<template>
    <v-app class="todo-list__wrapper">
        <div class="todo-list-header">
            <h1
                class="todo-list-header__title display-3 font-weight-thin text-uppercase text-center"
            >
                What Todo?
            </h1>
            <v-text-field
                v-model="taskName"
                label="Что надо сделать?"
                class="todo-list-header__input"
                @keyup.enter="addNewTask"
            />
        </div>
        <div class="todo-list-filter__wrapper">
            <v-tabs background-color="primary" dark class="mb-4" v-model="tab" :centered="true">
                <v-tab v-for="item in filteredTodos" :key="item.tab">
                    {{ item.tab }}
                </v-tab>
            </v-tabs>
            <v-tabs-items v-model="tab">
                <v-tab-item v-for="item in filteredTodos" :key="item.tab">
                    <v-card
                        flat
                        outlined
                        centered
                        class="mx-auto mb-1 px-5"
                        max-width="600px"
                        v-for="todo in item.content"
                        :key="todo.id"
                    >
                        <TodoItem
                            :todo="todo"
                            @handleCheckTodo="handleCheckTodo(todo)"
                            @handleRemoveTodo="handleRemoveTodo(todo)"
                        />
                    </v-card>
                </v-tab-item>
            </v-tabs-items>
        </div>
    </v-app>
</template>

<script>
import axios from 'axios';
import TodoItem from '../components/todoItem';

const generate = require('nanoid/generate');

export default {
    name: 'App',
    components: {
        TodoItem,
    },
    data() {
        return {
            tabCurrent: null,
            taskName: '',
            todos: [],
            tab: null,
        };
    },
    computed: {
        openedTodos() {
            return this.todos.filter(
                item =>
                    !item.checked && item.title.toLowerCase().includes(this.taskName.toLowerCase()),
            );
        },
        closedTodos() {
            return this.todos.filter(
                item =>
                    item.checked && item.title.toLowerCase().includes(this.taskName.toLowerCase()),
            );
        },
        allTodos() {
            return this.todos.filter(item =>
                item.title.toLowerCase().includes(this.taskName.toLowerCase()),
            );
        },
        filteredTodos() {
            return [
                {
                    tab: 'Открытые',
                    content: this.openedTodos.slice().reverse(),
                },
                {
                    tab: 'Закрытые',
                    content: this.closedTodos.slice().reverse(),
                },
                {
                    tab: 'Все',
                    content: this.allTodos.slice().reverse(),
                },
            ];
        },
    },
    mounted() {
        this.getTodos();
    },
    methods: {
        async getTodos() {
            const result = await axios({ method: 'GET', url: '/api/tasks' });
            this.todos = result.data;
        },
        generateId() {
            return generate('0123456789', 4);
        },
        addNewTask() {
            const id = this.generateId();
            try {
                if (this.taskName.trim().length > 2) {
                    this.todos.push({ id, title: this.taskName, checked: false });
                    this.taskName = '';
                    axios.post('/api/tasks', { id, title: this.taskName });
                }
            } catch {
                this.todos = this.todos.filter(todo => todo.id !== id);
                console.error("Task wasn't added!");
            }
        },
        handleCheckTodo(todo) {
            todo.checked = !todo.checked;
            try {
                axios.post(`/api/tasks/${todo.id}/check`, { checked: !todo.checked });
            } catch {
                todo.checked = !todo.checked;
            }
        },
        handleRemoveTodo(todo) {
            const index = this.todos.findIndex(() => todo);
            try {
                this.todos = this.todos.filter(item => item.id !== todo.id);
                axios({ method: 'GET', url: `/api/tasks/${todo.id}/remove` });
            } catch {
                this.todos.splice(index, 0, todo);
            }
        },
        fliterClosed() {
            this.filterProp = 'Открытые';
        },
        fliterOpened() {
            this.filterProp = 'Закрытые';
        },
        fliterAll() {
            this.filterProp = 'Все';
        },
    },
};
</script>

<style lang="scss">
.todo-list {
    &-header {
        width: 100%;
        padding: 20px 20px 0;

        &__input {
            width: 400px;
            margin: 0 auto;
        }
    }
}
</style>
