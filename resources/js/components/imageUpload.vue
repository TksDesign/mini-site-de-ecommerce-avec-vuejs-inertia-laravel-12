<script setup>
import { ref } from 'vue';

// pour envoyer cette image a la class Create.vue
const emit = defineEmits(['image'])

// pour recuperer une image
const props = defineProps({
    listingImage: String
})
const currentImage = props.listingImage ? `/storage/${props.listingImage}` : null

const preview = ref(currentImage)
const oversizedImage = ref(false);
// pour pouvoir retouner a l'image pardefaut
const showRevertBtn = ref(false);
// cette fonction permet de selectionner de changer la valeur du preview qu'on a utiliser dans img
const imageSelect = (e) => {
    preview.value = URL.createObjectURL(e.target.files[0]);
    oversizedImage.value = e.target.files[0].size > 3145728;
    showRevertBtn.value=true
    emit('image', e.target.files[0])
}
// pour revenir a l'image

const reverImageChange=()=>{
    showRevertBtn.value=false
    preview.value=currentImage
    oversizedImage.value=false
      emit('image', null) //pour que si on reviens sur l'iamge par default alors que le emit reviens aussi
}

</script>

<template>
    <div>
        <span class="block text-sm font-medium" :class="oversizedImage ? ' text-red-700' : 'text-slate-700'">
            {{ oversizedImage ? 'The selected image exceeds 3Mb' : ' Image(Max size 3Mb)' }}
        </span>
        <label for="image" class="relative block rounded-md mt-1 bg-slate-300
        h-[140px] overflow-hidden cursor-pointer border-slate-300 border">
            <img :src="preview ?? '/storage/images/listing/default.jpg'" alt="image of Product"
                class=" object-center object-cover h-full w-full ">
            <button v-if="showRevertBtn" @click.prevent="reverImageChange" type="button" class="absolute top-2 right-2 bg-white/75 w-8 h-8
     rounded-full grid place-items-center text-slate-700">
                <i class="fa-solid fa-rotate-left"></i>
            </button>
        </label>

        <input @input="imageSelect" type="file" name="image" id="image" hidden>
    </div>
</template>