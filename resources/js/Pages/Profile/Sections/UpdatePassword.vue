<script setup>
import { useForm } from '@inertiajs/vue3';
import Container from '../../../components/Container.vue';
import InputField from '../../../components/InputField.vue';
import PrimaryBtn from '../../../components/PrimaryBtn.vue';
import Title from '../../../components/Title.vue';
import { route } from '../../../../../vendor/tightenco/ziggy/src/js';
import ErrorMessages from '../../../components/ErrorMessages.vue';



const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: ''
})

const submit = () => {
    form.put(route('profile.password'), {
        onSuccess: () => form.reset(),
        preserveScroll: true //pour preserver le scroll
    })

}

</script>

<template>
    <Container class="mb-6">
        <div class="mb-6 text-start">
            <Title>Update password</Title>
            <p>Ensure your are using a long, random password to stay secure.</p>
            <ErrorMessages :errors="form.errors" />
        </div>
        <form class="space-y-6" @submit.prevent="submit">
            <InputField label="Current password" icon="key" type="password" class="w-1/2 "
                v-model="form.current_password" />
            <InputField label="Nouveau password" icon="key" type="password" class="w-1/2 "
                v-model="form.password" />
            <InputField label="confirm new password" icon="key" type="password" class="w-1/2"
                v-model="form.password_confirmation" />
            <p v-if="form.recentlySuccessful === true" class="text-center text-green-500">Saved!</p>
            <div class="w-1/5">
                <PrimaryBtn :disable="form.processing">Save</PrimaryBtn>
            </div>

        </form>
    </Container>
</template>