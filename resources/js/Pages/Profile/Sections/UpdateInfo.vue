<script setup>
import { router, useForm } from '@inertiajs/vue3';
import Container from '../../../components/Container.vue';
import InputField from '../../../components/InputField.vue';
import PrimaryBtn from '../../../components/PrimaryBtn.vue';
import Title from '../../../components/Title.vue';
import { route } from '../../../../../vendor/tightenco/ziggy/src/js';
import ErrorMessages from '../../../components/ErrorMessages.vue';
import SessionMessages from '../../../components/SessionMessages.vue';


const props = defineProps({
    user: Object,
    status: String
})

const form = useForm({
    name: props.user.name,
    email: props.user.email
})

const resendEmail = (e) => {
    router.post(route('verification.send'), {}, {
        onStart: () => e.target.disabled = true,
        onFinish: () => e.target.disabled = false,
    })
}

// const submit = () => {
//     form.patch(route('profile.info'));
// }

</script>

<template>
    <Container class="mb-6">
        <div class="mb-6 text-start">
            <Title>Update Information</Title>
            <p>Update your account's profile information and email address.</p>
            <ErrorMessages :errors="form.errors" />
        </div>
        <form class="space-y-6" @submit.prevent="form.patch(route('profile.info'))">
            <InputField label="Name" icon="id-badge" class="w-1/2 " v-model="form.name" />
            <InputField label="Email" icon="at" class="w-1/2 " v-model="form.email" />

            <div v-if="user.email_verified_at === null" class="text-center flex flex-col">
                <SessionMessages :status="status" />
                <p class="">Your email address is unverified.</p>
                <button @click="resendEmail" class="text-indigo-500 font-medium dark:text-indigo-400 cursor-pointer 
                underline disabled:text-slate-400 disabled:cursor-wait">Click here to
                    re-send the verification email</button>
            </div>
            <div class=" w-1/2">
                <PrimaryBtn :disable="form.processing">Save</PrimaryBtn>

            </div>
        </form>
    </Container>
</template>