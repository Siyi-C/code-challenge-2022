<template>
    <div class="container media">

        <!--update form-->
 
        <!-- image gallery-->
        <div class="image-gallery">
            <div v-for="item in imageGallery" :key="item.id">
                    <div>
                        <p class="media-title">Title:</p>
                        <p>{{item.title}}</p>
                    </div>

                    <div> 
                        <p class="media-des" >Description:</p>
                        <p>{{item.description}}</p>
                    </div> 

                    <img :src="item.image_path" style="margin-top: 10px;" />

                    <div class="editButton">
                        <RouterLink :to="{name: 'ImageEdit', params: {id: item.id}}">Edit</RouterLink>
                    </div>
            </div>
        </div>
    </div> <!-- end of container-->

    <!-- <p @click="toggleModal">Click</p> -->

   
</template>

<script setup>
import EditVue from '../components/Edit.vue';
import useImage from '@/composables/image';
import { onMounted } from 'vue';

const {imageGallery, getImages, getDetails} = useImage();
onMounted(() => getImages())


</script>