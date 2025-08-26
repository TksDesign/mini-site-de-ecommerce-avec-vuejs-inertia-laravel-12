<script setup>
import { ref, watch } from 'vue';
import Card from '../components/Card.vue';
import PaginationLinks from '../components/PaginationLinks.vue';
import { router } from '@inertiajs/vue3';
import { throttle } from 'lodash';


// pour pouvoir faire des recherche associer
const params = route().params;

const props = defineProps({
    listings: Object,
    searchTerm: String
})
const form = ref({
    search: props.searchTerm

});
// recupere le nom de l'utilisateur correspondant a l'id
const username=params.user_id ? props.listings.data.find(i=>i.user_id===Number(params.user_id)).user.name:null;


watch(
    [() => form.value.search,
    () => params.user_id ?? null,
    params.tag ?? null,],

    throttle(([search, userId, tag]) => {
        router.get(route('home'),
            { search: search ?? '', user_id: userId ?? '', tag: tag ?? '' },
            { preserveState: true, preserveScroll: true }
        )
    }, 1000)
)
</script>

<template>
    <Header title=" | Home" />
    <div class="flex flex-col items-center justify-center mb-4 gap-2">
        <div class="w-2/4 mb-4">
            <form @submit.prevent="search">
                <div class="relative mt-1 rounded-md">
                    <div class="pointer-events-none absolute inset-y-0 left-0
                flex items-center pl-3">
                        <span class="grid place-content-center text-sm text-slate-400">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                    </div>
                    <input type="search" name="" placeholder="search..." v-model="form.search" class="block w-full p-6 border rounded-full pr-3 pl-9 text-sm 
                dark:text-slate-900 border-slate-300 outline-0
                focus:ring-1 focus:ring-inset focus:ring-indigo-400
                focus:border-indigo-400 placeholder:text-slate-400 dark:text-white">
                </div>
            </form>
        </div>
        <div class=" flex items-center gap-3">
            <Link v-if="params.tag" :href="route('home', { ...params, tag: null, page: null })"
                class="group p-1 bg-indigo-400 rounded text-white">
            {{ params.tag }}
            <i class="fa-solid fa-xmark text-xs text-slate-300 group-hover:text-white animate-pulse"></i>
            </Link>
            <Link v-if="params.user_id" :href="route('home', { ...params, user_id: null, page: null })"
                class="group p-1 bg-indigo-400 rounded text-white">
            {{ username }}
            <i class="fa-solid fa-xmark text-xs text-slate-300 group-hover:text-white animate-pulse"></i>
            </Link>
        </div>
    </div>
    <div>
        <div v-if="Object.keys(listings.data).length">
            <div class="grid grid-cols-3 gap-4">
                <div v-for="listing in listings.data" :key="listing.id">
                    <Card :listing="listing" />
                </div>
            </div>
            <div class="mt-8">
                <PaginationLinks :paginator="listings" />
            </div>
        </div>
        <div v-else
            class="w-full h-screen flex flex-col text-[clamp(20px,10vw,420px)]  text-teal-950 items-center justify-start mt-30 ml-[clamp(1px,30%,20px)]">
            <div class="flex flex-row gap-12">
                <div class="flex flex-col">
                    <span class=" font-black">Au</span>
                    <span>cun</span>
                </div>
                <div class="flex flex-col">
                    <span>Pro</span>
                    <span class=" font-black">duit??!!</span>
                </div>
            </div>

        </div>
    </div>
</template>