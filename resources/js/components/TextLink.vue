<script setup>
defineProps({
    routeName: String,
    label: String,
    params:Object
})
</script>

<template>
    <Link :href="route(routeName ,params)" class="text-indigo-500 hover:text-indigo-600 font-medium
                dark:text-indigo-400 dark:hover:text-indigo-500 border-b-1">{{ label }}</Link>
</template>