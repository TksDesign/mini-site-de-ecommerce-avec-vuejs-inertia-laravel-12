<script setup>
import { useForm } from '@inertiajs/vue3';
import Container from '../../components/Container.vue';
import InputField from '../../components/InputField.vue';
import PrimaryBtn from '../../components/PrimaryBtn.vue';
import TextLink from '../../components/TextLink.vue';
import Title from '../../components/Title.vue';
import { watch } from 'vue';  // Ajout de l'import de watch
import ErrorMessages from '../../components/ErrorMessages.vue';
import CheckBox from '../../components/CheckBox.vue';
import SessionMessages from '../../components/SessionMessages.vue';
import { route } from '../../../../vendor/tightenco/ziggy/src/js';

defineProps({
    status:String,
    lastEmail:String

})
const form = useForm({
    email: "",
    password: "",
    remember: null
});


// fonnctionn pour gereer le bouton submit

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset("password"),
    })
}

// Surveiller les changements de l'email
watch(() => form.email, (newEmail) => {
    sessionStorage.setItem('lastEmail', newEmail);
});

</script>

<template>
    <Header title=" | Login" />
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <Title>Login to your account</Title>
            <p>Need an account?
                <TextLink routeName="register" label="Register" />
            </p>
        </div>
        <ErrorMessages :errors="form.errors" />
        <SessionMessages :status="status" />
        <form class="space-y-6" @submit.prevent="submit">
            <InputField label="Email" type="email" icon="at" v-model="form.email" placeholder="Tksd@gmail.com" />
            <InputField label="Password" type="password" icon="unlock-keyhole" v-model="form.password" />
            <div class="flex items-center justify-between">
                <div>
                    <CheckBox name="remember" v-model="form.remember">
                        Remember me
                    </CheckBox>
                </div>
                <TextLink routeName="password.request" :params="{email:form.email}" label="Forgot Password ?" />
            </div>
            <PrimaryBtn :disabled="form.processing">Login</PrimaryBtn>
        </form>
    </Container>
</template>