<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    paginator: Object
})
const makeLabel = (label) => {
    if (label == '&laquo; Previous') {
        return '<<'
    }
    if (label == 'Next &raquo;') {
        return '>>'
    }
    return label
}
</script>

<template>
    <div class="flex justify-between">
        <div>
            <template v-for="(link,i) in paginator.links" :key="link.i">
                <span v-if="!link.url" v-html="makeLabel(link.label)" class="text-gray-400"></span>
                <Link v-else :href="link.url" v-html="makeLabel(link.label)"
                    :class="{ 'text-slate-800 font-bold': link.active }" class=" p-2 " :preserve-scroll="true" />
            </template>
        </div>
    </div>
</template>