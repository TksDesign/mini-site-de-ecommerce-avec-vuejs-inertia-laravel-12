<script setup>
import { ref } from 'vue';

// pour envoyer cette image a la class Create.vue

const emit=defineEmits(['image'])

const preview=ref(null)
const oversizedImage=ref(false);
// cette fonction permet de selectionner de changer la valeur du preview qu'on a utiliser dans img
const imageSelect=(e)=>{
    preview.value=URL.createObjectURL(e.target.files[0]);
    oversizedImage.value=e.target.files[0].size > 3145728;
    emit('image',e.target.files[0])
}

</script>

<template>
    <div>
        <span class="block text-sm font-medium" :class="oversizedImage ? ' text-red-700' :'text-slate-700'">
           {{ oversizedImage ? 'The selected image exceeds 3Mb' : ' Image(Max size 3Mb)' }}
        </span>
        <label for="image" class="block rounded-md mt-1 bg-slate-300
        h-[140px] overflow-hidden cursor-pointer border-slate-300 border">
    <img :src="preview ?? '/storage/images/listing/default.jpg'" alt="image of Product" class=" object-center object-cover h-full w-full "> 
    </label>

        <input @input="imageSelect" type="file" name="image" id="image" hidden>
    </div>
</template>