<template>
    <v-app>
        <div class="pa-4">
            <router-link to="/tasks">
                <v-btn color="primary" text>
                    Todos
                </v-btn>
            </router-link>
            |
            <router-link to="/profile">
                <v-btn color="primary" text>
                    Profile
                </v-btn>
            </router-link>
        </div>
        <router-view />
    </v-app>
</template>
