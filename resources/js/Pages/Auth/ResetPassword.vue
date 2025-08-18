<script setup>
import { useForm } from '@inertiajs/vue3';
import Container from '../../components/Container.vue';
import InputField from '../../components/InputField.vue';
import PrimaryBtn from '../../components/PrimaryBtn.vue';
import Title from '../../components/Title.vue';
import ErrorMessages from '../../components/ErrorMessages.vue';


const props=defineProps({
    token:String,
    email:String,
})

const form=useForm({
    token:props.token,
    email:props.email,
    password:"",
    password_confirmation:"",
});

// fonnctionn pour gereer le bouton submit

const submit=()=>{
    form.post(route('password.update'),{
        onFinish:()=>form.reset("password_confirmation")
    })
}

</script>

<template>
    <Header title=" | Reset Password"/>
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <Title>Enter your new password</Title>
        </div>
        <ErrorMessages :errors="form.errors"/>
        <form class="space-y-6" @submit.prevent="submit">
            <InputField label="Email" type="email" icon="at" v-model="form.email"/>
            <InputField label="Password" type="password" icon="key" v-model="form.password"/>
            <InputField label="Confirm Password" type="password" icon="unlock-keyhole" v-model="form.password_confirmation"/>
            <PrimaryBtn :disabled="form.processing">Reset password</PrimaryBtn>
        </form>
    </Container>
</template>