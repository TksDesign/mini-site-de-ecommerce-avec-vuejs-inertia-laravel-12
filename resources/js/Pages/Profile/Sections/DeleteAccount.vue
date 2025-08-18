<script setup>
import { router, useForm } from '@inertiajs/vue3';
import Container from '../../../components/Container.vue';
import InputField from '../../../components/InputField.vue';
import PrimaryBtn from '../../../components/PrimaryBtn.vue';
import Title from '../../../components/Title.vue';
import { route } from '../../../../../vendor/tightenco/ziggy/src/js';
import ErrorMessages from '../../../components/ErrorMessages.vue';
import { ref } from 'vue';

const showConfirmPassword = ref(false)

const form = useForm({
    password: ''
})



const submit = () => {
    form.delete(route('profile.destroy'), {
        onFinish: () => form.reset(),
        preserveScroll: true

    });
}

</script>

<template>
    <Container class="mb-6">
        <div class="mb-6 text-start">
            <Title class="text-red-400">Delete Account</Title>
            <p class="w-1/2">Once your is deleted, all of its resources data
                will be
                permanently deleted. This action cannot be undone.
            </p>

        </div>
        <div v-if="showConfirmPassword">
            <form class="space-y-6" @submit.prevent="submit">
                <InputField label="Confirm Password" icon="key" type="password" class="w-1/2 "
                    v-model="form.password" />
                <ErrorMessages :errors="form.errors" />
                <div class="w-1/6 flex gap-2">
                    <PrimaryBtn :disable="form.processing">Delete</PrimaryBtn>
                    <button @click="showConfirmPassword = false" class=" cursor-pointer">Cancel</button>
                </div>
            </form>
        </div>
        <button v-if="!showConfirmPassword" @click="showConfirmPassword = true"
            class=" mt-2 px-6 py-2 rounded-lg bg-red-500 text-white">
            <i class="fa-solid fa-triangle-exclamation mr-2"></i>
            Delete Account
        </button>
    </Container>
</template>