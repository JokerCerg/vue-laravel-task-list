<template>
    <div class="todo-item">
        <input
            type="checkbox"
            :checked="todo.checked"
            @click.prevent="$emit('handleCheckTodo')"
            class="todo-item__checkbox"
        />
        <v-card-text class="text-uppercase" :class="checked">
            {{ todo.title }}
        </v-card-text>
        <div @click="$emit('handleRemoveTodo')" class="todo-item-btn">
            <button class="todo-item-btn__close">&times;</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'TodoItem',
    props: {
        todo: {
            type: Object,
            required: true,
        },
    },
    computed: {
        checked() {
            return this.todo.checked ? 'text--disabled' : null;
        },
    },
};
</script>

<style lang="scss">
.todo-item {
    display: flex;
    justify-content: space-between;
    align-items: center;

    &-btn {
        position: relative;
        width: 30px;
        height: 30px;

        &__close {
            position: absolute;
            left: 0;
            right: 0;
            vertical-align: middle;
            display: none;
            border: none;
            background: none;
            cursor: pointer;
            padding: 0;
            margin: 0 auto;
            line-height: 30px;
            font-size: 20px;
            color: #bd2130;
        }
    }

    &:hover {
        .todo-item-btn__close {
            display: inline;
        }
    }

    &__checkbox {
        margin: 0;
    }

    &__title {
        font-size: 18px;
        flex-basis: 100%;
        cursor: pointer;
        max-width: 350px;
    }
}
</style>
