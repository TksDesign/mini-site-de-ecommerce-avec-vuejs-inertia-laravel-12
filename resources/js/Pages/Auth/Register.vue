<script setup>
import { useForm } from '@inertiajs/vue3';
import Container from '../../components/Container.vue';
import InputField from '../../components/InputField.vue';
import PrimaryBtn from '../../components/PrimaryBtn.vue';
import TextLink from '../../components/TextLink.vue';
import Title from '../../components/Title.vue';
import ErrorMessages from '../../components/ErrorMessages.vue';

const form=useForm({
    name:"",
    email:"",
    password:"",
    password_confirmation:"",
});

// fonnctionn pour gereer le bouton submit

const submit=()=>{
    form.post(route('register'),{
        onFinish:()=>form.reset("password","password_confirmation"),
    })
}

</script>

<template>
    <Header title=" | Register"/>
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <Title>Register a new account</Title>
            <p>Already have an account? <TextLink routeName="login" label="Login"/>
            </p>
        </div>
        <ErrorMessages :errors="form.errors"/>
        <form class="space-y-6" @submit.prevent="submit">
            <InputField label="Name" icon="user" v-model="form.name" placeholder="Daphane"/>
            <InputField label="Email" type="email" icon="at" v-model="form.email" placeholder="Tksd@gmail.com"/>
            <InputField label="Password" type="password" icon="key" v-model="form.password"/>
            <InputField label="Confirm Password" type="password" icon="unlock-keyhole" v-model="form.password_confirmation"/>
            <p class="text-slate-500 text-sm dark:text-slate-400">
                by creating an account, you agree to our Terms of 
                Service and 
                privacy Policy
            </p>
            <PrimaryBtn :disabled="form.processing">Register</PrimaryBtn>
        </form>
    </Container>
</template>