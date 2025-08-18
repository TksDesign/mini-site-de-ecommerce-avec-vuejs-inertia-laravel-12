<script setup>
import { useForm } from '@inertiajs/vue3';
import Container from '../../components/Container.vue';
import InputField from '../../components/InputField.vue';
import { onMounted } from 'vue'; 
import PrimaryBtn from '../../components/PrimaryBtn.vue';
import ErrorMessages from '../../components/ErrorMessages.vue';
import SessionMessages from '../../components/SessionMessages.vue';

const props = defineProps({
    lastEmail: String,
    status: String
})
const form = useForm({
    email: sessionStorage.getItem('lastEmail') ||''
});

// fonnctionn pour gereer le bouton submit

const submit = () => {
    form.post(route('password.email'))
}

// Nettoyer le stockage après utilisation
onMounted(() => {
    sessionStorage.removeItem('lastEmail');
});

</script>

<template>
    <Header title=" | Forgot-password" />
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <p>
                Forgot your password? No problem. juste let us know your email
                adress and we will email you a password reset linnk that will
                alllow yo to choose a new one
            </p>
        </div>
        <ErrorMessages :errors="form.errors" />
        <SessionMessages :status="status" />

        <form class="space-y-6" @submit.prevent="submit">
            <InputField label="Email" type="email" icon="at" v-model="form.email" placeholder="Tksd@gmail.com" />
            <PrimaryBtn :disabled="form.processing">Send password Rest Link</PrimaryBtn>
        </form>
    </Container>
</template>