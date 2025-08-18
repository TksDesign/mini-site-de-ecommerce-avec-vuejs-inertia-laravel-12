<script setup>
import { useForm } from '@inertiajs/vue3';
import Container from '../../components/Container.vue';
import PrimaryBtn from '../../components/PrimaryBtn.vue';
import { route } from '../../../../vendor/tightenco/ziggy/src/js';
import SessionMessages from '../../components/SessionMessages.vue';


const props = defineProps({
    status: String,
});
const form = useForm();
const submit = () => {
    form.post(route('verification.send'))
}
</script>

<template>
    <Header title=" | Email verification" />
    <Container class="w-1/2">
        <div class="mb-8">
            <p>
                Thanks for signing up! Before getting started, could you verify
                your email adress
            </p>
            <SessionMessages :status="status" class="mt-8" />
        </div>
        <form @submit.prevent="submit">
            <PrimaryBtn :disabled="form.processing">resent verification email</PrimaryBtn>
        </form>
    </Container>
</template>