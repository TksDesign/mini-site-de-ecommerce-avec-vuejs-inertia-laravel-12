<script setup>
import { useForm } from '@inertiajs/vue3';
import Container from '../../components/Container.vue';
import InputField from '../../components/InputField.vue';
import PrimaryBtn from '../../components/PrimaryBtn.vue';
import ErrorMessages from '../../components/ErrorMessages.vue';




const form = useForm({
    password: "",
});

// fonnctionn pour gereer le bouton submit

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    })
}

</script>

<template>
    <Header title=" | Password Confirmation" />
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <p>
                This is des secure area. please confirm y
                our password before continuing
            </p>
        </div>
        <ErrorMessages :errors="form.errors" />
        <form class="space-y-6" @submit.prevent="submit">
            <InputField label="Password" type="password" icon="unlock-keyhole" v-model="form.password" />
            <PrimaryBtn :disabled="form.processing">Confirm</PrimaryBtn>
        </form>
    </Container>
</template>