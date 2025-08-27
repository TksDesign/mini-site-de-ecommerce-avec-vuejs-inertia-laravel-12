<script setup>
import { router } from '@inertiajs/vue3';


// pour pouvoir faire des recherche associer
const params = route().params;


defineProps({
    listing: Object
})
//  pour recuper l'id utilisateur
const selectUser = (id) => {
    router.get(route('home'), {
        user_id: id,
        search: params.search,
        tag: params.tag
    });
}

const selectTags = (tag) => {
    router.get(route('home'), {
        user_id: params.user_id,
        search: params.search,
        tag: tag,
    })
}
</script>

<template>
    <div class=" bg-white rounded-lg shadow-lg overflow-hidden
    dark:bg-slate-800 h-full flex flex-col justify-between">
        <div>
            <!-- image -->
            <Link :href="route('listing.show', listing.id)"> <!-- on se dirige en suite dans le listingcontroller show-->
            <img :src="listing.image ? `/storage/${listing.image}` : '/storage/images/listing/default.jpg'"
                alt="image de produit" class="w-full h-48 bg-slate-300 object-cover object-center ">
            </Link>
            <!-- titke  -->
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2">
                    <!-- on diminue le nombre de mot affiche -->
                    {{ listing.title.substring(0, 40) }}...
                </h3>
                <!-- on passe en valeur la date de creation et on la formate avec "toLocaleDateSting"" -->
                <p> Listing on {{ new Date(listing.created_at).toLocaleDateString() }} by
                    <button class="text-link block" @click="selectUser(listing.user.id)">{{
                        listing.user.name.substring(0, 8) }}...</button>
                </p>
            </div>
        </div>
        <!-- tags -->
        <div v-if="listing.tags" class="flex items-center gap-3 px-4 pb-4">
            <div v-for="tag in listing.tags.split(',')" :key="tag">
                <button class="bg-slate-400 text-white text-xs px-2 rounded py-px
                hover:bg-slate-500 dark:hover:bg-slate-900" @click="selectTags(tag)">
                    {{ tag }}
                </button>
            </div>
        </div>
    </div>
</template>