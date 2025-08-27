<script setup>
import { useForm } from '@inertiajs/vue3';
import Container from '../../components/Container.vue';
import Title from '../../components/Title.vue';
import InputField from '../../components/InputField.vue';
import PrimaryBtn from '../../components/PrimaryBtn.vue';
import TextArea from '../../components/TextArea.vue';
import ErrorMessages from '../../components/ErrorMessages.vue';
import ImageUpload from '../../components/imageUpload.vue';

const props= defineProps({
    listing:Object
})

const form = useForm({
    title: props.listing.title,
    desc: props.listing.desc,
    tags: props.listing.tags || null,
    email: props.listing.email || null,
    link: props.listing.link || null,
    image: null,
    _method:'PUT' //a utiliser lorsqu'on veut soumettre une image avec une methode PUT

})

</script>

<template>
    <Header title=" | edit listing"></Header>
{{ console.log(listing) }}
    <Container>
        <div class="mb-6">
            <Title> Edit de new listing</Title>
        </div>
        <ErrorMessages  :errors="form.errors"/>
        <form @submit.prevent="form.post(route('listing.update', listing.id))" class="grid grid-cols-2 gap-6">
            <div class=" space-y-6">
                <InputField label="Title" icon="heading" :placeholder="listing.title" v-model="form.title" />
                <InputField label="tags (separate with comma)" icon="tags" placeholder="one, two, three"
                    v-model="form.tags" />
                <TextArea label="description" icon="newspaper" placeholder="une petite description" v-model="form.desc"/>
            </div>
            <div class=" space-y-6">
                <InputField label="Email" type="email" icon="at" placeholder="listing@gmail.com" v-model="form.email" />
                <InputField label="External link" icon="up-right-form-square" placeholder="https://example.com"
                    v-model="form.link" />
                    <!-- on passe l'image au formulaire de soumission -->
                <ImageUpload :listingImage="listing.image" @image="(e)=>{ (form.image=e)}"/> 

            </div>
        <div>
            <PrimaryBtn :disabled="form.processing">Update</PrimaryBtn>
        </div>
        </form>
    </Container>
</template>