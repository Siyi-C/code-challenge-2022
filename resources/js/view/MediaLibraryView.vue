<template>
    <div class="container media">
        <ul class="image-gallery">
            <div v-for="item in imageGallery" :key="item.id">
               
                <li>
                    <div>
                        <p class="media-title">Title:</p>
                        <p>{{item.title}}</p>
                    </div>

                    <div> 
                        <p class="media-des" >Description:</p>
                        <p>{{item.description}}</p>
                    </div> 
                    
                    <img :src="item.image_path" style="margin-top: 10px;"/>

                    <div class="editButton">
                        <RouterLink  :to="{name: 'ImageEdit', params: {id: item.id}}">Edit</RouterLink>
                    </div>

                </li>
            </div>
        </ul>
    </div>
    
</template>

<script setup>
import useImage from '@/composables/image';
import { onMounted } from 'vue';

const {imageGallery, getImages} = useImage();


onMounted(() => getImages())

</script>