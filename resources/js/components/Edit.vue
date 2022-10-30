<template>

    <div class="edit-container">
        <form v-on:submit.prevent="editImage($route.params.id)">
            <div>
                <img :src="imageDetail.image_path" style="margin-top: 10px;"/>
            </div>

            <label for="title">Title</label>
            <input type="text" v-model="imageDetail.title"/>

            <label for="desc">Description</label>
            <input type="text" v-model="imageDetail.description"/>

            <input type="submit" value="Update"/>
        </form> 
    </div>
   
</template>

<script setup>
import { onMounted } from 'vue';
import useImage from '../composables/image';

const { imageDetail, editImage, getDetails, errors} = useImage()

const props = defineProps({
    id: {
        required: true,
        type: String
    }
})

onMounted(() => getDetails(props.id))

</script>