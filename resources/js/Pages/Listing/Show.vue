<script setup>
import Container from '../../components/Container.vue';


defineProps({
    listing: Object,
    user: Object
})
</script>

<template>
    <Header title=" | listing detail "></Header>
    <Container class="flex max-md:flex-col gap-4 items-center overflow-hidden ">
        <div class="relative w-full md:max-w-100 max-md:max-h-40 h-full bg-slate-200 rounded">
            <img :src="listing.image ? `/storage/${listing.image}` : `/storage/images/listing/default.jpg`"
                alt="image du produit"
                class="w-full md:max-w-100 max-md:max-h-40 h-100 object-cover object-center rounded">
            <div class=" absolute bg-black/5 top-0 left-0 w-full h-full rounded"></div>
        </div>
        <div class="w-3/5 flex flex-col item-center justify-start">
            <div class="mb-6">
                <div class="flex items-end justify-between mb-2">
                    <p class="text-slate-400 w-full border-b">
                        listing details
                    </p>
                    <!-- edit and delete -->
                    <div>
                        edit and delete
                    </div>
                </div>

                <h3 class="font-bold text-2xl mb-4"> {{ listing.title }}</h3>

                <p class="whitespace-pre-line">{{ listing.desc }}</p>
                
            </div>
            <!-- conctact info -->
            <div class="mb-6">
                <p class="text-slate-400 w-full mb-2 border-b">
                    Contact info
                </p>
                <div v-if="listing.email" class="flex items-center mb-2 gap-2">
                    <i class="fa-solid fa-at"></i>
                    <p>Email:</p>
                    <a :href="`mailto:${listing.email}`" class=" text-link">{{ listing.email }}</a>

                </div>
                <!-- link -->
                <div v-if="listing.link" class="flex items-center mb-2 gap-2">
                    <i class="fa-solid fa-up-right-from-square"></i>
                    <p>External Link:</p>
                    <a :href="listing.link" target="_blank" class=" text-link ">{{ listing.link.substring(0, 22) }}</a>
                </div>
                <!-- user -->
                <div class="flex items-center mb-2 gap-2">
                    <i class="fa-solid fa-user"></i>
                    <p>Listed by:</p>
                    <Link :href="route('home', { user_id: user.id })" class="text-link">{{ user.name }}</Link>
                </div>
            </div>
            <!-- tags -->
            <div v-if="listing.tags" class="mb-6">
                <p class="text-slate-400 w-full mb-2 border-b">
                    Tags
                </p>
                <div class="flex items-center gap-3">
                    <div v-for="tag in listing.tags.split(',')" key="tag">
                        <Link :href="route('home', { tag })" class="bg-slate-400 text-white text-xs px-2 rounded py-px
                hover:bg-slate-500 dark:hover:bg-slate-900">
                        {{ tag }}
                        </Link>
                        
                    </div>
                </div>
            </div>
        </div>
    </Container>
</template>