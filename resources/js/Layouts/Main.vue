<script setup>
import { switchThem } from '../them';
import NavLink from '../components/NavLink.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { route } from '../../../vendor/tightenco/ziggy/src/js';

// hook innertia recupere les props pour l'envoyer cote frontend
const page = usePage();
const user = computed(() => page.props.auth.user);

const show = ref(false);

</script>
<template>
    <!--overlay-->
    <!--lorsqu'onn va cliquer sur le boutton alors cette div va apparaitre -->
    <div v-show="show" @click="show = false" class="fixed inset-0 z-40"></div>
    <header class="bg-slate-800 text-white">
        <nav class="p-6 mx-auto max-w-screen-lg flex items-center justify-between">
            <NavLink routeName="home" componentName="Home">Home</NavLink>

            <div class="flex items-center space-x-6">
                <!----------- Auth ----------->
                <div v-if="user" class="relative">
                    <div @click="show = !show" class="flex items-center gap-2 px-3 py-1
                    rounded-lg hover:bg-slate-700 cursor-pointer">
                        <p>{{ user.name }}</p>
                        <i class="fa-solid fa-angle-down"></i>
                        <!----------- drop down menu LOGOUT ----------->
                        <div v-show="show" class="absolute z-50 top-15 left-0 right-0 bg-slate-800
                text-white rounded-lg border-slate-700 border overflow-hidden w-40 ">
                            <Link :href="route('profile.edit')" class="block w-full p-4
                            hover:bg-slate-700 text-left">Profile</Link>
                            <Link :href="route('dashboard')" class="block w-full p-4
                            hover:bg-slate-700 text-left">Dashboard</Link>
                            <!-- le as bouton signifie qu'on veux l'ouvrir sur une autre page -->
                            <Link :href="route('logout')" method="post" as="bouton" class="w-full p-4
                            hover:bg-slate-700 text-left">Logout</Link>
                        </div>
                    </div>
                </div>
                <!----------- guest ----------->
                <div v-else>
                    <NavLink routeName="register" componentName="Auth/Register">Register</NavLink>
                    <NavLink routeName="login" componentName="Auth/Login">Login</NavLink>
                </div>
                <button @click="switchThem" class="hover:bg-slate-700 w-6 h-6 grid 
                place-items-center rounded-full hover:outline-1 outline-white">
                    <i class="fa-solid fa-circle-half-stroke"></i>
                </button>
            </div>
        </nav>
    </header>
    <main class="p-6 mx-auto max-w-screen-lg">
        <slot />
    </main>
</template>