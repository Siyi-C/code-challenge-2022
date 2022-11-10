<template>
    <div class="container">
       
        <div class="search-area">
            <h3>Search:</h3>
            <input type="text" placeholder="Search image" v-model="search" />
            <input type="submit"  @click="getImg"/> 
       
        </div>
            <LightBox
            :items="lightbox.items"
            :thumbnails="lightbox.images.thumbnails"
            :largeImages="lightbox.images.largeImages"
            :captions="lightbox.captions"
            :descriptions="lightbox.descriptions"
            class="lightBox"
            />
    </div>
 
</template>

<script>
import axios from 'axios'
import LightBox from './LightBox.vue'


    export default{
        components: {
            LightBox
        } ,
        data(){
            return {
                list:[],
                search: "",
                title:"",
                description:"",
                image_path: "",
                errors:[], 
                isActive: undefined,
                lightbox: {
                    items:[],
                    images: {
                        thumbnails: [],
                        largeImages: [],
                        },  
                    captions: [],
                    descriptions: [],
                },              
                index: null
            }
        },

        methods: {

            changeSelected(index) {
                this.isActive = (index == this.isActive ? undefined : index);
            },

            getImg() {
                axios.get(`https://api.unsplash.com/search/photos?page=1&query=${this.search}&client_id=v2CLzDkWNRJl7uVQkN-LlzXuEpiQwHxK6b7OudCoDpE`)
                .then((res) => {
                    this.list = res.data['results']
                    this.lightbox.items = res.data['results']
                    this.lightbox.images.thumbnails=[]
                    this.lightbox.images.largeImages=[]
                    this.lightbox.captions=[]
                    this.lightbox.descriptions=[]
                    this.list.forEach(e => {
                        this.lightbox.images.thumbnails.push(e.urls.thumb)
                        this.lightbox.images.largeImages.push(e.urls.regular)
                        this.lightbox.captions.push(e.alt_description)
                        this.lightbox.descriptions.push(e.description)
                        // console.log(this.lightbox.descriptions)
                    });
                    // console.log(this.list)
                }).catch(err => console.log(err))
            },

        }        
    }

</script>

